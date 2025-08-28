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
    }

    public function user_updated()
    {
        return view('admin/admin_users');
    }
    public function edit_users($id)
    {
        $users_detail = User::where('id', $id)->get();

        return view('admin/edit_user', compact('users_detail'));
    }
}
