<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//todoモデル追加
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos=Todo::all();
        return view('todo.index',[
            'todos'=>$todos,
        ]);
    }

    public function create()
    {
        return view('todo.create');
    }

    // Requestは渡ってきたデータを使う．Todo $todoはTodoモデルをインスタンス化してる(DI)
    public function store(Request $request,Todo $todo)
    {
        $todo->text=$request->input('text');
        $todo->save();
        return redirect('/');
    }

    // indexの画面から送られてくるidを受け取る
    public function edit($id)
    {
        $todo=Todo::find($id);
        return view('todo.edit',[
            'todo'=>$todo,
        ]);
    }
    
    public function update(Request $request,$id)
    {
        $todo=Todo::find($id);
        $todo->text=$request->input('text');
        $todo->save();
        return redirect('/');
    }
    
}
