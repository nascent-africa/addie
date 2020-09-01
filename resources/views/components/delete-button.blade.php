<!-- Button trigger modal -->
<button type="button" class="{{ $classes }}" data-toggle="modal" data-target="#delete-modal-{{ $id }}">
    <span data-feather="trash"></span>
    {{ $slot }}
</button>

<!-- Modal -->
<div class="modal fade" id="delete-modal-{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Delete')}} {{ $name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{__('Are you sure you want to delete this?')}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('No')}}</button>

                <a href="{{ $url }}" type="button" class="btn btn-primary"
                   onclick="event.preventDefault();
                       document.getElementById('delete-form-{{ $id }}').submit();">{{__('Yes')}}</a>

                <form id="delete-form-{{ $id }}" action="{{ $url }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>
