<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ApartamentosTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('predio_id');
            $table->unsignedBigInteger('finalidade_id');
            $table->string('andar', 10);
            $table->string('numero', 12)->nullable();
            $table->string('quartos', 2);
            $table->string('banheiros', 2);
            $table->string('metros', 20);
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->foreign('predio_id')->references('id')->on('predios');
            $table->foreign('finalidade_id')->references('id')->on('finalidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartamentos');
    }
}
