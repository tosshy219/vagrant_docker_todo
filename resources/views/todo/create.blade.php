@extends('layout')

@section('title','TODO追加画面')

@section('content-title')
  <h1>TODO追加画面</h1>
@endsection

{{-- 簡易nav配置 --}}
@section('nav')
  @include('nav_simple')
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
  {{-- 優先順位決める --}}
  <span>重要度：</span>
  <div class="form-check form-check-inline">
    <input
      class="form-check-input"
      type="radio"
      name="priority"
      id="inlineRadio1"
      value="1"
    />
    <label class="form-check-label" for="inlineRadio1">高</label>
  </div>
  
  <div class="form-check form-check-inline">
    <input
      class="form-check-input"
      type="radio"
      name="priority"
      id="inlineRadio2"
      value="2"
    />
    <label class="form-check-label" for="inlineRadio2">中</label>
  </div>
  <div class="form-check form-check-inline">
    <input
      class="form-check-input"
      type="radio"
      name="priority"
      id="inlineRadio3"
      value="3"
    />
    <label class="form-check-label" for="inlineRadio3">低</label>
  </div>
  <span style="color: rgb(145, 145, 145);font-size:11px;">※なしでもいいです</span>

    <button type="submit" class="btn btn-sm peach-gradient col-md-12 mx-auto" style="font-size:15px;padding:12px;margin-top:13px;">
      追加
    </button>

  </form>
@endsection