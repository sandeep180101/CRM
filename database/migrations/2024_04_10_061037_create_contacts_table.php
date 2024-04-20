<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('contact_name',100);
            $table->string('contact_email',50)->nullable();
            $table->string('contact_phone', 15)->nullable();
            $table->string('contact_address')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0=>active,1=>inactive');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('users');
            $table->foreign('updated_by_id')->references('id')->on('users');
            $table->timestamps();
            $table->index([
                'contact_name', 
                'contact_email', 
                'contact_phone', 
                'contact_address', 
                'status', 
                'created_by_id',
                'updated_by_id',
            ], 'contacts_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
