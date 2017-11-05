<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    
    public function kasir()
	{
    return $this->belongsTo('App\Kasir', 'kasir_id');
	}
	public function buku()
	{
    return $this->belongsTo('App\Buku', 'buku_id');
	}
}
