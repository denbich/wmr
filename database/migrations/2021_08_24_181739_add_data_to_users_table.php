<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('gender');
            $table->text('photo_src');
            $table->string('telephone');
            $table->text('agreement_src')->nullable();
            $table->date('agreement_date')->nullable();
            $table->integer('condition');
            $table->boolean('marketing_agreement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
