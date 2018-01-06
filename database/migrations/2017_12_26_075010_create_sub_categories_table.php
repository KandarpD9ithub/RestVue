<?php
/**
 * @package Database/migrations
 *
 * @class CreateSubCategoriesTable
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            //$table->string('categories_id')->nullable();
            $table->integer('categories_id')->unsigned();
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->unsignedTinyInteger('available')->comment('0 (No), 1 (Yes)')->default(0);
            $table->unsignedTinyInteger('is_active')->comment('0 (inActive), 1 (Active)')->default(1);
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
        Schema::dropIfExists('sub_categories');
    }
}
