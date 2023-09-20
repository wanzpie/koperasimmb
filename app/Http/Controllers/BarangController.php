<?php

namespace App\Http\Controllers;

use App\Model\Mbarang;
use App\Model\ProjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{

    public function __construct(){

    }
   //list daftar barang
    public  function index(){

        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');

        $barang = Mbarang::all();

        //DD($project);
        $listbarang   = array('barang'=>$barang,
            'PROJECT_NO_CHAR'=>$PROJECT_NO_CHAR
        );
        return view('page.barang.list',with ($listbarang));

    }

    //create  barang
    public function create(){

        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');

        $barang = Mbarang::all();

        //DD($project);
        $listbarang   = array('barang'=>$barang,
            'PROJECT_NO_CHAR'=>$PROJECT_NO_CHAR
        );
        return view('page.barang.form',with ($listbarang));
    }
    public function store(Request  $request){

        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
       if($request->nama !='' || $request->satuan !='' || $request->tipemerek !='' || $request->harga !='')
       {
           Mbarang::create([
               'nama_barang'=>$request->nama,
               'satuan'=>$request->satuan,
               'tipe_merek'=>$request->tipemerek,
               'harga_barang'=>$request->harga
           ]);
       }
        return redirect(route('barang.index'))->with('success','Data barang berhasil ditambah');;


    }
    public function saveedit(Request $request,$id){


        $barang = Mbarang::where('id_barang',$id)->first();

        $barang->update([
            'nama_barang'=>$request->nama_barang,
            'satuan'=>$request->satuan,
            'tipe_merek'=>$request->tipe_merek,
            'harga_barang'=>$request->harga_barang,
            'updated_at'=>date('Y-m-d H:i:s')

        ]);

        if($barang){
            return redirect()->route('barang.index')->with('success','Data barang berhasil diupdate');
        }
    }

    public function destroy($id){

        $project = Mbarang::where('id_barang',$id)->first();
    }

    public function reject($id){
    
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        
        $barang = Mbarang::where('id_barang',$id)->delete();
        // dd($barang);
        
        return redirect()->route('barang.index')->with('success','Data Barang berhasil dihapus');


    }
}
