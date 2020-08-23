<x-page-wrapper>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title ?? __('Countries') }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('countries.create') }}" title="Add country" class="btn btn-sm btn-outline-secondary">
                <span data-feather="plus-square"></span>
                Add Country
            </a>

            {{ $actions ?? '' }}
        </div>
    </div>

    {{ $slot }}

</x-page-wrapper>
