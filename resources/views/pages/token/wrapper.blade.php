<x-page-wrapper>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title ?? __('Api Tokens') }}</h1>
        @can('administrator')
        <div class="btn-toolbar mb-2 mb-md-0">
            <a role="button" href="#" title="Add country" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">
                <span data-feather="plus-square"></span>
                {{__('Create token')}}
            </a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Create token') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="create-token-form" method="post" action="{{ route('tokens') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="token-name" class="col-form-label">{{__('Token Name')}}:</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="token-name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                            <button type="button" class="btn btn-primary"
                                    onclick="event.preventDefault();
                                                 document.getElementById('create-token-form').submit();">{{__('Generate')}}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{ $actions ?? '' }}
        </div>
        @endcan
    </div>

    {{ $slot }}

</x-page-wrapper>
