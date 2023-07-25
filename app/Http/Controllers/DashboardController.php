<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){

        if (auth()->user()->role == 'admin') {
            return view('admin.index');
        }
        if (auth()->user()->role == 'sender') {
            return view('sender.index');
        }
        if (auth()->user()->role == 'receiver') {
            return view('receiver.index');
        }

    }

    public function profile(){
        
        return view('profile');
    }

    public function updateProfile(Request $request){
        
        $request->validate([
           'name'     => 'required|string',
           'email'    => 'required|string|email|unique:users,email,'.Auth::user()->id ,
           'phone'    => 'required|string|max:11|unique:users,phone,'.Auth::user()->id ,
           'avater'   => 'nullable|image|mimes:png,jpg,jpeg',
        ]);


        $user = User::fine(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        if ($request->hasFile('avater')) {
            $image = $request->file('avater');
            $imageName = time().$user->id.'.'.$image->extension();
            $image->move(public_path('/uploads/users/avaters/'),$imageName);
            if (File::exists(public_path($user->avatar))) {
                File::delete(public_path($user->avatar));
            }
            $user->profile_photo_path = '/uploads/users/avaters/'.$imageName;
            $user->save();
        }


        return redirect()->back()->with('success','Profile updated successfully');
    }



    public function updatePassword(Request $request){
        
        $request->validate([
           'old_password'          => 'required|string',
           'password'              => 'required|string|confirmed',
           'password_confirmation' => 'required|same:password',
        ]);
        

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            
            return redirect()->back()->with('error','Your current password is incorrect');
        }

        $user = User::fine(auth()->user()->id);
        $user->password = bcrypt($request->password);
        $user->save();


        return redirect()->back()->with('success','Password updated successfully');
    }
}
