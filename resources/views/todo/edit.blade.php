@extends('layout')

@section('title','TODO変更')

@section('content-title')
{{-- editはupdateとセット --}}
  <h1>TODO変更画面</h1>
@endsection

@section('content')
{{-- updateの時はGETでもPOSTでもなくPUT --}}
  <form action="{{route('update',['id'=>$todo->id])}}" method="post">
    @csrf
    {{-- ここ↓ --}}
    @method('PUT')
    <input class="card col-md-12"
            type="text" 
            name="text" 
            value="{{$todo->text}}"
            style="padding:10px;margin:20px 0 15px 0;">

    <button 
    type="submit"
    class="btn peach-gradient col-md-12 mx-auto"
    style="margin:10px 0;font-size:14px;"
    >変更する</button>
  </form>
@endsection