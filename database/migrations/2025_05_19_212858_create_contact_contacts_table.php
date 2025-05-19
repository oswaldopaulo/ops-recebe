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
        Schema::create('contact_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("contactid")->references('id')->on('contacts')->onDelete('cascade');
            $table->string('descricao',100)->nullable();
            $table->integer('tipo',)->nullable()->comment('0: Telefone, 1: Email, 2: Celular');
            $table->string('valor',255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_contacts');
    }
};
