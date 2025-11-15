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
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('search_section')->default(1);
            $table->tinyInteger('intro_section')->default(1);
            $table->tinyInteger('featured_rooms_section')->default(1);
            $table->tinyInteger('featured_services_section')->default(1);
            $table->tinyInteger('faq_section')->default(1);
            $table->tinyInteger('statistics_section')->default(1);
            $table->tinyInteger('video_section')->default(1);
            $table->tinyInteger('featured_package_section')->default(1);
            $table->tinyInteger('facilities_section')->default(1);
            $table->tinyInteger('testimonials_section')->default(1);
            $table->tinyInteger('blogs_section')->default(1);
            $table->tinyInteger('brand_section')->default(1);
            $table->tinyInteger('top_footer_section')->default(1);
            $table->tinyInteger('copyright_section')->default(1);
            $table->tinyInteger('package_feature_setion')->default(1);
            $table->tinyInteger('latest_package_section')->default(1);
            $table->tinyInteger('room_feature_section')->default(1);
            $table->tinyInteger('latest_room_section')->default(1);
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
        Schema::dropIfExists('home_sections');
    }
};
