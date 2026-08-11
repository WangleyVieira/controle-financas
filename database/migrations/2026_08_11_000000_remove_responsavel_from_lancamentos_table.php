<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lancamentos', function (Blueprint $table) {
            $table->dropForeign(['responsavel_id']);
            $table->dropColumn('responsavel_id');
        });

        Schema::dropIfExists('responsavels');
    }

    public function down(): void
    {
        Schema::create('responsavels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->uuid('cadastrado_por_usuario')->nullable();
            $table->foreign('cadastrado_por_usuario')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('lancamentos', function (Blueprint $table) {
            $table->unsignedInteger('responsavel_id')->nullable()->after('wangley_falta_pagar');
            $table->foreign('responsavel_id')->references('id')->on('responsavels');
        });
    }
};
