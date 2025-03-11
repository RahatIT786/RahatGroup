<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('main_companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_dly_name')->nullable();
            $table->string('company_contect_person')->nullable();
            $table->string('company_mobile', 12);
            $table->string('company_landline_number')->nullable();
            $table->string('company_email');
            $table->string('company_website_name')->nullable();
            $table->text('company_registered_address');
            $table->text('company_about')->nullable();
            $table->string('company_pan')->nullable();
            $table->string('company_gst')->nullable();
            $table->string('company_state');
            $table->string('company_city');
            $table->string('company_logo')->nullable();
            $table->boolean('delete_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_companies');
    }
};
