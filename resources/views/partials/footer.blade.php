<footer class="site-footer">
    <div class="marquee" aria-hidden="true">
        <div class="marquee__track">
            @for ($copy = 0; $copy < 2; $copy++)
                <div class="marquee__group">
                    <span>Let's work together</span>
                    <span class="marquee__sep">✳</span>
                    <span>Open to opportunities</span>
                    <span class="marquee__sep">✳</span>
                    <span>Information management</span>
                    <span class="marquee__sep">✳</span>
                    <span>{{ config('portfolio.location') }}</span>
                    <span class="marquee__sep">✳</span>
                </div>
            @endfor
        </div>
    </div>

    <div class="shell site-footer__grid">
        <div>
            <span class="index-tag">05 / Contact</span>
            <a class="footer-email" href="mailto:{{ config('portfolio.email') }}">{{ config('portfolio.email') }}</a>
            <p class="mono-label" style="margin-top: 1.1rem; color: var(--fg-muted);">
                {{ config('portfolio.affiliation.name') }}
            </p>
        </div>

        <nav class="footer-col" aria-label="Footer">
            <h3>Index</h3>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#profile">Profile</a>
            <a href="{{ route('home') }}#education">Education</a>
            <a href="{{ route('experience') }}">Experience</a>
            <a href="{{ route('projects') }}">Work</a>
        </nav>

        <div class="footer-col">
            <h3>Elsewhere</h3>
            @foreach (config('portfolio.social') as $social)
                <a href="{{ $social['url'] }}" @if (!str_starts_with($social['url'], 'mailto:')) target="_blank" rel="noopener noreferrer" @endif>
                    {{ $social['label'] }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="shell footer-bottom">
        <span>© {{ now()->year }} {{ config('portfolio.name') }}</span>
        <span>
            Local time <strong data-clock>--:--:--</strong> · PHT
        </span>
        <span>
            <a href="#top">Back to top ↑</a>
        </span>
    </div>
</footer>
