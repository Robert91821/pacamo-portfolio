<header class="site-header" data-header>
    <div class="site-header__bar shell">
        <a class="brand" href="{{ route('home') }}" aria-label="{{ config('portfolio.site_name') }} — home">
            <span class="brand__mark" aria-hidden="true">JP</span>
            <span class="brand__text">
                <span class="brand__name">{{ config('portfolio.site_name') }}</span>
                <span class="brand__role">{{ config('portfolio.role') }}</span>
            </span>
        </a>

        <nav class="nav-desktop" aria-label="Primary">
            <a class="nav-link {{ Request::routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}">
                <span>01</span>Index
            </a>
            <a class="nav-link" href="{{ route('home') }}#profile">
                <span>02</span>Profile
            </a>
            <a class="nav-link {{ Request::routeIs('experience') ? 'is-active' : '' }}" href="{{ route('experience') }}">
                <span>03</span>Experience
            </a>
            <a class="nav-link {{ Request::routeIs('projects') ? 'is-active' : '' }}" href="{{ route('projects') }}">
                <span>04</span>Work
            </a>
        </nav>

        <div class="header-tools">
            <span class="status">
                <span class="status__dot" aria-hidden="true"></span>
                <span class="status__label">Open to opportunities</span>
            </span>

            <button type="button" class="theme-toggle" data-theme-toggle aria-pressed="true" aria-label="Switch to light appearance">
                <span class="theme-toggle__track" aria-hidden="true">
                    <span class="theme-toggle__thumb"></span>
                </span>
                <span class="theme-toggle__label" data-theme-label>Dark</span>
            </button>

            <button type="button" class="menu-toggle" data-menu-toggle aria-expanded="false" aria-controls="mobile-menu">
                <span data-menu-label>Menu</span>
                <span class="menu-toggle__bars" aria-hidden="true">
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>
    </div>

    <div class="menu-overlay" id="mobile-menu" data-menu aria-hidden="true">
        <nav class="menu-overlay__nav" aria-label="Mobile">
            <a class="menu-overlay__link" href="{{ route('home') }}">
                <span>01</span>Index
            </a>
            <a class="menu-overlay__link" href="{{ route('home') }}#profile">
                <span>02</span>Profile
            </a>
            <a class="menu-overlay__link" href="{{ route('experience') }}">
                <span>03</span>Experience
            </a>
            <a class="menu-overlay__link" href="{{ route('projects') }}">
                <span>04</span>Work
            </a>
            <a class="menu-overlay__link" href="{{ route('home') }}#contact">
                <span>05</span>Contact
            </a>
        </nav>

        <div class="menu-overlay__foot">
            <a class="footer-email" href="mailto:{{ config('portfolio.email') }}">{{ config('portfolio.email') }}</a>
            <div class="menu-overlay__socials">
                @foreach (config('portfolio.social') as $social)
                    <a href="{{ $social['url'] }}" @if (!str_starts_with($social['url'], 'mailto:')) target="_blank" rel="noopener noreferrer" @endif>
                        {{ $social['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</header>
