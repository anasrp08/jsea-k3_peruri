@extends('layouts.app')
{{-- <link rel="stylesheet" href="{{ asset('/adminlte3/summernote-bs4.css') }}"> --}}

@section('content')
{{-- <div class="container"> --}}
<style>
    #tbl_evaluasi tbody tr {

        cursor: pointer;
    }

    .card-title-center {
        /* float: center !important;  */
        float: center;
        font-size: 1.1rem;
        font-weight: 400;
        margin: 0;
    }

</style>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @include('history.f_detail_jsea')
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>


@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function () {
         


        $('.textarea').summernote({
            placeholder: 'Isi disini....',
            tabsize: 2,
            height: 200,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                // ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                // ['color', ['color']],
                ['para', ['ol', 'paragraph']],
                ['height', ['height']]
            ]
        }) 
        var idTender=$('#idTender').val()
        getDataTender()
        
        function setDataEvaluasi(dataEvaluasi) { 
            if (dataEvaluasi.length > 1) {
                for (i = 0; i < dataEvaluasi.length; i++) {
                    console.log(dataEvaluasi[i].kriteria)
                    switch (dataEvaluasi[i].kriteria) {
                        case "1":
                        console.log(dataEvaluasi[i].catatan)
                        $("#pelaksanaan").summernote("code", dataEvaluasi[i].catatan);
                            // $('#pelaksanaan').data("wysihtml5").editor.setValue(dataEvaluasi[i].catatan)
                            break;
                        case "2":
                        $("#pelindung").summernote("code", dataEvaluasi[i].catatan); 
                            break;
                        case "3":
                        $("#peralatan").summernote("code", dataEvaluasi[i].catatan); 
                            break;
                        case "4":
                        $("#bahan").summernote("code", dataEvaluasi[i].catatan); 
                            break;
                        case "5":
                        $("#urutan").summernote("code", dataEvaluasi[i].catatan); 
                            break;
                        case "6":
                        $("#bahaya").summernote("code", dataEvaluasi[i].catatan); 
                            break;
                        case "7":
                        $("#pengendalian").summernote("code", dataEvaluasi[i].catatan); 
                            break;

                        default:
                            break;
                    }

                }
                console.log('asd')
                $('#np').val(dataEvaluasi[0].np)
                $('#nama_pegawai').val(dataEvaluasi[0].created_by)
                $('#id_tender_db').val(dataEvaluasi[0].id_daftar)
                $('#status_data').val('ada')
                $('#terima').prop('disabled', true)
                $('#np1').prop('disabled', true)
                $('#nama_pegawai1').prop('disabled', true)
                
                 


            }else if(dataEvaluasi.length == 1) {
                console.log('masuk')
                $('#np1').val(dataEvaluasi[0].np),
                $('#nama_pegawai1').val(dataEvaluasi[0].created_by)
                $('#id_tender_db').val(dataEvaluasi[0].id_daftar)
                $('#terima').prop('disabled', true)
                $('#nama_pegawai1').prop('disabled', true)
                $('#np1').prop('disabled', true) 
                $('#nama_pegawai').prop('disabled', true)
                $('#np').prop('disabled', true) 
                $("#pelaksanaan").summernote("disable")
                        $("#pelindung").summernote("disable"); 
                         
                        $("#peralatan").summernote("disable"); 
                         
                        $("#bahan").summernote("disable"); 
                          
                        $("#urutan").summernote("disable"); 
                          
                        $("#bahaya").summernote("disable"); 
                         
                        $("#pengendalian").summernote("disable"); 
                        $('#simpan').prop('disabled', true) 
                        $('#send').prop('disabled', true) 
                // $('#generate_pdf').prop('disabled', true)
                
            }else if(dataEvaluasi.length == 0){
                $('#generate_pdf').prop('disabled', true)
                $('#terima').prop('disabled', false)

            }
        }


        function pdfViewer(data) {
            if (data == "" || data == 'NULL') {
                return document.getElementById("pdfviewer").innerHTML =
                    '<span class="badge badge-primary">Tidak ada evaluasi</span>';
            } else {
                return document.getElementById("pdfviewer").innerHTML = '<iframe src ="{{ asset("")}}' + data +
                    '" style="width:100%; height:100%;"></iframe>';
            }
        }



        // pdfViewer(docJsea) 
        
        // $('.textarea').summernote('insertOrderedList')  


        function getDataTender() {
            var paramData = {
                id_tender_db: $('#idTender').val()
            }

            $.ajax({
                url: "{{ route('evaluasi.detail_jsea') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramData,
                beforeSend: function () {
                    $('#action_button').val('menyimpan...');
                },
                success: function (data) {
                    console.log(data)
                    var dataHeader = data.dataDetail
                    var dataEvaluasi = data.dataEvaluasi
                    var tglReview
                    if (dataHeader.updated_at == null) {
                        tglReview = '-'

                    } else {
                        tglReview = moment(dataHeader.updated_at).format('DD/MM/YYYY')
                    }
                    $('#nama_tender').text(dataHeader.nama_pekerjaan)
                    $('#vendor').text(dataHeader.vendor)
                    $('#no_tender').text(dataHeader.no_tender)
                    $('#no_pr').text(dataHeader.no_pr)
                    $('#no_jsea').text(dataHeader.no_jsea)
                    $('#tgl_dibuat').text(moment(dataHeader.tgl_tender).format('DD/MM/YYYY'))
                    $('#tgl_updated').text(moment(dataHeader.tgl_tender).format('DD/MM/YYYY'))
                    $('#tgl_dikirim').text(moment(dataHeader.created_at).format('DD/MM/YYYY'))
                    $('#tgl_review').text(tglReview)
                    $('#status_tender').text(dataHeader.status_tender)
                    $('#status_review').text(dataHeader.status)
                    pdfViewer(dataHeader.path_file)
                    console.log(dataEvaluasi.length)

                    setDataEvaluasi(dataEvaluasi)


                }
            })
        }
        $('#generate_pdf').on('click', function () {
            var url =
                '{{ route("formulir.cetak",":id")}}';
            url = url.replace(":id", idTender);


            document.location.href = url;
        })



        $('#send').on('click', function (event) {
            event.preventDefault();
            console.log('tes')
            $('#action').val('posting')
            var paramObj = {
                pelaksanaan: $('#pelaksanaan').val(),
                pelindung: $('#pelindung').val(),
                peralatan: $('#peralatan').val(),
                bahan: $('#bahan').val(),
                urutan: $('#urutan').val(),
                bahaya: $('#bahaya').val(),
                pengendalian: $('#pengendalian').val(),
                id_tender_db: $('#id_tender_db').val(),
                np: $('#np').val(),
                nama_pegawai: $('#nama_pegawai').val(),
                action: $('#action').val(),

            }

            $.ajax({
                url: "{{ route('evaluasi.update_posting') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramObj,
                beforeSend: function () {
                    $('#send').val('menyimpan...');
                },
                success: function (data) {
                    var html = '';
                    console.log(data)
                    if (data.errors) {
                        toastr.success(data.errors, 'Gagal Posting', {
                            timeOut: 5000
                        });
                        $('#send').val('Posting Evaluasi');
                    }
                    if (data.success) {

                        var id_tender_db = $('#idTender').val()
                        var no_tender = $('#no_tender').text()
                        var status_kirim = data.success
                        sendMail(id_tender_db, no_tender, status_kirim)
                    }

                }
            })

        })


        $('#save_evaluasi').on('submit', function (event) {
            event.preventDefault();

            if ($('#status_data').val() == '') {
                $('#action').val('save')
            } else {
                $('#action').val('update_save')
            }
            // $('#action').val('save')
            $.ajax({
                url: "{{ route('evaluasi.save') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                // dataType: "json",
                beforeSend: function () {
                    $('#simpan').val('menyimpan...');
                },
                success: function (data) {
                    var html = '';
                    console.log(data)
                    if (data.errors) {
                        toastr.success(data.errors, 'Gagal Tersimpan', {
                            timeOut: 5000
                        });
                        $('#simpan').val('Simpan');
                    }
                    if (data.success) {
                        toastr.success(data.success, 'Tersimpan', {
                            timeOut: 5000
                        });
                        $('#simpan').val('Simpan');


                    }

                }
            })

        })
        $('#terima').on('click', function (event) {
            event.preventDefault();
            var paramData = {
                id_tender_db: idTender,
                np: $('#np1').val(),
                nama_pegawai: $('#nama_pegawai1').val(),
                // action:"pengadaan",

            } 
            $.ajax({
                url: "{{ route('evaluasi.diterima') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramData,
                beforeSend: function () {
                    $('#terima').text('menyimpan...');
                },
                success: function (data) {
                    var html = '';
                    console.log(data)
                    if (data.errors) {
                        toastr.success(data.errors, 'Gagal Posting', {
                            timeOut: 5000
                        });
                        $('#terima').text('Terima');
                    }
                    if (data.success) {
                        
                        var id_tender_db = $('#idTender').val()
                        var no_tender = $('#no_tender').text()
                        var status_kirim = data.success
                        sendMail(id_tender_db, no_tender, status_kirim)
                        $('#terima').text('Terima');
                        $('#terima').prop('disabled',true);
                        $('#np1').prop('disabled',true);
                        $('#nama_pegawai1').prop('disabled',true);
                        
                        
                    }

                }
            })
        })
        

        function sendMail(id_tender_db, no_tender, status_kirim) {

            var paramData = {
                id_tender: id_tender_db,
                no_tender: no_tender,
                unit_kerja: "pengadaan",
                // action:"pengadaan",

            }
            $.ajax({
                url: "{{ route('mail.send')}}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramData,
                beforeSend: function () {
                    $('#send').val('proses menyimpan & kirim...');
                },
                success: function (data) {
                    var html = '';
                    console.log(data)
                    if (data.success) {
                        toastr.success(data.success + " & " + status_kirim, 'Terkirim', {
                            timeOut: 5000
                        });
                        $('#tbl_jsea').DataTable().ajax.reload();
                        $('#send').val('Posting Evaluasi');


                    }

                }
            })
        }

        // updateData(cair, ["Polos", "Ada"], [dataPieChart[0],dataPieChart[1]])
    })

</script>
@endsection
