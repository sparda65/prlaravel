<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
    //restringir acceso a usuarios sin auntenticar
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function saveComment(Request $req){
        $user = new User();
        $comment = new Comment();
        $user = \Auth::user();

        $validate = $this->validate($req,[
                                'image_id' => 'integer|required',
                                'content'  => 'string|required']);

        $user_id = $user->id;
        $image_id = $req->input('image_id');
        $content = $req->input('content');

        $comment->user_id = $user_id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();


        return redirect()->route('ImageDetail',['id'=>$image_id])->with([
            'message' => 'Comentario creado correctamente!'
        ]);

    }

    public function deleteComment($id){
        $user = new User();

        $user = \Auth::user();
        $comment = Comment::find($id);

        if($user && ($comment->user_id == $user->id ||  $comment->image->user_id== $user->id)){
            $comment->delete();
        }else{
             return redirect()->route('ImageDetail',['id'=>$image_id])->with([
                'message' => 'Comentario eliminado correctamente!'
            ]);
        }

        return redirect()->route('ImageDetail',['id'=>$comment->image->id])->with([
            'message' => 'Comentario no se ha eliminado!'
        ]);

    }
}
