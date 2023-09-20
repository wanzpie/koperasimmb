<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mshu extends Model
{
    protected $table = 'simpanpinjam';
    protected $primaryKey='id';
    protected $fillable=[
       
         'id', 
        'nik_anggota',
        'id_anggota', 
        'period', 
        'simp_wajib',
        'simp_pokok', 
        'simp_sukarela',
        'pinjaman1', 
        'pinjaman2',
        'jum_simpo', 
        'jum_simp_sr',
        'bagihasil_pinjaman',
        'nominal_shu',
        'generate_status',
        'active_status_int',
        'created_at',
        'updatet_at'

        ];
}
