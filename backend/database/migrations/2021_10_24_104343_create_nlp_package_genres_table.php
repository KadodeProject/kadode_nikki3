<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNlpPackageGenresTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nlp_package_genres', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->comment('ジャンル名');
            $table->string('description')->nullable()->comment('説明');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nlp_package_genres');
    }
}
