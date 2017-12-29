<?php

/**
 * @package Database/migrations
 *
 * @class CreateDiscountOfferRulesTable
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->integer('country')->nullable();
            $table->string('mobile', 15)->nullable();
            $table->unsignedTinyInteger('role_name')->comment('1 (Admin), 2 (Accountant), 3 (Cashier), 4 (Store Manager), 5 ( Chef)');
            $table->enum('is_active', [0,1])->default(1);
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
