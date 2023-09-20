<?php

namespace App\Http\Controllers;

use App\Model\Manggota;
use App\Model\Mpembayaran;
use App\Model\Mpembayarandt;
use App\Model\Msimpanpinjam_hd;
use App\Model\Msimpanpinjam_dt; 
use App\Model\ProjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

//status bayar
//0 -request
//1 -approve
//2 -reject

class SpmPembayaranController extends Controller
{
    public function index(){

        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

        $spmbayar = \DB::select('select * from spm_pembayaran a 
        INNER join md_bank b on a.spmbayar_bank_id=b.id_bank
        where a.spmbayar_status="request" ');
        
        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');
        $listbayar   = array('spmbayar'=>$spmbayar,
            'PROJECT_NO_CHAR'=>$PROJECT_NO_CHAR
        );
//        dd($listspm_sr);

        return view('page.pembayaran.listpembayaran',with($listbayar));
    }

    public function create(){

        $anggota = Manggota::all();
        $bank =  \DB::table('md_bank')->SELECT('*')->get();
        $project = ProjectModel::all();

//        dd('test');
        $listbayar = array('bank'=>$bank,
                           'project'=>$project,
                           'anggota'=>$anggota);

        return view('page.pembayaran.form',with($listbayar));
    }

    
    //simpan pembayaran
    public function store(Request $request){

        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');
        // dd("UPDATE counter_tabel SET spm_byr=spm_byr+1 WHERE PROJECT_NO_CHAR = '$PROJECT_NO_CHAR'");
        // Mpembayaran::create([
        //     'id_bayar', 
        //     'spmbayar_nochar',
        //      'spmbayar_tgl_bayar',
        //       'spmbayar_nominal', 
        //       'spmbayar_status', 
        //       'spmbayar_catatan', 
        //       'spmbayar_bank_id', 
        //       'created_at', 
        //       'created_by', 
        //       'updated_at', 
        //       'updated_by'
        // ];
    // );

    $validatedData = $request->validate([
        'spmbayar_bank_id' => 'required',
        'spmbayar_tgl_bayar' => 'required|date',
        'spmbayar_catatan' => 'nullable|string',
        'spmbayar_nominal' => 'required|numeric',
        'id_project' => 'required'
    ]);
    $counter = self::autonumber('spm_byr', 'PYM');
    // dd($counter);
 
 
     try {
        
        \DB::beginTransaction();
        $pembayaran = new Mpembayaran();
        $pembayaran->spmbayar_nochar = $counter;
        $pembayaran->spmbayar_bank_id = $request->spmbayar_bank_id;
        $pembayaran->spmbayar_tgl_bayar = $request->spmbayar_tgl_bayar;
        $pembayaran->spmbayar_catatan = $request->spmbayar_catatan;
        $pembayaran->spmbayar_nominal = $request->spmbayar_nominal;
        $pembayaran->id_project = $request->id_project;
        $pembayaran->spmbayar_status='request';
        $pembayaran->created_by = Session::get('username');
        $pembayaran->save();
            
              //insert dtail bayar

              $dtlpyment = \DB::getPdo()->lastInsertId();
            //   dd($dtlpyment);

              $iddetail = Mpembayaran::where('id_bayar',$dtlpyment)->first();
                
              $id_spmdt_int = $request->id_spmdt_int;
            //   dd($id_spmdt_int);
              if ($iddetail) {
                  foreach ($id_spmdt_int as $key => $id_detail) {
                      $billdt = \DB::table('spm_pembayaran_dt')->insert([
                           'spmbayar_nochar'=>$iddetail->spmbayar_nochar,
                           'id_anggota'=>$request->id_anggota[$key],
                            'spmhd_nochar'=>$request->spmhd_nochar[$key], 
                            'spmdt_invoice'=>$request->spmdt_invoice[$key],
                            'jenis_spmhd'=>$request->jenis_spmhd[$key],  
                            'spmdt_tgl_byar'=>$request->spmbayar_tgl_bayar, 
                            'spmdt_nominal'=>$request->spmdt_nominal[$key],
                            'spm_bagihasil'=> $request->spm_bagihasil[$key],
                            'status_bayar'=>0, 
                             'created_at'=>date('Y-m-d'),
                             'updated_at'=>null
                      ]);

                    //   dd($billdt);
                   $bayar =  $request->spmdt_nominal[$key];
               
                   $spmhd_nochar = $request->spmhd_nochar[$key];
   
                  
                }
      
              } else {
                  return "data detail tidak bisa ditambahkan";
              }
              DB::statement("UPDATE counter_tabel SET spm_byr=spm_byr+1 WHERE PROJECT_NO_CHAR = '$PROJECT_NO_CHAR' ");
      
              \DB::commit();

     } catch (\Throwable $th) {
        throw $th;
         \DB::rollback();
        return redirect()->route('pembayaran.index')->with('warning', 'Failed save data, errmsg : ' . $ex);
       
     }
   
     return redirect()->route('pembayaran.index')->with('success', 'Save Pembayaran Successfully!');
  
    
  
      
    }

    public function edit($id){
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
        $anggota = Manggota::all();
        $bank =  \DB::table('md_bank')->SELECT('*')->get();
        $project = ProjectModel::all();
      
        $idbayar = Mpembayaran::where('id_bayar',$id)->first();
        $detail =  Mpembayarandt::where('spmbayar_nochar','=',$idbayar->spmbayar_nochar)->get();
      

        $listbayar= array('idbayar'=>$idbayar,
                              'detail'=>$detail,
                            'anggota'=>$anggota,
                        'bank'=>$bank,
                    'project'=>$project);
          
         return view('page.pembayaran.formedit',with($listbayar));                     
    }

    // public function approvepmbayaran($id){

    //     if (Session::get('id') == '') {
    //         Session::flush();
    //         return redirect('/login');
    //     }
       
    //     $idbayar = Mpembayaran::where('id_bayar',$id)
    //               ->update(['status_bayar'=>1]);
    //     // ->first()
        
    //     $detail =  Mpembayarandt::where('id_bayar','=',$id)->get();
    //     $tgl = Mpembayaran::where('id_bayar',$id)->first(); 
    //    $thnbayar = Carbon::parse($tgl->spmbayar_tgl_bayar);
    //    $year = $thnbayar->year();
    //     foreach ($detail as $dtl){

    //     $byrdtl=     Mpembayarandt::where('spmdt_invoice',$dtl->spmdt_invoice)
    //                 // ->first();
    //                  ->update(['status_bayar'=>1]);
            
    //     if($byrdtl){

    //                // Cari ID Anggota berdasarkan spmhd_nochar
    //                $idanggota = \DB::table('spm_simpanpinjam_hd as a')
    //                ->join('spm_simpanpinjam_dt as b', 'a.spmhd_nochar', '=', 'b.spmhd_nochar')
    //                ->where('a.spmhd_nochar', $dtl->spmhd_nochar)
    //                ->select('a.id_anggota')
    //                ->first();
               
    //            // Pastikan ID Anggota ditemukan sebelum mengupdate
    //            if ($idanggota) {
    //             if (in_array($jenis_spmhd, ['KRB', 'KRU'])) {
    //                 \DB::table('simpanpinjam')
    //                     ->where('id_anggota', $idanggota->id_anggota)
    //                     ->where('period','=',$year)
    //                     ->update([
    //                         'bagihasil_pinjaman' => DB::raw('bagihasil_pinjaman + ' . $byrdtl->spm_bagihasil),
    //                     ]);
    //             }elseif($jenis_spmhd=='SKR'){
    //                 \DB::table('simpanpinjam')
    //                 ->where('id_anggota', $idanggota->id_anggota)
    //                 ->where('period','=',$year)
    //                 ->update([
    //                     'jum_simp_sr' => DB::raw('jum_simp_sr + ' . $byrdtl->spmdt_nominal),
    //                 ]);
    //             }else{
    //                 \DB::table('simpanpinjam')
    //                 ->where('id_anggota', $idanggota->id_anggota)
    //                 ->where('period','=',$year)
    //                 ->update([
    //                     'jum_simpo' => DB::raw('jum_simpo + ' . $byrdtl->spmdt_nominal),
    //                 ]);
    //             }
    //             }
        
        
    //            }

    //     }
   

    //     $listbayar= array('idbayar'=>$idbayar,
    //                           'detail'=>$detail);
          
    //      return view('page.pembayaran.formedit',with($listbayar));                     
    // }
    public function approvePembayaran1($id)
        {
            if (Session::get('id') == '') {
                Session::flush();
                return redirect('/login');
            }
         
       
            // Mulai transaksi database
            // DB::beginTransaction();

            // try {
                // Perbarui status pembayaran
                 //    dd($test);
                // Dapatkan detail pembayaran
                $latest=  Mpembayaran::where('id_bayar', $id)
                ->first();
                $detail =  Mpembayarandt::where('spmbayar_nochar', '=', $latest->spmbayar_nochar)
                ->where('status_bayar','=',0)    
                ->get();
                // dd($detail);
         
                // Dapatkan tanggal pembayaran
                $tgl = Mpembayaran::where('id_bayar', $id)->first();
                $thnBayar = Carbon::parse($tgl->spmbayar_tgl_bayar)->year;
                // $updatedAnggota = [];
                foreach ($detail as $dtl) {
                    
                $iddetailinv =    Msimpanpinjam_dt::where('spmdt_invoice',$dtl->spmdt_invoice)
                           ->first();
                        //    dd($iddetailinv);
                    // Perbarui status pembayaran detail
                    //$jenisSpmhd = $iddetailinv->jenis_spmhd;

                    // Cari ID Anggota berdasarkan spmhd_nochar
                    $idAnggota = \DB::table('spm_simpanpinjam_hd as a')
                        ->join('spm_simpanpinjam_dt as b', 'a.spmhd_nochar', '=', 'b.spmhd_nochar')
                        ->where('b.spmdt_invoice', $iddetailinv->spmdt_invoice)
                        ->select('a.id_anggota')
                        ->first();
                        // dd($idAnggota);
                    // dd($iddetailinv->jenis_spmhd);
                    // Pastikan ID Anggota ditemukan sebelum mengupdate
                    // if ($idAnggota) {

                        // Anda perlu mendapatkan jenis_spmhd yang benar
                    //  dd($jenisSpmhd);
                    // dd($dtl->spm_bagihasil);
                        if (in_array($iddetailinv->jenis_spmhd, ['KRB', 'KRU'])) {
                            // dd('1');
                            DB::statement("UPDATE simpanpinjam SET bagihasil_pinjaman=bagihasil_pinjaman+$dtl->spm_bagihasil WHERE id_anggota = '".$idAnggota->id_anggota."'
                            and period='".$thnBayar."' ");
                            Mpembayarandt::where('spmdt_invoice', $dtl->spmdt_invoice)
                            ->update(['status_bayar' => 1]);
                       
                            Msimpanpinjam_dt::where('spmdt_invoice',$dtl->spmdt_invoice)
                               ->update(['spmdt_status_bayar'=>1]);
                        
                            //    $test =     \DB::table('simpanpinjam')
                    //             ->where('id_anggota', $idAnggota->id_anggota)
                    //             ->where('period', $thnBayar)
                    //             // ->first();
                    //             ->update([
                    //                    'bagihasil_pinjaman' => \DB::raw('bagihasil_pinjaman + ' . $dtl->spm_bagihasil),
                    //      ]);
                        //  dd($test);       
                                // ->update([
                                //     'bagihasil_pinjaman' => \DB::raw('bagihasil_pinjaman + ' . $dtl->spm_bagihasil),
                                // ]);
                        } 
                        elseif ($iddetailinv->jenis_spmhd == 'SKR') {
                            // dd($dtl->spmdt_nominal);
                    //  dd('2');
                            DB::statement("UPDATE simpanpinjam SET jum_simpsr=jum_simpsr+$dtl->spmdt_nominal WHERE id_anggota = '".$idAnggota->id_anggota."'
                            and period='".$thnBayar."' ");
                            Mpembayarandt::where('spmdt_invoice', $dtl->spmdt_invoice)
                            ->update(['status_bayar' => 1]);
                       
                            Msimpanpinjam_dt::where('spmdt_invoice',$dtl->spmdt_invoice)
                               ->update(['spmdt_status_bayar'=>1]);
                        //   \DB::table('simpanpinjam')
                        //         ->where('id_anggota', $idAnggota->id_anggota)
                        //         ->where('period', $thnBayar)
                        //         // ->first();
                        //         ->update([
                        //             'jum_simpsr' => \DB::raw('jum_simpsr + ' . $dtl->spmdt_nominal),
                        //         ]);
                        // dd($test);
 
                        } 
                       elseif ($iddetailinv->jenis_spmhd == 'SPP') {
                          
                        // dd('3');
                        DB::statement("UPDATE simpanpinjam SET jum_simwa=jum_simwa+$dtl->spmdt_nominal WHERE id_anggota = '".$idAnggota->id_anggota."'
                        and period='".$thnBayar."' ");
                        Mpembayarandt::where('spmdt_invoice', $dtl->spmdt_invoice)
                        ->update(['status_bayar' => 1]);
                   
                        Msimpanpinjam_dt::where('spmdt_invoice',$dtl->spmdt_invoice)
                           ->update(['spmdt_status_bayar'=>1]);
                        // \DB::table('simpanpinjam')
                            //     ->where('id_anggota', $idAnggota->id_anggota)
                            //     ->where('period', $thnBayar)
                            //     ->update([
                            //         'jum_simwa' => DB::raw('jum_simwa + ' . $dtl->spmdt_nominal),
                            //     ]);
                        }else{
                            return redirect()->route('pembayaran.index')->with(['error'=>'Data tidak lengkap']);
                        }

                        // if (!in_array($idAnggota->id_anggota, $updatedAnggota)) {
                        //     $updatedAnggota[] = $idAnggota->id_anggota;
                        // }
                   
                    // }  
                }

                $idheadbayar=  Mpembayaran::where('id_bayar', $id)
                ->update(['spmbayar_status' => 'approve']);
     

                // Commit transaksi jika semuanya berhasil
                // DB::commit();
            // } catch (\Exception $e) {
                // Rollback transaksi jika terjadi kesalahan
                // DB::rollback();
                // Handle kesalahan sesuai kebutuhan Anda, misalnya:
                // throw $e; // Lempar kesalahan untuk ditangani oleh penanganan kesalahan global
                // return redirect()->back()->with('error', 'Terjadi kesalahan saat menyetujui pembayaran.');
            // }

            $listBayar = [
                'idbayar' => $id,
                'detail' => $detail,
            ];
            
            return redirect()->route('pembayaran.index')->with('success', 'Approve Pembayaran Successfully!');
        
            // return view('page.pembayaran.formedit')->with($listBayar);
        }

   
        public function rpembayaran(){
       
        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
        return view('page.pembayaran.rpembayaran');                     
   
        
    }
     
    public function approvePembayaran($id){

        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }

        $latest=  Mpembayaran::where('id_bayar', $id)
        ->first();
        $detail = Mpembayarandt::where('spmbayar_nochar', '=', $latest->spmbayar_nochar)
    ->where('status_bayar', '=', 0)
    ->get();


$detail = Mpembayarandt::where('spmbayar_nochar', '=', $latest->spmbayar_nochar)
    ->where('status_bayar', '=', 0)
    ->get();

$tgl = Mpembayaran::where('id_bayar', $id)->first();
$thnBayar = Carbon::parse($tgl->spmbayar_tgl_bayar)->year;

foreach ($detail as $dtl) {
    $iddetailinv = Mpembayarandt::where('spmdt_invoice', $dtl->spmdt_invoice)->first();
    $idAnggota1 = \DB::table('spm_simpanpinjam_hd as a')
        ->join('spm_simpanpinjam_dt as b', 'a.spmhd_nochar', '=', 'b.spmhd_nochar')
        ->where('b.spmdt_invoice', $iddetailinv->spmdt_invoice)
        ->select('a.id_anggota')
        ->first();
//    dd($iddetailinv->jenis_spmhd);
    if (!$iddetailinv) {
        return redirect()->route('pembayaran.index')->with(['error' => 'Data tidak lengkap']);
    }

    switch ($iddetailinv->jenis_spmhd) {
        case 'KRB':
        case 'KRU':
            DB::statement("UPDATE simpanpinjam SET bagihasil_pinjaman=COALESCE(bagihasil_pinjaman, 0)+$iddetailinv->spm_bagihasil WHERE id_anggota = '" . $iddetailinv->id_anggota . "' and period='" . $thnBayar . "' ");
            break;

        case 'SKR':
            DB::statement("UPDATE simpanpinjam SET jum_simpsr=COALESCE(jum_simpsr, 0)+$iddetailinv->spmdt_nominal WHERE id_anggota = '" . $iddetailinv->id_anggota . "' and period='" . $thnBayar . "' ");
            break;

        case 'SPP':
            DB::statement("UPDATE simpanpinjam SET jum_simwa=COALESCE(jum_simwa, 0)+$iddetailinv->spmdt_nominal WHERE id_anggota = '" . $iddetailinv->id_anggota . "' and period='" . $thnBayar . "' ");
            break;

        default:
            return redirect()->route('pembayaran.index')->with(['error' => 'Jenis spmhd tidak valid']);
    }

    Mpembayarandt::where('spmdt_invoice', $dtl->spmdt_invoice)->update(['status_bayar' => 1]);
    Msimpanpinjam_dt::where('spmdt_invoice', $dtl->spmdt_invoice)->update(['spmdt_status_bayar' => 1]);
}

      $idheadbayar = Mpembayaran::where('id_bayar', $id)->update(['spmbayar_status' => 'approve']);


 return redirect()->route('pembayaran.index')->with('success', 'Approve Pembayaran Successfully!');
        


    }
    public function deletepmbayaran($id){
     
        {
            if (Session::get('id') == '') {
                Session::flush();
                return redirect('/login');
            }
        
            // Mulai transaksi database
            DB::beginTransaction();
        
            try {
                $idbayar = Mpembayaran::where('id_bayar', $id)->first();
        
                // Hapus detail pembayaran terlebih dahulu
                Mpembayarandt::where('spmbayar_nochar', '=', $idbayar->spmbayar_nochar)->delete();
        
                // Hapus pembayaran
                Mpembayaran::where('id_bayar', $id)->delete();
        
                // Commit transaksi jika semuanya berhasil
                DB::commit();
        
                return redirect()->route('pembayaran.index')->with('success', 'Penghapusan Pembayaran Berhasil!');
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi kesalahan
                DB::rollback();
                
                // Handle kesalahan sesuai kebutuhan Anda, misalnya:
                // throw $e; // Lempar kesalahan untuk ditangani oleh penanganan kesalahan global
                return redirect()->route('pembayaran.index')->with('error', 'Terjadi kesalahan saat menghapus pembayaran.');
            }
        }
    }
    public function vwrpembayaran(Request $request){

        if (Session::get('id') == '') {
            Session::flush();
            return redirect('/login');
        }
        $spmbayar = \DB::select('select * from spm_pembayaran a INNER join md_bank b on a.spmbayar_bank_id=b.id_bank');
        
        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');
        $listbayar   = array('spmbayar'=>$spmbayar,
            'PROJECT_NO_CHAR'=>$PROJECT_NO_CHAR
        );
//        dd($listspm_sr);

        return view('page.pembayaran.rpembayaran',with($listbayar));
    
    

//    dd($request->all());
    }

//     public function storespm(Request $request)
// {
//     // Validasi input data
//     $validatedData = $request->validate([
//         'spmbayar_bank_id' => 'required',
//         'spmbayar_tgl_bayar' => 'required|date',
//         'spmbayar_catatan' => 'nullable|string',
//         'spmbayar_nominal' => 'required|numeric',
//         'id_project' => 'required',
//     ]);

//     // Simpan data pembayaran
//     $pembayaran = new Pembayaran();
//     $pembayaran->spmbayar_bank_id = $request->input('spmbayar_bank_id');
//     $pembayaran->spmbayar_tgl_bayar = $request->input('spmbayar_tgl_bayar');
//     $pembayaran->spmbayar_catatan = $request->input('spmbayar_catatan');
//     $pembayaran->spmbayar_nominal = $request->input('spmbayar_nominal');
//     $pembayaran->id_project = $request->input('id_project');
//     $pembayaran->save();

//     // Redirect ke halaman yang sesuai setelah penyimpanan
//     return redirect()->route('nama_route_anda') // Gantilah 'nama_route_anda' dengan nama route yang sesuai
//         ->with('success', 'Data pembayaran berhasil disimpan.');
// }
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
