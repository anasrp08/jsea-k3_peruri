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
<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-tabs">
        <div class="card-header text-center">
            <h3 class="card-title-center text-center">Memo Evaluasi Form JSEA Rekanan</h3>
        </div>
        <div class="card-body">
            @include('history.f_updt_evaluasi')
        </div>
    </div>
    </div>
    {{-- @include('history.detail') --}}



</section>
{{-- </div> --}}

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> 

<script>
    $(document).ready(function () {
        $('.textarea').summernote({
            placeholder: 'Isi disini....',
        tabsize: 2,
        height: 200
        })
         
        var pProv = {
            tes: 'tes'
        }

        $('#send1').on('click', function (event) {
            event.preventDefault(); 
            console.log('tes')
            $('#action').val('update')
            var paramObj={
                pelaksanaan:$('#pelaksanaan').val(),
                pelindung:$('#pelindung').val(),
                peralatan:$('#peralatan').val(),
                bahan:$('#bahan').val(),
                urutan:$('#urutan').val(),
                bahaya:$('#bahaya').val(),
                pengendalian:$('#pengendalian').val(),
                id_tender_db:$('#id_tender_db').val(),
                np:$('#np').val(),
                nama_pegawai:$('#nama_pegawai').val(),
                action:$('#action').val(),
                
            }
            
             $.ajax({
                 url: "{{ route('evaluasi.update_posting') }}",
                 method: "POST",
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 data: paramObj,
                //  contentType: false,
                //  cache: false,
                //  processData: false,
                 // dataType: "json",
                 beforeSend: function () {
                     $('#action_button').val('menyimpan...');
                 },
                 success: function (data) {
                     var html = '';
                     console.log(data)
                     if (data.errors) {
                         html = '<div class="alert alert-danger">';
                         for (var count = 0; count < data.errors.length; count++) {
                             html += '<p>' + data.errors[count] + '</p>';
                         }
                         html += '</div>';
                         $('#form_result').html(html);
                         $('#action_button').val('Submit');
                     }
                     if (data.success) {
                         toastr.success(data.success, 'Tersimpan', {
                             timeOut: 5000
                         });
                         $('#create_jadwal')[0].reset();

                         $('#pilihuji').get(0).selectedIndex = 0;
                         window.location.reload()
                         
                         $('#form_result').html('');
                     }

                 }
             })
          
     })
     
         
        $('#save_evaluasi').on('submit', function (event) {
            event.preventDefault();
            $('#action').val('save')
                $.ajax({
                    url: "{{ route('evaluasi.update') }}",
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
                        $('#action_button').val('menyimpan...');
                    },
                    success: function (data) {
                        var html = '';
                        console.log(data)
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#form_result').html(html);
                            $('#action_button').val('Submit');
                        }
                        if (data.success) {
                            toastr.success(data.success, 'Tersimpan', {
                                timeOut: 5000
                            });
                            $('#create_jadwal')[0].reset();

                            $('#pilihuji').get(0).selectedIndex = 0;
                            window.location.reload()
                            
                            $('#form_result').html('');
                        }

                    }
                })
             
        })
        
        
        // updateData(cair, ["Polos", "Ada"], [dataPieChart[0],dataPieChart[1]])
    })

</script>
@endsection
