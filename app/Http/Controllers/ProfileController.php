<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show', [
            'user' => Auth::user(),
        ]);
    }

    public function details(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::id() . ',id'],
        ]);

        // $data = [
        //     'name' => $request->name,
        //     'email' => $request->email,
        // ];

        $user = User::find(Auth::id());

        if ($user->update($data)) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    public function password(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate([
            'password' => ['required', 'confirmed'],
            'current_password' => ['required'],
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $data = [
                'password' => Hash::make($request->password),
            ];

            if ($user->update($data)) {
                return back()->with(['success' => 'Magic has been spelled!']);
            } else {
                return back()->with(['failure' => 'Magic has failed to spell!']);
            }
        } else {
            return back()->withErrors(['current_password' => 'Current password does not match!']);
        }
    }
}
