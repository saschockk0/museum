<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_excursions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('excursion_id')->unsigned();

            $table->unique(['user_id', 'excursion_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('excursion_id')->references('id')->on('excursions');
            $table->timestamps();
        });
        DB::unprepared('
        CREATE TRIGGER `addPlaces` AFTER INSERT ON `user_excursions`
        FOR EACH ROW Update `excursions` SET excursions.places = excursions.places - 1
            WHERE excursions.id = NEW.excursion_id
        ');
        DB::unprepared('
        CREATE TRIGGER `removePlace` AFTER DELETE ON `user_excursions`
        FOR EACH ROW Update `excursions` SET excursions.places = excursions.places + 1
            WHERE excursions.id = OLD.excursion_id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_excursions');
    }
};
