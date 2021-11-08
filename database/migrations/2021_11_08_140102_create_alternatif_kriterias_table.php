<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternatifKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternatif_kriterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id');
            $table->foreignId('alternatif_id');
            $table->decimal('nilai', 8, 2);
            $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
            $table->foreign('alternatif_id')->references('id')->on('alternatif')->onDelete('cascade');
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
        Schema::dropIfExists('alternatif_kriterias');
    }
}
