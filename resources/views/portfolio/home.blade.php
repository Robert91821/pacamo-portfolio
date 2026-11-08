@extends('layouts.app')

@section('title', config('portfolio.site_name'))

@php
    $experienceCount = count(config('portfolio.experience'));
    $educationCount = count(config('portfolio.education'));
    $languageCount = count(config('portfolio.languages'));
    $skillCount = collect(config('portfolio.skills'))->sum(fn ($group) => count($group['items']));
@endphp

@section('content')
    {{-- ============================================================
         Hero
    ============================================================== --}}
    <section class="hero" id="bio">
        <div class="hero__grid" aria-hidden="true"></div>
        <div class="hero__glow" aria-hidden="true"></div>

        <div class="shell hero__inner">
            <div class="hero__top">
                <span class="mono-label">Portfolio — 2026</span>
                <span class="mono-label">Information Technology / {{ config('portfolio.location') }}</span>
                <span class="mono-label"><span class="accent-dot" aria-hidden="true"></span>Open to opportunities</span>
            </div>

            <h1 class="display hero__title">
                <span class="hero__line">
                    <span class="hero__word" data-reveal="mask" style="--reveal-delay: 80;">John<wbr>Robert</span>
                </span>
                <span class="hero__line hero__line--right">
                    <span class="hero__word outline-text" data-reveal="mask" style="--reveal-delay: 220;">Pacamo</span>
                    <span class="hero__asterisk" aria-hidden="true">✳</span>
                </span>
            </h1>

            <div class="hero__foot">
                <div data-reveal style="--reveal-delay: 320;">
                    <p class="mono-label" style="color: var(--acid-text);">{{ config('portfolio.role') }}</p>
                    <p class="hero__lede">
                        A fourth-year IT student turning information into organised, usable systems.
                    </p>
                </div>

                <div class="portrait" data-tilt data-reveal style="--reveal-delay: 380;">
                    <div class="portrait__frame">
                        <img
                            src="{{ asset(config('portfolio.avatar')) }}"
                            alt="Portrait of {{ config('portfolio.name') }}"
                            width="290"
                            height="290"
                            fetchpriority="high"
                        >
                    </div>
                    <span class="portrait__tag">Est. 2023 — Present</span>
                </div>

                <div class="hero__cta" data-reveal style="--reveal-delay: 440;">
                    <a class="btn btn--acid" data-magnetic href="#contact">
                        Start a conversation <span aria-hidden="true">↗</span>
                    </a>
                    <a class="btn btn--ghost" data-magnetic href="{{ route('experience') }}">
                        View experience <span aria-hidden="true">↗</span>
                    </a>
                    <span class="scroll-cue">
                        <span class="scroll-cue__line" aria-hidden="true"></span>
                        Scroll to explore
                    </span>
                </div>
            </div>
        </div>

        <div class="marquee hero__marquee" aria-hidden="true">
            <div class="marquee__track">
                @for ($copy = 0; $copy < 2; $copy++)
                    <div class="marquee__group">
                        <span>Information Technology</span>
                        <span class="marquee__sep">✳</span>
                        <span>OJT Library Intern</span>
                        <span class="marquee__sep">✳</span>
                        <span>Information Management</span>
                        <span class="marquee__sep">✳</span>
                        <span>Online Safety &amp; Netiquette</span>
                        <span class="marquee__sep">✳</span>
                        <span>{{ config('portfolio.affiliation.name') }}</span>
                        <span class="marquee__sep">✳</span>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- ============================================================
         Profile
    ============================================================== --}}
    <section class="section" id="profile">
        <div class="shell statement">
            <aside class="statement__aside" data-reveal>
                <span class="index-tag">01 / Profile</span>
                <span class="mono-label">Based in {{ config('portfolio.location') }}</span>
                <span class="mono-label">{{ config('portfolio.pronouns') }}</span>
            </aside>

            <div>
                <p class="statement__text" data-reveal="mask">
                    {{ config('portfolio.bio.0') }}
                </p>

                <div class="stat-grid" data-reveal style="--reveal-delay: 120;">
                    <div class="stat">
                        <span class="stat__num">{{ str_pad($experienceCount, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="stat__label">Active role</span>
                    </div>
                    <div class="stat">
                        <span class="stat__num">{{ str_pad($educationCount, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="stat__label">Study stages</span>
                    </div>
                    <div class="stat">
                        <span class="stat__num">{{ str_pad($skillCount, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="stat__label">Core skills</span>
                    </div>
                    <div class="stat">
                        <span class="stat__num">{{ str_pad($languageCount, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="stat__label">Languages</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         Education
    ============================================================== --}}
    <section class="section" id="education">
        <div class="shell">
            <header class="section-head">
                <div data-reveal>
                    <span class="index-tag">02 / Education</span>
                    <h2 class="display section-title" style="margin-top: 1rem;">
                        Academic<br><span class="outline-text">record</span>
                    </h2>
                </div>
                <p class="mono-label" style="max-width: 24ch; color: var(--fg-muted);">
                    Formal training across information technology and senior secondary education.
                </p>
            </header>

            <ol class="edu-list">
                @foreach (config('portfolio.education') as $edu)
                    <li class="edu-row" data-reveal style="--reveal-delay: {{ $loop->index * 90 }};">
                        <span class="edu-row__index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="edu-row__years">{{ $edu['start'] }}—{{ $edu['end'] ?? 'Now' }}</span>
                        <span class="edu-row__degree">{{ $edu['degree'] }}</span>
                        <span class="edu-row__school">{{ $edu['institution'] }}</span>
                        <span class="edu-row__arrow" aria-hidden="true">↗</span>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- ============================================================
         Interests
    ============================================================== --}}
    <section class="section section--tight">
        <div class="shell">
            <span class="index-tag" data-reveal>03 / Interests</span>
        </div>

        <div class="marquee marquee--display interests-marquee" style="margin-top: clamp(2rem, 4vw, 3rem);">
            <div class="marquee__track">
                @for ($copy = 0; $copy < 2; $copy++)
                    <div class="marquee__group">
                        @foreach (config('portfolio.interests') as $interest)
                            <span class="marquee__word {{ $loop->even ? 'outline-text' : '' }}">{{ $interest }}</span>
                            <span class="marquee__sep" aria-hidden="true">✳</span>
                        @endforeach
                    </div>
                @endfor
            </div>
        </div>

        <div class="shell">
            <div class="tag-row">
                @foreach (config('portfolio.interests') as $interest)
                    <span class="tag" data-reveal style="--reveal-delay: {{ $loop->index * 70 }};">{{ $interest }}</span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         Contact
    ============================================================== --}}
    <section class="section section--contact" id="contact">
        <div class="shell">
            <span class="index-tag" data-reveal>04 / Contact</span>

            <h2 class="display contact__title" data-reveal="mask">
                Let's make<br>
                information<br>
                <span class="outline-text">matter.</span>
            </h2>

            <div class="contact__row">
                <div data-reveal>
                    <a class="contact__email" data-magnetic href="mailto:{{ config('portfolio.email') }}">
                        {{ config('portfolio.email') }}
                        <span aria-hidden="true">↗</span>
                    </a>
                    <p class="mono-label" style="margin-top: 1.1rem; max-width: 34ch;">
                        Open to opportunities in IT, information management, and library operations.
                    </p>
                </div>

                <nav class="social-links" aria-label="Social links" data-reveal style="--reveal-delay: 120;">
                    @foreach (config('portfolio.social') as $social)
                        <a class="social-link"
                            href="{{ $social['url'] }}"
                            @if (!str_starts_with($social['url'], 'mailto:')) target="_blank" rel="noopener noreferrer" @endif>
                            <i class="{{ $social['icon'] }}" aria-hidden="true"></i>
                            {{ $social['label'] }}
                            <span class="social-link__arrow" aria-hidden="true">↗</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        </div>
    </section>
@endsection
