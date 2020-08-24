<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class LanguageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function __invoke(Request $request)
    {
        // Validate form request...
        $data = $request->validate([
            'locale' => ['required', 'string', Rule::in(['en', 'fr'])]
        ]);

        $request->session()->put('locale', $data['locale']);

        app()->setLocale($request->session()->get('locale'));

        flash()->success('Language changed successfully');

        return redirect()->back();
    }
}
