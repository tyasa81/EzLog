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
        if (! Schema::hasTable('logs')) {
            Schema::create('logs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('loggable_type');
                $table->unsignedBigInteger('loggable_id');
                $table->string('acted_by_type');
                $table->unsignedBigInteger('acted_by_id');
                $table->string('action');
                $table->string('column');
                $table->string('before')->nullable();
                $table->string('after');
                $table->string('description')->nullable();
                $table->timestamps();

                $table->index(['loggable_type', 'loggable_id', 'user_id'], 'loggable_user_index');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
