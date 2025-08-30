<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ProfileController extends Controller
{
    public function showProfile($id)
    {
        $user = User::findOrFail($id);
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

        return redirect()->route('profile', $user->id)->with('success', 'Profile updated successfully');
    }
}
