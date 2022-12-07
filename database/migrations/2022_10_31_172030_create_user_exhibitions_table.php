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
        Schema::create('user_exhibitions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('exhibition_id')->unsigned();

            $table->unique(['user_id', 'exhibition_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('exhibition_id')->references('id')->on('exhibitions');
            $table->timestamps();
        });

        DB::unprepared('
        CREATE TRIGGER `addPlacesExhib` AFTER INSERT ON `user_exhibitions`
        FOR EACH ROW Update exhibitions SET exhibitions.places = exhibitions.places - 1
            WHERE exhibitions.id = NEW.exhibition_id
    ');
    DB::unprepared('
    CREATE TRIGGER `removePlacesExhib` AFTER DELETE ON `user_exhibitions`
    FOR EACH ROW Update exhibitions SET exhibitions.places = exhibitions.places + 1
               WHERE exhibitions.id = OLD.exhibition_id
    ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_exhibitions');
    }
};
