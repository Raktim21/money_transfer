<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curency;
use Illuminate\Http\Request;

class CurencyController extends Controller
{
    public function index(){
        $datas = Curency::search()->paginate(20);
        return view('admin.curency.index');
    }

    public function create(Request $request){
        
        $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric',
        ]);

        $curency = new Curency();
        $curency->name = $request->name;
        $curency->rate = $request->rate;
        $curency->save();

        return redirect()->back()->with('success','Curency created successfully');
    }


    public function update(Request $request,$id){
        
        $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric',
        ]);

        $curency = Curency::findOrFail($id);
        $curency->name = $request->name;
        $curency->rate = $request->rate;
        $curency->save();
        
        return redirect()->back()->with('success','Curency updated successfully');
    }
    
    
    public function delete($id)  {
        
        $curency = Curency::findOrFail($id)->delete();

        return redirect()->back()->with('success','Curency deleted successfully');

    }
}
