<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model {
    protected $table = 'md_divisi';
    // protected $primaryKey = 'id_divisi';

    protected $fillable =[
        'id_divisi',
        'nama_divisi',

    ];
}
