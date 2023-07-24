<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(){

        $users = User::search()->paginate(15);

        return view('admin.users.index',compact('users'));
    }


    public function store(UserCreateRequest $request){
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->phone = $request->phone;
        $user->save();

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = time().$user->id.'.'.$image->extension();
            $image->move(public_path('/uploads/users/avaters/'),$imageName);
            $user->profile_photo_path = '/uploads/users/avaters/'.$imageName;
            $user->save();
        }

        return redirect()->route('admin.users.list')->with('success','User created successfully');

    }




    public function update(UserUpdateRequest $request,$id){

        $user = User::find($id);
        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->role   = $request->role;
        $user->phone  = $request->phone;
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

        return redirect()->back()->with('success','User created successfully');

    }


    public function delete($id){
        $user = User::find($id);
        if (File::exists(public_path($user->avatar))) {
            File::delete(public_path($user->avatar));
        }
        $user->delete();

        return redirect()->back()->with('success','User deleted successfully');
    }
}
