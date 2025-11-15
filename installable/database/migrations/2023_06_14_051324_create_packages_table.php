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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->text('slider_imgs');
            $table->string('featured_img');
            $table->string('plan_type');
            $table->unsignedMediumInteger('max_persons')->nullable();
            $table->integer('number_of_days')->default(1);
            $table->string('pricing_type');
            $table->unsignedDecimal('package_price', 8, 2)->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedDecimal('avg_rating', 8, 2)->nullable();
            $table->unsignedInteger('is_featured')->default(0);
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
        Schema::dropIfExists('packages');
    }
};
