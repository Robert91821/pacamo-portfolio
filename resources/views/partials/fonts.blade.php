@php
    /*
     * laravel-vite-plugin emits the self-hosted font CSS as a standalone asset
     * (see fonts-manifest.json) rather than attaching it to a Vite entry point.
     * Resolve it here for production builds, or inline it while the dev server
     * is running.
     */
    $hotFile = public_path('hot');
    $devManifestPath = public_path('fonts-manifest.dev.json');
    $prodManifestPath = public_path('build/fonts-manifest.json');

    $fontCssUrl = null;
    $fontInlineCss = null;
    $fontPreloads = [];

    if (is_file($hotFile) && is_file($devManifestPath)) {
        $devManifest = json_decode((string) file_get_contents($devManifestPath), true);
        $fontInlineCss = $devManifest['style']['inline'] ?? null;
        $fontPreloads = $devManifest['preloads'] ?? [];
    } elseif (is_file($prodManifestPath)) {
        $prodManifest = json_decode((string) file_get_contents($prodManifestPath), true);
        $fontCssFile = $prodManifest['style']['file'] ?? null;
        $fontCssUrl = $fontCssFile ? asset('build/' . $fontCssFile) : null;
        $fontPreloads = $prodManifest['preloads'] ?? [];
    }
@endphp

@foreach ($fontPreloads as $preload)
    @php
        $preloadHref = $preload['url'] ?? (isset($preload['file']) ? asset('build/' . $preload['file']) : null);
    @endphp
    @if ($preloadHref)
        <link rel="preload" href="{{ $preloadHref }}" as="font" type="{{ $preload['type'] ?? 'font/woff2' }}" crossorigin="anonymous">
    @endif
@endforeach

@if ($fontCssUrl)
    <link rel="stylesheet" href="{{ $fontCssUrl }}">
@endif

@if ($fontInlineCss)
    <style>{!! $fontInlineCss !!}</style>
@endif
