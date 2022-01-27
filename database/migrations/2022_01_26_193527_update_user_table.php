<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('phone');
            $table->longText('address')->nullable();
            $table->text('payment_method');
            $table->text('credit_card_number')->nullable();
            $table->date('expiration_date')->nullable();
            $table->integer('ccv_code')->nullable();
            $table->text('credit_card_name')->nullable();
            $table->text('atm_card_number')->nullable();
            $table->text('bank_name')->nullable();
            $table->text('atm_card_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
