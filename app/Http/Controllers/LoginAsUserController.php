<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginAsUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = \App\Models\User::findOrFail($request->id);
        auth()->login($user);
        return redirect()->route('dashboard');
    }
}
