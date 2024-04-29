<?php

use Illuminate\Support\Facades\Route;
use App\Models\Image;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
     $images = Image::all();
    foreach ($images as $image) {
        echo $image->image_path."<br/>";
        echo $image->description."<br/>";
        echo "<b>".$image->user->name.' '.$image->user->surname."</b>";
        if(count($image->comments) >= 1){
        echo '<br/><strong>COMENTARIOS</strong>';
            foreach ($image->comments as $comment){
                echo '<br/>'.$comment->user->name.' '.$comment->user->surname.' : ';
                echo $comment->content;
            }
        }
        echo '<br/> Likes : '.count($image->likes);
        echo "<hr/>";

    }
    return view('welcome');
});

Auth::routes();
//rutas principales
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rutas USER
Route::get('/configuracion', [App\Http\Controllers\UserController::class, 'config'])->name('config');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('UserUpdate');
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('UserAvatar');
Route::get('/user/profile/{id}', [App\Http\Controllers\UserController::class, 'profileUser'])->name('ViewUser');

//rutas IMAGES
Route::get('/image/create', [App\Http\Controllers\ImageController::class, 'create'])->name('ImageCreate');
Route::post('/image/SaveImage', [App\Http\Controllers\ImageController::class, 'SaveImage'])->name('SaveImage');
Route::get('/image/file/{filename}', [App\Http\Controllers\ImageController::class, 'getImages'])->name('GetImages');
Route::get('/image/{id}', [App\Http\Controllers\ImageController::class, 'detailImage'])->name('ImageDetail');

//rutas COMMENTS
Route::post('/comment/SaveComment', [App\Http\Controllers\CommentController::class, 'saveComment'])->name('SaveComment');
Route::get('/comment/DeleteComment/{id}', [App\Http\Controllers\CommentController::class, 'deleteComment'])->name('DeleteComment');

//rutas LIKE

Route::get('/like/{id}', [App\Http\Controllers\LikeController::class, 'like'])->name('SaveLike');
Route::get('/dislike/{id}', [App\Http\Controllers\LikeController::class, 'dislike'])->name('DeleteLike');
Route::get('/likes', [App\Http\Controllers\LikeController::class, 'index'])->name('ListLike');
