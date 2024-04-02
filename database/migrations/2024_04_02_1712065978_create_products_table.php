<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->string('nom')->nullable()->default('');
			$table->string('slug')->unique();
			$table->text('description')->nullable()->default('');
			$table->string('prix')->nullable()->default('');
			$table->enum('type_paiement');
			$table->enum('type');
			$table->json('display_img_url_list');
			$table->json('images_url_list');
			$table->foreignId('category_id')
			->constrained()
			->onDelete('cascade');
			$table->foreignId('municipality_id')
			->constrained()
			->onDelete('cascade');
			$table->foreignId('user_id')
			->constrained()
			->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
