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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('company_name'); // Company Name
            $table->string('account_name'); // Account Name
            $table->string('account_no'); // Account No
            $table->string('ifsc_swift'); // IFSC/SWIFT
            $table->string('bank_name'); // Bank Name
            $table->string('branch_name')->nullable(); // Branch Name
            $table->string('iban_no')->nullable(); // IBAN NO
            $table->string('gst')->nullable(); // GST
            $table->string('pan_card'); // Pan Card
            $table->string('delete_status')->default(1);
            $table->string('active_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
