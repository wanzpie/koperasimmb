<?php

namespace App\Http\Controllers;

use App\Model\ProjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MdProjectController extends Controller
{
     public function __construct()
    {
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
//            redirect('godigital.metropolitanland.com');
        }
//        $this->middleware('auth');
    }

    public function index(){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');

        $project = ProjectModel::where('active_status_int',1)->get();

        //DD($project);
        $listinst   = array('project'=>$project,
            'PROJECT_NO_CHAR'=>$PROJECT_NO_CHAR
        );
        return view('page.project.list',with ($listinst));

    }
    public function list(){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');

            $project = ProjectModel::all();

       //DD($project);
        $listinst   = array('project'=>$project,
                          'PROJECT_NO_CHAR'=>$PROJECT_NO_CHAR
                           );
        return view('page.project.list',with ($listinst));

    }

    public function store(Request  $request){
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }
        if($request->project_name !='' || $request->alamat_project !='')
        {
            ProjectModel::create([
                'project_name'=>$request->project_name,
                'alamat_project'=>$request->alamat_project,
                'active_status_int'=>1

            ]);
        }
        return redirect()->route('project.index')->with('success','Project berhasil ditambah');;

    }
    public function edit($id){

        $PROJECT_NO_CHAR= Session::get('PROJECT_NO_CHAR');
        $project = ProjectModel::where('PROJECT_NO_CHAR',$PROJECT_NO_CHAR)->first();
//        dd($project);
    }
    public function saveedit(Request $request,$id){


        $project = ProjectModel::where('project_no_char',$id)->first();

        $project->update([
            'project_name'=>$request->project_name,
            'alamat_project'=>$request->alamat_project,

        ]);

        if($project){
            return redirect()->route('project.index')->with('success','Project berhasil diupdate');
        }
      //  dd($request->all());

    }

    public function reject($id){

      
        if(Session::get('id') == ''){
            Session::flush();
            return redirect('/login');
        }

        $project = ProjectModel::where('project_no_char',$id)
        ->update(['active_status_int'=>0]);

        // dd(project);

        return redirect()->route('project.index')->with('success','project berhasil di nonaktifkan');

    }
}
