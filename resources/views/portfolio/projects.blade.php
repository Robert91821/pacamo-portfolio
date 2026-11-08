@extends('layouts.app')

@section('title', 'Projects — ' . config('portfolio.site_name'))

@section('content')
    <header class="page-hero">
        <div class="shell">
            <span class="index-tag" data-reveal>Index / 04</span>
            <h1 class="display page-hero__title" style="margin-top: 1.25rem;" data-reveal="mask">
                Selected<br><span class="outline-text">work</span>
            </h1>
            <div class="page-hero__meta" data-reveal style="--reveal-delay: 120;">
                <span class="mono-label">Case studies &amp; experiments</span>
                <span class="mono-label">Archive — {{ str_pad(count(config('portfolio.projects')), 2, '0', STR_PAD_LEFT) }} entries</span>
            </div>
        </div>
    </header>

    <section class="section" id="work">
        <div class="shell">
            @if (empty(config('portfolio.projects')))
                <div class="archive-empty" data-reveal>
                    <div class="archive-empty__top">
                        <span class="index-tag">Archive / In progress</span>
                        <span class="archive-empty__badge">
                            <span class="status__dot" aria-hidden="true"></span>
                            In preparation
                        </span>
                    </div>

                    <div class="archive-empty__num display outline-text" aria-hidden="true">00</div>

                    <div class="archive-empty__body">
                        <div>
                            <p class="archive-empty__copy">
                                The project archive is being assembled. Case studies will be published here as
                                they are written up — each one covering the brief, the build, and the outcome.
                            </p>

                            <div class="tag-row">
                                @foreach (config('portfolio.interests') as $interest)
                                    <span class="tag">{{ $interest }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="archive-empty__actions">
                            <a class="btn btn--acid" data-magnetic href="{{ route('experience') }}">
                                Explore experience <span aria-hidden="true">↗</span>
                            </a>
                            <a class="btn btn--ghost" data-magnetic href="{{ route('home') }}#contact">
                                Get in touch <span aria-hidden="true">↗</span>
                            </a>
                        </div>
                    </div>

                    <div class="archive-load" aria-hidden="true"></div>

                    <div class="archive-empty__foot">
                        <span>Status — drafting</span>
                        <span>Entry count — 00</span>
                        <span>Updated — {{ now()->format('Y') }}</span>
                    </div>
                </div>
            @else
                <div class="project-grid">
                    @foreach (config('portfolio.projects') as $project)
                        <article class="project-card" data-reveal style="--reveal-delay: {{ $loop->index * 90 }};">
                            <div>
                                @if (!empty($project['tags']))
                                    <div class="project-card__tags">
                                        @foreach ($project['tags'] as $tag)
                                            <span class="project-card__tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <h2 class="project-card__title">
                                    <a href="{{ $project['url'] }}">{{ $project['title'] }}</a>
                                </h2>
                                <p class="project-card__summary">{{ $project['summary'] }}</p>
                            </div>
                            <a class="project-card__arrow" href="{{ $project['url'] }}" aria-label="Open {{ $project['title'] }}">↗</a>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="section section--tight">
        <div class="shell" style="display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 2rem;" data-reveal>
            <div>
                <span class="index-tag">Next</span>
                <h2 class="display section-title" style="margin-top: 1rem;">
                    Let's make<br><span class="outline-text">contact</span>
                </h2>
            </div>
            <a class="btn btn--acid" data-magnetic href="{{ route('home') }}#contact">
                Start a conversation <span aria-hidden="true">↗</span>
            </a>
        </div>
    </section>
@endsection
