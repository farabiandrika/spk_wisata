<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('keterangan');
            $table->decimal('nilai', 8, 2);
            $table->foreignId('kriteria_id');
            $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
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
        Schema::dropIfExists('sub_kriterias');
    }
}
