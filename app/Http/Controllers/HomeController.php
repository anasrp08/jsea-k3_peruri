<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
// use App\Helpers\QueryHelper; 
// use App\Helpers\UpdKaryawanHelper; 
use App\Http\Requests;
use App\Helpers\AppHelper;
use App\Helpers\AuthHelper;
// use App\Http\Controllers\Collection;
use App\Role;
use Validator;
use Response;
use DB;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PDO;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(DB::table('cemori.tbl_status')->get());
        // dd(Laratrust::hasRole('Pengawas'));
        // if (Laratrust::hasRole('admin') || Laratrust::hasRole('operator')) {

        //     return view('dashboard.dashboard');

        // } else if(Laratrust::hasRole('unit kerja') ) {
        //     // UpdKaryawanHelper::updatePegawai();
        //     // return view('pemohon.create', QueryHelper::getDropDown());
        //     return redirect()->route('pemohon.entri', QueryHelper::getDropDown());
        // }else if(Laratrust::hasRole('pengawas') ) {
        //     // dd('tes');
        //     // UpdKaryawanHelper::updatePegawai();
        //     return redirect()->route('pemohon.listview', QueryHelper::getDropDown());
        //     // return view('pemohon.list', QueryHelper::getDropDown());
        // }
        //    dd($this->dataTender());
        return view('dashboard.dashboard');
    }
    public function dashboardGrafik(Request $request){
// dd($request->period);
        // $date=DateTime::createFromFormat("m/Y", $request->period);
        
        // $year=$date->format('Y');
        $year=$request->period;
        $dataPermintaan=[];
        $dataOnProgress=[];
        $dataFinish=[]; 

        for($i=1;$i<=12;$i++){
            $dataJumlahPermintaan[$i] = DB::table('tr_daftar_jsea') 
                ->whereYear('tr_daftar_jsea.created_at', $year)
                ->whereMonth('tr_daftar_jsea.created_at', $i)->count();

            $dataOnProgressReview[$i] = DB::table('tr_daftar_jsea')
            ->where('status_review', '2')
            ->whereYear('tr_daftar_jsea.created_at', $year)
            ->whereMonth('tr_daftar_jsea.created_at', $i)->count();

            $dataSelesai[$i]= DB::table('tr_daftar_jsea')
            ->where('status_review', '3')
            // ->orWhere('status_review', '4')
            ->whereYear('tr_daftar_jsea.created_at', $year)
            ->whereMonth('tr_daftar_jsea.created_at', $i)->count();
 
            array_push($dataPermintaan,$dataJumlahPermintaan[$i]);
            array_push($dataOnProgress,$dataOnProgressReview[$i]);
            array_push($dataFinish,$dataSelesai[$i]);

        } 
        return response()->json([
            'dataPermintaan'=>$dataPermintaan,
            'dataOnProgress'=>$dataOnProgress,
            'dataSelesai'=>$dataFinish
        ]);
         
    }

    public function dataBanner(Request $request)
    {
        //dari eproc yg blm direview
        $dataEproc = $this->dataFromEproc($request);
        $dataSistem = null;
        $dataSistem = DB::table('tr_daftar_jsea')->get();
        $persenApprove=0;
        $persenEvaluasi=0;
        $persenTerima=0;
        $filteredData = [];
        for ($i = 0; $i < $dataSistem->count(); $i++) {
            $key = $dataEproc->search(function ($item) use ($dataSistem, $i) {
                return $item->idtender == $dataSistem[$i]->id_tender;
            });
            $dataEproc->pull($key);
        }
        $dataBlmReview=$dataEproc->count();
         
        
        //jumlah seluruh permintaan bulan inipengadaan permintaan ke k3
        $dataJumlahPermintaan = DB::table('tr_daftar_jsea')->count();
        //pemintaan review ke k3
        $dataOpenPermintaan = DB::table('tr_daftar_jsea')->where('status_review', '1')->count();
        //form yg masih disave
        $dataOnProgressReview = DB::table('tr_daftar_jsea')->where('status_review', '2')->count();
        //form yg diterima
        $dataApprove = DB::table('tr_daftar_jsea')->where('status_review', '3')->count();
        //form yang ada evaluasi
        $dataEvaluasi = DB::table('tr_daftar_jsea')->where('status_review', '4')->count();
        //review yang diterima oleh pengadaan
        $dataDiterima = DB::table('tr_daftar_jsea')->where('status_review', '6')->count();

        if($dataJumlahPermintaan==0){

        }else{
            $persenApprove=(int)$dataDiterima/(int)$dataJumlahPermintaan *  100;
            $persenEvaluasi=(int)$dataEvaluasi/(int)$dataJumlahPermintaan *  100;
            $persenTerima=(int)$dataDiterima/(int)$dataJumlahPermintaan *  100;

        }
        
       

        return response()->json([
            'dataBlmReview' => $dataBlmReview,
            'dataPermintaan' => $dataJumlahPermintaan, 
            'dataOnProgressReview' => $dataOnProgressReview,
            'dataApprove' => $dataApprove,
            'dataEvaluasi' => $dataEvaluasi,
            'dataDiterima' => $dataDiterima, 
            'dataOpenPermintaan' => $dataOpenPermintaan, 
            'persenApprove' => $persenApprove, 
            'persenEvaluasi' => $persenEvaluasi, 
            'persenTerima' => $persenTerima, 
        ]);
    }
    public static function dataFromEproc($request)
    {
        $dataEproc = DB::connection('pgsql')->table('prcmts')
            ->join('prcmt_participants', 'prcmts.id', 'prcmt_participants.prcmt_id')
            ->join('vendors', 'prcmt_participants.vendor_id', 'vendors.id')
            ->join('parties', 'vendors.party_id', 'parties.id')
            ->join('prcmt_docs', 'prcmts.id', 'prcmt_docs.prcmt_id')
            ->join('prcmt_items', 'prcmts.id', 'prcmt_items.prcmt_id')
            ->join('purch_reqn_items', 'purch_reqn_items.id','prcmt_items.purch_reqn_item_id')
            ->join('purch_reqns', 'purch_reqns.id','purch_reqn_items.purch_reqn_id' )
            // ->join('mysql.tr_daftar_jsea as db2', 'db2.id_tender', 'prcmts.id')

            ->select(
                'prcmts.id as idtender',
                'prcmts.number',
                'prcmts.name',
                // 'prcmts.desc',
                'prcmts.state as status_tender',
                'prcmts.created_at as tender_dibuat',
                'prcmts.updated_at as tender_update',
                'prcmt_participants.created_at as participant_dibuat',
                'prcmt_participants.updated_at as participant_diupdate',
                'prcmt_participants.state as status_vendor',
                'parties.full_name as nama_vendor',

                'vendors.id as vendor_id',
                'prcmt_docs.name as tipe_file',
                'prcmt_docs.file_uid',
                'prcmt_docs.file_name',
                'prcmt_docs.desc as deskripsi_file',
                'prcmt_docs.created_at as doc_upload',
                'purch_reqns.number as no_sppj'
                // 'db2.status_review'
            )
            ->where('prcmts.number', 'like', '%PLJ%')
            ->where('prcmts.desc', 'like', '%JSEA%')
            ->where('prcmt_participants.state', '=', 'AWARDED')
            ->where('prcmt_docs.name', '=', 'JSEA')
            ->whereYear('prcmt_docs.created_at', '=', $request->tahun)
            ->orderBy('prcmts.created_at', 'desc')


            ->get();
        collect($dataEproc);
        // foreach($dataEproc as $row){ 
        $dataEproc->map(function ($item) {
            $item->status_review = '-';
            $item->no_jsea = '-';
            $item->evaluasi_jsea = '-';
            $item->status_review = '-'; 
        });

        return $dataEproc;
    }
    public function dataTender(Request $request)
    {

        $dataEproc = $this->dataFromEproc($request); 

        $dataSistem = null;
        $dataSistem = DB::table('tr_daftar_jsea')->get();
        $filteredData = [];
        for ($i = 0; $i < $dataSistem->count(); $i++) {
            $key = $dataEproc->search(function ($item) use ($dataSistem, $i) {
                return $item->idtender == $dataSistem[$i]->id_tender;
            });
            $dataEproc->pull($key);
        }

        // $c = $c->filter(function($item) {
        //     return $item->id != 2;
        // });

        // dd($dataEproc);

        // $merged = $dataSistem->merge($dataEproc);  
        // $merged1 = $merged->filter(function ($item) {
        //     return data_get($item, 'status_review') === "-";
        // })->values();
        // dd($merged);


        if (request()->ajax()) {
            return datatables()->of($dataEproc)
                ->addIndexColumn()
                // ->addColumn('status_review', 'Permohonan Review')
                // ->addColumn('no_jsea', '-')
                // ->addColumn('evaluasi_jsea', '-')
                // ->addColumn('action', '-')
                // ->rawColumns(['action', 'no_jsea', 'status_review'])

                ->make(true);
        }
        // dd($users);
        return $dataEproc;
    }
    public function noSurat()
    {

        // dd($idAsalLimbah);
        $noSuratUnitKerja = DB::table('md_no_jsea')->first();

        // $unitKerja=$noSuratUnitKerja->unit_kerja;
        $currMonth = date("m");
        $currYear = date("Y");
        $nomor = (int)$noSuratUnitKerja->no_jsea;
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

        $concatFormat = $no . "/" . "JSEA/" . numberToRomanRepresentation($currMonth) . "/" . $currYear;
        $nomor++;
        DB::table('md_no_jsea')->update(['no_jsea' => $nomor]);
        return  $concatFormat;
    }
    public function store(Request $request)
    {
        $username = AuthHelper::getAuthUser()[0]->email;
        $data = json_decode($request->data);
        $rules = array(

            'file_jsea'        =>  'required|max:10048',
        );
        $messages = array(

            'file_jsea.required'       => 'File JSEA harus diisi Harus Diisi',

            'required' => 'form :attribute harus diisi.',
            'same'    => 'The :attribute and :other must match.',
            'max'    => 'file :attribute terlalu besar max :max Kb.',
            'between' => 'The :attribute must be between :min - :max.',
            'in'      => 'The :attribute must be one of the following types: :values',

        );

        // $error = Validator::make($data->all(), $rules, $messages);
        // if ($error->fails()) {
        //     return response()->json(['errors' => $error->errors()->all()]);
        // }

        $no_jsea = $this->noSurat();
        $path_file = AppHelper::pathFile('File Jsea', date('Y'));

        $pathToDB = null;
        if ($request->hasFile('file_jsea')) {
            if (!File::exists($path_file)) {
                File::makeDirectory($path_file, $mode = 0777, true, true);
            }
            $upload_file = $request->file('file_jsea');

            // $extension=$upload_file->getClientOriginalName(); 
            $filename_jsea = $upload_file->getClientOriginalName();
            $upload_file->move($path_file, $filename_jsea);
            $pathToDB = AppHelper::savePath('File Jsea', date('Y'), $filename_jsea);
        }

        $dataTender = array(

            'id_tender'         =>  $data->idtender,
            'no_pr'             =>  $data->no_sppj,
            'no_tender'         =>  $data->number,
            'no_sppj'           =>  $data->no_sppj,
            'no_jsea'           =>  $no_jsea,
            'tgl_sppj'          =>  $data->tender_dibuat,
            'path_file'         =>  $pathToDB,
            'file_name'         =>  $data->file_name,
            'tgl_upload'        =>  $data->doc_upload,
            'desc_file'         =>  $data->deskripsi_file,
            'id_vendor'         =>  $data->vendor_id,
            'status_vendor'     =>  $data->status_vendor,
            'status_tender'     =>  $data->status_tender,
            'status_review'     =>  '1',
            'vendor'            =>  $data->nama_vendor,
            'nama_pekerjaan'    =>  $data->name,
            'updated_by'        =>  $username,
            'tgl_tender'        =>  $data->tender_dibuat,
            'tgl_updtender'     =>  $data->tender_dibuat,
            'tgl_review'         =>  null,
            'created_at'        =>  date('Y-m-d')
            

        );
        $insertHeader = DB::table('tr_daftar_jsea')->insertGetId($dataTender, true);


        // $dataEvaluasi=array(
        //     'id_tender'           =>  $request->id_tender,
        //     'id_daftar'         =>  $insertHeader
        // );

        $dataStatus = array(
            'id_tender'         =>  $data->idtender,
            'id_daftar'         =>  $insertHeader,
            'status'            =>  '1',
            'created_by'         =>  $username
        );
        // $insertEvaluasi=DB::table('tr_evaluasi_jsea')->insert($dataEvaluasi); 
        $insertStatus = DB::table('tr_status_jsea')->insert($dataStatus);

        try {
            // UpdtSaldoHelper::updateSaldoNamaLimbah($row['nama_limbah'],$row['jmlhlimbah']);
            return response()->json(['success' => 'Data Berhasil Di Simpan','id_tender_db'=>$insertHeader]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Data Gagal Disimpan']);
        }
    }
}
