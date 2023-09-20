<?php namespace App\Http\Util;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Session;
/**
 * Description of utilSession
 *
 * @author rizky
 */
class utilSession {
    function checkSession() {
        $isLogged = (bool) Session::get('dataSession.isLogin');
        
        if($isLogged == FALSE){
            //dd($isLogged);
          
            return redirect()->route('users.login');;
        }
    }
    
    public function setSession(){
        
    }
}
