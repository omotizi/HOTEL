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
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_number');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('room_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->unsignedInteger('guests');
            $table->unsignedDecimal('subtotal',8,2)->nullable();
            $table->unsignedDecimal('discount', 8, 2)->default(0);
            $table->unsignedDecimal('grand_total', 8, 2);
            $table->string('currency_symbol');
            $table->string('currency_symbol_position');
            $table->string('currency_text');
            $table->string('currency_text_position');
            $table->string('payment_method');
            $table->string('gateway_type');
            $table->string('attachment')->nullable();
            $table->string('invoice')->nullable();
            $table->unsignedTinyInteger('payment_status')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
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
        Schema::dropIfExists('room_bookings');
    }
};
