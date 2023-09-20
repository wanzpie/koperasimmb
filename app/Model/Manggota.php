<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manggota extends Model
{
    protected  $table= 'md_anggota';
    protected  $fillable=[

        'nik_karyawan',
        'nama_karyawan',
        'nik_atasan',
        'id_project',
        'id_divisi',
        'tanggal_join_karyawan',
        'status_karyawan',
        'jabatan',
        'tgl_join_koperasi',
        'pend_terakhir',
        'status_kawin',
        'nama_sutri',
        'pek_sutri',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

}
