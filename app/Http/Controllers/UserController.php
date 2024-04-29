<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\User;

class UserController extends Controller
{
    //restringir acceso a usuarios sin auntenticar
    public function __construct()
    {
        $this->middleware('auth');
    }

    //mostrar vista configurar
    public function config(){
        return view ('user.config');
    }

    //Obtiene datos de formulario, guarda cambios en tabla, redireeciona a vista config
    public function update(Request $req){
        $user = \Auth::user();
        $id = $user->id;

        //validacion
        $validate = $this->validate($req, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);

        
        //recoger datos del formulario
        $name = $req->input('name');
        $surname = $req->input('surname');
        $nick = $req->input('nick');
        $email = $req->input('email');

        //llenar objetos con los nuevos datos
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        $image_path = $req->file('image_path');
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            $user->image = $image_path_name;
        }
        //ejecutar consulta
        $user->update();

        //redireccionar usuario 
        return redirect()->route('config')->with(['message' => 'Usuario Actualizado correctamente']);
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
    public function profileUser($id){
        $user = User::Find($id);
        return view('user.profile',[
            'user' => $user
        ]);
    }
}
