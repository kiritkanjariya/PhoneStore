<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

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
}
