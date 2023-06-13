<?php

declare(strict_types=1);

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
        Schema::create('book_stocks', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->comment('FK: books');
            $table->unsignedTinyInteger('max_stocks')->comment('書籍の在庫数');
            $table->unsignedTinyInteger('current_stocks')->comment('現在ある在庫数');
            $table->timestamps();

            $table->comment('在庫数');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_stocks');
    }
};
