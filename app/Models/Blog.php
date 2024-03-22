<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = "blogs";
    protected $fillable = [
    'blog_title',
    'url_slug',
    'descritption',
    'image',
    'display_on_home',
    'user_id',
    'category_id',
    'status',
];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}
}
