<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->except('_token'))) {
            return redirect()->route('dashboard');
        } else {
            return back()->with(['failure' => 'Invalid login credentials!']);
        }
    }

    public function register_view()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'confirmed'],
            ],
            // [
            //     'name.required' => "Soemthing"
            // ]
        );

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if (User::create($data)) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with(['success' => 'Successfully logged out!']);
    }
}
