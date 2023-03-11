<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->unsignedInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->unsignedInteger('qty');
            $table->unsignedInteger('subtotal');
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
        Schema::dropIfExists('transaction_details');
    }
};
