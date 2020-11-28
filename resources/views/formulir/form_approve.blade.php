<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> </title>
</head>

<body>
    <style type="text/css">
        .page-break {
            page-break-after: avoid;
            /* page-break-inside: avoid; */
        }

        table.center {
            margin-left: auto;
            margin-right: auto;
        }

        .table1 {
            border: 2px solid black;
            text-align: center;
            border-collapse: collapse;
        }

        table tr td,
        table tr th {
            font-size: 12pt;

        }

        td.tblbawah {
            border: 2px solid black;
            text-align: center;
            padding: 10px;
            width: 120px;
        }

        div.a {
            text-indent: 30px;
        }

        td.logokanan {
            text-align: right;
            align-content: right;
            padding-left: 50px;
            padding-right: 20px;

        }

        td.logokiri {
            text-align: left;
            align-content: left;
            padding-right: 50px;
            /* padding-left: ; */
        }

        td.header {
            font-size: 20pt;
            text-align: center;
            font-weight: bold;

        }

        td.titlecenter {
            font-size: 40pt;
            text-align: center;
            font-weight: bold;

            border: 4px solid #000000;
        }

        td.headerow2left {
            font-size: 12pt;
            text-align: left;
            /* padding-right: 10px;  */
            /* border:2px solid black; */
            /* border: 1px solid black; */
            /* margin-left: 10rem; */

        }

        td.headerow2right {
            font-size: 12pt;
            text-align: left;

            /* padding: 10px; */
        }

        td.headerow2right1 {
            font-size: 12pt;
            text-align: right;
            /* padding: 10px; */
            /* padding-left: 200px; */
            /* border: 1px solid black; */
        }

        td.ttnama {
            font-size: 12pt;
            text-align: right;

            /* padding: 10px; */
            /* padding-left: 200px; */
            /* border: 1px solid black; */
        }


        td.headerow3left {
            font-size: 12pt;
            text-align: left;
            padding-bottom: 10px;
        }

        td.headerow3center {
            font-size: 12pt;
            text-align: left;
            /* padding-bottom: 5px; */
            /* border: 1px solid black; */
        }

        td.headerow3right {
            font-size: 12pt;
            text-align: left;
            padding-bottom: 10px;
        }

        /* garis header */
        hr.new1 {
            border: 1px solid black;
        }

        /* table hasil uji */
        table.hasiluji,
        th.headeruji,
        td.itemuji {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th.headeruji,
        td.itemuji {
            font-size: 12pt;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 5px;
            text-align: center;
        }

        td.namalimbah {
            font-size: 10pt;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            /* padding-right: 5px; */
            border-bottom-style: inset;
            border-top-style: inset;
            border-left-style: inset;
            border-right-style: inset;
            text-align: left;
        }

        td.catatan1 {
            font-size: 10pt;
            border-bottom-style: inset;
            border-top-style: inset;
            border-right-style: solid;
            border-right-width: thin;
            border-left-style: solid;
            border-left-width: thin;
            text-align: left;
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

        td.keterangan {
            font-size: 12pt;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 5px;
            /* border: 1px solid black; */
            border-right-style: solid;
            border-right-width: thin;

            text-align: center;
        }


        td.ttdbottom {
            font-size: 12pt;
            /* padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
            padding-right: 10px; */
            text-align: left;
            /* border: 1px solid black;
            border-collapse: collapse; */
        }

        td.tblbawah1 {
            border: 2px solid black;
            text-align: center;
            padding: 10px;
            width: 100px;
        }

        td.row3 {
            text-align: justify;
            padding-top: 20px;
            padding-bottom: 10px;

            /* padding: 10px; */

        }

        td.rincian {
            text-align: justify;
            padding-top: 20px;
            padding-bottom: 10px;

            /* padding: 10px; */

        }

        td.row3right {
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
            font-weight: bold;
            /* padding: 10px; */

        }

        td.row2 {
            font-size: 20pt;
            text-align: center;
            font-weight: bold;

        }

        td.row6 {
            font-size: 12pt;
            text-align: right;
            margin-top: 2px;
            /* font-weight: bold; */
            /* vertical-align: baseline; */

        }

        th.ttd {
            font-size: 12pt;
            text-align: center;
            padding-bottom: 100px;
            border: 1px solid black;
            border-collapse: collapse;
            /* font-weight: bold; */
            /* vertical-align: baseline; */

        }

        div.bg-image {
            background-image: url(/img/perurilogo.jpg);
            background-position: center;
            background-size: cover;
        }

        .background {
            position: absolute;
            z-index: 0;
            background: white;
            display: block;
            min-height: 50%;
            min-width: 50%;
            color: yellow;
        }

        .background1 {
            position: absolute;
            z-index: 0;
            background: white;
            display: block;
            color: yellow;
        }


        #bg-text {
            color: lightgrey;
            font-size: 120px;
            transform: rotate(300deg);
            -webkit-transform: rotate(300deg);
        }

        #content {
            position: absolute;
            z-index: 1;
        }

        p.mohon {
            text-indent: 100px;
            font-size: 12pt;
            /* padding: 10px; */
            /* border: 2px solid black; */
        }

    </style>

    <div id="background">
        <img class='background' src="{{ public_path('/img/perurilogo.jpg') }}" alt="AdminLTE Logo" width="700px"
            height="700px" style="opacity: .10;margin-top: 100px;">

        {{-- <img class='background1' src="{{ public_path('/img/validbiru1.png') }}" alt="AdminLTE Logo" width="250px"
        height="75px"
        style="opacity: .5;margin-top: 100px;margin-left:200px;bottom: 150;transform: rotate(-30deg)">
    </div> --}}
    <div id='content'>
        <table class="table" style="padding-bottom: 3rem;">
            <tr>
                <td class='logokiri' colspan="4" style="padding-bottom: 5rem;">
                    <img src="{{ public_path('/img/perurilogo.jpg') }}" alt="AdminLTE Logo" width="100px" height="80px"
                        style="opacity: .8">
                </td>
            </tr>

            <tr>
                <td class="headerow2left">
                    Kepada
                </td>
                <td class="headerow3center">
                    :
                </td>

                <td class="headerow2right">
                    Yth. Kasek K3 dan Damkar
                    {{-- {{$no_surat}} --}}
                </td>
                <td class="headerow2right1" colspan="12">
                    Nomor : {{$dataEvaluasi[0]->no_jsea}} 
                    {{-- {{$no_surat}} --}}
                </td>
            </tr>
            <tr>
                <td class="headerow2left">
                    Dari
                </td>
                <td class="headerow3center">
                    :
                </td>

                <td class="headerow2right" colspan="5">
                    Seksi Jasa
                    {{-- {{$tanggal}} --}}
                </td>
            </tr>
            <tr>
                <td class="headerow2left">
                    Perihal
                </td>
                <td class="headerow3center">
                    :
                </td>

                <td class="headerow2right" colspan="5">
                    Permintaan Review Form Job Safety Environment Analysis (JSEA) Rekanan
                    {{-- {{$tanggal}} --}}
                </td>
            </tr>
        </table>

        <table class="table2">
            <tr>
                <td colspan="6" style="padding-bottom: 2rem;">
                    <p class='mohon'>Mohon dilakukan review dan evaluasi form jsea penawaran rekanan dibawah ini, atas
                        perhatian dan kerjasamanya kami ucapkan terimakasih.</p>
                </td>

            </tr>
            <tr>
                <td class="ttnama" colspan="6" style="padding-right: 0.5rem;padding-bottom:5rem;">
                    Karawang, {{$datePermohonan}}
                </td> 

            </tr>
            <tr>
                <td class=" ttnama" colspan="6" style="padding-right: 2.5rem;">
                    <u class='namattd'>Dwi Yandhini</u>
                </td>
            </tr>
            <tr>
                <td class="ttnama" colspan="6" style="padding-right: 2.5rem;">
                    Kepala Seksi
                </td>
            </tr>

        </table>
        <hr class="new1" style="margin-bottom: 4rem;margin-top: 4rem;" >
        <p style="margin-left: 0.1rem;">Dengan ini kami sampaikan hasil review dan evaluasi form JSEA:</p>
        <table class="table">


            <tr>
                <td class="headerow2left">
                    Nama Pekerjaan
                </td>
                <td class="headerow3center">
                    :
                </td>

                <td class="headerow2right">
                    {{$dataEvaluasi[0]->nama_pekerjaan}} 
                    {{-- {{$no_surat}} --}}
                </td>

            </tr>
            <tr>
                <td class="headerow2left">
                    Nomor SPPJ
                </td>
                <td class="headerow3center">
                    :
                </td>

                <td class="headerow2right" colspan="5">
                    {{$dataEvaluasi[0]->no_sppj}} 
                    
                    {{-- {{$tanggal}} --}}
                </td>
            </tr>
            <tr>
                <td class="headerow2left">
                    Nama Rekanan
                </td>
                <td class="headerow3center">
                    :
                </td>
                <td class="headerow2right" colspan="5">
                    {{$dataEvaluasi[0]->vendor}} 
                    {{-- {{$tanggal}} --}}
                </td>
            </tr>

        </table>
        <p style="margin-left: 0.1rem;">Hasil review dan evaluasi form JSEA:</p>
        @if($dataEvaluasi->count() == 1)
        <p style="margin-left: 0.1rem;"><mark>1. Sesuai</mark></p> 
        <p style="margin-left: 0.1rem;"><del>2. Perlu perbaikan pada saat pekerjaan dilakukan sesuai Catatan Evaluasi
                untuk Perbaikan</del></p> 
                @else
                <p style="margin-left: 0.1rem;"><del>1. Sesuai</del></p> 
                <p style="margin-left: 0.1rem;"><mark>2. Perlu perbaikan pada saat pekerjaan dilakukan sesuai Catatan Evaluasi
                        untuk Perbaikan</mark></p> 
                @endif

        <table class="table1" style="width: 100%; page-break-before: always;">

            <tr>

                <th class="headeruji" style='width:3%;' colspan="1">No.</th>
                <th class="headeruji">KRITERIA</th>
                <th class="headeruji" colspan="2">CATATAN EVALUASI UNTUK PERBAIKAN</th>
            </tr>
            {{-- @foreach($dataEvaluasi as $data) --}}
            <tr>
                <td class="no">1</td>
                <td class="namalimbah">-</td>
                {{-- <td class="catatan1" colspan="2">{{$data->catatan}}</td> --}}
                <td class="catatan1" colspan="2">-</td>

            </tr>
            {{-- @endforeach --}}

        </table>
        <table class="table2">
            <tr>
                <td colspan="6">
                    <p class='catatanfooter'>Catatan :</p>
                    <p class='catatanfooter'>Apabila terdapat catatan evaluasi perbaikan dari K3, maka harus dipenuhi
                        pada saat pekerjaan dilakukan, jika tidak dipenuhi akan dilakukan penindakan.</p>
                </td>

            </tr>
            <tr>
                <td class="ttnama" colspan="5">
                <td class="ttnama" colspan="6"style="padding-right: 2rem;">
                    Karawang, {{$datePermohonan}}
                </td>

            </tr>
            <tr>
                <td class="ttnama" colspan="5" style="padding-right: 3rem;">
                <td class="ttnama" colspan="6" style="padding-right: 3rem;padding-bottom:4rem;">
                    Seksi K3 dan Damkar
                </td>

            </tr>
            <tr>
                <td class="ttnama" colspan="6" >
                     
                </td>
                <td class="ttnama" colspan="6" style="padding-right: 5rem;  text-align: center;">
                    <u class='namattd'>{{$dataEvaluasi[0]->created_by}} </u>
                </td>
            </tr>
            <tr>
                <td class="ttnama" colspan="6"  >
                    
                </td>
                <td class="ttnama" colspan="6" style="padding-right: 5rem;  text-align: center;">
                    Tenaga Ahli K3
                </td>
            </tr>

        </table>


        <div class="page-break">
        </div>

        {{-- <h1>Page 2</h1> --}}



        <script>
            $(document).ready(function () {


            })

        </script>
</body>

</html>
