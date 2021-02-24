<nav class="navbar peach-gradient">
  <div class="row col-md-12 mx-auto">

    <a href="/">
      <h2 style="color:white;margin-top:10px;">pcp課題最新</h2>
    </a>

    <div class="col-md-4 row align-items-end justify-content-between mx-auto" style="position:absolute;bottom:0;right:0;">


      {{-- CSV出力 --}}
      <form action="{{route('CSV')}}" method="POST" style="margin: 0;">
        @csrf
        <button class="btn heavy-rain-gradient rounded waves-effect" type="submit" style="color:rgb(49, 49, 49);padding:5px 10px;margin:0;">CSV出力</button>
      </form>


      

      
      @if(count($todos)>0)
      
      {{-- 優先順位オンオフ --}}
        <form action="{{route('priority')}}" method="POST" style="margin: 0;">
          @csrf
          <button class="btn heavy-rain-gradient rounded waves-effect" type="submit" style="color:rgb(49, 49, 49);padding:5px 10px;margin:0;">

            @if ($priority->number==0)
              優先度オンにする
            @endif
            @if ($priority->number==1)
            優先度オフにする
            @endif
            
          </button>
        </form>
        
        <form action="{{route('sort')}}" method="POST" style="margin: 0;">
          @csrf
          <button class="btn heavy-rain-gradient rounded waves-effect" type="submit" style="color:rgb(49, 49, 49);padding:5px 10px;margin:0;">
            @if($sort->number==0)
            入力した順にする
            @endif
            @if ($sort->number==1)
            優先順位順にする
            @endif
            
          </button>
        </form>
      @endif
        
      </div>
      
    </div>
    
    
  </nav>