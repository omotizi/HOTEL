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
        Schema::create('basic_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('uniqid')->default(12345);
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('website_title');
            $table->string('support_email')->nullable();
            $table->string('support_contact')->nullable();
            $table->string('address');
            $table->string('base_currency_symbol');
            $table->string('base_currency_symbol_position');
            $table->string('base_currency_text');
            $table->string('base_currency_text_position');
            $table->decimal('base_currency_rate');
            $table->string('primary_color');
            $table->string('secondary_color');
            $table->string('breadcrumb_overlay_color');
            $table->decimal('breadcrumb_overlay_opacity');
            $table->tinyInteger('smtp_status');
            $table->string('smtp_host');
            $table->integer('smtp_port');
            $table->string('encryption');
            $table->string('smtp_username');
            $table->string('smtp_password');
            $table->string('from_mail');
            $table->string('from_name');
            $table->string('to_mail');
            $table->string('breadcrumb');
            $table->tinyInteger('google_recaptcha_status')->nullable();
            $table->string('google_recaptcha_site_key')->nullable();
            $table->string('google_recaptcha_secret_key')->nullable();
            $table->string('maintenance_img');
            $table->tinyInteger('maintenance_status');
            $table->text('maintenance_msg');
            $table->string('secret_path')->nullable();
            $table->string('announcement_img')->nullable();
            $table->tinyInteger('announcement_status')->nullable();
            $table->decimal('popup_delay')->nullable();
            $table->string('footer_logo')->nullable();
            $table->tinyInteger('room_category_status')->default(1);
            $table->unsignedTinyInteger('package_category_status');
            $table->unsignedTinyInteger('room_rating_status');
            $table->unsignedTinyInteger('package_rating_status');
            $table->unsignedTinyInteger('room_guest_checkout_status');
            $table->unsignedTinyInteger('package_guest_checkout_status');
            $table->string('theme_version');
            $table->string('home_version')->default('slider');
            $table->tinyInteger('is_disqus')->default(1);
            $table->string('disqus_shortname');
            $table->tinyInteger('is_tawkto')->default(1);
            $table->string('tawkto_property_id')->nullable();
            $table->tinyInteger('is_whatsapp')->default(1);
            $table->string('whatsapp_number')->nullable();
            $table->string('whatsapp_header_title')->nullable();
            $table->text('whatsapp_popup_message')->nullable();
            $table->tinyInteger('whatsapp_popup')->default();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->tinyInteger('preloader_status');
            $table->string('preloader')->nullable();
            $table->text('hero_video_link')->nullable();
            $table->string('notification_image')->nullable();
            $table->string('qr_image')->nullable();
            $table->string('qr_color')->default(000000);
            $table->unsignedInteger('qr_size')->default(250);
            $table->string('qr_style')->default('square');
            $table->string('qr_eye_style')->default('square');
            $table->unsignedInteger('qr_margin')->default(0);
            $table->string('qr_text')->nullable();
            $table->string('qr_text_color')->default(000000);
            $table->unsignedInteger('qr_text_size')->default(15);
            $table->unsignedInteger('qr_text_x')->default(50);
            $table->unsignedInteger('qr_text_y')->default(50);
            $table->string('qr_inserted_image')->nullable();
            $table->unsignedInteger('qr_inserted_image_size')->default(20);
            $table->unsignedInteger('qr_inserted_image_x')->default(50);
            $table->unsignedInteger('qr_inserted_image_y')->default(50);
            $table->string('qr_type')->nullable();
            $table->string('qr_url')->nullable();
            $table->unsignedTinyInteger('facebook_login_status')->default(1);
            $table->string('facebook_app_id')->nullable();
            $table->string('facebook_app_secret')->nullable();
            $table->unsignedTinyInteger('google_login_status')->default(1);
            $table->string('google_client_id')->nullable();
            $table->string('google_client_secret')->nullable();

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
        Schema::dropIfExists('basic_settings');
    }
};
