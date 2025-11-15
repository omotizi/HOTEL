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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->text('slider_imgs');
            $table->string('featured_img');
            $table->unsignedTinyInteger('status');
            $table->unsignedSmallInteger('bed');
            $table->unsignedSmallInteger('bath');
            $table->integer('max_guests')->nullable();
            $table->unsignedDecimal('rent',8,2);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->unsignedTinyInteger('is_featured')->default(0);
            $table->unsignedDecimal('avg_rating', 8, 2)->nullable();
            $table->unsignedInteger('quantity')->default(1);
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
        Schema::dropIfExists('rooms');
    }
};
