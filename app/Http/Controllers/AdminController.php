<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_profile', compact('profileData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $file = $request->file('photo');
        if ($file) {
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName(); // 270623.artur.jpg
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function AdminPassword()
    {
        return view('admin.admin_password');
    }

    public function AdminPasswordUpdate(Request $request)
    {
        // Validation |confirmed
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        // Match the old password
        $pass = Auth::User()->password;
        $req = $request->old_password;
        if (!Hash::check($req, $pass)) {
            $notification = array(
                'message' => 'Old Password do not match our records.',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        // Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully.',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }
}
