<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   // return redirect('https://sso.metropolitanland.com/LogoutAllApps');
    return redirect(route('login'));
});

Route::get('/logoutLicenza', function(){
   Session::flush();
 //return redirect('https://sso.metropolitanland.com/LogoutAllApps');
});


Auth::routes();
//Start Users Route
Route::get('/users/{users}/confirm', ['as' => 'users.confirm', 'uses' => 'UserController@confirm' ]);
Route::get('/users/{users}/activate', ['as' => 'users.activate', 'uses' => 'UserController@activate' ]);
Route::resource('users', 'UserController');

Route::group(['middleware' => 'auth'], function () {

    Route::get('password', 'PasswordController@edit')
        ->name('user.password.edit');
    Route::patch('password', 'PasswordController@update')
        ->name('user.password.update');
    Route::patch('password', 'PasswordController@update')
        ->name('user.password.update');

});
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('change_proj', 'HomeController@index')->name('home');
//coa

Route::post('/change_project', [
    'as'   => 'change_project',
    'uses' => 'HomeController@chProject'
]);
Route::get('/logout', function(){
    Session::flush();
    Auth::logout();
    return Redirect::to("/login")
        ->with('message', array('type' => 'success', 'text' => 'You have successfully logged out'));
});
Route::post('/checkValidSession', [
    'as'   => 'checkValidSession',
    'uses' => 'HomeController@checkValidSession'
]);

//koperasi master
Route::resource('barang', 'BarangController');
Route::resource('anggota', 'AnggotaController');
Route::get('ranggota', 'AnggotaController@ranggota');
Route::resource('project', 'MdProjectController');

//edit

Route::get('anggota/{id}/edit', ['as' => 'anggota.edit', 'uses' => 'AnggotaController@edit']);
Route::post('anggota/{id}/update', ['as' => 'anggota.update', 'uses' => 'AnggotaController@update']);


Route::post('project/{id}/saveedit', ['as' => 'project.saveedit', 'uses' => 'MdProjectController@saveedit']);

Route::post('barang/{id}/saveedit', ['as' => 'barang.saveedit', 'uses' => 'BarangController@saveedit']);

Route::post('barang/{id}/reject', ['as' => 'barang.reject', 'uses' => 'BarangController@reject']);

Route::post('anggota/{id}/reject', ['as' => 'anggota.reject', 'uses' => 'AnggotaController@reject']);

Route::post('project/{id}/reject', ['as' => 'project.reject', 'uses' => 'MdProjectController@reject']);

//transaski

Route::resource('simpanan_sr', 'SpmHeaderController');
//Route::get('/simpanpinjam/list', ['as' => 'simpanpinjam.list', 'uses' => 'SpmHeaderController@simpanpinjam' ]);
Route::post('simpanan_sr/{id}/delete',['as'=>'simpanan_sr.deletesr','uses' => 'SpmHeaderController@deletesr']);

Route::get('peminjaman',['as' => 'peminjaman.index','uses' => 'SpmHeaderController@listspm']);
Route::get('peminjaman/createspm',  ['as' => 'peminjaman.createspm','uses' => 'SpmHeaderController@createspm']);
Route::get('ambil-data-pinjaman/{option}',  ['as' => 'peminjaman.ambil-data-pinjaman','uses' => 'SpmHeaderController@ambilDatapinjaman']);
//Route::post('peminjaman', 'SpmHeaderController@spmstore');
Route::post('peminjaman', ['as' => 'peminjaman.spmsimpan', 'uses' => 'SpmHeaderController@spmsimpan' ]);
Route::get('peminjaman/{id}', ['as' => 'peminjaman.spmedit', 'uses' => 'SpmHeaderController@spmedit' ]);
Route::post('peminjaman/{id}/update', ['as' => 'peminjaman.spmupdate', 'uses' => 'SpmHeaderController@spmupdate' ]);
Route::post('peminjaman/{id}/delete', ['as' => 'peminjaman.spmdelete', 'uses' => 'SpmHeaderController@spmdelete' ]);
Route::post('peminjaman/{id}/generatesch', ['as' => 'peminjaman.generatesch', 'uses' => 'SpmHeaderController@generatesch' ]);
Route::post('peminjaman/{id}/inactive', ['as' => 'peminjaman.inactive', 'uses' => 'SpmHeaderController@inactive' ]);
Route::get('peminjaman/{id}/reschedule', ['as' => 'peminjaman.reschedule', 'uses' => 'SpmHeaderController@reschedule' ]);


//pembayaran
Route::resource('pembayaran', 'SpmPembayaranController');
Route::post('pembayaran/{id}/approve',['as'=>'pembayaran.approve','uses' => 'SpmPembayaranController@approvePembayaran']);
Route::get('pembayaran/{id}/delete',['as'=>'pembayaran.delete','uses' => 'SpmPembayaranController@deletepmbayaran']);

Route::get('rpembayaran',['as'=>'rpembayaran','uses' => 'SpmPembayaranController@rpembayaran']);
Route::post('vwrpembayaran',['as'=>'vwrpembayaran','uses' => 'SpmPembayaranController@vwrpembayaran']);


//simposukarela pokok/sukarela/pinjaman
Route::get('simposukarela', 'SpmPembayaranController@simposukarela');
//shu

Route::resource('shu', 'ShuController');
Route::post('shu/{id}/saveedit',['as'=>'shu.saveedit','uses' => 'ShuController@saveedit']);
Route::get('pointshu', ['as'=>'pointshu','uses' =>'ShuController@pointshu']);
Route::post('simpanshu', ['as'=>'simpanshu','uses' =>'ShuController@simpanshu']);

Route::get('generateshu', ['as'=>'generateshu','uses' =>'ShuController@generateshu']);
Route::get('getpointallshu/{tahun}',['as'=>'getpointallshu' ,'uses'=> 'ShuController@getpointallshu'] );


Route::get('reportshu', ['as'=>'reportshu','uses' =>'ShuController@reportshu']);
Route::post('vwreportshu', ['as'=>'vwreportshu','uses' =>'ShuController@vwreportshu']);
