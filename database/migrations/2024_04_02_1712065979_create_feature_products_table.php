<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_products', function (Blueprint $table) {
            $table->id();
			$table->foreignId('feature_id')
			->constrained()
			->onDelete('cascade');
			$table->foreignId('product_id')
			->constrained()
			->onDelete('cascade');
			$table->integer('quantite');
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
        Schema::dropIfExists('feature_products');
    }
}
