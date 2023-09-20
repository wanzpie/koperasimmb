<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mpembayaran extends Model
{
    protected $table='spm_pembayaran';
    protected $primary_key = 'id_bayar';
    protected $fillable=['id_bayar', 'spmhd_nochar', 'spmdt_invoice', 'spmbayar_tgl_bayar', 'spmbayar_nominal', 'spmbayar_status', 'spmbayar_bayarke', 'spmbayar_catatan', 'spmbayar_nochar', 'spmbayar_bank_acc', 'created_at', 'created_by', 'updated_at', 'updated_by'];

}
