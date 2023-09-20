<?php

namespace App\Http\Controllers;

use App\Model\Manggota;
use App\Model\Mbarang;
use App\Model\Mshu;
use App\Model\Msimpanpinjam_hd;
use App\Model\Msimpanpinjam_dt; 
use App\Model\ProjectModel;
use App\Model\Mcompany;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SpmHeaderController extends Controller
{
    //list simp sukarela
    public function index()
    {

        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
       

        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }

//        $spm_sr = Msimpanpinjam_hd::where('jenis_spmhd','SKR')->get();
        $spm_sr = \DB::select("SELECT id_spmhd,a.id_anggota,b.nik_karyawan,b.nama_karyawan,c.nama_divisi,a.spmhd_nochar,a.spm_catatan,a.tgl_pengajuan_spm as tgl_pengajuan,b.tgl_join_koperasi ,a.spmhd_nominal FROM `spm_simpanpinjam_hd` a inner join md_anggota b
                  on a.id_anggota=b.id_anggota INNER join md_divisi c on b.id_divisi=c.id_divisi
                   where a.jenis_spmhd='SKR'");
        $PROJECT_NO_CHAR = Session::get('PROJECT_NO_CHAR');
        $listspm_sr = array('spm_sr' => $spm_sr,
            'PROJECT_NO_CHAR' => $PROJECT_NO_CHAR
        );
//        dd($listspm_sr);

        return view('page.simpanpinjam.listsimpanpinjam_sr', with($listspm_sr));

    }

    //buat simp sukarela
    public function create()
    {
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
       
        $anggota = \DB::select("SELECT * FROM `md_anggota` a inner join md_divisi b on a.id_divisi=b.id_divisi
                   INNER join md_jabatan c on a.jabatan=c.id_jabatan");
        $project = ProjectModel::all();
        $listsr = array('anggota' => $anggota,
            'project' => $project);
        return view('page.simpanpinjam.form', with($listsr));
    }


    //simpan  sukarela
    public function store(Request $request)
    {   
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
        if (is_null($request->id_anggota)) {
            return redirect()->route('simpanan_sr.index')->with('error', 'Nama anggota tidak boleh kosong');
        }
        if($request->spmhd_nominal==0){
            
            return redirect()->route('simpanan_sr.index')->with('error','jumlah  simpanan sukarela tidak boleh 0');
        }
        //  dd($request->all());
        if($request->spmhd_nominal>200000){
            
            return redirect()->route('simpanan_sr.index')->with('error','jumlah maksimal simpanan sukarela adalah Rp 200.000,00');
        }
        $user = session::get('username');
        $cekuser = User::where('username',$user)->first();
         $company = Mcompany::where('id_company',$cekuser->project_no_char)->first();
        // dd($company->shu_period);
        $PROJECT_NO_CHAR = Session::get('PROJECT_NO_CHAR');
        $counter = self::autonumber('spm_sr', 'SKR');

        $schedule =[];
    $skr =   Msimpanpinjam_hd::FirstOrCreate([
            'id_anggota' => $request->id_anggota,
            'jenis_spmhd' => 'SKR'
            
        ], [
            'spmhd_nochar' => $counter,
            'spmhd_nominal' => $request->spmhd_nominal,
            'tgl_pengajuan_spm'=>date('Y-m-d'),
            'tglcair_spm' => null,
            'spm_id_barang' => 0,
            'spm_lunas' => 0,
            'spm_status' => 'request',
            'spm_point_cum' => 0,
            'created_by' => Session::get('username'),
            'updated_by' => ''

        ]);
           
        $lastinsert = \DB::getPdo()->lastInsertId();
          
      $dtl=   Msimpanpinjam_hd::where('spmhd_nochar', $counter)
                        ->where('jenis_spmhd','=','SKR')
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
            'id_anggota' => $request->id_anggota,
            'spmdt_jdwal_bayar'=>$dtl->tgl_pengajuan_spm,
            'spmdt_invoice' => $dtl->spmhd_nochar.'#'.sprintf("%04s", 1),
            'jenis_spmhd' => $dtl->jenis_spmhd,
            'spm_nominal' => $dtl->spmhd_nominal,
            'spm_bagihasil'=>0,                
            'spmdt_status_bayar'=>0,
            'created_at'=>date('Y-m-d'),
            'created_by'=> Session::get('username')
        ];
        //   dd($schedule);
        $schedules[] = $schedule;
        
        Msimpanpinjam_dt::insert($schedules);

        \DB::statement("UPDATE counter_tabel SET spm_sr=spm_sr+1 WHERE PROJECT_NO_CHAR = '$PROJECT_NO_CHAR' ");
       
        $anggota = Manggota::where('id_anggota',$idanggota)->first();

        // $date = Carbon::parse(Carbon::now());
        // $Year = $date->year;
        $date = Carbon::parse($dtl->tgl_pengajuan_spm);
          $Year = $date->year;
          $dtanggota = Manggota::where('id_anggota',$anggota->id_anggota)->first();
        // dd($anggota);
        // if($anggota){
 
// dd($request->id_anggota.'*'.$dtanggota ->nik_karyawan.$Year);
         $res =   Mshu::updateOrCreate(
                ['id_anggota'=>$request->id_anggota,
                'nik_anggota'=>$dtanggota ->nik_karyawan,
                'period'=>$Year],
                [   
                    'simp_pokok'=>20000,
                   'simp_wajib'=>20000,
                    // 'pinjaman1'=>$totalspm->totalpinjaman, 
                    'simp_sukarela'=>$dtl->spmhd_nominal,
                    // \DB::raw('simp_sukarela + ' . $totalspm->simpanan_sr),
                    'generate_status'=>0
            ]);

            // dd($res);
        // }
        

        return redirect(route('simpanan_sr.index'));
    }

    public function deletesr($id){
        
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
       
        $header =  Msimpanpinjam_hd::where('id_spmhd', $id)->first();
        Msimpanpinjam_dt::where('spmhd_nochar',$header->spmhd_nochar)->delete();
        Msimpanpinjam_hd::where('id_spmhd', $id)->delete();

        return redirect()->route('simpanan_sr.index')->with('success','Data simpan sukarela berhasil di hapus');

    }
    //list pinjam barang dan uang
    public function listspm()
    {
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
        $PROJECT_NO_CHAR = Session::get('PROJECT_NO_CHAR');
        $spmpinjams = \DB::select("SELECT id_spmhd,a.spmhd_nochar,a.id_anggota,b.nik_karyawan,b.nama_karyawan,c.nama_divisi,a.spm_catatan,a.tgl_pengajuan_spm as tgl_pengajuan,
                  b.tgl_join_koperasi ,a.spm_period,a.spm_status,a.spm_id_barang,  a.spmhd_nominal,a.jenis_spmhd,a.is_generate
                  FROM `spm_simpanpinjam_hd` a inner join md_anggota b
                  on a.id_anggota=b.id_anggota INNER join md_divisi c on b.id_divisi=c.id_divisi
                   where a.jenis_spmhd in ('KRU','KRB') and a.spm_status !='reject'");
        $PROJECT_NO_CHAR = Session::get('PROJECT_NO_CHAR');
        $listspm = array('spmpinjams' => $spmpinjams,
            'PROJECT_NO_CHAR' => $PROJECT_NO_CHAR
        );
//        dd($listspm_sr);

        return view('page.simpanpinjam.listsimpanpinjam', with($listspm));
    }

    //form simpan pinjam
    public function createspm()
    {

        $PROJECT_NO_CHAR = Session::get('PROJECT_NO_CHAR');
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
//        dd('tes');
        $anggota = Manggota::all();
        $project = ProjectModel::all();
        $barang = Mbarang::all();

        $listanggota = array('anggota' => $anggota,
            'PROJECT_NO_CHAR' => $PROJECT_NO_CHAR,
            'project' => $project,
            'barang' => $barang
        );
        return view('page.simpanpinjam.formspm', with($listanggota));
    }
    
    public function ambilDatapinjaman($option)
    {
         $dataPinjaman = \DB::select("CALL datatagihan(".$option.") ");
    //    dd($dataPinjaman);
         // $dataPinjaman = \DB::select("
        //                     SELECT 
        //                 a.id_spmdt,
        //                 a.spmhd_nochar,
        //                 a.nama_karyawan,
        //                a.jadwal_bayar,
        //                 a.jenis_spmhd,
        //                 a.spm_nominal,
        //                 a.spmdt_status_bayar,
        //                 a.spmdt_invoice,
        //                 a.id_project
        //             FROM (
        //                 SELECT 
        //                     a.id_spmdt,
        //                     a.spmhd_nochar,
        //                     c.nama_karyawan,
        //                     MIN(a.spmdt_jdwal_bayar) as jadwal_bayar,
        //                     a.jenis_spmhd,
        //                     a.spm_nominal,
        //                     a.spmdt_status_bayar,
        //                     a.spmdt_invoice,
        //                     a.id_project
        //                 FROM spm_simpanpinjam_dt a
        //                 INNER JOIN spm_simpanpinjam_hd b ON a.spmhd_nochar = b.spmhd_nochar
        //                 INNER JOIN md_anggota c ON b.id_anggota = c.id_anggota
        //                 WHERE a.id_project = '".$option."'
        //                 GROUP BY  a.id_spmdt,
        //                     a.spmhd_nochar,
        //                     c.nama_karyawan,
        //                     a.jenis_spmhd,
        //                     a.spm_nominal,
        //                     a.spmdt_status_bayar,
        //                     a.spmdt_invoice,
        //                     a.id_project
        //             ) AS a 
        //             GROUP BY a.spmhd_nochar ");

          
                        
    
     
      $html = '';
      $total=0;
    
    foreach ($dataPinjaman as $key => $pinjaman) {
    
        $html .= '<tr>';
        $html .= '<td>' . ($key + 1) . '</td>';
        $html .= '<input type="hidden" name="id_spmdt_int[]" value="' . $pinjaman->id_spmdt . '">';
        $html .= '<td>' . $pinjaman->spmhd_nochar . '<input type="hidden" name="spmhd_nochar[]" value="' . $pinjaman->spmhd_nochar . '">' . '</td>';
        $html .= '<td>' . $pinjaman->nama_karyawan . '<input type="hidden" name="id_anggota[]" value="' . $pinjaman->id_anggota. '">'.'</td>';
        $html .= '<td>' . $pinjaman->jenis_spmhd . '<input type="hidden" name="jenis_spmhd[]" value="' . $pinjaman->jenis_spmhd. '">'.'</td>';
        $html .= '<td>' . $pinjaman->spmdt_invoice . '<input type="hidden" name="spmdt_invoice[]" value="' . $pinjaman->spmdt_invoice . '">' . '</td>';
        $html .= '<td>' . $pinjaman->jadwal_bayar . '<input type="hidden" name="spmdt_jdwal_bayar[]" value="' . $pinjaman->jadwal_bayar . '">' . '</td>';
        $html .= '<td>' . $pinjaman->spm_nominal . '<input type="hidden" name="spm_nominal[]" value="' . $pinjaman->spm_nominal . '">' . '</td>';
        $html .= '<td>' . $pinjaman->spm_bagihasil . '<input type="hidden" name="spm_bagihasil[]" value="' . $pinjaman->spm_bagihasil . '">' . '</td>';
       
        $html .= '<td><input type="number" class="bayar" id="BYR-' . $pinjaman->id_spmdt . '" name="spmdt_nominal[]" value="' . $pinjaman->spm_nominal . '"></td>';
        $html .= '</tr>';
        $total += $pinjaman->spm_nominal;
    }
    $html .= '<tr>';
        $html .= '<td colspan="8">Total</td>';
        // $html .= '<td></td>';
        // $html .= '<td></td>';
        // $html .= '<td></td>';
        // $html .= '<td></td>';
        // $html .= '<td></td>';
        // $html .= '<td></td>';
        $html .= '<td><b>' . number_format($total,2,",",".") . '</b></td>';
        $html .= '</tr>';
    return $html;
    
    }
    //save simpanpinjam(kredit barang &uang)
    public function spmsimpan(Request $request)
    {  
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
        $PROJECT_NO_CHAR = Session::get('PROJECT_NO_CHAR');
        $username = Session::get('username');

        $counter = self::autonumber('spm_pinjam', 'SPM');
        Msimpanpinjam_hd::Create([
            'spmhd_nochar' => $counter,
            'id_anggota' => $request->id_anggota,
            'jenis_spmhd' => $request->jenis_spmhd,
            'spmhd_nominal' => $request->spmhd_nominal,
            'tgl_pengajuan_spm'=>$request->tgl_pengajuan_spm,
            'tglcair_spm' => null,
            'spm_catatan'=>$request->spm_catatan,
            'spm_id_barang' => $request->id_barang,
            'spm_period' => $request->spm_period,
            'spm_lunas' => 0,
            'spm_status' => 'request',
            'is_generate'=>0,
            'created_by' => $username,
            'updated_by' => '',
        ]);

        $dtlpyment = \DB::getPdo()->lastInsertId();
          
        $dtl=   Msimpanpinjam_hd::where('id_spmhd', $dtlpyment)
                          ->first();
    //    dd($dtl);

         $date = Carbon::parse($dtl->tgl_pengajuan_spm);
          $Year = $date->year;
          $anggota = Manggota::where('id_anggota',$dtl->id_anggota)->first();
        //        ->where('period','$Year')
        //        ->update(['pinjaman1'=>  \DB::raw('pinjaman1 + ' . $dtl->spmhd_nominal)]);
        $totalspm = \DB::table('spm_simpanpinjam_hd')
                    ->select(\DB::raw('SUM(spmhd_nominal) as totalpinjaman'))
                    ->where('id_anggota',$dtl->id_anggota)
                    ->whereIn('jenis_spmhd',['KRU','KRB'])
                    ->whereYear('tgl_pengajuan_spm', '=', $Year)
                    ->first();
    // dd($totalspm);
       $test= Mshu::updateOrCreate(
            ['id_anggota'=>$dtl->id_anggota,
             'nik_anggota'=>$anggota->nik_karyawan,
            'period'=>$Year],
            [ 
                // 'pinjaman1'=>$totalspm->totalpinjaman, 
                'pinjaman1'=>   \DB::raw('pinjaman1 + ' . $dtl->spmhd_nominal),
            'generate_status'=>0
           ]);

        //    dd($test);
        \DB::statement("UPDATE counter_tabel SET spm_pinjam=spm_pinjam+1 WHERE PROJECT_NO_CHAR = '$PROJECT_NO_CHAR' ");


        return redirect(route('peminjaman.index'));

    }
    
    public function spmupdate(Request $request,$id){
     

        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }

        Msimpanpinjam_hd::where('id_spmhd',$id)
        ->update(['tgl_pengajuan_spm'=>$request->tanggal_pinjaman,
                  'spm_period'=>$request->periode,
                  'spm_catatan'=>$request->spm_catatan,
                  'spmhd_nominal'=>$request->spm_nominal]);
    
                  return redirect()->route('peminjaman.index')->with('success', 'Update data pinjaman Successfully!');
  
    }

    public function generatesch(Request $request,$id){

        
        $spmheader =   Msimpanpinjam_hd::where('id_spmhd',$id)->first();
       $id_anggota = $spmheader->id_anggota;
       $projectloc = Manggota::where('id_anggota','=',$id_anggota)->first();
       
    //    dd($spmheader->jenis_spmhd);
       $totalAmount = $request->spm_nominal;
        $installmentCount = $request->periode;
        $tgl_sch_awal = Carbon::parse($request->tgl_sch_awal);
        // dd($spmheader->jenis_spmhd.$tgl_sch_awal.$installmentCount.$totalAmount);
        if($spmheader->jenis_spmhd=='KRU'){
            $rate =intval(0.01*$totalAmount);
        }else{

            $rate =intval(0.012*$totalAmount);
        }
    //    dd($rate);
        $installmentAmount = ($totalAmount / $installmentCount)+$rate;
        // dd($installmentCount);
        // $currentDate = now();
        $currentDate= $tgl_sch_awal;
        $rate;
       
        $schedules = [];

        for ($i = 1; $i <= $installmentCount; $i++) {
            $paymentDate = $currentDate->copy()->addMonths($i);

            $schedule = [

                'id_project'=> $projectloc->id_project,
                'spmhd_nochar'=>$spmheader->spmhd_nochar,
                'id_anggota'=>$spmheader->id_anggota,
                'spmdt_jdwal_bayar'=>$paymentDate,
                'spmdt_invoice' => $spmheader->spmhd_nochar.'#'.sprintf("%04s", $i),
                'jenis_spmhd' => $spmheader->jenis_spmhd,
                'spm_nominal' => $installmentAmount,
                'spm_bagihasil'=>$rate,                
                'spmdt_status_bayar'=>0,
                'created_at'=>date('Y-m-d'),
                'created_by'=> Session::get('username')
            ];

            $schedules[] = $schedule;
        }

        // dd($schedules);

       $spm=   Msimpanpinjam_dt::insert($schedules);
       if($spm){
        Msimpanpinjam_hd::where('id_spmhd',$id)
         ->update(['spm_status'=>'generate','is_generate'=>1]);
       }
        
      

       return redirect()->route('peminjaman.index')->with('success', 'generate schedule bayar Successfully!');
  

    }
    public function inactive($id){
        // dd($id);
    
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }

        $header =  Msimpanpinjam_hd::where('id_spmhd', $id)->first();
        Msimpanpinjam_dt::where('spmhd_nochar',$header->spmhd_nochar)
        ->update(['is_delete'=>1]);
        Msimpanpinjam_hd::where('id_spmhd', $id)
        ->update(['spm_status'=>'reject']);

        
        return redirect()->route('peminjaman.index')->with('success', 'delete pinjaman Successfully!');
  

    }
    
    public function spmdelete($id){
     
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }

        $header =  Msimpanpinjam_hd::where('id_spmhd', $id)->first();
        Msimpanpinjam_dt::where('spmhd_nochar',$header->spmhd_nochar)->delete();
        Msimpanpinjam_hd::where('id_spmhd', $id)
        ->update(['spm_status'=>'reject']);

        return redirect()->route('peminjaman.index')->with('success', 'delete pinjaman Successfully!');
  


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
