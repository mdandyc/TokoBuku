<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokobukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor', function (Blueprint $table) {
            $table->increments('id_distributor');
            $table->string('nama_distributor');
            $table->string('alamat');
            $table->string('telepon');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('pasok', function (Blueprint $table) {
            $table->increments('id_pasok');
            $table->string('distributor_id');
            $table->string('buku_id');
            $table->string('jumlah');
            $table->string('tanggal');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('buku', function (Blueprint $table) {
            $table->increments('id_buku');
            $table->string('judul');
            $table->string('isbn');
            $table->string('penulis');
            $table->string('penerbit');
            $table->string('tahun');
            $table->string('stok');
            $table->string('harga_pokok');
            $table->string('harga_jual');
            $table->string('ppn');
            $table->string('diskon');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('kasir', function (Blueprint $table) {
            $table->increments('id_kasir');
            $table->string('nama');
            $table->string('alamat');
            $table->string('telepon');
            $table->string('status');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('penjualan', function (Blueprint $table) {
            $table->increments('id_penjualan');
            $table->string('buku_id');
            $table->string('kasir_id');
            $table->string('jumlah');
            $table->string('total');
            $table->string('tanggal');
            $table->rememberToken();
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
        Schema::dropIfExists('distributor');
        Schema::dropIfExists('pasok');
        Schema::dropIfExists('buku');
        Schema::dropIfExists('kasir');
        Schema::dropIfExists('penjualan');
    }
}
