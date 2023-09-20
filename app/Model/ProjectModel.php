<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model {

	    protected $table = 'md_project';
         protected $primaryKey = 'project_no_char';
//       protected $dateFormat = 'Y-m-d H:i:s';
         protected $fillable =[
             'project_no_char',
             'project_name',
             'alamat_project',
             'active_status_int'
//            'PROJECT_NO_CHAR',
//            'ID_COMPANY_INT',
//            'PROJECT_ALIAS',
//            'ID_BUSINESS_INT',
//            'PROJECT_NAME',
//            'PROJECT_CODE',
//            'PREFIX_DEBTOR',
//            'PROJECT_ACTIVE_CHAR',
//            'PROJECT_DESC',
//            'MONTH_PERIOD',
//            'YEAR_PERIOD',
//            'VA_MANDIRI',
//            'PROJECT_ADDRESS',
//            'PROJECT_KEL',
//            'PROJECT_KEC',
//            'PROJECT_KOTA',
//            'PROJECT_PROPINSI',
//            'PROJECT_LUAS',
//             'GM_NAME',
//             'DIR_OPS_MAIL',
//             'GM_MAIL',
//             'created_at',
//             'updated_at'
            ];


}
