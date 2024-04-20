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
        Schema::create("master_industry_type", function (Blueprint $table) {
            $table->id();
            $table->string("industry_name",100);
            $table->tinyInteger('status')->default(0)->comment('0=>Active , 1=>Inactive');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('users');
            $table->foreign('updated_by_id')->references('id')->on('users');
            $table->timestamps();
            $table->index([
                'industry_name',
                'status', 
                'created_by_id',
                'updated_by_id',
            ], 'master_industry_type_index');
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
