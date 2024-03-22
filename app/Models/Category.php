<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        'category_name',
        'url_slug',
        'user_id',
        'status',
        'created_at',
        'updated_at'
    ];

    protected static function boot(){
            parent::boot();

            // Automatically generate url_slug when creating a new category
            static::creating(function ($category) {
                $category->url_slug = Str::slug($category->category_name);
            });

            // Update url_slug when category_name is updated
            static::updating(function ($category) {
                if ($category->isDirty('category_name')) {
                    $category->url_slug = Str::slug($category->category_name);
                }
            });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   
}
