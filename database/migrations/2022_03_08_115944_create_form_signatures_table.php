<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSignaturesTable extends Migration
{
    public function up()
    {
        Schema::create('form_signatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('volunteer_id');
            $table->unsignedBigInteger('form_id');
            $table->unsignedBigInteger('sign_id');
            $table->text('sign_path');
            $table->timestamps();

            $table->foreign('volunteer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->foreign('sign_id')->references('id')->on('signed_forms')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_signatures');
    }
}
