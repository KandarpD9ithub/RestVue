<?php
/**
 * @package Database/migrations
 *
 * @class CreateCustomersTable
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mobile_number');
            $table->string('email')->nullable();
            $table->integer('country')->nullable();
            $table->unsignedTinyInteger('gender')->comment('0 (male), 1 (female)')->default(0);
            $table->string('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->unsignedTinyInteger('is_active')->comment('0 (inActive), 1 (Active)')->default(1);
            $table->unsignedTinyInteger('created_by')->nullable();
            $table->unsignedTinyInteger('updated_by')->nullable();
            //$table->enum('gender',[0,1])->comment('0 (male), 1 (female)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
