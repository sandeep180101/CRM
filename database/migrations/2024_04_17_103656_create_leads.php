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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('name', 100);
            $table->string('company_name', 100);
            $table->string('email', 50);
            $table->string('phone', 15);
            $table->string('address', 255)->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('country_id')->references('id')->on('master_countries');
            $table->foreign('state_id')->references('id')->on('master_states');
            $table->foreign('city_id')->references('id')->on('master_cities');
            $table->string('pincode', 6)->nullable();
            $table->string('product_details', 255);
            $table->unsignedBigInteger('approximate_amount');
            $table->unsignedBigInteger('lead_source_id')->nullable();
            $table->unsignedBigInteger('lead_status_id')->nullable();
            $table->foreign('lead_source_id')->references('id')->on('master_lead_source');
            $table->foreign('lead_status_id')->references('id')->on('master_lead_status');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
