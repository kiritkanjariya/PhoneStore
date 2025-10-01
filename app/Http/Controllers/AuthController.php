<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


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
            if ($user->status != "active") {
                return back()->with('error', 'please, Active your account.');
            }
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
        $request->session()->forget('used_coupons');
        $request->session()->flush();
        $request->session()->forget('user');
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
    public function admin_logout(Request $request)
    {
        $request->session()->forget('admin');
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    public function otp()
    {
        return view('otp');
    }

    public function new_password($email)
    {
        return view('new_password', compact('email'));
    }

    public function forgot_password_submit(Request $request)
    {
        $user = User::where('email', $request->resetEmail)->first();

        if ($user) {
            $user->otp = rand(111111, 999999);
            $user->save();

            $data = [
                'name' => $user->name,
                "email" => $user->email,
                "otp" => $user->otp,
            ];
            Mail::send('otp_mailer', $data, function ($message) use ($data) {
                $message->subject('This mail is For OTP to reset your password.');
                $message->from('kiritkanjariya69@gmail.com', 'Kirit Kanjariya j.');
                $message->to($data['email'], $data['name']);
            });

            return redirect()->route('otp')->with('success', 'OTP sent to your Email....');
        } else {
            return redirect()->route('forgot_pass')->with('error', 'Email is not registered...');
        }
    }

    public function otp_submit(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);
        $user = User::where('otp', $request->otp)->first();
        if ($user) {
            return redirect()->route('new_password', $user->email)->with('success', 'Enter Your New password...');
        } else {
            return redirect()->route('otp')->with('error', 'OTP is incorrect...');
        }
    }

    public function reset_password(Request $request, $email)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->route('login')->with('success', 'Password reset SuccessFully...');
        }
    }
}
