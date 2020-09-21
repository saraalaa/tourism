<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_offer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id');
            $table->foreignId('city_id');
            $table->string('image');
            $table->string('hotel');
            $table->enum('room_type',['single','double']);
            $table->json('services')->nullable();
            $table->date('arrive_date');
            $table->date('departure_date');
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
        Schema::dropIfExists('city_offer');
    }
}
