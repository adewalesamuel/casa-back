<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
			$table->string('nom')->nullable()->default('');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('profile_img_url')->nullable()->default('');
			$table->enum('genre', ['homme', 'femme', 'other'])->nullable();
			$table->string('adresse')->nullable()->default('');
			$table->string('numero_telephone')->nullable()->default('');
			$table->string('numero_whatsapp')->nullable()->default('');
			$table->string('numero_telegram')->nullable()->default('');
			$table->string('company_name')->nullable()->default('');
			$table->string('company_logo_url')->nullable()->default('');
			$table->enum('type', ['client', 'vendeur'])->default('client');
			$table->string('api_token')->nullable()->default('');
			$table->boolean('is_active')->default(true);
			$table->boolean('is_company')->default(false);
			$table->timestamp('email_verified_at')->nullable();
			$table->rememberToken();
			$table->softDeletes();
			$table->timestamps();
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
}
