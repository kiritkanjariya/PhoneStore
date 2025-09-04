<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;


class ProfileController extends Controller
{
    public function showProfile()
    {

        if (!Session::has('user')) {
            return redirect()->route('login');
        }

        $user = User::find(Session::get('user')->id);
        return view('profile', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->hasFile('profile_pic')) {
            if ($user->profile && file_exists(public_path('uploads/profile/' . $user->profile))) {
                unlink(public_path('uploads/profile/' . $user->profile));
            }

            $file = $request->file('profile_pic');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);

            $user->profile = $filename;
        }

        $user->save();

        Session::put('user', $user);

        if ($request->hasFile('profile_pic')) {
            return redirect()->route('profile')->with('success', 'Profile picture updated successfully');
        }else{
            return redirect()->route('profile')->with('success', 'Profile updated successfully');
        }
    }
}
