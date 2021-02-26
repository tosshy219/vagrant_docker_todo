@extends('layout')

@section('title','TODO変更')

@section('content-title')
{{-- editはupdateとセット --}}
  <h1>TODO変更画面</h1>
@endsection

{{-- 簡易nav --}}
@section('nav')
  @include('nav_simple')
@endsection




@section('content')

{{-- エラー表示 --}}
@if (count($errors) > 0)
<div class="alert-danger" style="padding-top: 17px;margin-top:20px;">
  @foreach ($errors->all() as $error)
    <p style="text-align:center;">{{ $error }}</p>
  @endforeach
</div>
@endif

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
      {{-- 優先順位決める --}}
  <span>重要度：</span>
  <div class="form-check form-check-inline">
    <input
      class="form-check-input"
      type="radio"
      name="priority"
      id="inlineRadio1"
      value="1"
      checked=""
    />
    <label class="form-check-label" for="inlineRadio1">高</label>
  </div>
  
  <div class="form-check form-check-inline">
    <input
      class="form-check-input"
      type="radio"
      name="priority"
      id="inlineRadio2"
      checked=""

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
      checked=""

      value="3"
    />
    <label class="form-check-label" for="inlineRadio3">低</label>
  </div>
  <span style="color: rgb(145, 145, 145);font-size:11px;">※なしでもいいです</span>
    <button 
    type="submit"
    class="btn peach-gradient col-md-12 mx-auto"
    style="margin:10px 0;font-size:14px;"
    >変更する</button>
  </form>
@endsection


{{-- js埋め込み --}}
@section('js')
  {{-- 4は空白ということだからあらかじめ除外 --}}
  @if ($todo->priority!==4)
  <script>
    // laravelからjsに変数を渡す
    const priority='{{$todo->priority}}';
    // ラジオボタンのidとvalueの数字が揃っているので,これでひとつのラジオボタンが特定できる
    const radio= document.getElementById(`inlineRadio${priority}`);
    //特定のラジオボタンにcheckedを追加（これでボタン押した時と同じ見た目になる）
    radio["checked"]="checked";
  </script>
  @endif


    
  
@endsection