<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'genre',
        'user_id',
    ];

    // Userモデルとのリレーションシップ
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}