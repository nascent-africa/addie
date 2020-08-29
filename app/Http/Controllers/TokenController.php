<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TokenController extends Controller
{
    /**
     * TokenController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('pages.token.index')->with(['tokens' => auth()->user()->tokens]);
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string']
        ]);

        $newAccessToken = $request->user()->createToken($data['name']);

        $personalAccessToken = $newAccessToken->accessToken;

        $personalAccessToken->authorization_token = $newAccessToken->plainTextToken;
        $personalAccessToken->save();

        flash()->success(__('Token generated successfully!'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        request()->user()->tokens()->where('id', $id)->delete();

        flash()->success(__('Token revoked successfully!'));

        return redirect()->back();
    }
}
