<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
    @yield('title')
  </title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
  <style>
    .add-button{
      margin: 15px 0 10px 0;
      font-size:15px;
    }
    .priority-text{
      writing-mode: vertical-rl;
      position:absolute;
      right:-25px;
      top:13px;
      font-size:12.5px;
      font-weight: bold;
    }
    .priority-text{
      pointer-events: none;
    }
  </style>
</head>

<body>
  {{-- ナビバー入れる --}}
  @yield('nav')
  <div class="container" >
    <div class="row justify-content-center">
      <div class="col-md-7" >
        <div class="card cloudy-knoxville-gradient " style="margin-top:20px;padding-top:10px;text-align:center;">
          {{-- ページのタイトル --}}
          @yield('content-title')
        </div>
        <div class="card cloudy-knoxville-gradient" style="margin-top: 20px;padding:0 30px 10px 30px;">
          {{-- ここに内容が入る --}}
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  <!-- JQuery -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>

  {{-- js埋め込む時ここに入る --}}
  @yield('js')




</body>

</html>