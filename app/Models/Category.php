<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * fillable column
     * @var array
     */
    protected $fillable = [
        "name",
    ];

    /**
     * get all blog the belong to the category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogss() {
        return $this->hasMany(Blog::class);
    }
}
