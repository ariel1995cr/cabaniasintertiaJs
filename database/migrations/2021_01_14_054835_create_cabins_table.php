<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabins', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('type');
            $table->foreign('type')->references('id')->on('type_cabins');
            $table->integer('cantPax');
            $table->decimal('valorTemporadaAlta',8,2,true);
            $table->decimal('valorTemporadaBaja',8,2,true);
            $table->text('descripcion');
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
        Schema::dropIfExists('cabins');
    }
}
