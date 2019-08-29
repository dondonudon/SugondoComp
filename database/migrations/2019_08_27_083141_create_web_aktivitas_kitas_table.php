<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebAktivitasKitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_aktivitas_kita', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image',150);
            $table->text('content');
            $table->string('username',10);
            $table->integer('status')->comment('0: hide; 1: show')->default(1);
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
        Schema::dropIfExists('web_aktivitas_kitas');
    }
}
