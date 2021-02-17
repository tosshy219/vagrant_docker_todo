@extends('layout')

@section('title','記事一覧')

@section('content-title')
<h1>TODOリスト</h1>
@endsection

@section('content')

  @foreach ($todos as $todo)
    <a href="" class="card hoverable" style="margin-top: 10px;padding:5px 10px;color:black;">
      {{-- divの中で左右に配置 --}}
      <div class="d-flex justify-content-between">
        <span style="line-height: 40px;">{{$todo->text}}</span>
        <form method="POST" action="">
          @csrf
          <button class="btn btn-light btn-sm" type="submit">消去</button>
        </form>
      </div>
      {{---ここまで----}}
    </a>
  @endforeach

  <a href="{{route('create')}}" class="btn peach-gradient add-button" >追加する</a>

@endsection