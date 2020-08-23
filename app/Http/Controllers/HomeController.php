<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home')->with([
            'countryCount' => Country::count(),
            'userCount' => User::count()
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function profile()
    {
        return view('profile');
    }

    /**
     * Update user account
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
        ]);

        $user = User::find(Auth::id());

        $user->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);

        flash()->success(__('Profile updated successfully!'));

        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::find(Auth::id());

        $user->update([
            'password' => Hash::make($data['password'])
        ]);

        flash()->success(__('Password changed successfully!'));

        return redirect()->back();
    }
}
