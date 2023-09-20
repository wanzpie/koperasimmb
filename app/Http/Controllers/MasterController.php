<?php

namespace App\Http\Controllers;

use App\Model\MasterPermiDTModel;
use App\Model\MasterPermitHdModel;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Model\MasterInstansiModel;
use Illuminate\Support\Facades\Session;

class MasterController extends Controller
{
    public function __construct()
    {
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

    }

    public function listinstansi(){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

       // $instansi = MasterInstansiModel::all();
        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');

        $instansi= DB::select("select b.id,b.nama_instansi,a.name_lokasi from  master_instansi b left join master_Lokasi a
        on b.lokasi_id = a.id ");
        $lokasi = DB::table('master_lokasi')->get();

        $listinst   = array(
            'title'         => 'List Instansi',
            'instansi'     => $instansi,
            'lokasi'=>$lokasi
        );
        return view('page.instansi.list',with ($listinst));


    }
    public function saveinstansi(Request $request){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');
        $instansi = new MasterInstansiModel();
        $instansi->nama_instansi = $request->nama_instansi;
        $instansi->lokasi_id = $request->lokasi_id;
        $instansi->project_code = $PROJECT_NO_CHAR;
        $instansi->save();
        if($instansi){
            return redirect(route('instansi.list'));
        }

    //dd($request);
    }
    public function savelokasi(Request $request){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
     if($request->name_lokasi != ''){

         $lokasi = DB::table('master_lokasi')
             ->insert(['name_lokasi'=>$request->name_lokasi,'created_at'=>Carbon::parse(Carbon::now()) ]);
         if($lokasi){
             return redirect(route('instansi.list'));
         }

     }else{
         return redirect(route('instansi.list'));
     }



    }
    public  function permitdtlist(){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');
       // $permitdt = MasterPermiDTModel::where('project_code',$PROJECT_NO_CHAR)->get();
        $permithd = MasterPermitHdModel::all();

        $permitdt= DB::select("select b.id_permitdt, a.nama_perijinan,b.permit_description
         from master_permit_hd a inner join master_permit_dt b on a.id=b.permit_hd_int
                                 where b.project_code='$PROJECT_NO_CHAR'");

        $category = DB::table('permit_category')->get();

        $listpermitdt   = array(
            'title'         => 'List Permit Detail',
            'permitdt'     => $permitdt,
            'permithd'=>$permithd,
            'category'=>$category
        );
        return view('page.permit.list',with ($listpermitdt));
    }
    public  function savepermitdt(Request $request){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');

        if($request->permit_hd_int != null ||$request->permit_description !=null){

            $permitdt = new MasterPermiDTModel();
            $permitdt->permit_hd_int= $request->permit_hd_int;
            $permitdt->permit_description= $request->permit_description;
            $permitdt->project_code= $PROJECT_NO_CHAR;
            $permitdt->save();

        }else{
            return redirect(route('permitdt.list'));
        }


        if($permitdt){
            return redirect(route('permitdt.list'));
        }


    }
    public function editinstansi($id){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }


        $idinstansi = MasterInstansiModel::findorfail($id);
      //  return response()->json($idinstansi);
       // dd($idinstansi);

    }
    public function permitdtedit($id){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

       $permitdt = MasterPermiDTModel::where('id_permitdt',$id)->first();
      // dd($permitdt);
    }
    public function savepermitct(Request $request){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');
        if($request->category_name != ''){

            $permithd = DB::table('master_permit_hd')
                ->insert(['nama_perijinan'=>$request->category_name,'project_code'=>$PROJECT_NO_CHAR,'created_at'=>Carbon::parse(Carbon::now()) ]);
            if($permithd){
                return redirect(route('permitdt.list'));
            }

        }else{
            return redirect(route('instansi.list'));
        }


    }
    public function saveedit(Request $request,$id){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

        $masterinstansi = MasterInstansiModel::find($id);

        MasterInstansiModel::where('id',$id)->update([
            'nama_instansi'=>$request->edit_name_instansi
        ]);
        if($masterinstansi){

            return redirect()->route('instansi.list');
        }
    }

    public function prmdtsaveedit(Request $request,$id){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

     $permitdt =   MasterPermiDTModel::where('id_permitdt',$id)->first();

        $permitdt->update([
            'permit_description'=>$request->permit_name
        ]);
        if($permitdt){

            return redirect(route('permitdt.list'))->with('success','Permit Detail name update succesfully ');
        }
    }

}
