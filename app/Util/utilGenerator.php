<?php namespace App\Http\Util;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\Model;
use Carbon\Carbon;
use App\Model\TowerApt;
use DB;
use Illuminate\Support\Facades\Session;

/**
 * Description of utilGenerator
 *
 * @author rizky
 */

class utilGenerator {
    public function InvoiceGenerator($projek,$kodeTransaksi,$errRoute){
        $project_no = \Session::get('dataSession.project_no');
        $countTable = Model\Counter::where('PROJECT_NO_CHAR', '=', $project_no)->first();
        $counter = str_pad($countTable->invoice_count, 4, "0", STR_PAD_LEFT);
        $countTable->invoice_count = $countTable->invoice_count+1;
        $date = Carbon::parse(Carbon::now());
        $monthYear = $date->year.' '.$date->month;

        try{
               $countTable->save();
        } catch (Exception $ex) {
               return redirect()->route($errRoute)->with('errorFailed','Failed update counter table, errmsg : '.$ex);
        }

        return $projek."/".$kodeTransaksi."/".substr($date->year, 2)."/".str_pad($date->month, 2, "0", STR_PAD_LEFT)."/".$counter;
    }

    public function KodeStockUnitGenerator($bookingEntryData){

        $idUnitApt = $bookingEntryData['ID_UNIT_CHAR'];
        $noUnit = $bookingEntryData['KODE_STOK_UNIQUE_ID_CHAR'];
        $floor = $bookingEntryData['FLOOR_APT_INT'];
        $towerCode = TowerApt::where('ID_TOWER_INT','=',$bookingEntryData['ID_TOWER_INT'])->first();
        $kodeStockUnit = $noUnit;
        return $kodeStockUnit;
    }

    public function KodeStockUnitGenerator2($StockUnitApartment){
        $idUnitApt = $StockUnitApartment['ID_UNIT_APARTMENT_INT'];
        $noUnit = $StockUnitApartment['NOUNIT_CHAR'];
        $floor = $StockUnitApartment['FLOOR_INT'];
        $towerCode = TowerApt::where('ID_TOWER_INT','=',$StockUnitApartment['ID_TOWER_INT'])->first();
        $kodeStockUnit = $noUnit;
        return $kodeStockUnit;
    }

