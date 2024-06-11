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
        Schema::create('infobooks', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->unsignedBigInteger('user_id'); // 外キー ユーザーID
            $table->string('title'); // 本のタイトル
            $table->string('authors')->nullable(); // 著者名
            $table->date('publishedDate')->nullable(); // 出版日
            $table->text('description')->nullable(); // 説明文
            $table->string('imageLinks')->nullable(); // サムネイル画像
            $table->timestamps(); // created_at と updated_at

            // 外部キー制約の追加
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infobooks');
    }
};