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
        Schema::create('contact_addresses', function (Blueprint $table) {

            $table->id();
            $table->string('descricao',50);
            $table->foreignId("contactid")->references('id')->on('contacts')->onDelete('cascade');
            $table->string('cep',10)->index();
            $table->string('endereco',100);
            $table->string('bairro',100);
            $table->string('cidade',100);
            $table->string('uf',2);
            $table->string('numero',10)->nullable();
            $table->string('referencia',100)->nullable();
            $table->string('complemento',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_addresses');
    }
};
