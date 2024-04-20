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
        Schema::create('master_lead_source', function (Blueprint $table) {
            $table->id();
            $table->string('lead_source_name',100);
            $table->tinyInteger('status')->default('0')->comment('0=>active,1=>inactive');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('users');
            $table->foreign('updated_by_id')->references('id')->on('users');
            $table->timestamps();
            $table->index([
                'lead_source_name',
                'status', 
                'created_by_id',
                'updated_by_id',
            ], 'master_lead_source_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_lead_source');
    }
};
