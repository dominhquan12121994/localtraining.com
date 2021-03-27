<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('refund_id');
            $table->unsignedBigInteger('receiver_id');
            $table->char('lading_code', 50);
            $table->smallInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('orders', function($table) {
            $table->foreign('shop_id')->references('id')->on('order_shops');
            $table->foreign('sender_id')->references('id')->on('order_shops_address');
            $table->foreign('refund_id')->references('id')->on('order_shops_address');
            $table->foreign('receiver_id')->references('id')->on('order_receivers');
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
