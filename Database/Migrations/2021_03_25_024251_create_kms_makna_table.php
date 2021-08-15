<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKmsMaknaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kms_makna', function (Blueprint $table) {
            $table->id();

            $table->integer('kata_id');
            $table->integer('bahasa_id');

            $table->string('kata');
            $table->text('terjemahan')->nullable();
            $table->string('penggalan')->nullable();
            $table->string('lafal')->nullable();
            
            $table->string('audio')->nullable();
            $table->string('gambar')->nullable();

            $table->integer('verified')->default(0);
            $table->integer('user_id');
            
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
        Schema::dropIfExists('kms_makna');
    }
}
