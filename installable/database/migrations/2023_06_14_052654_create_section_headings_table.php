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
        Schema::create('section_headings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->string('room_section_title')->nullable();
            $table->string('room_section_subtitle')->nullable();
            $table->text('room_section_text')->nullable();
            $table->string('service_section_title')->nullable();
            $table->string('service_section_subtitle')->nullable();
            $table->string('booking_section_title')->nullable();
            $table->string('booking_section_subtitle')->nullable();
            $table->string('booking_section_button')->nullable();
            $table->string('booking_section_button_url')->nullable();
            $table->string('booking_section_video_url')->nullable();
            $table->string('package_section_title')->nullable();
            $table->string('package_section_subtitle')->nullable();
            $table->string('facility_section_title')->nullable();
            $table->string('facility_section_subtitle')->nullable();
            $table->string('facility_section_image')->nullable();
            $table->string('testimonial_section_title')->nullable();
            $table->string('testimonial_section_subtitle')->nullable();
            $table->string('testimonial_section_image')->nullable();
            $table->string('faq_section_title')->nullable();
            $table->string('faq_section_subtitle')->nullable();
            $table->string('faq_section_image')->nullable();
            $table->string('blog_section_title')->nullable();
            $table->string('blog_section_subtitle')->nullable();
            $table->string('room_feature_category_title')->nullable();
            $table->string('package_feature_category_title')->nullable();
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
        Schema::dropIfExists('section_headings');
    }
};
