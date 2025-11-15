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
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('background_image')->nullable();
            $table->string('background_color')->nullable();
            $table->decimal('background_opacity', 8,2)->default(1);
            $table->string('title')->nullable();
            $table->text('text')->nullable();
            $table->string('button_text')->nullable();
            $table->text('button_url')->nullable();
            $table->string('button_color')->nullable();
            $table->string('end_date')->nullable();
            $table->string('end_time')->nullable();
            $table->integer('delay')->default(1000);
            $table->integer('serial_number')->default(0);
            $table->integer('type')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
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
        Schema::dropIfExists('popups');
    }
};
