<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageNERSTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('package_n_e_r_s', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('package_id')->comment('登録しているパッケージの名前');
            $table->unsignedBigInteger('label_id')->comment('ラベルのID');
            $table->string('name')->comment('名前');
            $table->timestamps();

            // 他テーブルとの関連付け
            $table->foreign('package_id')
                ->references('id')
                ->on('nlp_package_names')
                ->onDelete('cascade') // cascadeでパッケージ消えたらNEデータも消せる
;

            $table->foreign('label_id')
                ->references('id')
                ->on('n_e_r_labels')
                ->onDelete('cascade') // cascadeでラベル消えたら統計データも消せる
;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_n_e_r_s');
    }
}
