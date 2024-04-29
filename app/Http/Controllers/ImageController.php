<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Image;
use App\Models\User;

class ImageController extends Controller
{
    //restringir acceso a usuarios sin auntenticar
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Create(){
        return view('image.create');
    }

    public function SaveImage(Request $req){
        $image = new Image();
        $user = new User();
        //llenar objeto con usuario autenticado
        $user = \Auth::user();
        $id = $user->id;
        //validaciones
        $validate = $this->validate($req,[
                                'description' => 'required',
                                'image_path'  => 'required|image']);

        //recoger datos
        $image_path = $req->file('image_path');
        $descripcion = $req->input('description');
        //recoger archivo imagen y darle nuevo nombre desde el servidor
        //se crea nombre unico con el tiemp preciso del que se subio para que sea irrepetible
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            //llenar atributo path con el nuevo nombre creado
            $image->image_path = $image_path_name;
        }
        
        //lenar objeto imagen con los datos
        $image->description = $descripcion;
        $image->user_id = $id;

        //guardar data
        $image->save();
        
        return redirect()->route('home')->with([

            'message' => 'Imagen subida correctamente!'
        ]);
    }
    public function getImages($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detailImage($id)
    {
        $image = Image::find($id);
        return view('image.detail', [
            'image' => $image
        ]);
    }
}
