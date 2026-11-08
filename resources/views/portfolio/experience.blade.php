@extends('layouts.app')

@section('title', 'Experience — ' . config('portfolio.site_name'))

@section('content')
    <header class="page-hero">
        <div class="shell">
            <span class="index-tag" data-reveal>Index / 03</span>
            <h1 class="display page-hero__title" style="margin-top: 1.25rem;" data-reveal="mask">
                Work<br><span class="outline-text">experience</span>
            </h1>
            <div class="page-hero__meta" data-reveal style="--reveal-delay: 120;">
                <span class="mono-label">Roles, skills, recognition &amp; languages</span>
                <span class="mono-label">{{ config('portfolio.affiliation.name') }}</span>
            </div>
        </div>
    </header>

    {{-- ============================================================
         Timeline
    ============================================================== --}}
    <section class="section" id="timeline">
        <div class="shell">
            <header class="section-head">
                <div data-reveal>
                    <span class="index-tag">01 / Timeline</span>
                    <h2 class="display section-title" style="margin-top: 1rem;">Roles</h2>
                </div>
                <p class="mono-label" style="max-width: 26ch; color: var(--fg-muted);">
                    Applied experience in information management and day-to-day library operations.
                </p>
            </header>

            <ol class="timeline">
                @foreach (config('portfolio.experience') as $exp)
                    @php
                        $startLabel = \Carbon\Carbon::parse($exp['start'] . '-01')->format('M Y');
                        $endLabel = $exp['end'] ? \Carbon\Carbon::parse($exp['end'] . '-01')->format('M Y') : 'Present';
                    @endphp
                    <li class="timeline__item" data-reveal style="--reveal-delay: {{ $loop->index * 100 }};">
                        <div class="timeline__year">
                            {{ \Carbon\Carbon::parse($exp['start'] . '-01')->format('Y') }}
                            <span>{{ $startLabel }} — {{ $endLabel }}</span>
                        </div>
                        <div class="timeline__rail" aria-hidden="true">
                            <span class="timeline__dot"></span>
                        </div>
                        <div>
                            <span class="mono-label">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} / Role</span>
                            <h3 class="timeline__role" style="margin-top: 0.65rem;">{{ $exp['role'] }}</h3>
                            <p class="timeline__org">{{ $exp['org'] }}</p>
                            <p class="timeline__summary">{{ $exp['summary'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- ============================================================
         Capabilities
    ============================================================== --}}
    <section class="section" id="capabilities">
        <div class="shell">
            <header class="section-head">
                <div data-reveal>
                    <span class="index-tag">02 / Capabilities</span>
                    <h2 class="display section-title" style="margin-top: 1rem;">
                        Skills<br><span class="outline-text">&amp; hobbies</span>
                    </h2>
                </div>
            </header>

            <div class="skills-grid">
                @foreach (config('portfolio.skills') as $skillGroup)
                    <div class="skill-card" data-reveal style="--reveal-delay: {{ $loop->index * 100 }};">
                        <h3 class="skill-card__title">{{ $skillGroup['name'] }}</h3>
                        <ul class="skill-list">
                            @foreach ($skillGroup['items'] as $skill)
                                <li>
                                    <div class="skill__head">
                                        <span>{{ $skill['label'] }}</span>
                                        <span>{{ $skill['level'] }}/5</span>
                                    </div>
                                    <div class="skill__track" role="img" aria-label="{{ $skill['label'] }}: {{ $skill['level'] }} out of 5">
                                        <span class="skill__fill" style="--level: {{ $skill['level'] / 5 * 100 }}%;"></span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         Recognition
    ============================================================== --}}
    <section class="section" id="recognition">
        <div class="shell">
            <header class="section-head">
                <div data-reveal>
                    <span class="index-tag">03 / Recognition</span>
                    <h2 class="display section-title" style="margin-top: 1rem;">
                        Awards<br><span class="outline-text">&amp; certificates</span>
                    </h2>
                </div>
            </header>

            <div class="award-list">
                @foreach (config('portfolio.awards') as $award)
                    <article class="award" data-reveal style="--reveal-delay: {{ $loop->index * 90 }};">
                        <span class="award__mark" aria-hidden="true">✳</span>
                        <div>
                            <h3 class="award__title">{{ $award['title'] }}</h3>
                            <p class="award__meta">
                                {{ $award['awarder'] }}@if (!empty($award['date'])) · {{ $award['date'] }}@endif
                            </p>
                            <p class="award__summary">{{ $award['summary'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         Languages
    ============================================================== --}}
    <section class="section" id="languages">
        <div class="shell">
            <header class="section-head">
                <div data-reveal>
                    <span class="index-tag">04 / Languages</span>
                    <h2 class="display section-title" style="margin-top: 1rem;">Languages</h2>
                </div>
            </header>

            <div class="lang-grid">
                @foreach (config('portfolio.languages') as $lang)
                    <div class="lang" data-reveal style="--reveal-delay: {{ $loop->index * 90 }};">
                        <div>
                            <span class="lang__name">{{ $lang['name'] }}</span>
                            <span class="lang__label">{{ $lang['label'] }}</span>
                        </div>
                        <span class="lang__score">{{ $lang['level'] }}/5</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         Next
    ============================================================== --}}
    <section class="section section--tight">
        <div class="shell" style="display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 2rem;" data-reveal>
            <div>
                <span class="index-tag">Next</span>
                <h2 class="display section-title" style="margin-top: 1rem;">
                    Selected <span class="outline-text">work</span>
                </h2>
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 0.6rem;">
                <a class="btn btn--acid" data-magnetic href="{{ route('projects') }}">
                    View work <span aria-hidden="true">↗</span>
                </a>
                <a class="btn btn--ghost" data-magnetic href="{{ route('home') }}#contact">
                    Contact <span aria-hidden="true">↗</span>
                </a>
            </div>
        </div>
    </section>
@endsection
