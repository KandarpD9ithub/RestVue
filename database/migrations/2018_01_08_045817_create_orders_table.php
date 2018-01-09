<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->string('transaction_id')->nullable();
            $table->string('order_number');
            $table->enum('status', ['ordered', 'in_progress', 'ready', 'delivered', 'canceled'])->default('ordered');
            $table->unsignedTinyInteger('payment_method')->comment('1: cash, 2:card, 3:paytm');
             $table->unsignedTinyInteger('parcel')->comment('0 (No), 1 (Yes)')->nullable();
            $table->integer('cash_given')->nullable();
            $table->unsignedInteger('order_taken_by');
            $table->dateTime('progress')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->unsignedInteger('cancelled_by')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->unsignedInteger('in_progress_by')->nullable();
            $table->unsignedInteger('ready_by')->nullable();
            $table->unsignedInteger('delivered_by')->nullable();
            $table->string('table_id')->nullable();
            $table->dateTime('ordered_at')->nullable();
            $table->dateTime('ready_at')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('discount')->nullable();
            $table->string('offer')->nullable();
            $table->string('tax_collected')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('paytm_mobile')->nullable();
            $table->string('card_number')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
