<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory;

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'title',
        'content',
        'image',
        'slug',
        'category_id',
        'is_highlighted',
        'user_id'
    ];

    // Relasi dengan kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);  // Menambahkan relasi ke model User
    }

    public function comments()
{
    return $this->hasMany(Comment::class);
}



    // Jika diperlukan, dapat juga menambahkan method untuk membuat slug secara otomatis
    public static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $article->slug = Str::slug($article->title);
            $article->user_id = Auth::user()->id;
        });
    }
}