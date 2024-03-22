<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "blog_comments";

    protected $fillable = [
        'blog_id',
        'full_name',
        'comment',
        'status',
        'created_at',
        'updated_at'
    ];
}
