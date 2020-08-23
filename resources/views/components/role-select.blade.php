
<button type="button" class="btn btn-light" data-toggle="modal" data-target="#role-model-{{ $id }}">
    <span data-feather="more-vertical"></span>
</button>

<!-- Modal -->
<div class="modal fade" id="role-model-{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                    <tbody>
                    @forelse($userRoles as $userRole)
                        <tr>
                            <td class="text-capitalize">{{ $userRole->name }}</td>
                            <td style="width: 3%">
                                <a class="btn btn-light" href="{{ route('remove-role', ['role' => $userRole, 'user' => $user]) }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('remove-role-{{ $userRole->id }}').submit();">
                                    {{ __('Remove') }}
                                </a>

                                <form id="remove-role-{{ $userRole->id }}" action="{{ route('remove-role', ['role' => $userRole, 'user' => $user]) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @empty
                        <p>No roles assigned to this user.</p>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-body">
                <form action="{{ route('assign-role', ['user' => $user]) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <select class="form-select text-capitalize" name="role" aria-label="Default select example">
                            <option selected>Open this select role</option>

                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('Assign')}}</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
            </div>
        </div>
    </div>
</div>
