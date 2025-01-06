<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('mobile', 15)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('avatar')->nullable();
            $table->rememberToken();
            $table->string('two_factor_code', 20)->nullable();
            $table->dateTime('two_factor_expires_at')->nullable();
            $table->enum('is_active', ['Y', 'N'])->nullable()->default('Y');
            $table->enum('is_account_locked', ['Y', 'N'])->nullable()->default('Y');
            $table->string('two_factor_code_resend_attempt', 100)->nullable();
            $table->integer('logins')->nullable();
            $table->string('last_login_ip', 50)->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->dateTime('account_locked_at')->nullable();
            $table->integer('login_attempt')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_at')->nullable();
            $table->timestamp('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
