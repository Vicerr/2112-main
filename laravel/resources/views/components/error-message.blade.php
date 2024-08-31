@if(session()->has('error'))
<div id="flash-message" class="error--message">
  <span id="closebtn" class="closebtn">&times;</span>
    <b>
    {{session('error')}}
    </b>
</div>
@endif