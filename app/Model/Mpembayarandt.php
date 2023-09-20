<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mpembayarandt extends Model
{
    protected $table='spm_pembayaran_dt';
    protected $primary_key = 'id_bayardt_it';
    protected $fillable=
    [
        'id_bayardt_int', 
        'spmbayar_nochar', 
        'id_anggota',
        'spmhd_nochar', 
        'spmdt_invoice',
         'jenis_spmhd',
          'spmdt_tgl_byar',
           'spmdt_nominal',
            'spm_bagihasil', 
            'status_bayar',
             'created_at', 
             'updated_at'
    ];

}
