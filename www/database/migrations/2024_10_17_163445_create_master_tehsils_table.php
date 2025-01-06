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
        Schema::create('master_tehsils', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('district_id')->nullable();
            $table->string('tehsil', 100)->nullable();
            $table->string('tehsil_code', 10)->nullable();
            $table->string('synonyms_name', 500)->nullable();
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
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->enum('is_new', ['Y', 'N'])->default('N');
            $table->string('comments', 255)->nullable();
            $table->string('pincode_assigned', 500)->nullable();
            $table->integer('map_tehsil_id')->nullable();
            $table->string('map_pincode', 800)->nullable();
            $table->enum('verified_on_map', ['Y', 'N'])->default('N');
            $table->dateTime('created_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_tehsils');
    }
};
