<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_extras', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->text('note1');
            $table->text('note2');
            $table->string('client_code', 255)->default('');
        });

        Schema::table('order_extras', function($table) {
            $table->foreign('id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_extras');
    }
}
