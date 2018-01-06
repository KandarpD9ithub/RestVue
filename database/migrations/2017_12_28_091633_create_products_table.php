<?php

/**
 * @package Database/migrations
 *
 * @class CreateProductsTable
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('price')->nullable();            
            $table->integer('categories_id')->unsigned();
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->integer('sub_categories_id')->unsigned();
            $table->foreign('sub_categories_id')->references('id')->on('sub_categories');
            //$table->string('tax_id')->nullable();
            /*$table->integer('tax_id')->unsigned();
            $table->foreign('tax_id')->references('id')->on('taxes');*/
            $table->string('available')->nullable();
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->enum('is_active',['0','1'])->comment('0 (inActive), 1 (Active)')->default(1)->nullable();
            $table->string('time_duration')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
