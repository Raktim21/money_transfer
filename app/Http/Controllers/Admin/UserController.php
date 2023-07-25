<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\MoneyTransfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(){

        $users = User::where('role','admin')->search()->paginate(15);

        return view('admin.users.admin',compact('users'));
    }


    public function sender(){

        $users = User::where('role','sender')->search()->paginate(15);

        return view('admin.users.sender',compact('users'));
    }


    public function receiver(){

        $users = User::where('role','receiver')->search()->paginate(15);

        return view('admin.users.receiver',compact('users'));
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

        if (auth()->user()->id == $id) {
            return redirect()->back()->with('error','You can not delete yourself');
        }

        if (MoneyTransfer::where('sender_id',$id)->exists() || MoneyTransfer::where('receiver_id',$id)->exists()) {
            return redirect()->back()->with('error','This user have a active or previous payment request.');
        }

        $user = User::find($id);
        if (File::exists(public_path($user->avatar))) {
            File::delete(public_path($user->avatar));
        }
        $user->delete();

        return redirect()->back()->with('success','User deleted successfully');
    }


    public function recharge(Request $request,$id){
        
        $request->validate([
            'fund' => 'required|numeric|min:1',
        ]);


        $user = User::find($id);

        if ($user->role != 'sender') {
            return redirect()->back()->with('error','You can not recharge this user');
        }

        $user->fund = $request->fund + $user->fund;
        $user->save();

        return redirect()->back()->with('success','User recharge successfully');
    }
}
