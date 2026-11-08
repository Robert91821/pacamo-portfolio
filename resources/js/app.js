/*
 * SIGNAL — editorial brutalism interaction layer.
 * Scroll reveals, custom cursor, magnetic controls, tilt, progress,
 * mobile menu, theme toggle and a live local clock.
 */

const root = document.documentElement;

const ready = (fn) => {
    if (document.readyState !== 'loading') {
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn);
    }
};

ready(() => {
    /* ---------------------------------------------------------------------
     * Theme toggle (dark is the default; light is the alternate "paper" mode)
     * ------------------------------------------------------------------ */
    const themeToggle = document.querySelector('[data-theme-toggle]');
    const themeLabel = document.querySelector('[data-theme-label]');

    if (themeToggle) {
        const syncTheme = () => {
            const isDark = root.classList.contains('dark');
            themeToggle.setAttribute('aria-pressed', String(isDark));
            themeToggle.setAttribute(
                'aria-label',
                isDark ? 'Switch to light appearance' : 'Switch to dark appearance'
            );
            if (themeLabel) {
                themeLabel.textContent = isDark ? 'Dark' : 'Light';
            }
        };

        syncTheme();

        themeToggle.addEventListener('click', () => {
            const isDark = root.classList.toggle('dark');
            localStorage.setItem('hb-theme', isDark ? 'dark' : 'light');
            syncTheme();
        });
    }

    /* ---------------------------------------------------------------------
     * Mobile menu
     * ------------------------------------------------------------------ */
    const menuToggle = document.querySelector('[data-menu-toggle]');
    const menu = document.querySelector('[data-menu]');
    const menuLabel = document.querySelector('[data-menu-label]');

    if (menuToggle && menu) {
        const setMenu = (open) => {
            root.classList.toggle('menu-open', open);
            menuToggle.setAttribute('aria-expanded', String(open));
            menu.setAttribute('aria-hidden', String(!open));
            if (menuLabel) {
                menuLabel.textContent = open ? 'Close' : 'Menu';
            }
        };

        setMenu(false);

        menuToggle.addEventListener('click', () => {
            setMenu(!root.classList.contains('menu-open'));
        });

        menu.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => setMenu(false));
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                setMenu(false);
            }
        });
    }

    /* ---------------------------------------------------------------------
     * Scroll progress, header state and parallax
     * ------------------------------------------------------------------ */
    const header = document.querySelector('[data-header]');
    const progress = document.querySelector('[data-progress]');
    const parallaxItems = Array.from(document.querySelectorAll('[data-parallax]'));

    const onScroll = () => {
        const y = window.scrollY;

        if (header) {
            header.classList.toggle('is-scrolled', y > 24);
        }

        if (progress) {
            const max = document.documentElement.scrollHeight - window.innerHeight;
            progress.style.transform = `scaleX(${max > 0 ? Math.min(y / max, 1) : 0})`;
        }

        parallaxItems.forEach((item) => {
            const speed = parseFloat(item.dataset.parallax) || 0.12;
            const rect = item.getBoundingClientRect();
            const offset = rect.top + rect.height / 2 - window.innerHeight / 2;
            item.style.transform = `translate3d(0, ${offset * -speed}px, 0)`;
        });
    };

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);

    /* ---------------------------------------------------------------------
     * Scroll reveals
     * ------------------------------------------------------------------ */
    const revealItems = Array.from(document.querySelectorAll('[data-reveal]'));

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-in');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.12, rootMargin: '0px 0px -8% 0px' }
        );

        revealItems.forEach((item, index) => {
            if (!item.style.getPropertyValue('--reveal-delay')) {
                item.style.setProperty('--reveal-delay', String((index % 8) * 65));
            }
            observer.observe(item);
        });
    } else {
        revealItems.forEach((item) => item.classList.add('is-in'));
    }

    /* ---------------------------------------------------------------------
     * Custom cursor
     * ------------------------------------------------------------------ */
    const dot = document.querySelector('[data-cursor-dot]');
    const ring = document.querySelector('[data-cursor-ring]');

    if (dot && ring && window.matchMedia('(pointer: fine)').matches) {
        root.classList.add('has-cursor');

        let mouseX = window.innerWidth / 2;
        let mouseY = window.innerHeight / 2;
        let ringX = mouseX;
        let ringY = mouseY;

        window.addEventListener('mousemove', (event) => {
            mouseX = event.clientX;
            mouseY = event.clientY;
        });

        const renderCursor = () => {
            ringX += (mouseX - ringX) * 0.16;
            ringY += (mouseY - ringY) * 0.16;
            dot.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0)`;
            ring.style.transform = `translate3d(${ringX}px, ${ringY}px, 0)`;
            requestAnimationFrame(renderCursor);
        };

        renderCursor();

        document.querySelectorAll('a, button, [data-cursor-grow]').forEach((element) => {
            element.addEventListener('mouseenter', () => root.classList.add('cursor-active'));
            element.addEventListener('mouseleave', () => root.classList.remove('cursor-active'));
        });
    }

    /* ---------------------------------------------------------------------
     * Magnetic buttons
     * ------------------------------------------------------------------ */
    document.querySelectorAll('[data-magnetic]').forEach((element) => {
        element.addEventListener('mousemove', (event) => {
            const rect = element.getBoundingClientRect();
            const x = event.clientX - rect.left - rect.width / 2;
            const y = event.clientY - rect.top - rect.height / 2;
            element.style.transform = `translate(${x * 0.16}px, ${y * 0.26}px)`;
        });

        element.addEventListener('mouseleave', () => {
            element.style.transform = '';
        });
    });

    /* ---------------------------------------------------------------------
     * Tilt surfaces
     * ------------------------------------------------------------------ */
    document.querySelectorAll('[data-tilt]').forEach((element) => {
        element.addEventListener('mousemove', (event) => {
            const rect = element.getBoundingClientRect();
            const px = (event.clientX - rect.left) / rect.width - 0.5;
            const py = (event.clientY - rect.top) / rect.height - 0.5;
            element.style.transform = `perspective(900px) rotateY(${px * 9}deg) rotateX(${py * -9}deg)`;
        });

        element.addEventListener('mouseleave', () => {
            element.style.transform = '';
        });
    });

    /* ---------------------------------------------------------------------
     * Live local clock (Asia/Manila)
     * ------------------------------------------------------------------ */
    const clock = document.querySelector('[data-clock]');

    if (clock) {
        const formatter = new Intl.DateTimeFormat('en-PH', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false,
            timeZone: 'Asia/Manila',
        });

        const tick = () => {
            clock.textContent = formatter.format(new Date());
        };

        tick();
        setInterval(tick, 1000);
    }
});
