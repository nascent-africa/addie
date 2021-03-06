<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    /**
     * RoleController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'can:superuser']);
    }

    /**
     * @param Request $request
     * @param Role $role
     * @param User $user
     * @return RedirectResponse
     */
    public function remove(Request $request, Role $role, User $user)
    {
        $user->removeRole($role->name);

        flash()->success(__("Role assigned successfully!"));

        return redirect()->back();
    }


    public function assign(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => ['required', 'exists:roles,name']
        ]);

        $user->assignRole($data['role']);

        flash()->success(__("Role assigned successfully!"));

        return redirect()->back();
    }
}
