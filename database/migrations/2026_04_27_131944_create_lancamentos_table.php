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
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 20)->default('gasto');
            $table->string('descricao', 255);
            $table->decimal('valor', 12, 2);
            $table->date('data_vencimento');
            $table->unsignedTinyInteger('dia_pagamento')->nullable();
            $table->boolean('is_pago')->default(false);
            $table->date('data_pagamento')->nullable();
            $table->text('observacao')->nullable();
            $table->string('link_pagamento')->nullable();
            $table->boolean('is_parcelado')->default(false);
            $table->unsignedInteger('parcela_atual')->nullable();
            $table->unsignedInteger('total_parcelas')->nullable();
            $table->decimal('valor_parcela', 12, 2)->nullable();
            $table->uuid('grupo_parcelamento')->nullable();

            $table->boolean('is_fixo')->default(false);

            $table->integer('responsavel_id')->unsigned();
            $table->foreign('responsavel_id')->references('id')->on('responsavels');

            $$table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');

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
        Schema::dropIfExists('lancamentos');
    }
};
