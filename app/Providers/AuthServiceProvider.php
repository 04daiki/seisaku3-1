<?php

namespace App\Providers;

use App\Models\Book;
use App\Policies\BookPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    // 削除のメソッド

    protected $policies = [
        Book::class => BookPolicy::class,
    ];

    // 他のメソッド
    
}