    public function KwitansiCicilanGenerator($errRoute){
        $project_no = \Session::get('dataSession.project_no');
        $countTable = Model\Counter::where('PROJECT_NO_CHAR', '=', $project_no)->first();
        $counter = str_pad($countTable->kwt_bc_count, 4, "0", STR_PAD_LEFT);
        $countTable->kwt_bc_count = $countTable->kwt_bc_count+1;
        $date = Carbon::parse(Carbon::now());
        $monthYear = $date->year.' '.$date->month;
        $dataProject = Model\ProjectModel::where('PROJECT_NO_CHAR','=',$project_no)->first();

        try{
               $countTable->save();
        } catch (Exception $ex) {
               return redirect()->route($errRoute)->with('errorFailed','Failed update counter table, errmsg : '.$ex);
        }

        return $counter."/KWT/".$dataProject['PROJECT_CODE']."/BC/".substr($date->year, 2)."/".str_pad($date->month, 2, "0", STR_PAD_LEFT);
    }
    public static function autonumber($field){

        $PROJECT_NO_CHAR=  Session::get('PROJECT_NO_CHAR');
        $prefix= \DB::table('MD_PROJECT')->SELECT('PREFIX_DEBTOR')->where('PROJECT_NO_CHAR',$PROJECT_NO_CHAR)->first();
        $date = Carbon::parse(Carbon::now());
        $q=\DB::table('counter_table')->select(\DB::raw("MAX(RIGHT($field,5)) as kd_max"));

        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%05s", $tmp);
            }
        }
        else
        {
            $kd = 'INV'."000001";
        }

        return  $prefix->PREFIX_DEBTOR."WRD".$date->year."#".$kd;
    }

    public function KwitansiPelunasanGenerator($errRoute){
        $PROJECT_NO_CHAR=  Session::get('PROJECT_NO_CHAR');
        $countTable = Model\Counter::where('PROJECT_NO_CHAR', '=', $PROJECT_NO_CHAR)->first();
        $counter = str_pad($countTable->kwt_bc_count, 4, "0", STR_PAD_LEFT);
        $countTable->kwt_bc_count = $countTable->kwt_bc_count+1;
        $date = Carbon::parse(Carbon::now());
        $monthYear = $date->year.' '.$date->month;
        $dataProject = Model\ProjectModel::where('PROJECT_NO_CHAR','=',$PROJECT_NO_CHAR)->first();

        try{
            $countTable->save();
        } catch (Exception $ex) {
            return redirect()->route($errRoute)->with('errorFailed','Failed update counter table, errmsg : '.$ex);
        }

        return $dataProject['PROJECT_CODE']."/KU/".substr($date->year, 2)."/".str_pad($date->month, 2, "0", STR_PAD_LEFT)."/".$counter;
    }

     public function KwitansiTempCicilanGenerator($errRoute){
        $project_no = \Session::get('dataSession.project_no');
        $countTable = Model\Counter::where('PROJECT_NO_CHAR', '=', $project_no)->first();
        $counter = str_pad($countTable->kwt_bc_count, 4, "0", STR_PAD_LEFT);
        $countTable->kwt_bc_count = $countTable->kwt_bc_count+1;
        $date = Carbon::parse(Carbon::now());
        $monthYear = $date->year.' '.$date->month;
        $dataProject = Model\ProjectModel::where('PROJECT_NO_CHAR','=',$project_no)->first();

        try{
               $countTable->save();
        } catch (Exception $ex) {
               return redirect()->route($errRoute)->with('errorFailed','Failed update counter table, errmsg : '.$ex);
        }

        return $counter."/KWTEMP/".$dataProject['PROJECT_CODE']."/BC/".substr($date->year, 2)."/".str_pad($date->month, 2, "0", STR_PAD_LEFT);
    }

    public function KwitansiDendaGenerator($errRoute){
        $project_no = \Session::get('dataSession.project_no');
        $countTable = Model\Counter::where('PROJECT_NO_CHAR', '=', $project_no)->first();
        $counter = str_pad($countTable->denda_count, 4, "0", STR_PAD_LEFT);
        $countTable->denda_count = $countTable->denda_count+1;
        $date = Carbon::parse(Carbon::now());
        $dataProject = Model\ProjectModel::where('PROJECT_NO_CHAR','=',$project_no)->first();

        try{
               $countTable->save();
        } catch (Exception $ex) {
               return redirect()->route($errRoute)->with('errorFailed','Failed update counter table, errmsg : '.$ex);
        }

        return $counter."/KWT/".$dataProject['PROJECT_CODE']."/DN/".substr($date->year, 2)."/".str_pad($date->month, 2, "0", STR_PAD_LEFT);
    }

    public function InvoiceBlokirGenerator($projek,$kodeTransaksi,$errRoute){
        $project_no = \Session::get('dataSession.project_no');
        $countTable = Model\Counter::where('PROJECT_NO_CHAR', '=', $project_no)->first();
        $counter = str_pad($countTable->invoiced_blokir, 4, "0", STR_PAD_LEFT);
        $countTable->invoiced_blokir = $countTable->invoiced_blokir+1;
        $date = Carbon::parse(Carbon::now());
        //$monthYear = $date->year.' '.$date->month;

        try{
               $countTable->save();
        } catch (Exception $ex) {
               return redirect()->route($errRoute)->with('errorFailed','Failed update counter table, errmsg : '.$ex);
        }

        return $projek."/".$kodeTransaksi."/".substr($date->year, 2)."/".str_pad($date->month, 2, "0", STR_PAD_LEFT)."/".$counter;
    }

    public function KwitansiPaymentBlokirGenerator($errRoute){
        $project_no = \Session::get('dataSession.project_no');
        $countTable = Model\Counter::where('PROJECT_NO_CHAR', '=', $project_no)->first();
        $counter = str_pad($countTable->kwt_blokir_count, 4, "0", STR_PAD_LEFT);
        $countTable->kwt_blokir_count = $countTable->kwt_blokir_count+1;
        $date = Carbon::parse(Carbon::now());
        $monthYear = $date->year.' '.$date->month;
        $dataProject = Model\ProjectModel::where('PROJECT_NO_CHAR','=',$project_no)->first();

        try{
               $countTable->save();
        } catch (Exception $ex) {
               return redirect()->route($errRoute)->with('errorFailed','Failed update counter table, errmsg : '.$ex);
        }

        return $counter."/KWT/".$dataProject['PROJECT_CODE']."/BL/".substr($date->year, 2)."/".str_pad($date->month, 2, "0", STR_PAD_LEFT);
    }

    public function InvoiceBuyBackGenerator($projek,$kodeTransaksi,$errRoute){
        $project_no = \Session::get('dataSession.project_no');
        $countTable = Model\Counter::where('PROJECT_NO_CHAR', '=', $project_no)->first();
        $counter = str_pad($countTable->invoiced_buyback, 4, "0", STR_PAD_LEFT);
        $countTable->invoiced_buyback = $countTable->invoiced_buyback+1;
        $date = Carbon::parse(Carbon::now());
        $monthYear = $date->year.' '.$date->month;

        try{
               $countTable->save();
        } catch (Exception $ex) {
               return redirect()->route($errRoute)->with('errorFailed','Failed update counter table, errmsg : '.$ex);
        }

        return $projek."/".$kodeTransaksi."/".substr($date->year, 2)."/".str_pad($date->month, 2, "0", STR_PAD_LEFT)."/".$counter;
    }

    public function KwitansiPaymentBuyBackGenerator($errRoute){
        $project_no = \Session::get('dataSession.project_no');
        $countTable = Model\Counter::where('PROJECT_NO_CHAR', '=', $project_no)->first();
        $counter = str_pad($countTable->kwt_buyback_count, 4, "0", STR_PAD_LEFT);
        $countTable->kwt_buyback_count = $countTable->kwt_buyback_count+1;
        $date = Carbon::parse(Carbon::now());
        $monthYear = $date->year.' '.$date->month;
        $dataProject = Model\ProjectModel::where('PROJECT_NO_CHAR','=',$project_no)->first();

        try{
               $countTable->save();
        } catch (Exception $ex) {
               return redirect()->route($errRoute)->with('errorFailed','Failed update counter table, errmsg : '.$ex);
        }

        return $counter."/KWT/".$dataProject['PROJECT_CODE']."/BB/".substr($date->year, 2)."/".str_pad($date->month, 2, "0", STR_PAD_LEFT);
    }

    public function JournalGenerator($sourcecode,$module,$errRoute){
        $project_no = Session::get('PROJECT_NO_CHAR');
        $dataProject = Model\ProjectModel::where('PROJECT_NO_CHAR','=',$project_no)->first();
        $countTable = Model\SourceCode::where('ACC_SOURCODE_CHAR','=',$sourcecode)
                                        ->where('PROJECT_NO_CHAR','=',$project_no)
                                        ->first();
        //dd($countTable);
        $counter = str_pad($countTable->ACC_SOURCODE_COUNTER, 4, "0", STR_PAD_LEFT);
        $nilaiCountTable = $countTable->ACC_SOURCODE_COUNTER + 1;
        $date = Carbon::parse(Carbon::now());
        //dd($countTable['ACC_SOURCODE_ID']);
        //$monthYear = $date->year.' '.$date->month;
        Model\SourceCode::where('ACC_SOURCODE_ID','=',$countTable['ACC_SOURCODE_ID'])
                        ->update(['ACC_SOURCODE_COUNTER'=>$nilaiCountTable]);
//        DB::statement("UPDATE ACC_SOURCODE
//                       SET ACC_SOURCODE_COUNTER = ".$nilaiCountTable.""
//                       . " WHERE ACC_SOURCODE_CHAR = '".$sourcecode."' '"
//                       . " AND PROJECT_NO_CHAR = '".$project_no."'");

        //$dataProject['PROJECT_CODE'] . '/' .$countTable['ACC_SOURCODE_CHAR']. '/' . substr($date->year, 2). '/' .str_pad($date->month, 2, "0", STR_PAD_LEFT). '/' . $Counter;

        return $dataProject['PROJECT_CODE'] . '/' .$countTable['ACC_SOURCODE_CHAR'].'/'.$module.'/'. substr($date->year, 2). '/' .str_pad($date->month, 2, "0", STR_PAD_LEFT). '/' . $counter;
    }
    public function JournalutGen($sourcecode,$module,$errRoute){
        $project_no = Session::get('PROJECT_NO_CHAR');
        $dataProject = Model\ProjectModel::where('PROJECT_NO_CHAR','=',$project_no)->first();
        $countTable = Model\SourceCode::where('ACC_SOURCODE_CHAR','=',$sourcecode)
            ->where('PROJECT_NO_CHAR','=',$project_no)
            ->first();
        //dd($countTable);
        $counter = str_pad($countTable->ACC_SOURCODE_COUNTER, 4, "0", STR_PAD_LEFT);
        $nilaiCountTable = $countTable->ACC_SOURCODE_COUNTER + 1;
        $date = Carbon::parse(Carbon::now());
        //dd($countTable['ACC_SOURCODE_ID']);
        //$monthYear = $date->year.' '.$date->month;
//        Model\SourceCode::where('ACC_SOURCODE_ID','=',$countTable['ACC_SOURCODE_ID'])
//            ->update(['ACC_SOURCODE_COUNTER'=>$nilaiCountTable]);
//        DB::statement("UPDATE ACC_SOURCODE
//                       SET ACC_SOURCODE_COUNTER = ".$nilaiCountTable.""
//                       . " WHERE ACC_SOURCODE_CHAR = '".$sourcecode."' '"
//                       . " AND PROJECT_NO_CHAR = '".$project_no."'");

        //$dataProject['PROJECT_CODE'] . '/' .$countTable['ACC_SOURCODE_CHAR']. '/' . substr($date->year, 2). '/' .str_pad($date->month, 2, "0", STR_PAD_LEFT). '/' . $Counter;

        return $dataProject['PROJECT_CODE'] . '/' .$countTable['ACC_SOURCODE_CHAR'].'/'.$module.'/'. substr($date->year, 2). '/' .str_pad($date->month, 2, "0", STR_PAD_LEFT). '/' . $counter;
    }

    public function  JournalCounter($sourcecode,$module,$field,$errRoute){

        $project_no = Session::get('PROJECT_NO_CHAR');
      //  dd($project_no);

        $dataProject = Model\ProjectModel::where('PROJECT_NO_CHAR','=',$project_no)->first();
        $countTable = Model\SourceCode::where('ACC_SOURCODE_CHAR','=',$sourcecode)
            ->where('PROJECT_NO_CHAR','=',$project_no)
            ->first();

        $date = Carbon::parse(Carbon::now());
        $q=\DB::table('counter_table')->select(\DB::raw("MAX(RIGHT($field,5)) as kd_max"));

        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = 'INV'."000001";
        }
        \DB::statement("UPDATE counter_table SET $field=$field+1 WHERE PROJECT_NO_CHAR = $project_no ");
    //   RETURN 'TEST';
        return  $dataProject['PROJECT_CODE'].$countTable['ACC_SOURCODE_CHAR'].$module.substr($date->year, 2).str_pad($date->month, 2, "0", STR_PAD_LEFT). $kd;
    }

}
