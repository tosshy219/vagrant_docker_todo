@if ($priority->number==1)
  @if ($todo->priority==1)
    <span class="priority-text" style="color:rgb(233, 72, 44);">重要</span>
  @endif
  @if ($todo->priority==2)
    <span class="priority-text" style="color:rgb(191, 162, 0);">普通</span>
  @endif
  @if ($todo->priority==3)
    <span class="priority-text" style="color:rgb(42, 145, 45);font-size:11.5px;">後で<span style="writing-mode:horizontal-tb;">OK</span></span>
  @endif
@endif
