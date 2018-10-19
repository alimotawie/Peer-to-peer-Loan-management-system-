<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashCollection', function (Blueprint $table) {
            $table->increments('id');
            $table->string('loan_id'); //will use loan id to get the borrower user id
            $table->string('user_id'); //lender
            $table->integer('amount')->unsigned();
            $table->float('percent');
            $table->integer('payback')->unsigned();
            $table->string('status');
            $table->string('paymentmethod');
            $table->date('deadline');
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
        Schema::dropIfExists('cashCollection');
    }
}
