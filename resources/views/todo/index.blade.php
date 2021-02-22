@extends('layout')

@section('title','記事一覧')

@section('content-title')
<h1>TODOリスト</h1>
@endsection

@section('content')



  @foreach ($todos as $todo)

    <a href="{{route('edit',['id'=>$todo->id])}}" class="card hoverable" style="margin-top: 10px;padding:5px 10px;color:black;">
      {{-- divの中で左右に配置 --}}
      <div class="d-flex justify-content-between align-items-center">
        <span style="width:70%;">{{$todo->text}}</span>
        <form method="POST" action="{{route('destroy',['id'=>$todo->id])}}">
          @csrf
          <button class="btn-sm btn" type="submit" >消去</button>
        </form>
        @include('todo.priorityLetters')
      </div>
      {{---ここまで----}}
    </a>
    
  @endforeach

  <a href="{{route('create')}}" class="btn peach-gradient add-button" >追加する</a>

@endsection