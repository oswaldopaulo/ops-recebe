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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->Integer('userid')->index();
//            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade'); // Definição da chave estrangeira
            $table->string('name', 100)->nullable();
            $table->string('document', 20)->nullable();
            $table->tinyInteger('type')->comment('0: Fisica, 1: Juridica')->default(0);
            $table->boolean('active')->comment('0: No, 1: Yes')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
