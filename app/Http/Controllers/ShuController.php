<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Model\Mcompany;
use App\Model\Mshu;
use App\User;
use Illuminate\Support\Facades\DB;

class ShuController extends Controller
{


    public function index(){
    ///data shu 
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
       $user = session::get('username');
       $cekuser = User::where('username',$user)->first();
        $company = Mcompany::where('id_company',$cekuser->project_no_char)->first();
       
    //    dd($company->shu_period);
       $datashu = \DB::select('SELECT * FROM `simpanpinjam` a inner join md_anggota b on a.id_anggota=b.id_anggota 
        inner join md_project c on b.id_project=c.project_no_char');
        
        $data   = array('datashu'=>$datashu,
                      'PROJECT_NO_CHAR'=>$PROJECT_NO_CHAR,
                      'company'=>$company
    );
    // dd($data);
    return view('page.shu.list',with ($data));
       
    }

    public function pointshu(){
        ///data shu 
            if (Session::get('id') == '') {
                Session::flush();
                return redirect('/login');
            }
           $user = session::get('username');
           $cekuser = User::where('username',$user)->first();
            $company = Mcompany::where('id_company',$cekuser->project_no_char)->first();
           
        //    dd($company->shu_period);
           $datashu = \DB::select('SELECT * FROM `simpanpinjam` a inner join md_anggota b on a.id_anggota=b.id_anggota 
            inner join md_project c on b.id_project=c.project_no_char');
            
            $data   = array('datashu'=>$datashu,
                          'PROJECT_NO_CHAR'=>$PROJECT_NO_CHAR,
                          'company'=>$company
        );
        // dd($data);
        return view('page.shu.list',with ($data));
           
        }

    public function generateshu(){

        
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }

        return view('page.shu.form');
    }

    public function saveedit(Request $request,$id){
      
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
        $user = session::get('username');
        $cekuser = User::where('username',$user)->first();
         $company = Mcompany::where('id_company',$cekuser->project_no_char)->first();
         
         $update = Mshu::where([
            'id'=>$id,
            'nik_anggota' => $request->nik_karyawan,
            'period' => $company->shu_period
        ])->update([
            'jum_simpo' => $request->total_simpo,
            'jum_simp_sr' => $request->total_sim_sr,
            'bagihasil_pinjaman' => $request->total_pinjaman
        ]);

        return redirect('shu')->with('success','Point SHU berhasil diubah');
    }

    public function getpointallshu($tahun){

        $totalpoint = \DB::table('simpanpinjam')
        ->select(DB::raw('SUM((jum_simwa/1000) + (jum_simpsr/2000) + (bagihasil_pinjaman/2000)) as totalpoint'))
        ->where('period', '=', $tahun)
        ->first();
        // $nmr= number_format($totalpoint->total,0,".",",");
        // dd($totalpoint);
        return response()->json(['totalpoint' => (int) $totalpoint->totalpoint]);

    }

    public function simpanshu(Request $request){

        // dd($request->all());

        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
        
        $period= $request->periodeshu;
        $jumlah_profit = $request->jumlah_profit;
        $totalpoint= $request->totalpoint;
        $user = session::get('username');
        $cekuser = User::where('username',$user)->first();
         $company = Mcompany::where('id_company',$cekuser->project_no_char)->first();
         
         $shuexist =  \DB::select("select * from simpanpinjam where period='".$request->periodeshu."' and generate_status=1 limit 1");
         if($shuexist){

            return redirect('generateshu')->with('error','SHU tahun '.$request->periodeshu.' sudah digenerate');
         }
   
      $shuresult =  \DB::select("select * from simpanpinjam where period='".$request->periodeshu."' and generate_status=0");
   //   dd($shuresult);
      foreach ($shuresult as $result){

        $detnochar = \DB::table('simpanpinjam')
        ->select('*')
        ->where('id', $result->id)
        ->first();
        // dd($detnochar);

        $query = \DB::select("UPDATE simpanpinjam
        SET nominal_shu = ((IFNULL(jum_simwa, 0) / 1000) + (IFNULL(jum_simpsr, 0) / 2000) + (IFNULL(bagihasil_pinjaman, 0) / 2000)) * ($jumlah_profit / $totalpoint),
            generate_status = 1
        WHERE id_anggota =$detnochar->id_anggota");

      }
      
      $result =  \DB::select("select * from simpanpinjam where period='".$request->periodeshu."' and generate_status=1");
     $resarray = array('result'=>$result,
                         'hasil'=>1);
      $nextperiod = (int) $period+1;                  
       Mcompany::where(['id_company'=>$cekuser->project_no_char])
              ->update(['shu_period'=>$nextperiod]);
         
                        //  dd($hasil);

    //   return view('page.shu.form',with($resarray));
    return redirect('generateshu')->with('success','Bagi Hasil berhasil digenerate');
    
    }
   
    public function reportshu(){

        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
       $user = session::get('username');
       $cekuser = User::where('username',$user)->first();
        $company = Mcompany::where('id_company',$cekuser->project_no_char)->first();
       
    //    dd($company->shu_period);
       $result = \DB::select('SELECT * FROM `simpanpinjam` a inner join md_anggota b on a.id_anggota=b.id_anggota 
        inner join md_project c on b.id_project=c.project_no_char');
        
        $data   = array('result'=>$result,
                      'PROJECT_NO_CHAR'=>$PROJECT_NO_CHAR,
                      'company'=>$company
    );
    // dd($data);
    return view('page.shu.rshulist',with ($data));
    }

    public function vwreportshu(Request $request){
    
       

        $result =  \DB::select("SELECT * FROM `simpanpinjam` a inner join md_anggota b on a.id_anggota=b.id_anggota 
                            inner join md_project c on b.id_project=c.project_no_char where a.period='".$request->periodeshu."' and generate_status=1");
        // dd($result);

        $resarray = array('result'=>$result,
                         'hasil'=>1,
                         'periode' => $request->periodeshu);

                        //  dd($result);
                        
       
       return view('page.shu.vwrshulist',with($resarray));
    }


}
