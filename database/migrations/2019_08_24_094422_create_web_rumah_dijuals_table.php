<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebRumahDijualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_rumah_dijual', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_lister');
            $table->string('nama_rumah',100);
            $table->string('lokasi',150);
            $table->text('detail');
            $table->decimal('harga',12,2);
            $table->string('gambar',150);
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
        Schema::dropIfExists('web_rumah_dijuals');
    }
}
