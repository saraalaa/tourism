<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('adult_price',8,2);// 6 no. of all numbers , 2 for decimal numbers
            $table->decimal('children_price',8,2);// 6 no. of all numbers , 2 for decimal numbers
            $table->string('image');
            $table->date('arrive_date');
            $table->date('departure_date');
//            $table->unsignedInteger('duration')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
