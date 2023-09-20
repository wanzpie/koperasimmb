<?php

namespace App\Http\Controllers;

use App\Model\PermitProcessModel;
use DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
    {
        $isLogged = (bool) Session::get('activated');
        if($isLogged == FALSE){
              return redirect('/login');
        }
//        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $isLogged = (bool) Session::get('activated');
        //''
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }else{
            $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');
          //  dd(Session::get('PROJECT_NO_CHAR'));
          //  $listpr= Session::get('assignment_project');
          //  dd($listpr);
//            $permitprocess = PermitProcessModel::where('project_code',$PROJECT_NO_CHAR)
//                ->whereIn('permit_gov_status',['process'])
//                ->get();
//            $permitexpire = PermitProcessModel::where('project_code',$PROJECT_NO_CHAR)
//                ->whereIn('permit_gov_status',['approve'])
//                ->get();

//            $permitprocess = DB::select("select c.nama_perijinan,b.permit_description,* from permit_transaction a left join master_permit_dt b
//                                          on a.id_permitdt = b.id_permitdt left join master_permit_hd c on b.permit_hd_int=c.id
//                                          where a.project_code='$PROJECT_NO_CHAR' and a.permit_gov_status='process'");
//            $permitexpire = DB::select("select c.nama_perijinan,b.permit_description,* from permit_transaction a left join master_permit_dt b
//                                          on a.id_permitdt = b.id_permitdt left join master_permit_hd c on b.permit_hd_int=c.id
//                                          where a.project_code='$PROJECT_NO_CHAR' and a.permit_gov_status='approve'");

            $listinst   = array(
                'title'         => 'List Instansi',
//                'permitprocess'     => $permitprocess,
//                'permitexpire'=>$permitexpire

            );
            return view('home',with ($listinst));
        }



    }
    public function chProject(Request $request){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        //dd($request->all());
        $project = \App\Model\ProjectModel::where('PROJECT_NO_CHAR', $request->project)->first();
        $encrypt = hash( 'sha256',Session::get('username').''.$project->PROJECT_NO_CHAR.''.$project->PROJECT_CODE);

        Session::put('PROJECT_NO_CHAR', $project->PROJECT_NO_CHAR);
        Session::put('project_name', $project->PROJECT_NAME);
        Session::put('checker', $encrypt);

        Session::regenerate();
        return redirect()->route('home');
    }
    public function checkValidSession(Request $request){
        $checker = Session::get('checker');

        if($checker != $request->id){
            return response()->json(['msg'=>'1']);
        }else{
            return response()->json(['msg'=>'0']);
        }
    }
}
