<?php

namespace App\Http\Controllers;

use Session;
use App\Todo;                               //db lagbe so App\Todo class import kore use korsi
use Illuminate\Http\Request;


class TodosController extends Controller
{
    public function index(){ 

        $todos = Todo::all();

        return view('todos')->with('todos' , $todos);   // here return view('todos') means todos.blade view and ->with('todos') means in blade view we will acces by this name within foreach loop
    } 

    public function store(Request $request){

        //dd($request->all());

        $todo = new Todo;

        $todo->todo = $request->todo;  
        $todo->save();

        Session::flash('success','Your todo is created');
        return redirect()->back();
      
    }

    public function delete($id){

        $todo = Todo::find($id);

        $todo->delete();
        Session::flash('success','Your todo is deleted');
        return redirect()->back();
      
    }

    public function update($id){

        $todo = Todo::find($id);

        
        return view('update')->with('todos' , $todo);
      
    }

    public function save(Request $request , $id){

        $todo = Todo::find($id);
        $todo->todo =$request->todo;
        $todo->save();

        Session::flash('success','Your todo is updated');
        return redirect()->route('todos');
      
    }

    public function completed($id){

        $todo = Todo::find($id);
        $todo->completed = 1;
        $todo->save();

        Session::flash('success','Your todo was marked as completed');
        return redirect()->back();
      
    }
}
