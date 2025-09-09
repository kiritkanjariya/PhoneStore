<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($user->role == 'user') {
                    $request->session()->put('user', $user);
                    return redirect('/')->with('success', 'Logged in successfully');
                } else {
                    $request->session()->put('admin', $user);
                    return redirect('/dashboard')->with('success', 'Logged in successfully');
                }
            } else {
                return back()->with('error', 'Invalid password');
            }
        } else {
            return back()->with('error', 'Email does not exist');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
    public function admin_logout(Request $request)
    {
        $request->session()->forget('admin');
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
