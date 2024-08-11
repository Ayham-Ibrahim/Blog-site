<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'content',
        'photo',
    ];

    /**
     * Get the user that owns the Blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     *  comments that belongs to the Blog
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * get the category that the blog belongs to
     * @return BelongsTo
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
     *  make the user_id of the Blog is the id of the auth user how add the blog
     * @return void
     */
    public static function boot() {
        parent::boot();

        static::creating(function($blog){
            $blog->user_id = Auth::user()->id;
        });
    }

}
