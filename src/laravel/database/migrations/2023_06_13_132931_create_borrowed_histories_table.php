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
        Schema::create('borrowed_histories', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrower_id')->constrained('users')->comment('FK: users, 借りたユーザーのID');
            $table->foreignId('book_id')->constrained()->comment('FK: books');
            $table->timestamp('borrowed_at')->comment('貸出日時');
            $table->timestamp('returned_at')->comment('返却日時');
            $table->enum('status', ['borrowed', 'returned', 'missing'])->comment('貸出状態');
            $table->timestamps();

            $table->comment('貸出履歴');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_histories');
    }
};
