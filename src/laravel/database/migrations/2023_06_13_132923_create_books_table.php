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
        Schema::create('books', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('library_id')->constrained()->comment('FK: libraries');
            $table->string('title', 255)->comment('書籍名');
            $table->string('isbn', 21)->comment('ISBN = 書籍の国際標準図書番号');
            $table->string('author', 255)->comment('著者名');
            $table->string('publisher', 255)->comment('出版社名');
            $table->timestamps();
            $table->softDeletes();

            $table->comment('図書情報');
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
