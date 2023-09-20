<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mcompany extends Model
{
    //
    protected $table = 'md_company';
         protected $primaryKey = 'id_company';

         protected $fillable =[
            'id_company', 
            'comp_code',
             'company_name',
              'alamat_korespondensi',
               'alamat_surat',
                'npwp', 
                'simpo_nominal',
                 'month_period',
                  'year_period',
                  'shu_period'
         ];
}
