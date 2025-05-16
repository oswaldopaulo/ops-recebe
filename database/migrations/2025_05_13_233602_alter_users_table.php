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
        //
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
            $table->string('document', 20)->nullable()->unique();
            $table->string('username', 20)->nullable()->unique();
            $table->tinyInteger('type', )->comment('0: Fisica, 1: Juridica')->default(0);
            $table->tinyInteger('active', )->comment('0: No, 1: Yes')->default(1);
            $table->string('role', 10)->default('user')->comment('user, admin');
            $table->integer('group')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
//        Schema::table('users', function (Blueprint $table) {
//            $table->dropColumn('document');
//            $table->dropColumn('username');
//            $table->dropColumn('group');
//            $table->dropColumn('deleted_at');
//        });
    }
};
