<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekias',  function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('pekia_title');
            $table->string('pekia_location')->default('not-set');
            $table->string('pekia_coordinates')->default('not-set');
            $table->string('pekia_price')->default(0);    
            $table->text('collection')->default('not-set');
            $table->string('directory')->default('not-set');
            $table->string('status')->default(0);
            $table->string('swaply_price')->default(0);
            $table->string('swaply_msg')->default('no-msg');
            $table->timestamp('pickup_date')->default(now());
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
        Schema::dropIfExists('pekias');
    }
}
