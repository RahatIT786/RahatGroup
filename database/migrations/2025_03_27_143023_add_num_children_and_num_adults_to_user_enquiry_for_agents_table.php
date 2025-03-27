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
        Schema::table('user_enquiry_for_agents', function (Blueprint $table) {
            $table->integer('num_children')->default(0)->after('message');
            $table->integer('num_adults')->default(0)->after('num_children');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_enquiry_for_agents', function (Blueprint $table) {
            $table->dropColumn(['num_children', 'num_adults']);
        });
    }
};
