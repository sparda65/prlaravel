<div class="card pub-image">
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
                        <a href="{{ route('ImageDetail',['id'=>$image->id]) }}">
                            <div class="image-container">
                                <img src="{{ route('GetImages',['filename'=>$image->image_path]) }}"/>
                            </div>
                        </a>
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
                            <a href="{{ route('ImageDetail',['id'=>$image->id]) }}" class="btn btn-warning btn-sm btn-comments">
                                Comentarios ({{count($image->comments)}})
                            </a>
                        </div>
                    </div>
                </div>