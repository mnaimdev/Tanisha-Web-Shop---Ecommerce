<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function users()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('backend.users.users', [
            'users' => $users,
        ]);
    }

    function user_delete($user_id)
    {
        $user = User::find($user_id);
        if ($user->image == null) {
            User::find($user_id)->delete();
            return back()->with("user_del", "User has been deleted. Find your trash list :)");
        } else {
            $image = public_path('/uploads/users/' . $user->image);
            unlink($image);

            User::find($user_id)->delete();
            return back();
        }
    }

    function edit_profile()
    {
        return view('backend.users.edit_profile');
    }

    function update_profile(Request $request)
    {
        if ($request->new_password == null) {
            User::find(Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,

            ]);
            return back();
        } else {

            if (Hash::check($request->old_password, Auth::user()->password)) {
                User::find(Auth::id())->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->new_password),
                ]);
                return back()->with('update', 'Updated Successfully :)');
            } else {
                return back()->with('password', 'Password Not Match!');
            }
        }
    }

    function update_profile_image(Request $request)
    {
        if (Auth::user()->image == null) {
            $uploaded_file = $request->image;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Auth::id() . '.' . $extension;
            Image::make($uploaded_file)->save(public_path('uploads/users/' . $file_name));

            User::find(Auth::id())->update([
                'image' => $file_name,
            ]);

            return back()->with('image', 'Uploaded Successfully!');
        } else {
            $user_image = Auth::user()->image;
            $deleted_from = public_path('/uploads/users/' . $user_image);
            unlink($deleted_from);

            $uploaded_file = $request->image;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Auth::id() . '.' . $extension;
            Image::make($uploaded_file)->save(public_path('uploads/users/' . $file_name));

            User::find(Auth::id())->update([
                'image' => $file_name,
            ]);

            return back()->with('image', 'Uploaded Successfully!');
        }
    }

    function trash_list()
    {
        $users = User::onlyTrashed()->where("id", "!=", Auth::id())->get();
        return view("backend.users.trash", [
            'users' => $users,
        ]);
    }

    function trash_delete($user_id)
    {
        User::onlyTrashed()->find($user_id)->forceDelete();
        return back();
    }

    function trash_restore($user_id)
    {
        User::onlyTrashed()->find($user_id)->restore();
        return back();
    }

    function check_delete(Request $request)
    {
        foreach ($request->checkbox as $check) {
            User::find($check)->delete();
        }
        return back()->with("user_all", "Deleted Successfully :)");
    }

    function check_trash(Request $request)
    {
        if ($request->checkbox == "") {
            return back()->with("select", "Select your data!");
        } else {
            if ($request->restore) {
                foreach ($request->checkbox as $check) {
                    User::onlyTrashed()->find($check)->restore();
                }
                return back()->with("trash_restore", "Restored Successfully :)");
            }
            if ($request->delete) {
                foreach ($request->checkbox as $check) {
                    User::onlyTrashed()->find($check)->forceDelete();
                }
                return back()->with("trash_delete", "Deleted Successfully :)");
            }
        }
    }

    function add_user(Request $request)
    {
        if ($request->password_confirmation == $request->password) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return back();
        } else {
            return back()->with('not_match', 'Password Not Match');
        }
    }
}
