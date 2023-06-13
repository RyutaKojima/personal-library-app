<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('libraries', static function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->comment('図書館名');
            $table->string('identification_code', 100)->unique()->comment('図書館識別コード');
            $table->timestamps();
            $table->softDeletes();

            $table->comment('図書館情報');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libraries');
    }
};
