<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
// use App\Helpers\QueryHelper; 
// use App\Helpers\UpdKaryawanHelper; 
use App\Http\Requests;
use App\Helpers\AppHelper;
use App\Helpers\AuthHelper; 
use App\Role;
use DB;
use Illuminate\Support\Facades\Auth;
use PDO;

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
        // return view('home');
    }

    public function dataBanner()
    {

        // $dataKapasitas=DB::table('md_tps')->get(); 

        return response()->json(['error' => 'Data Gagal Disimpan']);
    }
    public function dataTender()
    {

        $dataEproc = DB::connection('pgsql')->table('prcmts')
            ->join('prcmt_participants', 'prcmts.id', 'prcmt_participants.prcmt_id')
            ->join('vendors', 'prcmt_participants.vendor_id', 'vendors.id')
            ->join('parties', 'vendors.party_id', 'parties.id')
            ->join('prcmt_docs', 'prcmts.id', 'prcmt_docs.prcmt_id')

            ->select(
                'prcmts.id as id_tender',
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
                'prcmt_docs.created_at as doc_upload'
            )
            ->where('prcmts.number', 'like', '%PLJ%')
            ->where('prcmts.desc', 'like', '%JSEA%')
            ->where('prcmt_participants.state', '=', 'AWARDED')
            ->where('prcmt_docs.name', '=', 'JSEA')
            ->orderBy('prcmts.number', 'desc')
            ->get();
        if (request()->ajax()) {
            return datatables()->of($dataEproc)
                ->addIndexColumn()
                ->addColumn('status_review', 'Permohonan Review')
                ->addColumn('no_jsea', '-')
                ->addColumn('evaluasi_jsea', '-')
                ->addColumn('action', '-')
                ->rawColumns(['action', 'no_jsea', 'status_review'])

                ->make(true);
        }
        // dd($users);
        return $dataEproc;
    }
    public function noSurat(){

        // dd($idAsalLimbah);
        $noSuratUnitKerja=DB::table('md_no_jsea')->first(); 
        
        // $unitKerja=$noSuratUnitKerja->unit_kerja;
        $currMonth=date("m");
        $currYear=date("Y"); 
        $nomor=(int)$noSuratUnitKerja->no_jsea;
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
        $no=sprintf('%03d', $nomor);
       
        $concatFormat=$no."/".numberToRomanRepresentation($currMonth)."/". $currYear;
        $nomor++;
        DB::table('md_no_jsea')->update(['no_jsea' => $nomor]); 
        return  $concatFormat; 
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $username=AuthHelper::getAuthUser()[0]->email;
        
        $no_jsea=$this->noSurat(); 
        $dataTender = array(

            'id_tender'         =>  $request->id_tender,
            'no_pr'             =>  $request->no_pr,
            'no_tender'         =>  $request->number,
            'no_sppj'           =>  $request->no_sppj,
            'no_jsea'           =>  $no_jsea,
            'tgl_sppj'          =>  $request->tender_dibuat,
            'path_file'			=>  $request->file_uid,
            'file_name'         =>  $request->file_name,
            'tgl_upload'        =>  $request->doc_upload,
            'desc_file'         =>  $request->deskripsi_file,
            'id_vendor'         =>  $request->vendor_id,
            'status_vendor'     =>  $request->status_vendor,
            'status_tender'     =>  $request->status_tender,
            'status_review'     =>  $request->status_review,
            'vendor'            =>  $request->nama_vendor,
            'nama_pekerjaan'    =>  $request->name,
            'updated_by'        =>  $username, 
            'tgl_tender'        =>  $request->tender_dibuat,
            'tgl_updtender'     =>  $request->tender_dibuat,
            'created_at'        =>  date('Y-m-d')
           
        ); 
        $insertHeader=DB::table('tr_daftar_jsea')->insertGetId($dataTender,true);

        
        // $dataEvaluasi=array(
        //     'id_tender'           =>  $request->id_tender,
        //     'id_daftar'         =>  $insertHeader
        // );

        $dataStatus=array(
            'id_tender'         =>  $request->id_tender,
            'id_daftar'         =>  $insertHeader,
            'status'            =>  'Permohonan Review',
            'created_by'         =>  $username
        );
        // $insertEvaluasi=DB::table('tr_evaluasi_jsea')->insert($dataEvaluasi); 
        $insertStatus=DB::table('tr_status_jsea')->insert($dataStatus); 
        
    try {
        // UpdtSaldoHelper::updateSaldoNamaLimbah($row['nama_limbah'],$row['jmlhlimbah']);
        return response()->json(['success' => 'Data Berhasil Di Simpan']);
        
    } catch (Exception $e) {
        return response()->json(['error' => 'Data Gagal Disimpan']);
    }
         
    }
}
