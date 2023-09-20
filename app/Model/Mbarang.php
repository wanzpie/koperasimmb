<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mbarang extends Model
{
    //
    protected $table = 'md_barang';
    protected $primaryKey='id_barang';
    protected $fillable=[
        'id_barang',
        'nama_barang',
        'satuan',
        'tipe_merek',
        'harga_barang',
        'created_at',
        'updated_at'
    ];
}
