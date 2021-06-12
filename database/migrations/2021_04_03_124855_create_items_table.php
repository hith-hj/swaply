<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('item_type');
            $table->string('item_title');
            $table->string('item_info');
            $table->text('collection');
            $table->string('swap_with');
            $table->string('item_location');
            $table->string('directory');
            $table->string('amount')->default(0);
            $table->string('views')->default(0);
            $table->string('requests')->default(0);
            $table->string('status')->default(0);
            $table->string('rates')->default(0);
            $table->string('category')->default('not-yet');
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
        Schema::dropIfExists('items');
    }
}
