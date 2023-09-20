<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;

class SsoLoginController extends Controller
{

     public function getRedirect($id,$email)
    {
		$header = array();
        $token=$id;

        $client = new \GuzzleHttp\Client(['verify' => false ]);
        $res = $client->request('POST', 'https://sso.metropolitanland.com/api/detailsLICENZA', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Content-Type' => 'application/json'],
            'form_params' => [

                'email' =>$email
            ]
        ]);
        $contents = (string) $res->getBody();
        $data = json_decode($res->getBody(), true);
        Session::put([
            'id' =>  $data['data'][0]['id'],
            'username' => $data['data'][0]['username'],
            'name' => $data['data'][0]['first_name']." ".$data['data'][0]['last_name'],
            'email' => $data['data'][0]['email'],
            'activated' => TRUE,
            'PROJECT_NO_CHAR' => $data['data'][0]['project_no_char'],
            'assignment_project' => $data['data'][0]['List_proyek'],
            'permissions'=> $data['data'][0]['List_menus'],
            'ROLE_PERMISSION'=>$data['data'][0]['List_level']

        ]);
        $PROJECT_NO_CHAR=$data['data'][0]['project_no_char'];
        $permitprocess = DB::select("select c.nama_perijinan,b.permit_description,* from permit_transaction a left join master_permit_dt b
                                          on a.id_permitdt = b.id_permitdt left join master_permit_hd c on b.permit_hd_int=c.id
                                          where a.project_code='$PROJECT_NO_CHAR' and a.permit_gov_status='process'");
        $permitexpire = DB::select("select c.nama_perijinan,b.permit_description,* from permit_transaction a left join master_permit_dt b
                                          on a.id_permitdt = b.id_permitdt left join master_permit_hd c on b.permit_hd_int=c.id
                                          where a.project_code='$PROJECT_NO_CHAR' and a.permit_gov_status='approve'");

        $listinst   = array(
            'title'         => 'List Instansi',
            'permitprocess'     => $permitprocess,
            'permitexpire'=>$permitexpire

        );
        return view('home',with ($listinst));


    }
}
