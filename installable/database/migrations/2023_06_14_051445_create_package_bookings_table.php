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
        Schema::create('package_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_number');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->unsignedBigInteger('package_id');
            $table->unsignedInteger('visitors');
            $table->unsignedDecimal('subtotal', 8, 2);
            $table->unsignedDecimal('discount', 8, 2)->default(0.00);
            $table->unsignedDecimal('grand_total', 8, 2)->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('currency_symbol_position')->nullable();
            $table->string('currency_text')->nullable();
            $table->string('currency_text_position')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('gateway_type')->nullable();
            $table->string('attachment')->nullable();
            $table->string('invoice')->nullable();
            $table->unsignedTinyInteger('payment_status')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('package_bookings');
    }
};
