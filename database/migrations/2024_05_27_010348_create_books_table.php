<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // 自動的にユニークなIDカラムを作成
            $table->string('name')->nullable(false); // 本の名前（空はダメ）
            $table->string('photo')->nullable(); // 本の写真（空でもいい）
            $table->string('genre')->nullable(); // 本の種類（空でもいい）
            $table->timestamps(); // 登録日時（created_at と updated_at）
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};