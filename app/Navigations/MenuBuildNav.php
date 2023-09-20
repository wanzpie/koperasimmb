<?php
//
//namespace App\Navigations;
//
//use Session, DB, Log;
//
//
//class MenuBuildNav {
//    public static function menus(){
//        $now = date('Y-m-d H:i:s');
//        $day = date("N",strtotime($now));
//        $menu = array();
//        $perms = Session::get('permissions');
//
//        $query = \DB::select("SELECT DISTINCT p.* FROM menus as p INNER JOIN menus as c ON p.id = c.parent_id
//        WHERE c.id IN ($perms)
//        UNION ALL
//        SELECT * FROM menus WHERE id IN ($perms)");
//
//        if (!empty($query)){
//            $i = 1;
//            foreach ($query as $row)
//            {
//                $menu[$i]['id'] = $row->id;
//                $menu[$i]['title'] = $row->title;
//                $menu[$i]['uri'] = $row->uri;
//                $menu[$i]['parent'] = $row->parent_id;
//                $menu[$i]['is_parent'] = $row->is_parent;
//                $menu[$i]['show'] = $row->show_menu;
//                $i++;
//            }
//        }
//        $html_out = "<div class='navbar-default sidebar' role='navigation'>
//	        <div class='sidebar-nav navbar-collapse'>
//	            <ul class='nav' id='side-menu'>
//                    <li>
//                        <a href='". route('home'). "'><i class='fa fa-dashboard fa-fw'></i> Dashboard</a>
//                    </li>
//       	";
//        for ($i = 1; $i <= count($menu); $i++){
//            if (is_array($menu[$i])){    // must be by construction but let's keep the errors home
//                if ($menu[$i]['show'] && $menu[$i]['parent'] == 0){    // are we allowed to see this menu?
//                    $uri = $menu[$i]['uri'];
//                    if ($menu[$i]['is_parent'] == TRUE) {
//                        $html_out .= '<li ><a href="'.$menu[$i]['uri'].'" >'.$menu[$i]['title'].'<span class="fa arrow"></span></a>';
//                    }else{
//                        $html_out .= '<li ><a href="'.url($uri).'">'.$menu[$i]['title'].'<span></span></a>';
//                    }
//                    // loop through and build all the child submenus.
//                    $html_out .= self::get_childs($menu, $menu[$i]['id'], "nav-second-level");
//                    $html_out .= '</li>';
//                }
//            }
//        }
////        if(Session::get('pnum') == '1801' && Session::get('ptype') == '03'){
////            $html_out .= "<ul class='nav' id='side-menu'>
////                <li>
////                    <a href='".route('cashback2')."'><i class='fa fa-money fa-fw'></i> Cashback</a>
////                </li>
////            </ul>";
////        }else
////         if(Session::get('pnum') == '1801' && Session::get('ptype') <= '03'){
////            $sess = explode(',', Session::get('perms'));
////            $html_out .= "
////                <li><a href='javascript:void(0)'>Cashback<span class='fa arrow'></span></a>
////                    <ul class='nav nav-second-level collapse'>";
////            if(in_array("29", $sess)){
////                $html_out .= "<li><a href='".route('cashback.add')."'><i class='fa fa-plus fa-fw'></i> Add Voucher</a></li>";
////            }
////            $html_out .= "<li><a href='".route('cashback2')."'><i class='fa fa-money fa-fw'></i> Cashback</a></li>
////                        <li><a href='".route('cashback.reimburse_list')."'><i class='fa fa-print fa-fw'></i> Reimburse</a></li>";
////		if(Session::get('ptype') == '02'){
////		$html_out .= "<li>
////                    <a href='".route('cashback.cross')."'><i class='fa fa-money fa-fw'></i> Cross Selling VOC</a>
////                </li>";
////		}
////           $html_out .= "<li><a href='".route('cashback.report')."'><i class='fa fa-book fa-fw'></i> Report</a></li>
////                    </ul>
////                </li>
////            ";
////        }else{
////            $html_out .= "<ul class='nav' id='side-menu'>
////                <li>
////                    <a href='#'><i class='fa fa-money fa-fw'></i> Depresiasi</a>
////                </li>
////            </ul>";
////        }
//        $html_out .= '</ul></div></div>';
//
//        /*else if(Session::get('pnum') == '1801' && Session::get('ptype') == '02'){
//            $sess = explode(',', Session::get('perms'));
//            if(in_array("29", $sess)){
//                $html_out .= "<li><a href='".route('cashback.add')."'><i class='fa fa-plus fa-fw'></i> Add Voucher</a></li>";
//            }
//            $html_out .= "<ul class='nav' id='side-menu'>
//                <li>
//                    <a href='".route('cashback.index')."'><i class='fa fa-money fa-fw'></i> Cashback</a>
//                </li>
//                <li>
//                    <a href='".route('cashback.cross')."'><i class='fa fa-money fa-fw'></i> Cross Selling VOC</a>
//                </li>
//            </ul>";
//        }*/
//
//        return $html_out;
//    }
//    public static function get_childs($menu, $parent_id, $level){
//        $has_subcats = FALSE;
//        $html_out  = '';
//        $html_out .= "<ul class='nav nav-treeview".$level."'>";
//
//        for ($i = 1; $i <= count($menu); $i++){
//            if (is_array($menu[$i])){
//                if ($menu[$i]['show'] && $menu[$i]['parent'] == $parent_id){    // are we allowed to see this menu?
////                    dump($menu[$i]);
//                    $has_subcats = TRUE;
//                    $uri = $menu[$i]['uri'];
//                    if ($menu[$i]['is_parent'] == TRUE){
//                        $html_out .= '<li><a href="javascript:void(0)">'.$menu[$i]['title'].'<span class="fa arrow"></span></a>';
//                    }
//                    else{
//                        $html_out .= '<li><a href="'.url($uri).'" id="'.$uri.'">'.$menu[$i]['title'].'<span></span></a>';
//                    }
//                    $html_out .= self::get_childs($menu, $menu[$i]['id'], "nav-second-level");
//                    $html_out .= '</li>';
//                }
//            }
//        }
//        $html_out .= '</ul>';
//        return ($has_subcats) ? $html_out : FALSE;
//    }
//}


