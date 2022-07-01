<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * [showRegistrationForm description]
     * @return [type] [description]
     */
    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    /**
     * [login description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function register(Request $request)
    {
        $payloads = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'min:8']
        ]);

        $payloads['password'] = Hash::make($payloads['password']);

        $roleDefault = Role::where('is_default', true)->first();

        if ($roleDefault !== null) {
            $payloads['role_id'] = $roleDefault->id;
        }

        User::create($payloads);

        return redirect()->route('home');
    }
}
