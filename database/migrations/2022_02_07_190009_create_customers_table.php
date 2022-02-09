<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->text('name');
            $table->text('email');
            $table->text('phone');
            $table->longText('address');
            $table->text('credit_card_number')->nullable();
            $table->date('expiration_date')->nullable();
            $table->integer('cvv_code')->nullable();
            $table->text('credit_card_name')->nullable();
            $table->text('atm_card_number')->nullable();
            $table->text('bank_name')->nullable();
            $table->text('atm_card_name')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
