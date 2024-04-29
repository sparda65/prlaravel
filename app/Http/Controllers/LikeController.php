<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\User;

class LikeController extends Controller
{
    //restringir acceso a usuarios sin auntenticar
    public function __construct()
    {
        $this->middleware('auth');
    }

    //obtener publicaciones que usuario logeado haya dado like
    public function index()
    {
        $user = \Auth::user();
        $likes = Like::where('user_id', $user->id)
                        ->orderBy('id', 'desc')
                        ->paginate(5);
        return view('like.index', [
            'likes' => $likes
        ]);
    }
    public function like($image_id){
        $user = \Auth::user();
        $like = new Like();

        //comprobar si like ya existe
        $isset_like = Like::where('user_id', $user->id)
                                ->where('image_id', $image_id)
                                ->count();
        if($isset_like == 0){
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
    
            $like->save();

            return response()->json([
                'like' => $like
            ]);
        }else{
            return response()->json([
                'message' => 'Like ya existe'
            ]);
        }
    }    


    public function dislike($image_id){
        $user = \Auth::user();
        $like = new Like();

        //comprobar si like ya existe
        $like = Like::where('user_id', $user->id)
                                ->where('image_id', $image_id)
                                ->first();
        if($like){
            
            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'dislike'
            ]);
        }else{
            return response()->json([
                'message' => 'Like no existe'
            ]);
        }
    }    


}
