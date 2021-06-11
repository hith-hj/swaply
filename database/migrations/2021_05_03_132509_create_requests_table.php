<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('item_id');
            $table->string('sender_id');
            $table->string('sender_item');
            $table->string('request_type')->default('swap');
            $table->string('status')->default(0);
            $table->string('viewed')->default(0);
            $table->string('user_paid')->default('not-yet');
            $table->string('sender_paid')->default('not-yet');
            $table->string('user_location')->default('not-yet');
            $table->string('sender_location')->default('not-yet');
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
        Schema::dropIfExists('requests');
    }
}
