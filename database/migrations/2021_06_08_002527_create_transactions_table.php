<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('transactions');
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id'); //id untuk pembayaran
            $table->integer('qrcode_owner_id')->nullable();
            $table->integer('qrcode_id');
            $table->string('payment_method')->nullable(); //pembayaran user seperti bank 
            $table->longText('message')->nullable();
            $table->float('amount', 10, 4);
            $table->string('status')->default('initiated');   
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
        Schema::dropIfExists('transactions');
    }
}
