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
        Schema::create('master_states', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('zone_title', 10)->nullable();
            $table->integer('zone_id')->nullable();
            $table->string('state', 100)->nullable()->unique('unique_state_title');
            $table->string('hindi', 255)->nullable();
            $table->string('gujarati', 255)->nullable();
            $table->string('marathi', 255)->nullable();
            $table->string('panjabi', 255)->nullable();
            $table->string('tamil', 255)->nullable();
            $table->string('telugu', 255)->nullable();
            $table->string('kannada', 255)->nullable();
            $table->string('bengali', 255)->nullable();
            $table->string('oriya', 255)->nullable();
            $table->string('assamese', 255)->nullable();
            $table->string('code', 10)->nullable();
            $table->string('synonyms_name', 500)->nullable();
            $table->string('slug', 100)->nullable();
            $table->integer('sort_no')->default(0);
            $table->dateTime('created_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();

            $table->unique(['zone_id', 'state'], 'unique_state_ao_zone_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_states');
    }
};
