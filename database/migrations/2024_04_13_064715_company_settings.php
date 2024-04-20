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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name',100);
            $table->string('display_name',10);
            $table->string('email')->unique()->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('country_id')->references('id')->on('master_countries');
            $table->foreign('state_id')->references('id')->on('master_states');
            $table->foreign('city_id')->references('id')->on('master_cities');
            $table->string('gst_no',15)->nullable();
            $table->string('pan_no',10)->nullable();
            $table->string('logo')->nullable();
            $table->string('websites')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('users');
            $table->foreign('updated_by_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
