<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslatePrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translate_prizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prize_id');
            $table->string('locale');
            $table->string('title');
            $table->mediumText('description');
            $table->string('category');
            $table->timestamps();

            $table->foreign('prize_id')->references('id')->on('prizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translate_prizes');
    }
}
