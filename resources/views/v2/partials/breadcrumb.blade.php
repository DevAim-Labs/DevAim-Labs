{{-- Visible breadcrumb (the JSON-LD BreadcrumbList is built in SitePage). Uses $breadcrumbs. --}}
@if (! empty($breadcrumbs))
    <nav class="breadcrumb" aria-label="{{ $t['a11y']['breadcrumb'] }}">
        <ol>
            @foreach ($breadcrumbs as $crumb)
                <li>
                    @if ($loop->last)
                        <span aria-current="page">{{ $crumb['name'] }}</span>
                    @else
                        <a href="{{ $crumb['url'] }}">{{ $crumb['name'] }}</a>
                        <x-v2::icon name="chevron-right" class="breadcrumb__sep size-4" />
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
