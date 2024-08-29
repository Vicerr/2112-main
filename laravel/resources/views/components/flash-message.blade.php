@if(session()->has('message'))
<div id="flash-message" class="flash--message hidden">
  <span id="closebtn" class="closebtn">&times;</span>
    <b>
    {{session('message')}}
    </b>
</div>
@endif