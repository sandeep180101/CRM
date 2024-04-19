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
        //
        Schema::create("party", function (Blueprint $table) {
            $table->id();
            $table->string("name",100);
            $table->string("code",10)->unique();
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->unsignedBigInteger('business_id')->nullable();
            $table->foreign('industry_id')->references('id')->on('master_industry_type');
            $table->foreign('business_id')->references('id')->on('master_business_type');
            $table->string("phone",15);
            $table->string("email",15);
            $table->string("whatsapp",15);
            $table->string("skype",15);
            $table->string("GST",15);
            $table->string("website",100);
            $table->string('address', 255)->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('country_id')->references('id')->on('master_countries');
            $table->foreign('state_id')->references('id')->on('master_states');
            $table->foreign('city_id')->references('id')->on('master_cities');
            $table->string('pincode', 6)->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=>Active , 1=>Inactive');
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
        //
    }
};
