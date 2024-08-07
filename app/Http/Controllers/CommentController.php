<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function addComment(CommentRequest $request,Blog $blog){
        $blog->comments()->create([
            'content' => $request->content,
        ]);
        return back()->with('success', 'your Comment added successfully!');
    }

}
