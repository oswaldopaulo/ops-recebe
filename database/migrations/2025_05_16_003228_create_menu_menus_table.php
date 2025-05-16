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
        Schema::create('menu_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('session_id');
            $table->string('description', 100);
            $table->string('tooltips', 255)->nullable();
            $table->string('route', 100)->nullable();
            $table->string('icon', 100)->nullable();
            $table->boolean('collapsed')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_menus');
    }
};
