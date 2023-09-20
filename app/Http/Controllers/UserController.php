<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Session,Validation,DB;
use App\User;


class UserController extends Controller
{


     public function __construct()
    {
//        if(Session::get('id') == ''){
//            Session::flush();
//
//        }
//        $this->middleware('auth');
    }


    public function index(){
        // dd(Session::get('id'));
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

        $users = User::all();
        $inv   = array(
            'title'         => 'List User',
            'users'     => $users
        );
        return view('page.users.list', with($inv));

    }
    public function create(User $user){

//        if(Session::get('id') == ''){
//            Session::flush();
//            return redirect('/login');
//        }
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

        $menu_parents = \DB::select('select * from menus');
       // dd($menu_parents);
        $menu_childs = \DB::select('select * from menus where is_parent = 0');

        $projects = \DB::select("select * from md_project ");
        $inv   = array(
            'title'         => 'create User',
            'user'     => $user,
            'menu_parents'=>$menu_parents,
            'menu_childs'=>$menu_childs,
            'projects'=>$projects
        );
        return view('page.users.form', with($inv));

    }
    public function store(Request $request){

//        if(Session::get('id') == ''){
//            Session::flush();
//            return redirect('/login');
//        }
//       dd($request->all());

        $req = implode(',', $request->menu_perms);
//        $proj = $request->project_no_char;
             User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'level' => $request->perms_name,
            'menu' => $req,
            'project_no_char'=>1
            // $request->project_no_char,
//            'assignment_project' => $proj,

        ]);
        return redirect(route('users.index'));
    }

    public function edit($id){

        $user = User::find($id);
        $menu_parents = \DB::select('select * from menus');
        // dd($menu_parents);
         $menu_childs = \DB::select('select * from menus where is_parent = 0');
 
        $projects = \DB::select("select * from md_project ");
        $inv   = array(
            'title'         => 'create User',
            'user'     => $user,
            'menu_parents'=>$menu_parents,
            'menu_childs'=>$menu_childs,
            'projects'=>$projects
        );
        return view('page.users.form', with($inv));
    }

    public function update(Request $request,$id){

        $user = User::find($id);
        // dd($request->all());
        $req = implode(',', $request->menu_perms);
        //        $proj = $request->project_no_char;
                     User::where('id', $user->id)
                     ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => $request->password,
                        'level' => $request->perms_name,
                        'menu' => $req,
                        'project_no_char'=>$request->project_no_char,
                     ]);
                
       if($req){
        return redirect(route('users.index'));

       }
        
    }

    public function  confirm($id){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        $user = User::find($id);
        $user->update(['password'=>'Metland@123','isChange'=>1]);
        // dd($user);
        return redirect(route('users.index'))->with('success','Password has been reset to Metland@123');

    }
    
    //hapus
    public function show($id)
    {
        // Cari pengguna berdasarkan ID yang diberikan
        $user = User::find($id);
    
        if (!$user) {
            // Jika pengguna tidak ditemukan, Anda dapat menangani error atau mengembalikan respons yang sesuai
            return redirect()->route('users.index') // Gantilah 'nama_route_anda' dengan nama route yang sesuai
                ->with('error', 'Pengguna tidak ditemukan.');
        }
    
        // Hapus pengguna dari database
        $user->delete();
    
        // Setelah pengguna dihapus, Anda dapat mengarahkan kembali ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('users.index') // Gantilah 'nama_route_anda' dengan nama route yang sesuai
            ->with('success', 'Pengguna berhasil dihapus.');
    }
    
}
