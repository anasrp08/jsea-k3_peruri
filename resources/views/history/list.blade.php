@extends('layouts.app')


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-html5-1.6.5/datatables.min.css"/>


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


    @include('history.f_filter')
    @include('history.tbl_daftar_jsea') 


</section>
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-html5-1.6.5/datatables.min.js"></script>


<script>
    $(document).ready(function () { 
        $('input[name="review_date"]').daterangepicker({
            format: 'DD/MM/YYYY',
            autoUpdateInput: false,
            autoclose: true,
            locale: {
                cancelLabel: 'Clear'
            }

        })
        $('input[name="review_date"]').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });
        var login = '<?php echo auth()->user()->name ?>'
        console.log(login)
        if(login=='Pengadaan'){
            // $('#status').val()
            // $('select[name="status"]').find('option[value="4"]').attr("selected", true).change();
        }else if(login=='Unit K3'){
            $('select[name="status"]').find('option[value="1"]').attr("selected", true).change();
        }
        // var parseDataUser=JSON.parse(dataUser)
        // console.log(dataUser)
        // $('#kirim').on('click', function () {
        //     var paramData={
        //         id_tender:'2',
        //         no_tender:"PLJ/2019/00235",
        //         unit_kerja:"k3",
                
        //     }
        //     $.ajax({
        //         url: "{{ route('mail.send')}}",
        //         method: "POST",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: paramData, 
        //         beforeSend: function () {
        //             $('#action_button').val('menyimpan...');
        //         },
        //         success: function (data) {
        //             var html = '';
        //             console.log(data) 
        //             if (data.success) {
        //                 toastr.success(data.success, 'Terkirim', {
        //                     timeOut: 5000
        //                 }); 
                        
        //             }

        //         }
        //     }) 
        // }) 

        
        $('.date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy',
            todayHighlight: true
        });
        function pdfViewer(data) {
           
            return document.getElementById("pdfviewer").innerHTML = '<iframe src ="{{ asset("")}}' + data +
                '" style="width:100%; height:100%;"></iframe>';
        }
        var idTender
        var table = $('#tbl_evaluasi').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            scrollX: true,
            paging: true,
            dom: 'Blfrtip',
            
            buttons: [
                { extend: 'excel' , text: 'Export Excel' }
    ],
            columnDefs: [{
                    className: 'text-center',
                    targets: [1, 2, 3]
                },
                {
                    className: 'dt-body-nowrap',
                    targets: -1
                }
            ],
            select: true,
            language: {
                emptyTable: "Tidak Ada Data"
            },
            search: {
                caseInsensitive: false
            },
            ajax: {
                url: "{{ route('evaluasi.data') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: function (d) {
                    d.notender=$('#notender').val()
                    d.nosppj=$('#nosppj').val()
                    d.nojsea=$('#nojsea').val()
                    d.tender_date=$('#tender_date').val()
                    d.review_date=$('#review_date').val()
                    d.status=$('#status').val()

                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'no_tender',
                    name: 'no_tender'
                },
                {
                    data: 'no_sppj',
                    name: 'no_sppj'
                },
                {
                    data: 'no_jsea',
                    name: 'no_jsea'
                },
                {
                    data: 'nama_pekerjaan',
                    name: 'nama_pekerjaan'
                },
                {
                    data: 'status_tender',
                    name: 'status_tender'
                },
                {
                    data: 'tgl_tender',
                    name: 'tgl_tender',
                    render: function (data, type, row) {
                        if (data == null || data == "-" || data == "0000-00-00 00:00:00" ||
                            data == "NULL") {
                            return '<span>-</span>'
                        } else {
                            return moment(data).format('DD/MM/YYYY');
                        }

                    }
                },
                {
                    data: 'tgl_updtender',
                    name: 'tgl_updtender',
                    render: function (data, type, row) {
                        if (data == null || data == "-" || data == "0000-00-00 00:00:00" ||
                            data == "NULL") {
                            return '<span>-</span>'
                        } else {
                            return moment(data).format('DD/MM/YYYY');
                        }

                    }
                },

                {
                    data: 'vendor',
                    name: 'vendor'
                },
 
                {
                    data: 'status',
                    name: 'status',
                    render: function (data, type, row) { 
                        switch (row.status_review) {
                            case '1':
                                return '<span class="badge badge-info">'+data+'</span>'
                                break;
                            case '2':
                                return '<span class="badge badge-success">'+data+'</span>'
                                break;
                            case '3':
                                return '<span class="badge badge-warning">'+data+'</span>'
                                break;
                                case '4':
                                return '<span class="badge badge-primary">'+data+'</span>'
                                break;
                                case '5':
                                return '<span class="badge badge-primary">'+data+'</span>'
                                break;
                                case '6':
                                return '<span class="badge badge-primary">'+data+'</span>'
                                break;
                            default:
                                break;
                        }




                    }
                },


            ]
        }); 
        $('#cari').on('click', function () {
            $('#tbl_evaluasi').DataTable().ajax.reload();
        })
 
        function goToReview(id) {
            var url = '{{ route("evaluasi.buat",":id")}}';
            url = url.replace(':id', id);
            document.location.href = url;
        } 
        // $('#evaluasi').on('click', function () {
        //     goToReview(idTender)
        // })
        // $('#edit_evaluasi').on('click', function () {
        //     goToReview(idTender)

        // })
         
        

        // $('#terima').on('click', function () {  
        //     $('#id_tender_db').val(idTender) 
        //     $('#modalterima').modal(); 
        // });


        // $('#form_diterima').on('submit', function (event) {
        //     event.preventDefault();
            
        //     $.ajax({
        //         url: "{{ route('evaluasi.diterima') }}",
        //         method: "POST",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: new FormData(this),
        //          contentType: false,
        //          cache: false,
        //          processData: false,
        //         dataType: "json",
        //         beforeSend: function () {
        //             $('#action_button').val('menyimpan...');
        //         },
        //         success: function (data) {
        //             var html = '';
        //             console.log(data)
        //             if (data.errors) {
        //                 html = '<div class="alert alert-danger">';
        //                 for (var count = 0; count < data.errors.length; count++) {
        //                     html += '<p>' + data.errors[count] + '</p>';
        //                 }
        //                 html += '</div>';
        //                 $('#form_result').html(html);
        //                 $('#action_button').val('Submit');
        //             }
        //             if (data.success) {
        //                 toastr.success(data.success, 'Tersimpan', {
        //                     timeOut: 5000
        //                 });
        //                 $('#tbl_evaluasi').DataTable().ajax.reload();
        //                 $('#form_diterima')[0].reset();
        //                 $('#modalterima').modal('toggle'); 
        //                 $('#modaldetail').modal('toggle');

                        
        //             }

        //         }
        //     })
        // })
        
        $('#tbl_evaluasi tbody').on('click', 'tr', function () {
 
            var data = table.row($(this).closest('tr')).data();
            idTender = data.id; 
            var url = '{{ route("evaluasi.detailjsea",":id")}}';
            url = url.replace(':id', idTender);
            document.location.href = url;  

            // var tgl_dibuat = moment(data.tender_dibuat).format('DD/MM/YYYY');
            // var tgl_update = moment(data.tender_update).format('DD/MM/YYYY');
            // var tgl_dikirim = moment(data.created_at).format('DD/MM/YYYY');
            // var tgl_review = moment().format('DD/MM/YYYY');
            // var statusReview
             
            // switch (data.status_review) {
            //     case '1':
            //         statusReview = 'Belum Review'
            //         $('#edit_evaluasi').hide()
            //         $('#detail_evaluasi').prop('disabled', true);

            //         break;
            //     case '2':
            //         statusReview = 'Diterima'
            //         $('#edit_evaluasi').show()
            //         break;
            //     case '3':
            //         statusReview = 'Evaluasi'
            //         $('#detail_evaluasi').prop('disabled', false);
            //         // $('#edit_evaluasi').hide()
            //         $('#evaluasi').hide()
            //         $('#terima').hide()

            //         break;
            //     case '4':
            //         statusReview = 'Evaluasi'
            //         $('#edit_evaluasi').hide()
            //         $('#evaluasi').hide()
            //         $('#terima').hide()

            //         break;
            //     default:
            //         break;
            // }
            // $('#nama_tender').text(data.nama_pekerjaan);
            // $('#vendor').text(data.vendor);
            // $('#no_tender').text(data.no_tender);
            // $('#no_pr').text(data.no_pr);
            // $('#no_jsea').text(data.no_jsea);
            // $('#tgl_dibuat').text(tgl_dibuat);
            // $('#tgl_updated').text(tgl_update);
            // $('#dok_jsea').text(data.file_uid);
            // $('#dok_evaluasi').text(data.file_uid);
            // $('#status_tender').text(data.status_tender);
            // $('#status_review').text(statusReview);
            // $('#tgl_review').text(tgl_review);
            // $('#tgl_dikirim').text(tgl_dikirim);

            // // console.log('{{ asset("")}}'+ data.path_file)
            // // $("#download_file").attr("action", '{{ asset("")}}'+ data.path_file);
            // pdfViewer(data.path_file)
            // $('#modaldetail').modal();
           
        });
        $('#down_dok_jsea').on('click', function () {
            // event.preventDefault();
            $('#formModal').modal();
        }) 
        
        $('#refresh').on('click', function (event) {
            $('#tbl_evaluasi').DataTable().ajax.reload();
        })
 
        // $('#detail_evaluasi').on('click', function () {
 
        //     var table1 = $('#tbl_detail_evaluasi').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         destroy: true,
        //         select: true,
        //         dom: '<"right">rti<"clear">',
        //         language: {
        //             emptyTable: "Tidak ada data evaluasi"
        //         },
        //         // scrollY: "300px",
        //         // scrollCollapse: true,
        //         // scrollX: true,

        //         ajax: {
        //             url: '{{ route("evaluasi.detail")}}',
        //             type: "POST",
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             data: function (d) {
        //                 d.id_tender_db = idTender
        //             }
        //         },
        //         columns: [{
        //                 data: 'DT_RowIndex',
        //                 name: 'DT_RowIndex'
        //             },
        //             {
        //                 data: 'status',
        //                 name: 'status'
        //             },
        //             {
        //                 data: 'catatan',
        //                 name: 'catatan',
        //                 render: function (data) {
        //                     return $('<textarea />').html(data).text();
        //                 }
        //             },
        //             {
        //                 data: 'created_at',
        //                 name: 'created_at',
        //                 render: function (data, type, row) {
        //                     console.log(data)
        //                     return moment(data).format('DD/MM/YYYY');

        //                 }
        //             },
        //         ]

        //     })

            $('#modalEvaluasi').modal();

            console.log(idTender)
            var paramData = {
                id_tender_db: idTender
            }

            // $.ajax({
            //     url: "{{ route('evaluasi.detail') }}",
            //     method: "POST",
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     data: paramData,
            //     // contentType: false,
            //     // cache: false,
            //     // processData: false,
            //     // dataType: "json",
            //     beforeSend: function () {
            //         // $('#action_button').val('menyimpan...');
            //     },
            //     success: function (data) {
            //         var html = '';
            //         console.log(data)
            //         // if (data.errors) {
            //         //     html = '<div class="alert alert-danger">';
            //         //     for (var count = 0; count < data.errors.length; count++) {
            //         //         html += '<p>' + data.errors[count] + '</p>';
            //         //     }
            //         //     html += '</div>';
            //         //     $('#form_result').html(html);
            //         //     $('#action_button').val('Submit');
            //         // }
            //         // if (data.success) {
            //         //     toastr.success(data.success, 'Tersimpan', {
            //         //         timeOut: 5000
            //         //     });
            //         //     $('#create_jadwal')[0].reset();

            //         //     $('#pilihuji').get(0).selectedIndex = 0;
            //         //     window.location.reload()

            //         //     $('#form_result').html('');
            //         // }

            //     }
            // })

        

        
    })

</script>
@endsection
