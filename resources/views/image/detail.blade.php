@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')
            <div class="card pub-image pub-image-detail">
                <div class="card-header">
                    @if($image->user->image)
                        <div class="container-avatar">
                            <img class="avatar" src="{{ route('UserAvatar',['filename'=>$image->user->image]) }}"/>
                        </div>
                    @endif
                    <div class="data-user">
                        <a href="{{ route('ViewUser', ['id'=>$image->user->id]) }}">
                            {{ $image->user->name." ".$image->user->surname." | " }}
                            <span class="nick">
                                {{ "@".$image->user->nick}}
                            </span>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="image-container image-container">
                        <img src="{{ route('GetImages',['filename'=>$image->image_path]) }}"/>
                    </div>

                    <div class="descripcion">
                        <span class="nick"> {{ "@".$image->user->nick }}</span>
                        <span class="nick date">
                            {{ " | ".\FormatTime::LongTimeFilter($image->created_at)}}
                        </span>
                        <p>{{$image->description}}</p>
                    </div>
                    

                    <div class="likes">
                        <!-- Comprobar si usuario logeado dio like a publicacion -->
                        <?php $user_like = false; ?>
                        @foreach($image->likes as $like)
                            @if($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                            @endif
                        @endforeach
                        @if($user_like)
                        <img src="{{ asset('img/heart-red.png') }}" data-id="{{$image->id}}" class="btn-dislike" />
                        @else
                        <img src="{{ asset('img/heart-black.png') }}" data-id="{{$image->id}}" class="btn-like" />
                        @endif
                        <span class="number_likes">
                            {{count($image->likes)}}
                        </span>
                    </div>


                    <div class="comments">
                        <h2>Comentarios ({{count($image->comments)}})</h2>
                        <hr>
                        <div class="clear-fix"></div>
                        <form method="post" action="{{route('SaveComment')}}">
                        	@csrf
                        	<input type="hidden" name="image_id" value="{{$image->id}}">
                        	<p>
                        		<textarea class="form-control {{$errors->has('content') ? 'is-invalid' : ''}}" name="content" required></textarea>
                        	</p>
                        	<button type="submit" class="btn btn-success">Enviar</button>
                        </form>
                        @foreach($image->comments as $comment)
                        	<div class="comment">
		                        <span class="nick"> {{ "@".$comment->user->nick }}</span>
		                        <span class="nick date">
		                            {{ " | ".\FormatTime::LongTimeFilter($comment->created_at)}}
		                        </span>
		                        <p>{{$comment->content}}</p>
		                        @if(Auth::check() && ($comment->user_id == Auth::user()->id ||  $comment->image->user_id== Auth::user()->id))
		                        <a href="{{route('DeleteComment',['id'=>$comment->id])}}" class="btn btn-sm btn-danger">Eliminar</a>
		                        @endif
                        	</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <br/>
        </div>
    </div>
</div>
@endsection
