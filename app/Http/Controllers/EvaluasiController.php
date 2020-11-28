<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Helpers\AppHelper;
use App\Helpers\QueryHelper;
use App\Helpers\UpdtSaldoHelper;
use App\Helpers\AuthHelper;


use Redirect;
use Validator;
use Response;
use DB;
// use File;
use PDF;
use PDO;

class EvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function dataTender($status)
    {
        $queryData = DB::table('tr_daftar_jsea')
            ->join('md_status', 'tr_daftar_jsea.status_review', 'md_status.id')
            // ->join('tr_evaluasi_jsea', 'tr_evaluasi_jsea.id_daftar', 'tr_daftar_jsea.id')
            // ->whereIn('tr_daftar_jsea.status_review', ['1', '2','3', '4', '2'])
            ->select(
                'tr_daftar_jsea.id_tender',
                'tr_daftar_jsea.id',
                'tr_daftar_jsea.no_tender',
                'tr_daftar_jsea.no_jsea',
                'tr_daftar_jsea.no_sppj',
                'tr_daftar_jsea.nama_pekerjaan',
                'tr_daftar_jsea.tgl_tender',
                'tr_daftar_jsea.tgl_updtender',
                'tr_daftar_jsea.vendor',
                'tr_daftar_jsea.status_tender',
                'md_status.status',
                'tr_daftar_jsea.status_review',
                'tr_daftar_jsea.path_file',
                'tr_daftar_jsea.tgl_review'
            )
            // ->where('tr_daftar_jsea.status_review', '3') 
            ->orderBy('tr_daftar_jsea.created_at', 'desc');
        return $queryData;
    }
    public function viewDetalEvaluasi($id)
    { 
        
        $queryData = DB::table('tr_daftar_jsea') 
        ->where('tr_daftar_jsea.id',$id)
        ->first(); 
        $statusReview=$queryData->status_review;
        if(AuthHelper::getAuthUser()[0]->role_id == 2){
            if( $statusReview == 3 ||  $statusReview == 4){
                $queryData = DB::table('tr_daftar_jsea') 
            ->where('tr_daftar_jsea.id',$id)
            ->update(['status_review'=>'6']);  
            $queryData = DB::table('tr_status_jsea') 
            ->where('tr_status_jsea.id',$id)
            ->update(['status'=>'6']);  
            }
        }
        
        

        // dd($queryData);
        return view('history.detail_jsea', [
            'id_tender_db' => $id,
            
            

        ]);
    }
    public static function getDataTender(Request $request){

        // dd($request->all());
        $queryData = DB::table('tr_daftar_jsea')
        ->join('md_status', 'tr_daftar_jsea.status_review', 'md_status.id')
        ->select('tr_daftar_jsea.*','md_status.status')
        ->where('tr_daftar_jsea.id',$request->id_tender_db)
        ->first(); 

        $dataEvaluasi = DB::table('tr_evaluasi_jsea') 
        ->where('tr_evaluasi_jsea.id_daftar',$request->id_tender_db)
        ->get(); 
        return response()->json([
            'dataDetail'=>$queryData,
            'dataEvaluasi'=>$dataEvaluasi]);
    }
    function convertDate($date){
        if($date == null){
            return "-";
        }else{
            $date=DateTime::createFromFormat("d/m/Y", $date);
            $date= $date->format('Y/m/d');
            return $date;
        }
        
        
    }
    public function index(Request $request)
    {
        $dataUser = AuthHelper::getAuthUser()[0];
        // dd($username);
        $queryData = null;
        if (request()->ajax()) {
            if ($dataUser->display_name == 'Pengadaan') {
                $queryData = $this->dataTender(['3', '4']);
            } else {
                $queryData = $this->dataTender(['1', '2']);
            }

            if(!empty($request->tender_date)){

                // $splitDate2=explode(" - ",$request->tglinput);
                $queryData->where('tr_daftar_jsea.tgl_tender',array(  AppHelper::convertDateYmd($request->tender_date)));

            } 
            if(!empty($request->review_date)){

                $splitDate=explode(" - ",$request->review_date);
                $queryData->whereBetween('tr_daftar_jsea.tgl_review',array( $this->convertDate($splitDate[0]), $this->convertDate($splitDate[1])));
            }
            // if(!empty($request->review_date)){

            //     // $splitDate2=explode(" - ",$request->tglinput);
            //     $queryData->where('tr_daftar_jsea.updated_at',array(  AppHelper::convertDateYmd($request->review_date)));

            // } 
             
			
            $queryData=$queryData->get(); 
 
            //  dd( $queryData);   
            return datatables()->of($queryData)
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('notender'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains(Str::lower($row['no_tender']),Str::lower($request->get('notender'))) ? true : false;
                        });
                    }
                    if(!empty($request->get('nosppj'))){
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains(Str::lower($row['no_sppj']), Str::lower($request->get('nosppj'))) ? true : false;
                        });
                    }

                    if(!empty($request->get('nojsea'))){
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['no_jsea'], $request->get('nojsea')) ? true : false;
                        });
                    } 
                    if(!empty($request->get('status'))){
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['status_review'], $request->get('status')) ? true : false;
                        });
                    }
                   
                })
                ->addIndexColumn()
                // ->addColumn('action', 'action_butt_pemohon')
                // ->rawColumns(['action'])

                ->make(true);
        }
        return view('history.list', []);
    }
    public function viewEntri()

    {

        $dataStatus=DB::table('md_status')->get();
        $getUser=AuthHelper::getAuthUser()[0];
        // dd($getUser);    

        return view('history.list',[
            'dataStatus'=>$dataStatus,
            'dataUser1' => $getUser
        ]);
    }
    public function viewEvaluasi($id)
    {

        $dataEvaluasi = DB::table('tr_evaluasi_jsea')->where('id_daftar', $id)->get();


        if ($dataEvaluasi->count() > 0) {
            return view('history.updt_evaluasi', [
                'id_tender_db' => $id,
                'dataEvaluasi' => $dataEvaluasi

            ]);
        } else {
            return view('history.evaluasi', [
                'id_tender_db' => $id

            ]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function noSurat($idAsalLimbah)
    {

        $noSuratUnitKerja = DB::table('md_nosurat')->where('unit_kerja', $idAsalLimbah)->first();

        $unitKerja = $noSuratUnitKerja->unit_kerja;
        $currMonth = date("m");
        $currYear = date("Y");
        $nomor = (int)$noSuratUnitKerja->no;
        function numberToRomanRepresentation($number)
        {

            $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
            $returnValue = '';
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if ($number >= $int) {
                        $number -= $int;
                        $returnValue .= $roman;
                        break;
                    }
                }
            }
            return $returnValue;
        }
        $no = sprintf('%03d', $nomor);

        $concatFormat = $no . "/" . $unitKerja . "/" . numberToRomanRepresentation($currMonth) . "/" . $currYear;
        $nomor++;
        DB::table('md_nosurat')->update(['no' => $nomor]);
        return  $concatFormat;
    }
    public static function prepareData($request)
    {
        function isEmpty($dataRequest)
        {

            if ($dataRequest == '') {
                $dataRequest = '-';
            }
            return $dataRequest;
        }
        $arrData = [];
        $dataPelaksana = array(
            'data' => isEmpty($request->pelaksanaan),
            'kategori' => '1'
        );
        $dataPelindung = array(
            'data' => isEmpty($request->pelindung),
            'kategori' => '2'
        );
        $dataPeralatan = array(
            'data' => isEmpty($request->peralatan),
            'kategori' => '3'
        );
        $dataBahan = array(
            'data' => isEmpty($request->bahan),
            'kategori' => '4'
        );
        $dataUrutan = array(
            'data' => isEmpty($request->urutan),
            'kategori' => '5'
        );
        $dataBahaya = array(
            'data' => isEmpty($request->bahaya),
            'kategori' => '6'
        );
        $dataPengendalian = array(
            'data' => isEmpty($request->pengendalian),
            'kategori' => '7'
        );

        array_push($arrData, $dataPelaksana);
        array_push($arrData, $dataPelindung);
        array_push($arrData, $dataPeralatan);
        array_push($arrData, $dataBahan);
        array_push($arrData, $dataUrutan);
        array_push($arrData, $dataBahaya);
        array_push($arrData, $dataPengendalian);

        // dd($arrData);
        return  $arrData;
    }
     
    public function store(Request $request)
    {
        $arrData = $this->prepareData($request);
        $username = AuthHelper::getAuthUser()[0]->email;
        $dataTender = DB::table('tr_daftar_jsea')->where('id', $request->id_tender_db)->first();
        // dd($request->all());
        if ($request->action == 'save') {

            try {
                for ($i = 0; $i < count($arrData); $i++) {

                    $dataEvaluasi = array(
                        'id_tender'         =>  $dataTender->id_tender,
                        'id_daftar'         =>  $request->id_tender_db,
                        'catatan'           =>  $arrData[$i]['data'],
                        'kriteria'            =>  $arrData[$i]['kategori'],
                        'status'            =>  '2',
                        'np'                =>  $request->np,
                        'created_by'            => $request->nama_pegawai,
                        'created_at'            => date('Y-m-d')

                    );
                    $insertEvaluasi = DB::table('tr_evaluasi_jsea')->insert($dataEvaluasi);
                }
                $this->updateStatus($request,'2');
                return response()->json(['success' => 'Data Berhasil Di Simpan']);
            } catch (Exception $e) {
                return response()->json(['error' => 'Data Gagal Disimpan']);
            }
        } else if ($request->action == 'update_save') { 
            try { 
                for ($i = 0; $i < count($arrData); $i++) { 
                    $dataEvaluasi = array(
                        'id_tender'         =>  $dataTender->id_tender,
                        'id_daftar'         =>  $request->id_tender_db,
                        'catatan'           =>  $arrData[$i]['data'],
                        'kriteria'          =>  $arrData[$i]['kategori'],
                        'status'            =>  '2',
                        'np'                =>  $request->np,
                        'created_by'        => $request->nama_pegawai,
                        'created_at'        => date('Y-m-d')

                    );
                    $data=DB::table('tr_evaluasi_jsea')
                    ->where('kriteria', $arrData[$i]['kategori'])
                    ->where('id_daftar', $request->id_tender_db)
                    ->where('id_tender', $dataTender->id_tender)
                    ->update($dataEvaluasi);
 
                }
                $this->updateStatus($request,'2');
                
                return response()->json(['success' => 'Data Berhasil Di Simpan']);
            } catch (Exception $e) {
                return response()->json(['error' => 'Data Gagal Disimpan']);
            }
        }
 
        
    }
    public function updateEvaluasi(Request $request)
    {

        $username = AuthHelper::getAuthUser()[0]->email;
        $dataTender = DB::table('tr_daftar_jsea')->where('id', $request->id_tender_db)->first();
        $arrData = $this->prepareData($request);
        try {
            for ($i = 0; $i < count($arrData); $i++) {

                $dataEvaluasi = array(
                    'id_tender'         =>  $dataTender->id_tender,
                    'id_daftar'         =>  $request->id_tender_db,
                    'catatan'           =>  $arrData[$i]['data'],
                    'kriteria'            =>  $arrData[$i]['kategori'],
                    'status'            =>  '3',
                    'np'                =>  $request->np,
                    'created_by'            => $request->nama_pegawai,
                    'created_at'            => date('Y-m-d')

                );
                $insertEvaluasi = DB::table('tr_evaluasi_jsea')
                    ->where('id_daftar', $request->id_tender_db)
                    ->where('kriteria', $arrData[$i]['kategori'])
                    ->update($dataEvaluasi);
            }

            return response()->json(['success' => 'Data Berhasil Di Simpan']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Data Gagal Disimpan']);
        }
    }
    public function updateDiterima(Request $request)
    { 
        // dd($request->all());
        try {

            $dataTender = DB::table('tr_daftar_jsea')->where('id', $request->id_tender_db)->first();
            $dataEvaluasi = array(
                'id_tender'         =>  $dataTender->id_tender,
                'id_daftar'         =>  $request->id_tender_db,
                'catatan'           =>  '-',
                'kriteria'          =>  '-',
                'status'            =>  '3',
                'np'                =>  $request->np,
                'created_by'        =>  $request->nama_pegawai,
                'created_at'        =>  date('Y-m-d')

            ); 
            $insertEvaluasi = DB::table('tr_evaluasi_jsea')
            ->insert($dataEvaluasi);
            $this->updateStatus($request,'3'); 
            return response()->json(['success' => 'Data Berhasil Di Simpan']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Data Gagal Disimpan']);
        }
    }
    public static function updateStatus($request,$status)
    {
        $dataStatus = array(
            'status'            =>  $status,
            'updated_at'            => date('Y-m-d')
        );
        $dataStatusHeader = array(
            'status_review'            =>  $status,
            'updated_at'            => date('Y-m-d')
        );

        $insertStatus = DB::table('tr_status_jsea')->where('id', $request->id_tender_db)->update($dataStatus);
        $statusHeader = DB::table('tr_daftar_jsea')->where('id', $request->id_tender_db)->update($dataStatusHeader);
    }
    public function updatePosting(Request $request)
    {
        if ($request->action == 'posting') {
            $dataTender = DB::table('tr_daftar_jsea')->where('id', $request->id_tender_db)->first();
            $arrData = $this->prepareData($request);
            try {
                for ($i = 0; $i < count($arrData); $i++) {

                    $dataEvaluasi = array(
                        'id_tender'         =>  $dataTender->id_tender,
                        'id_daftar'         =>  $request->id_tender_db,
                        'catatan'           =>  $arrData[$i]['data'],
                        'kriteria'            =>  $arrData[$i]['kategori'],
                        'status'            =>  '4',
                        'np'                =>  $request->np,
                        'created_by'            => $request->nama_pegawai,
                        'created_at'            => date('Y-m-d')

                    );
                    $insertEvaluasi = DB::table('tr_evaluasi_jsea')
                        ->insert($dataEvaluasi);
                }
                $this->updateStatus($request,'4');


                return response()->json(['success' => 'Data Berhasil Di Simpan']);
            } catch (Exception $e) {
                return response()->json(['error' => 'Data Gagal Disimpan']);
            }
        } else {
            $dataTender = DB::table('tr_daftar_jsea')->where('id', $request->id_tender_db)->first();
            $arrData = $this->prepareData($request);
            try {
                for ($i = 0; $i < count($arrData); $i++) {

                    $dataEvaluasi = array(
                        'id_tender'         =>  $dataTender->id_tender,
                        'id_daftar'         =>  $request->id_tender_db,
                        'catatan'           =>  $arrData[$i]['data'],
                        'kriteria'            =>  $arrData[$i]['kategori'],
                        'status'            =>  '4',
                        'np'                =>  $request->np,
                        'created_by'            => $request->nama_pegawai,
                        'created_at'            => date('Y-m-d')

                    );
                    $insertEvaluasi = DB::table('tr_evaluasi_jsea')
                        ->where('id_daftar', $request->id_tender_db)
                        ->where('kriteria', $arrData[$i]['kategori'])
                        ->update($dataEvaluasi);
                }
                $this->updateStatus($request,'4');



                return response()->json(['success' => 'Data Berhasil Di Simpan']);
            } catch (Exception $e) {
                return response()->json(['error' => 'Data Gagal Disimpan']);
            }
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    public function showEvaluasi(Request $request)
    {
        // 
        if (request()->ajax()) {

            $queryData = DB::table('tr_evaluasi_jsea')
                ->join('md_kriteria', 'tr_evaluasi_jsea.kriteria', 'md_kriteria.id')
                ->select('tr_evaluasi_jsea.*', 'md_kriteria.status')
                ->where('id_daftar', $request->id_tender_db)->get();
            return datatables()->of($queryData)

                ->addIndexColumn()
                ->make(true);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
