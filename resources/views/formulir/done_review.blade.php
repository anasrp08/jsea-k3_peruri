
<style type="text/css">
    .table1 {
            border: 2px solid black;
            text-align: center;
            /* border-collapse: collapse; */
        }
        td.no {
            font-size: 12pt;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 5px;
            /* border: 1px solid black; */
            border-right-style: solid;
            border-bottom-style: inset;
            border-top-style: inset;
            border-right-width: thin;
            border-left-style: inset;
            border-right-width: thin;
            text-align: center;
        }
</style>

<h3>Dear, {{ $dataRecipient->nama }}</h3> 
<p>Review Form JSEA tender berikut selesai dilakukan </p>
Klik link berikut untuk melihat detail: <a href="http://localhost:8000/evaluasi/detail_tender/{{$dataTender->id}}" ><b>Detail Form JSEA</b></a>
<table class="table1" style="width: 100%;">

    <tr>

        <td class="no">No. Tender</td>
        <td class="no"> {{ $dataTender->no_tender }} </td> 
    </tr>
    <tr>
        <td class="no">Pekerjaan</td> 
        <td class="no"> {{ $dataTender->nama_pekerjaan}} </td> 
    </tr>
    <tr>
        <td class="no">No. SPPJ</td> 
        <td class="no"> {{ $dataTender->no_sppj }} </td> 
    </tr>
    <tr>
        <td class="no">No. JSEA</td> 
        <td class="no"> {{ $dataTender->no_jsea }} </td> 
    </tr>
    <tr>
        <td class="no">Vendor</td> 
        <td class="no"> {{ $dataTender->vendor }} </td> 
    </tr>
    <tr>
        <td class="no">Tgl. Kirim</td> 
        <td class="no"> {{ date('d-M-y', strtotime($dataTender->created_at )) }} </td> 
    </tr>

</table> 


