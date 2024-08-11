<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
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

      // Delete a comment by ID
      public function deleteComment(Blog $blog,Comment $comment)
      {
          $comment->delete();
          return back()->with('success', 'Comment deleted successfully!');
      }
  
      // Hide a comment by ID
      public function hideComment(Blog $blog, $commentId)
      {
          $comment = Comment::findOrFail($commentId);
          $comment->update(['hidden' => !$comment->hidden]);
          if($comment->hidden){
              return back()->with('success', 'Comment hidden successfully!');
          }else{
            return back()->with('success','Comment unhide successfully!');
          }

      }
    


}
