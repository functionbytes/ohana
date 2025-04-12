<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('countries_lang', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('country_id')->unsigned();
                $table->unsignedBigInteger('lang_id')->unsigned();
                $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('lang_id')->references('id')->on('langs')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('countries_lang');
    }
}
