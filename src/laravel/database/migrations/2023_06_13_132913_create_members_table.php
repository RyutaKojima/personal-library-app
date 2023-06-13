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
        Schema::create('members', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->comment('FK: users');
            $table->foreignId('library_id')->constrained()->comment('FK: libraries');
            $table->enum('role', ['member', 'librarian', 'owner'])->comment('役割');
            $table->timestamps();

            $table->unique(['user_id', 'library_id']);

            $table->comment('会員情報');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
