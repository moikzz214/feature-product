<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotspotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotspots', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('hotspot_type');
            $table->integer('item_id')->unsigned()->nullable();
            $table->text('content');
            $table->text('hotspot_settings');
            $table->timestamps();
            // types
            // hotspots_meta - table
            // id
            // media_id
            // hotspot_id
            // position
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotspots');
    }
}
