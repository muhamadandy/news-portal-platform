<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'livewire/upload-file', // Tambahkan ini agar upload file tidak terkena CSRF
    ];
}