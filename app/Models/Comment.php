<?php

namespace App\Models;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'blog_id',
        'hidden',
    ];

    /**
     *  the blog how own the comment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     *  the user how own the comment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *  make the user_id of the comment is the id of the auth user how add the comment
     * @return void
     */
    public static function boot() {
        parent::boot();

        static::creating(function($comment){
            $comment->user_id = Auth::user()->id;
        });
    }
}
