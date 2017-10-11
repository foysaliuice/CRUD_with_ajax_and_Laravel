<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
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

      return "done";
    }

    public function delete(request $request){
      Tasks::where('id',$request->id)->delete();
    }

    public function update(request $request){
      $items = Tasks::find($request->id);
      $items->task = $request->value;
      $items->save();
    }
}
