<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use Session;
class TaskController extends Controller
{
    public function index(){
      $items = Tasks::all();

      return view('master',compact('items'));
    }
    public function insert(request $request){
      $items = new Tasks();
      $items->task = $request->get('text');
      $items->save();
      Session::flash('status','Item Added');
    }

    public function delete(request $request){
      Tasks::where('id',$request->id)->delete();
      Session::flash('status','Item deleted');
    }

    public function update(request $request){
      $items = Tasks::find($request->id);
      $items->task = $request->value;
      $items->save();
      Session::flash('status','Item Updated');
    }
}
