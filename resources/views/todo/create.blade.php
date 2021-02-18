@extends('layout')

@section('title','TODO追加画面')

@section('content-title')
  <h1>TODO追加画面</h1>
@endsection

@section('content')

@if (count($errors) > 0)
<div class="alert-danger" style="padding-top: 17px;margin-top:20px;">
  @foreach ($errors->all() as $error)
    <p style="text-align:center;">{{ $error }}</p>
  @endforeach
</div>
@endif




{{-- aタグだとgetの通信になってしまうので，formをつかってPOSTにしてる --}}
  <form action="{{route('store')}}" method="POST">
    @csrf
    <input type="text" class="card col-md-12" name="text" placeholder=" 入力してください" style="margin-top: 20px;margin-bottom:15px;padding:10px;">

    <button type="submit" class="btn btn-sm peach-gradient col-md-12 mx-auto" style="font-size:15px;padding:12px;margin-top:13px;">
      追加
    </button>

  </form>
@endsection