namespace App\Navigations;

use Session, DB, Log;
use App\Menu;

class MenuBuildNav
{
    public static function menus()
    {
        $now = date('Y-m-d H:i:s');
        $day = date("N", strtotime($now));
        $menu = array();
        $perms = Session::get('menu');
        $query = DB::select(DB::raw("
        SELECT DISTINCT p.* FROM menus as p INNER JOIN menus as c ON p.id = c.parent_id
        WHERE c.id IN (" . $perms . ")
        UNION ALL
        SELECT * FROM menus WHERE id IN (" . $perms . ");
        "));

        if (!empty($query)) {
            $i = 1;
            foreach ($query as $row) {
                $menu[$i]['id'] = $row->id;
                $menu[$i]['title'] = $row->title;
                $menu[$i]['uri'] = $row->uri;
                $menu[$i]['parent'] = $row->parent_id;
                $menu[$i]['is_parent'] = $row->is_parent;
                $menu[$i]['show'] = $row->show_menu;
                $i++;
            }
        }
        $html_out = "
                      <nav class=\"mt-2\">
                     <ul class=\"nav nav-pills nav-sidebar flex-column\" data-widget=\"treeview\" role=\"menu\" data-accordion=\"false\">
                       <li>
                        <a href='" . route('home') . "' class='nav-link'><i class='nav-icon fas fa-tachometer-alt'></i> <p> Dashboard</p></a>
                    </li>
       	";
//        $html_out .= "
//                 <li class=\"nav-item\">
//                <a href=\"#\" id=\"change_project\" class=\"nav-link\" data-toggle=\"modal\" data-target=\"#modal-default\" >
//                    <i class=\"nav-icon fas fa-sync-alt\"></i>
//                    <p>
//                  Change Project
//                    </p>
//                </a>
//                 </li>
//         ";
        for ($i = 1; $i <= count($menu); $i++) {
            if (is_array($menu[$i])) {    // must be by construction but let's keep the errors home
                if ($menu[$i]['show'] && $menu[$i]['parent'] == 0) {    // are we allowed to see this menu?
                    $uri = $menu[$i]['uri'];
                    if ($menu[$i]['is_parent'] == TRUE) {
                        $html_out .= ' <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                      ' . $menu[$i]['title'] . '
                       <i class="fas fa-angle-left right"></i>
                        </p></a>';
//                        $html_out .= '<li><a href="' . $menu[$i]['uri'] . '">' . $menu[$i]['title'] . '<span class="fa arrow"></span></a>';
                    } else {
                        $html_out .= '<li class="nav-item"><a href="' . url($uri) . '"><p>' . $menu[$i]['title'] . '</p></a>';
                    }
                    // loop through and build all the child submenus.
                    $html_out .= self::get_childs($menu, $menu[$i]['id'], "");
                    $html_out .= '</li>';
                }
            }
        }

        $html_out .= '</ul></nav></div>';

        /*else if(Session::get('pnum') == '1801' && Session::get('ptype') == '02'){
            $sess = explode(',', Session::get('perms'));
            if(in_array("29", $sess)){
                $html_out .= "<li><a href='".route('cashback.add')."'><i class='fa fa-plus fa-fw'></i> Add Voucher</a></li>";
            }
            $html_out .= "<ul class='nav' id='side-menu'>
                <li>
                    <a href='".route('cashback.index')."'><i class='fa fa-money fa-fw'></i> Cashback</a>
                </li>
                <li>
                    <a href='".route('cashback.cross')."'><i class='fa fa-money fa-fw'></i> Cross Selling VOC</a>
                </li>
            </ul>";
        }*/

        return $html_out;
    }

    public static function get_childs($menu, $parent_id, $level)
    {
        $has_subcats = FALSE;
        $html_out = '';
        $html_out .= "<ul class='nav nav-treeview" . $level . "'>";

        for ($i = 1; $i <= count($menu); $i++) {
            if (is_array($menu[$i])) {
                if ($menu[$i]['show'] && $menu[$i]['parent'] == $parent_id) {    // are we allowed to see this menu?
                 //  dump($menu[$i]);
                    $has_subcats = TRUE;
                    $uri = $menu[$i]['uri'];
                    if ($menu[$i]['is_parent'] == TRUE) {
                        $html_out .= '<li><a href="#">' . $menu[$i]['title'] . '<span class="fa arrow"></span></a>';
                    } else {
                        if($uri=='javascript:void(0)'){
                            $html_out .= '<li class="nav-item "><a href="' . url($uri) . '" id="' . $uri . '" class="nav-link">
                                     <i class="nav-icon fas fa-th"></i> <i class="fas fa-angle-left right"></i></i><p>' . $menu[$i]['title'] . '</p> </a>';
                        }
                        else{
                            $html_out .= '<li class="nav-item "><a href="' . url($uri) . '" id="' . $uri . '" class="nav-link">
                                       <i class="far fa-circle nav-icon "></i><p>' . $menu[$i]['title'] . '</p> </a>';
                        }

                    }
                    $html_out .= self::get_childs($menu, $menu[$i]['id'], "");
                    $html_out .= '</li>';
                }
            }
        }
        $html_out .= '</ul>';
        return ($has_subcats) ? $html_out : FALSE;
    }
}
