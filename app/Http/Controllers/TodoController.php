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
    // 特定の何かをいじる時は個別でidが送られてくる
    public function edit($id)
    {
        $todo=Todo::find($id);
        return view('todo.edit',[
            'todo'=>$todo,
        ]);
    }
    
    //特定の一つを更新するため，idを引数に受け取っている
    public function update(Request $request,$id)
    {
        $todo=Todo::find($id);
        $todo->text=$request->input('text');
        $todo->save();
        return redirect('/');
    }
    
    //特定の一つを消去するため，idを引数に受け取っている
    public function destroy($id)
    {
        $todo = Todo::find($id);

        $todo->delete();

        return redirect('/');

    }
}
