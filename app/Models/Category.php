<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'name',
    ];

    // Relasi dengan artikel
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}