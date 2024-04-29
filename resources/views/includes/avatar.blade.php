@if(Auth::user()->image)
<div class="container-avatar">
    <img class="avatar" src="{{ route('UserAvatar', ['filename'=>Auth::user()->image]) }}"/>
</div>
@endif