<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function redicrect_users()
    {
        $users = User::all();
        return view('admin/admin_users', compact('users'));
    }

    public function user_added(Request $formdata)
    {
        $user = new User();
        $user->name = $formdata->name;
        $user->email = $formdata->email;
        $user->address = $formdata->address;
        $user->phone = $formdata->phone;
        $user->password = $formdata->password;

        if ($formdata->hasFile('profile_image')) {
            $file = $formdata->file('profile_image');
            $originalName = $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $originalName);
            $user->profile = $originalName;
        }
        $user->save();
        return $this->redicrect_users();
    }

    public function user_add()
    {
        return view('admin/add_user');
    }

    public function register_submit(Request $formdata)
    {
        $user = new User();
        $user->name = $formdata->fullname;
        $user->email = $formdata->email;
        $user->address = $formdata->address;
        $user->phone = $formdata->phone;
        $user->password = $formdata->password;

        if ($formdata->hasFile('profile_picture')) {
            $file = $formdata->file('profile_picture');
            $originalName = $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $originalName);
            $user->profile = $originalName;
        }
        $user->save();
        return view('login');
    }

    public function user_updated(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->status = $request->status;

        if ($request->hasFile('profile_image')) {
            if ($user->profile && file_exists(public_path('uploads/profile/' . $user->profile))) {
                unlink(public_path('uploads/profile/' . $user->profile));
            }

            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);

            $user->profile = $filename;
        }

        $user->save();

        return $this->redicrect_users()->with('success', 'User Updated successfully!');
    }
    public function edit_users($id)
    {
        $users_detail = User::where('id', $id)->get();

        return view('admin/edit_user', compact('users_detail'));
    }
}
