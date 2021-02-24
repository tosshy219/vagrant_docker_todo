<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//todoモデル追加
use App\Models\Todo;
//priority_on_offモデル追加
use App\Models\PriorityOnOff;
//sort_on_offモデル追加
use App\Models\SortOnOff;

class TodoController extends Controller
{
    public function index()
    {
        $todos=Todo::all();
        $priority=PriorityOnOff::find(1);
        $sort=SortOnOff::find(1);


        //ここからsortの処理
        if($sort->number==0){
        //とりあえずtodoをとってくる
        $non_sorted_todos=Todo::all();
        //優先順位がnullだとsortした時にnullが一番上にきてしまうので，nullの部分を4に書き換える
        foreach($non_sorted_todos as $non_sorted_todo){
            if($non_sorted_todo->priority==null){
                $non_sorted_todo->priority=4;
                $non_sorted_todo->save();
            }
        }
        //優先順位により並び替える
        $todos=$non_sorted_todos->sortBy('priority');
        }

        return view('todo.index',[
            'todos'=>$todos,
            'priority'=>$priority,
            'sort'=>$sort,
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
        // この時の$validatedDataはこんな感じ
        // array:1 [
        // "text" => "a"
        // ]

        // validatedDataはこういうふうに指定してあげないとエラーでた
        $todo->text=$validatedData["text"];
        $todo->priority=$request->input('priority');
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
        $todo->text=$validatedData["text"];
        $todo->priority=$request->input('priority');

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
        $head = ['id','優先順位','TODOリスト','作成日時','更新日時'];

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

    //優先順位の表示の機能
    public function priority()
    {
        $todos=Todo::all();
        $sort=SortOnOff::find(1);
        $priority=PriorityOnOff::find(1);
        // priority_on_offsテーブルやりとり

        //1の時にviewで優先順位表示，0の時非表示とする

        //if文の中をイコール一つにして時間を食った．0と1を切り替えている
        if($priority->number==1){
            $priority->number=0;
        }elseif($priority->number==0){
            $priority->number=1;
        }
        $priority->save();

        
        // ここから「優先順位順にしていた場合，sortも行う」
        if($sort->number==0){
        //とりあえずtodoをとってくる
        $non_sorted_todos=Todo::all();
        //優先順位がnullだとsortした時にnullが一番上にきてしまうので，nullの部分を4に書き換える
        foreach($non_sorted_todos as $non_sorted_todo){
            if($non_sorted_todo->priority==null){
                $non_sorted_todo->priority=4;
                $non_sorted_todo->save();
            }
        }
        //優先順位により並び替える
        $todos=$non_sorted_todos->sortBy('priority');

        }


        return view('todo.index',[
            "todos"=>$todos,
            "priority"=>$priority,
            "sort"=>$sort,
        ]);
    }
    public function sort()
    {
        $non_sorted_todos=Todo::all();
        $sort=SortOnOff::find(1);
        $priority=PriorityOnOff::find(1);


        //優先順位がnullだとsortした時にnullが一番上にきてしまうので，nullの部分を4に書き換える
        foreach($non_sorted_todos as $non_sorted_todo){
            if($non_sorted_todo->priority==null){
                $non_sorted_todo->priority=4;
                $non_sorted_todo->save();
            }
        }
        //もし優先順位順にするボタンを押してたら並び替える

        if($sort->number==1){
            $sort->number=0;
            $sort->save();
            $todos=$non_sorted_todos->sortBy('priority');
        }elseif($sort->number==0){
            $sort->number=1;
            $sort->save();
            $todos=$non_sorted_todos;
        }


        
        return view('todo.index',[
            'todos'=>$todos,
            'priority'=>$priority,
            'sort'=>$sort,
        ]);
    }
}
