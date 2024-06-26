<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
			$table->string('nom')->nullable()->default('');
			$table->string('slug')->unique();
			$table->text('description')->nullable()->default('');
			$table->string('icon_img_url')->nullable()->default('');
			$table->string('display_img_url')->nullable()->default('');
			$table->integer('quantite');
			$table->foreignId('category_id')
            ->nullable()
			->constrained()
			->nullOnDelete();
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
        Schema::dropIfExists('categories');
    }
}
