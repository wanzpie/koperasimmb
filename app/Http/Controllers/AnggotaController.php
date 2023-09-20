<?php

namespace App\Http\Controllers;

use App\Model\Divisi;
use App\Model\Manggota;
use App\Model\Mbarang;
use App\Model\Mshu;
use App\Model\Msimpanpinjam_hd;
use App\Model\Msimpanpinjam_dt; 
use App\Model\ProjectModel;
use App\Model\Mcompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;

class AnggotaController extends Controller
{

    public function index(){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');

        // $anggota = Manggota::all();
        $anggota =  \DB::select("select * from md_anggota a 
        INNER join md_project b on a.id_project=b.project_no_char
        INNER join md_divisi c on a.id_divisi=c.id_divisi
        INNER join md_jabatan d on a.jabatan=d.id_jabatan");

        $listanggota   = array('anggota'=>$anggota,
            'PROJECT_NO_CHAR'=>$PROJECT_NO_CHAR
        );
        return view('page.anggota.list',with ($listanggota));

    }

    public function create(){

        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');

        $anggota = Manggota::all();
        $project= ProjectModel::all();
        $divisi =Divisi::all();
        $jabatan = \DB::select("select * from md_jabatan");

        $listanggota   = array('anggota'=>$anggota,
            'PROJECT_NO_CHAR'=>$PROJECT_NO_CHAR,
            'project'=>$project,
            'divisi'=>$divisi,
            'jabatan'=>$jabatan
        );
        return view('page.anggota.form',with ($listanggota));
    }
//save anggota
    public function store(Request  $request){

        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
         $user = session::get('username');
          $cekuser = User::where('username',$user)->first();
         $company = Mcompany::where('id_company',$cekuser->project_no_char)->first();
         $nik = Manggota::where('nik_karyawan',$request->nik_karyawan)->first();
      if($nik){
      
        return redirect()->route('anggota.index')->with('error','NIK sudah terdaftar !');
    

      }
    //   dd($request->all());
     $anggota =   Manggota::FirstOrCreate([
            'nik_karyawan'=>$request->nik_karyawan
            ],['nama_karyawan'=>$request->nama_karyawan,
             'nik_atasan'=>$request->nik_atasan,
              'id_project'=>$request->id_project,
              'id_divisi'=>$request->id_divisi,
            'tanggal_join_karyawan'=>$request->tanggal_join_karyawan,
            'status_karyawan'=>$request->status_karyawan,
            'jabatan'=>$request->jabatan,
            'tgl_join_koperasi'=>$request->tgl_join_koperasi,
            'pend_terakhir'=>$request->pend_terakhir,
            'status_kawin'=>$request->status_kawin,
            'nama_sutri'=>$request->nama_sutri,
            'pek_sutri'=>$request->pek_sutri,
            'created_by'=>Session::get('username')
        ]);
        $date = Carbon::parse(Carbon::now());
        $Year = $date->year;
        $lastidanggota = \DB::getPdo()->lastInsertId();
        $hasil =   Manggota::where('id_anggota',$lastidanggota)->first();
        // dd($hasil);
        if($hasil){

             // dd($company->shu_period);
            $PROJECT_NO_CHAR = Session::get('PROJECT_NO_CHAR');
            $counter = $this->autonumber('spm_pk', 'SPP');

            // dd($counter);
    
            $schedule =[];
        $skr =   Msimpanpinjam_hd::FirstOrCreate([
                'id_anggota' => $hasil->id_anggota,
                'jenis_spmhd' => 'SPP'
            ], [
                'spmhd_nochar' => $counter,
                'spmhd_nominal' => 20000+20000,
                'tgl_pengajuan_spm'=>date('Y-m-d'),
                'tglcair_spm' => null,
                'spm_catatan'=>'Pokok 20k diawal ,wajib 20k',
                'spm_id_barang' => 0,
                'spm_lunas' => 0,
                'spm_status' => 'approve',
                'spm_point_cum' => 0,
                'created_by' => Session::get('username'),
                'updated_by' => ''
    
            ]);
               
            $lastinsert = \DB::getPdo()->lastInsertId();
              
          $dtl=   Msimpanpinjam_hd::where('spmhd_nochar', $counter)
                            ->where('jenis_spmhd','=','SPP')
                             ->select('*')
                            ->first();
                        
            $nochar = $dtl->spmhd_nochar  ;   
            $idanggota =$dtl->id_anggota;   
    
        //   dd( $nochar.$idanggota);
                            $idproject = \DB::table('spm_simpanpinjam_hd as a')
                            // ->join('spm_simpanpinjam_dt as b', 'a.spmhd_nochar', '=', 'b.spmhd_nochar')
                            ->join('md_anggota as b','a.id_anggota','=','b.id_anggota')
                            ->where('a.spmhd_nochar',$nochar )
                            ->select('b.id_project')
                            ->first();
                // dd($idproject);
           
            $schedule = [
               'id_project'=> $idproject->id_project,
                'spmhd_nochar'=>$dtl->spmhd_nochar,
                'id_anggota'=>$dtl->id_anggota,
                'spmdt_jdwal_bayar'=>$dtl->tgl_pengajuan_spm,
                'spmdt_invoice' => $dtl->spmhd_nochar.'#'.sprintf("%04s", 1),
                'jenis_spmhd' => $dtl->jenis_spmhd,
                'spm_nominal' => $dtl->spmhd_nominal,
                'spm_bagihasil'=>0,                
                'spmdt_status_bayar'=>0,
                'created_at'=>date('Y-m-d'),
                'created_by'=> Session::get('username'),
                'updated_at'=>null
            ];
            //   dd($schedule);
            $schedules[] = $schedule;
            
            Msimpanpinjam_dt::insert($schedules);
    
            \DB::statement("UPDATE counter_tabel SET spm_pk=spm_pk+1 WHERE PROJECT_NO_CHAR = '$PROJECT_NO_CHAR' ");
           

            Mshu::updateOrCreate(
                ['nik_anggota'=>$request->nik_karyawan,
                'id_anggota'=>$lastidanggota,
                'period'=>$Year],
               ['simp_wajib'=>20000,
                'simp_pokok'=>20000,
                'jum_simwa'=>0,
                'jum_simpsr'=>0,
                'bagihasil_pinjaman'=>0,
                'active_status_int'=>1,
                 'generate_status'=>0]);
        }
        return redirect()->route('anggota.index')->with('success','Berhasil input data anggota');
    }

    public function ranggota(){

        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

        $anggota = \DB::select("select * from md_anggota a 
        INNER join md_project b on a.id_project=b.project_no_char
        INNER join md_divisi c on a.id_divisi=c.id_divisi
        INNER join md_jabatan d on a.jabatan=d.id_jabatan");
       
        $listanggota=array('anggota'=>$anggota);

        return view('page.anggota.ranggota',with ($listanggota));
   
    }
   
    public function edit($id){
    
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        
        // $anggota = Manggota::all();
        $project= ProjectModel::all();
        $divisi =Divisi::all();
        $jabatan = \DB::select("select * from md_jabatan");
        $hasil =   Manggota::where('id_anggota',$id)->first();
        
        $hasilarray= array('hasil'=>$hasil,
                           'project'=>$project,
                            'divisi'=>$divisi,
                            'jabatan'=>$jabatan
                        );
                  
        return  view('page.anggota.formedit')->with($hasilarray);


    }

    public function update(Request $request,$id){
    

        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
 
      $result =   Manggota::where('id_anggota',$id)
        ->update(['nik_karyawan'=>$request->nik_karyawan,
                 'nama_karyawan'=>$request->nama_karyawan,
                 'nik_atasan'=>$request->nik_atasan,
                 'id_project'=>$request->id_project,
                 'tanggal_join_karyawan'=>$request->tanggal_join_karyawan,
                 'status_karyawan'=>$request->status_karyawan,
                 'id_divisi'=>$request->id_divisi,
                 'tgl_join_koperasi'=>$request->tgl_join_koperasi,
                 'jabatan'=>$request->jabatan,
                 'pend_terakhir'=>$request->pend_terakhir,
                 'status_kawin'=>$request->status_kawin,
                 'nama_sutri'=>$request->nama_sutri,
                 'pek_sutri'=>$request->pek_sutri
           ]);

           if($result){
            
            return redirect()->route('anggota.index')->with('success','Anggota berhasil diupdate');

           }
       

    }
    public function reject($id){
      
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

        Manggota::where('id_anggota',$id)->delete();

        return redirect()->route('anggota.index')->with('success','Anggota berhasil dihapus');

    }
    
    public static function autonumber($field, $kode)
    {
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
        $PROJECT_NO_CHAR = Session::get('PROJECT_NO_CHAR');
        $prefix = \DB::table('md_company')->SELECT('comp_code')->where('id_company', $PROJECT_NO_CHAR)->first();
        $date = Carbon::parse(Carbon::now());
        $q = \DB::table('counter_tabel')->select(\DB::raw("MAX(RIGHT($field,5)) as kd_max"))->where('PROJECT_NO_CHAR', $PROJECT_NO_CHAR);

        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%05s", $tmp);
            }
        } else {
            $kd = "00001";
        }

        return $prefix->com_code . $kode . sprintf("%02s", $date->month) . $date->year . "#" . $kd;
    }
}
