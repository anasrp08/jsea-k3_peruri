@extends('layouts.app')

@section('content')
<style>
    #tbl_jsea tbody tr {

cursor: pointer;
}
    </style>
{{-- <div class="container"> --}}
<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-tabs">
        <div class="card-header">
            <h4 id='title_konfirmasi' class="modal-title">Dashboard</h4>
        </div>
        <div class="card-body">
            
            @include('dashboard.banner') 
            @include('dashboard.tbl_daftar_jsea') 
            @include('dashboard.detail') 
        </div>

    </div>
    </div> 
</section>
{{-- </div> --}}

@endsection
@section('scripts')
{{-- <script src="{{ asset('/adminlte3/chartjs/Chart.bundle.min.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script> --}}

<script>
    $(document).ready(function () { 
        var table = $('#tbl_jsea').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            scrollX: true,
            paging:true,
            dom: '<"right">lrtip<"clear">',
            // buttons: [{
            //         text: 'Terima',
            //         className: 'btn btn-success',
            //         action: function (e, dt, node, config) {
            //             $('#title_konfirmasi').text('Diterima Oleh: ')
            //             $('#hidden_transaksi').val('terima')
            //             $('#modalconfirm').modal('show')

            //         }


            //     },
            //     {
            //         text: 'Validasi',
            //         className: 'btn btn-info',
            //         action: function (e, dt, node, config) {
            //             $('#title_konfirmasi').text('Divalidasi Oleh: ')
            //             $('#hidden_transaksi').val('validasi')
            //             $('#modalconfirm').modal('show')

            //         }


            //     },
            //     {
            //         extend: "selectAll",
            //         text: 'Pilih Semua',
            //         className: 'btn btn-default',
            //     },
            //     {
            //         extend: 'selectNone',
            //         text: 'Batal Pilih Semua',
            //         className: 'btn btn-default',
            //     },
            // ],
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
                url: "{{ route('dashboard.data') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: function (d) {





                }
            },
            // bFilter: false,
           
                       
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'number',
                    name: 'number'
                },
                {
                    data: 'no_jsea',
                    name: 'no_jsea'
                },
                {
                    data: 'no_jsea',
                    name: 'no_jsea'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'status_tender',
                    name: 'status_tender'
                },
                {
                    data: 'tender_dibuat',
                    name: 'tender_dibuat',
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
                    data: 'tender_update',
                    name: 'tender_update',
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
                    data: 'nama_vendor',
                    name: 'nama_vendor'
                },
               
                {
                    data: 'file_uid',
                    name: 'file_uid'
                },
                
                {
                    data: 'doc_upload',
                    name: 'doc_upload',
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
                    data: 'status_review',
                    name: 'status_review',
                    render: function (data, type, row) {
                       
                        return '<span class="badge badge-info">Belum Review</span>'
                     

                    }
                },
                 
                // {
                //     data: 'action',
                //     name: 'action',
                //     render: function (data, type, row) {
                //        if(row.status_review=='belum'){
                //         return '<button href="javascript:void(0)" name="lihat"  data-id="'+row.id_tender+'" data-original-title="Lihat" class="lihat btn btn-info edit-user">'+
                //                 'Lihat </button>'
                //        }else{

                //        } 
                //    },

                   
                //     orderable: false

                // }
            ]
        });
        var pProv={
            tes:'tes'
        }
        $.ajax({
            url: "{{ route('banner.data') }}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "accept": "application/json",
                "Access-Control-Allow-Origin": "*"
            },
            data: pProv,
            dataType: "json",

            success: function (data) {
                 
                // updateChart(dataKapasitas[6].saldo)
            }
        });
        $(document).on('click', '.lihat', function () {
            user_id = $(this).data('id');
            // $("#success-alert").hide();
            isVisible('pengadaan')
          
            var data = table.row($(this).closest('tr')).data();
            console.log(data)
            var tgl_dibuat=moment(data.tender_dibuat).format('DD/MM/YYYY');
            var tgl_update=moment(data.tender_update).format('DD/MM/YYYY');
            
            var tgl_review=moment().format('DD/MM/YYYY');
            $('#nama_tender').text(data.name);
            $('#vendor').text(data.nama_vendor);
            $('#no_tender').text(data.number);
            $('#no_pr').text(data.number);
            $('#no_jsea').val(data.number);
            $('#tgl_dibuat').text(tgl_dibuat);
            $('#tgl_updated').text(tgl_update);
            $('#dok_jsea').text(data.file_uid);
            $('#dok_evaluasi').text(data.file_uid);
            $('#status_tender').text(data.status_tender);
            $('#status_review').text(data.status_review);
            $('#tgl_review').text(tgl_review);
            // if(data.evaluasi_jsea=='-'){
            //     $('#lihat').hide() 
            // }else{

            //     $('#review').hide() 
            //     $('#accept').hide() 

            // } 
            $('#modaldetail').modal();

        });
        function isVisible(isVisible){
            if(isVisible=='k3'){
                $('#file_jsea').hide() 
                $('#down_dok_jsea').show()
            }else{
                $('#file_jsea').show()
                $('#down_dok_jsea').hide()
            }

            
        }
        // $('#simpan').on('click', function () {
        //     isVisible('k3')
        // })
        function goToReview(id){
            // var url = '{{ route("dashboard.data",":id")}}';
            url = url.replace(':id', id);
            document.location.href = url;
        }
        $('#lihat').on('click', function () {
          
            isVisible('k3')
        })
        $('#review').on('click', function () {
           
            isVisible('k3')
        })
        $('#accept').on('click', function () {
            toastr.success('status update', 'Tersimpan', {
                                timeOut: 5000
                            });
        })
        $(document).on('click', '.terima', function () {
            user_id = $(this).data('id');
            // $("#success-alert").hide();
            var data = table.row($(this).closest('tr')).data();

            $('#modaldetail').modal();

        });
        $(document).on('click', '.kirim', function () {
            user_id = $(this).data('id');
            // $("#success-alert").hide();
            var data = table.row($(this).closest('tr')).data();

            $('#modaldetail').modal();

        });
        $('#tbl_jsea tbody').on('click', 'tr', function () {
            user_id = $(this).data('id');
            // $("#success-alert").hide();
            isVisible('pengadaan')
          
            var data = table.row($(this).closest('tr')).data();
            console.log(data)
            var tgl_dibuat=moment(data.tender_dibuat).format('DD/MM/YYYY');
            var tgl_update=moment(data.tender_update).format('DD/MM/YYYY');
            
            var tgl_review=moment().format('DD/MM/YYYY');
            $('#nama_tender').text(data.name);
            $('#vendor').text(data.nama_vendor);
            $('#no_tender').text(data.number);
            $('#no_pr').text(data.number);
            $('#no_jsea').val(data.number);
            $('#tgl_dibuat').text(tgl_dibuat);
            $('#tgl_updated').text(tgl_update);
            $('#dok_jsea').text(data.file_uid);
            $('#dok_evaluasi').text(data.file_uid);
            $('#status_tender').text(data.status_tender);
            $('#status_review').text(data.status_review);
            $('#tgl_review').text(tgl_review);
             
            $('#modaldetail').modal();
        });

        $('#simpan').on('click', function () {
            var output = [];
                        var jsonData = {}
                        var id = [] 
                        var dataSelected = [] 
                        var data1 = table.rows({
                            selected: true
                        }).data()
                        console.log(data1[0]) 

                        url="{{ route('tender.store') }}"
                        $.ajax({
                            url: url,
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: data1[0],
                            // contentType: 'json',
                            // cache: false,
                            // processData: false,
                            // dataType: "json",
                            beforeSend: function () {
                                $('#saveentri').text('proses menyimpan...');
                            },
                            success: function (data) {
                                // console.log(data)
                                if (data.errors) {
                                    toastr.success(data.errors, 'Success', {
                                        timeOut: 5000
                                    });
                                }
                                if (data.success) {
                                    toastr.success(data.success, 'Success', {
                                        timeOut: 5000
                                    });
                                    $('#daftar_pemohon').DataTable().ajax.reload();
                                    // $('#counterentries').text(data.count);

                                    $('#saveentri').text('Simpan');
                                    // $('#tblorder').DataTable().ajax.reload();
                                    // renderTgl()

                                }

                            }
                        })
                        $('#np').val('').change()
                        $('#modalconfirm').modal('toggle')
        })
       
        // updateData(cair, ["Polos", "Ada"], [dataPieChart[0],dataPieChart[1]])
    })

</script>
@endsection
