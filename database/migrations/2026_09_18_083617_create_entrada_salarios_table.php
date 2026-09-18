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
        Schema::create('entrada_salarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('competencia', 7);
            $table->string('descricao');
            $table->decimal('valor_salario', 12, 2);

            $table->uuid('cadastrado_por_usuario')->nullable();
            $table->foreign('cadastrado_por_usuario')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_salarios');
    }
};
