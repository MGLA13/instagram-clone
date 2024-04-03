<?php

//Import facades and controllers
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\CommentaryController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SearchProfileController;
use App\Http\Controllers\ForgotPasswordController;

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


//Routes without authentication
Route::group(['middleware'=>'guest'], function()
{
  //Sign up
  Route::get('/create-account',[RegisterController::class,'index'])->name('register');
  Route::post('/create-account',[RegisterController::class,'store']);

  //Login
  Route::get('/login',[LoginController::class,'index'])->name('login');
  Route::post('/login',[LoginController::class,'store']);

  //Forgot password
  Route::get('/forgot-password',[ForgotPasswordController::class,'index'])->name('forgot');
  Route::post('/forgot-password',[ForgotPasswordController::class,'store']);

  //Reset password
  Route::get('/reset-password/{token}',[ResetPasswordController::class,'index'])->name('reset');
  Route::post('/reset-password/{token}',[ResetPasswordController::class,'store'])->middleware('throttle:5,60');;

});

//Routes with authentication
Route::group(['middleware'=>'auth'], function()
{

  //Home page
  Route::get('/',HomeController::class)->name('home');
  Route::get('/home',HomeController::class);

  //Sign out session
  Route::post('/logout',[LogoutController::class,'store'])->name('logout');

  //Create a new post
  Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');
  Route::post('/posts',[PostController::class,'store'])->name('posts.store');

  //Upload post image
  Route::post('/images',[ImageController::class,'store'])->name('images.store');

  //To search users 
  Route::get('/list-profiles',SearchProfileController::class)->name('search');
  
  //To add a comment to a post
  Route::post('/{user:username}/posts/{post}',[CommentaryController::class,'store'])->name('commentaries.store');

  //Delete a post
  Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

  //Give like to post of a user
  Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('posts.likes.store');
  
  //Give dislike to post of a user
  Route::delete('/posts/{post}/likes',[LikeController::class,'destroy'])->name('posts.likes.destroy');

  //Settings profile user
  Route::get('/edit-profile',[ProfileController::class,'index'])->name('profile.index');
  Route::post('/edit-profile',[ProfileController::class,'store'])->name('profile.store');
  
  //Get user followers
  Route::get('/{user:username}/followers',FollowerController::class)->name('user.followers');
  //Get user following
  Route::get('/{user:username}/following',FollowingController::class)->name('user.following');

  //Follow and unfollow users
  Route::post('/{user:username}/follow',[FollowController::class,'store'])->name('users.follow');
  Route::delete('/{user:username}/unfollow',[FollowController::class,'destroy'])->name('users.unfollow');


});

//To see user profile
Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');

//To see a post from a user
Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');






