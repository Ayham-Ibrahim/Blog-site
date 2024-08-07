<?php

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//landing page
Route::get('/', [BlogController::class, 'index'])->name('blogs.index');

//search
Route::get('/blogs/search', [BlogController::class, 'search'])->name('blogs.search');


Route::middleware('auth')->group(function () {
    //home page
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //blogs (crud)
    Route::resource('blogs', BlogController::class)->except(['index']);
    
    
    //blog softdeleted
    Route::get('blogs.show-deleted', [BlogController::class, 'deletedblog'])->name('deletedblog');
    Route::delete('blogs.forcedelete/{id}', [BlogController::class, 'forcedelete'])->name('forcedelete');
    Route::get('blogs.restore/{id}', [BlogController::class, 'restore'])->name('restore');
    //blog softdeleted
    
    // show blog details for all users
    Route::get('show/{blog}', [BlogController::class, 'showForAll'])->name('showForAll');
    
    // add comment
    Route::post('add-comment/{blog}', [CommentController::class, 'addComment'])->name('addComment');
});
