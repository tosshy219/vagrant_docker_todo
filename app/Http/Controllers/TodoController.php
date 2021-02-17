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
}
