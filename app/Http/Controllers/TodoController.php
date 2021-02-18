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
        $validatedData = $request->validate([
            'text' => 'required|max:50',
        ]);

        $todo->text=$validatedData;
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
        //いったん放置
        $validatedData = $request->validate([
            'text' => 'required|max:50',
        ]);

        $todo=Todo::find($id);
        $todo->text=$validatedData;
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

    //CSV出力の機能
    public function postCSV()
    {
        $todos_json=Todo::all();
        //fputcsv()はjsonの形式だと使えないため，変換
        $todos_not_json=json_decode($todos_json,true);
        // カラムの作成(のちに使うfputcsvは第二引数のところに”配列として”データを入れないといけないって)
        $head = ['id','TODOリスト','作成日時','更新日時'];

        // 書き込み用ファイルを開く
        $f = fopen('test.csv', 'w');
        if ($f) {
            // カラムの書き込み　$headの文字をUTF-8からSJISに変更
            mb_convert_variables('SJIS', 'UTF-8', $head);
            fputcsv($f, $head);
            // データの書き込み(csvファイルはSJISじゃないと文字化けするらしい)
            foreach ($todos_not_json as $todo) {
                //この$todo一つ一つがすでに配列
                mb_convert_variables('SJIS', 'UTF-8', $todo);
                fputcsv($f, $todo);
            }
        }
        // ファイルを閉じる
        fclose($f);

        // HTTPヘッダ
        header("Content-Type: application/octet-stream");
        //   送るデータのサイズが記してある．↓これがなくでも挙動に変化はない
        header('Content-Length: '.filesize('test.csv'));
        //     添付ファイルありますよー、ファイル名は***.csvですよー　←これがないとnumberというアプリじゃないアプリで  csvファイルが開かれた
        header('Content-Disposition: attachment; filename=test.csv');
        //　　これがないとtest.csvは作成されるけどファイルをmacから読み込むことができなかった
        readfile('test.csv');
    }
}
