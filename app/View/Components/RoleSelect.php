<?php

namespace App\View\Components;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Spatie\Permission\Models\Role;

class RoleSelect extends Component
{
    /**
     * @var Collection|Role[]
     */
    public $roles;

    /**
     * @var int|string
     */
    public $id;

    /**
     * @var User
     */
    public $user;

    /**
     * @var Role
     */
    public $userRoles;

    /**
     * Create a new component instance.
     *
     * @param Role $role
     * @param $id
     * @param $user
     */
    public function __construct(Role $role, $id, $user)
    {
        $this->id = $id;
        $this->user = $user;
        $this->roles = $role->all();

        $this->userRoles = $user->roles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.role-select');
    }
}
