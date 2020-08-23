<x-page-wrapper>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title ?? __('Regions') }}</h1>
        @can('administrator')
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('regions.create') }}" title="Add country" class="btn btn-sm btn-outline-secondary">
                <span data-feather="plus-square"></span>
                Add Region
            </a>

            {{ $actions ?? '' }}
        </div>
        @endcan
    </div>

    {{ $slot }}

</x-page-wrapper>
