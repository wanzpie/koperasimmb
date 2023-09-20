<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Msimpanpinjam_dt extends Model
{
    protected  $table= 'spm_simpanpinjam_dt';
    protected $primarykey ='id_spmdt';
    protected  $fillable=[
        'id_spmdt',
         'spmhd_nochar', 
         'id_anggota',
         'spmdt_jdwal_bayar', 
         'jenis_spmhd', 
         'spm_nominal', 
         'spm_bagihasil',
         'spmdt_status_bayar', 
         'spmdt_invoice', 
         'created_at', 
         'created_by',
          'id_project',
          'updated_at',
          'is_delete'
    ];

}
