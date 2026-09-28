{{--
    Page header for pages other than home: breadcrumb, eyebrow, H1, intro.
    Pass `title`; optional `eyebrow`, `intro`, `meta` (small line below).
--}}
<header class="page-head">
    <div class="wrap page-head__inner">
        @include('v2.partials.breadcrumb')

        @if (! empty($eyebrow))
            <p class="eyebrow">{{ $eyebrow }}</p>
        @endif
        <h1 class="h1 page-head__title" id="page-title">{{ $title }}</h1>
        @if (! empty($intro))
            <p class="lede page-head__intro">{{ $intro }}</p>
        @endif
        @if (! empty($meta))
            <p class="page-head__meta">{{ $meta }}</p>
        @endif
    </div>
</header>
