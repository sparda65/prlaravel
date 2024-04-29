@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-user">
                @if($user->image)
                    <div class="container-avatar">
                        <img class="avatar" src="{{ route('UserAvatar',['filename'=>$user->image]) }}"/>
                    </div>
                @endif    
                <div class="user-info">
                    <h1>{{"@".$user->nick}}</h1>
                    <h2>{{$user->name." ".$user->surname}}</h2> 
                    <span class="nick date">
                        {{ "Se unio ".\FormatTime::LongTimeFilter($user->created_at)}}
                    </span>
                </div>
            </div>
            <div class="clear-fix"></div>
            @include('includes.message')
            @foreach($user->images as $image)
                <br/>
                @include('includes.image', ['image' => $image])
                <br/>
            @endforeach
            
        </div>
    </div>
</div>
@endsection
