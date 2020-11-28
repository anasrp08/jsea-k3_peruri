<?php

namespace App\Http\Controllers;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\JseaEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; 
use App\Helpers\AppHelper; 
use App\Helpers\QueryHelper; 
use App\Helpers\UpdtSaldoHelper; 
use App\Helpers\AuthHelper;
use App\Mail\JseaMail;
use Redirect;
use Validator;
use Response;
use DB;
// use File;
use PDF;
 

class JseaMailController extends Controller
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
   
    public function index(Request $request)
    {
       //single send
    //    $id='1';
    //    dd($request->all());
        $dataTender=DB::table('tr_daftar_jsea')->where('id',$request->id_tender)
        ->where('no_tender',$request->no_tender)
        ->select('tr_daftar_jsea.id','tr_daftar_jsea.no_sppj',
        'tr_daftar_jsea.no_tender','tr_daftar_jsea.no_jsea',
        'tr_daftar_jsea.vendor',
        'tr_daftar_jsea.nama_pekerjaan',
        'tr_daftar_jsea.created_at')
        ->get(); 
        // dd($dataTender);
        $dataRecipient=DB::table('md_email')->where('keterangan',$request->unit_kerja)->get(); 
        // dd($dataRecipient);
        $contactList = [];
        $i=0;

        // foreach($dataRecipient as $contact){
        //       $contactList[$i] = $contact->email;
        //       $i++;
        //     }

        // Mail::to("anasrp08@gmail.com")->send(new JseaMail($dataTender,$dataRecipient));
        for($j=0;$j<$dataRecipient->count();$j++){ 
            Mail::to($dataRecipient[$j]->email)->send(new JseaMail($dataTender,$dataRecipient[$j],$request->unit_kerja));
        }
        // foreach ( $contactList as $recipient) {
        //     Mail::to($recipient)->send(new JseaMail($dataTender,$dataRecipient));
        // }
        return response()->json(['success' => 'Berhasil Dikirim']);
 
        // return "Email telah dikirim";

        // $contacts = DB::table('md_email')
        //             ->get();

        //             // Create an array element
        //             $contactList = [];
        //             $i=0;


        //akan dipakai
        // $emails = ['anasrp08@gmail.com', 'anasrp04@gmail.com','ti2018peruri@gmail.com'];

        // foreach ( $emails as $recipient) {
        //     Mail::to($recipient)->send(new JseaMail());
        // }

        // return "Email telah dikirim";


// versi1
// Mail::send(new JseaMail(), [], function($message) use ($emails)
// {    
//     $message->from('myemail@somecompany.com', 'Some Company Name')
//                   ->replyTo($emailReply, $nameReply)
//                   ->bcc($contactList, 'Contact List')
//                   ->subject("Subject title");
//     // $message->to($emails)->subject('This is test e-mail');    
// }); 


// versi2
//   // Get data from Database
//   $contacts = Contacts::select('email')
//   ->get();

// // Create an array element
// $contactList = [];
// $i=0;

// // Fill the array element
// foreach($contacts as $contact){
//   $contactList[$i] = $contact->email;
//   $i++;
// }

// .
// .
// .

// \Mail::send('emails.template', ['templateTitle'=>$templateTitle, 'templateMessage'=>$templateMessage, 'templateSalutation'=>$templateSalutation, 'templateCopyright'=>$templateCopyright], function($message) use($emailReply, $nameReply, $contactList) {
//       $message->from('myemail@somecompany.com', 'Some Company Name')
//               ->replyTo($emailReply, $nameReply)
//               ->bcc($contactList, 'Contact List')
//               ->subject("Subject title");
//   });
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
     
    public function store(Request $request)
    {
  
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
