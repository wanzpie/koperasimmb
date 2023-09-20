<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Msimpanpinjam_hd extends Model
{
    protected  $table= 'spm_simpanpinjam_hd';
    protected  $fillable=[
        'id_spmhd',
        'spmhd_nochar',
        'id_anggota',
        'jenis_spmhd',
        'tgl_pengajuan_spm',
        'spm_catatan',
        'spmhd_nominal',
        'spm_period',
        'tglcair_spm',
        'spm_id_barang',
        'spm_lunas',
        'spm_status',
        'is_generate',
        'created_at',
        'created_by'
        ,'updated_at',
        'updated_by'
    ];
}
