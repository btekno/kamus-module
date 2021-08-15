<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKmsBahasaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kms_bahasa', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');

            $table->string('kode');
            $table->string('nama');
            $table->text('info')->nullable();
            $table->string('wilayah')->nullable();
            
            $table->integer('jumlah_pengguna')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kms_bahasa');
    }
}
