<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * [showLoginForm description]
     * @return [type] [description]
     */
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $payloads = $request->validate([
            'email' => ['required'],
            'password' => ['required', 'min:8']
        ]);

        $remember = $request->has('remember');

        if (!\Auth::attempt($payloads, $remember)) {
            return redirect()->back()->withInput();
        }

        return redirect()->route('home');
    }
}
