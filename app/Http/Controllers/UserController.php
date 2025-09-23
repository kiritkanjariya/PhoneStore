<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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
        $user->role = $formdata->role;
        $user->token = uniqid();
        $user->password = $formdata->password;
        $user->status = $formdata->status;


        if ($formdata->hasFile('profile_image')) {
            $file = $formdata->file('profile_image');
            $originalName = $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $originalName);
            $user->profile = $originalName;
        }
        $user->save();
        return redirect()->route('admin_users')->with('success', 'User Added successfully ✅');
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
        $user->token = uniqid();
        $user->password = $formdata->password;

        if ($formdata->hasFile('profile_picture')) {
            $file = $formdata->file('profile_picture');
            $originalName = $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $originalName);
            $user->profile = $originalName;
        } else {
            $user->profile = 'logo.png';
        }
        $user1 = User::where("email", $formdata->email)->first();
        if ($user1) {
            return redirect()->route("register")->with("error", "This Email ia already Registerd");
        } else {
            $user->save();

            $user = User::where("email", $user->email)->first();

            $data = [
                'name' => $user->name,
                "email" => $user->email,
                "token" => $user->token,
            ];
            Mail::send('mailer', $data, function ($message) use ($data) {
                $message->subject('This mail is Activation Account Mail.');
                $message->from('kiritkanjariya69@gmail.com', 'Kirit Kanjariya j.');
                $message->to($data['email'], $data['name']);
            });

            return redirect()->route('register')->with('success', 'Eamil sent to your Email Please check your Email ... and Active your Account');
        }
        // return view('login');
    }

    public function activation($token)
    {

        $user = User::where('token', $token)->first();
        if ($user) {

            if ($user->status == 'inactive') {
                $user->status = 'active';
                $user->token = NULL;
                $user->save();

                return redirect()->route('login')->with('success', 'Your Account is Activated...');
            } else {
                return redirect()->route('login')->with('error', 'Your Account is Allready Activated...');
            }
        } else {
            return redirect()->route('login')->with('error', 'Invalid token, please try again.');
        }
    }

    public function edit_users($id)
    {
        $users_detail = User::where('id', $id)->get();

        return view('admin/edit_user', compact('users_detail'));
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

        return redirect()->route('admin_users')->with('success', 'User Updated successfully ✅');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->profile && file_exists(public_path('uploads/profile/' . $user->profile))) {
            unlink(public_path('uploads/profile/' . $user->profile));
        }

        $user->delete();

        return redirect()->route('admin_users')->with('error', 'User Deleted successfully ✅');
    }
}
