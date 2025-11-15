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
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->string('meta_keyword_home')->nullable();
            $table->text('meta_description_home')->nullable();
            $table->string('meta_keyword_blogs')->nullable();
            $table->text('meta_description_blogs')->nullable();
            $table->string('meta_keyword_contact_us')->nullable();
            $table->text('meta_description_contact_us')->nullable();
            $table->string('meta_keyword_gallery')->nullable();
            $table->text('meta_description_gallery')->nullable();
            $table->string('meta_keyword_rooms')->nullable();
            $table->text('meta_description_rooms')->nullable();
            $table->string('meta_keyword_services')->nullable();
            $table->text('meta_description_services')->nullable();
            $table->string('meta_keyword_packages')->nullable();
            $table->text('meta_description_packages')->nullable();
            $table->string('meta_keyword_error_page')->nullable();
            $table->text('meta_description_error_page')->nullable();
            $table->string('meta_keyword_registration')->nullable();
            $table->text('meta_description_registration')->nullable();
            $table->string('meta_keyword_login')->nullable();
            $table->text('meta_description_login')->nullable();
            $table->string('meta_keyword_forget_password')->nullable();
            $table->text('meta_description_forget_password')->nullable();
            $table->string('meta_keyword_faq')->nullable();
            $table->text('meta_description_faq')->nullable();
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
        Schema::dropIfExists('seos');
    }
};
