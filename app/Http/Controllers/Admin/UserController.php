<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;

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
            $user->avatar = '/uploads/users/avaters/'.$imageName;
            $user->save();
        }

        return redirect()->route('admin.users.list')->with('success','User created successfully');

    }
}
