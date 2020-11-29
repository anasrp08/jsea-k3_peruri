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
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                            href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                            aria-selected="true">Summary</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                            href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile"
                            aria-selected="false">Grafik</a>
                    </li> --}}
    
                </ul>
            </div>
            <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                    aria-labelledby="custom-tabs-one-home-tab">
                     
                        @include('dashboard.banner') 
                </div>
                
            @if (Auth::check())
            @role(['admin','pengadaan'])
            @include('dashboard.tbl_daftar_jsea')
            @endrole
            @endif
            @include('dashboard.detail')
        </div>

    </div>
    </div>
</section>
{{-- </div> --}}

@endsection
@section('scripts')
<script src="{{ asset('/adminlte3/chartjs/Chart.bundle.min.js') }}"></script>


<script>
    $(document).ready(function () {
//         $('#period').datepicker({
//             // uiLibrary: 'bootstrap4',
//             // defaultDate: new Date(),
//     format: "yyyy",
//     viewMode: "years",
//     minViewMode: "years",
//     changeMonth: false,
//         changeYear: true,
// });

 
        // $('#period').datepicker({
        //     uiLibrary: 'bootstrap4',
        //     todayHighlight: true,
        //     format: "mm/yyyy",
        //     defaultDate: new Date(),
        //     viewMode: "months",
        //     minViewMode: "months"
        // });
        // $('#period').val(moment().format('YYYY'))

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        var chartBulan = new Chart(document.getElementById("permintaan"), {
            type: 'bar',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                    "Agustus",
                    "September", "Oktober", "November", "Desember"
                ],
                datasets: [{
                        label: "Jumlah Permintaan",
                        backgroundColor: "#ff5722",
                        data: ''
                    },
                    {
                        label: "Permintaan On Progress",
                        backgroundColor: "#ff9800",
                        data: ''
                    },
                    {
                        label: "Permintaan Selesai",
                        backgroundColor: "#4caf50",
                        data: ''
                    }

                ]
            },
            options: {
                scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return value+' '+'Permintaan'
                        
                    },
                    beginAtZero: true,
                    stepSize: 5

                }
            }]
        },
                 
                // tooltips: {
                //     callbacks: {
                //         // title: function (tooltipItem, data) {
                //         //     return data['labels'][tooltipItem[0]['index']];
                //         // },
                //         label: function (tooltipItem, data) {
                //             var formattedjumlah = data['datasets'][0]['data'][tooltipItem['index']]
                //             console.log(namalimbah)
                //             var finalValue = null
                //             var satuan = null
                //             if (namalimbah == 1 || namalimbah == 2 || namalimbah == 3 ||
                //                 namalimbah == 17 || namalimbah == 20) {
                //                 finalValue = parseInt(formattedjumlah) / parseInt(1000)
                //                 satuan = 'm3'
                //             } else {
                //                 finalValue = parseInt(formattedjumlah) / parseInt(1000)
                //                 satuan = 'ton'
                //             }
                //             return formattedjumlah + ' ' + satuan
                //             // return data['datasets'];
                //         },
                //         // afterLabel: function (tooltipItem, data) {
                //         //     var dataset = data['datasets'][0];


                //         //     return "Presentase: " + '(' + dataset + '%)';
                //         //     // return data;
                //         // }
                //     },

                // }
            }
        });
        $('#period').val(new Date().getFullYear()).change()
        var paramData = {
            period: $('#period').val() 
        }
        $('#period').on('change', function () {
            namalimbah = $('#namalimbah').val()
            var paramData = {
                period: $('#period').val() 
            }
            getDataGrafik(paramData)
            // updateChart(chart, value,paramData)

        })
        
        getDataGrafik(paramData)

        function getDataGrafik(paramData) {

            $.ajax({
                url: "{{ route('grafik.data') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "accept": "application/json",
                    "Access-Control-Allow-Origin": "*"
                },
                data: paramData,
                dataType: "json",

                success: function (data) {
                    console.log(data)
                    console.log(chartBulan.data.datasets)
                     
                    var dataJumlah = data.dataPermintaan
                    var dataOnprogress = data.dataOnProgress
                    var dataSelesai = data.dataSelesai

                    chartBulan.data.datasets[0].data = dataJumlah
                    chartBulan.data.datasets[1].data = dataOnprogress
                    chartBulan.data.datasets[2].data = dataSelesai
                    chartBulan.update();

                }
            });
        }
        var table = $('#tbl_jsea').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            scrollX: true,
            paging: true,
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

                    d.tahun = new Date().getFullYear()





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
                    data: 'no_sppj',
                    name: 'no_sppj'
                },
                // {
                //     data: 'no_jsea',
                //     name: 'no_jsea'
                // },

                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'status_tender',
                    name: 'status_tender'
                },


                {
                    data: 'nama_vendor',
                    name: 'nama_vendor'
                },



                // {
                //     data: 'doc_upload',
                //     name: 'doc_upload',
                //     render: function (data, type, row) {
                //         if (data == null || data == "-" || data == "0000-00-00 00:00:00" ||
                //             data == "NULL") {
                //             return '<span>-</span>'
                //         } else {
                //             return moment(data).format('DD/MM/YYYY');
                //         }

                //     }
                // },
                {
                    data: 'status_review',
                    name: 'status_review',
                    render: function (data, type, row) {

                        return '<span class="badge badge-info">Belum Review</span>'


                    }
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
        var pProv = {
            tahun: new Date().getFullYear()
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
            var tgl_dibuat = moment(data.tender_dibuat).format('DD/MM/YYYY');
            var tgl_update = moment(data.tender_update).format('DD/MM/YYYY');

            var tgl_review = moment().format('DD/MM/YYYY');
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

        function isVisible(isVisible) {
            if (isVisible == 'k3') {
                $('#file_jsea').hide()
                $('#down_dok_jsea').show()
            } else {
                $('#file_jsea').show()
                $('#down_dok_jsea').hide()
            }


        }
        // $('#simpan').on('click', function () {
        //     isVisible('k3')
        // })
        function goToReview(id) {
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
            var tgl_dibuat = moment(data.tender_dibuat).format('DD/MM/YYYY');
            var tgl_update = moment(data.tender_update).format('DD/MM/YYYY');

            var tgl_review = moment().format('DD/MM/YYYY');
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

        $('#save_upload').on('submit', function (event) {
            event.preventDefault();
            var output = [];
            var jsonData = {}
            var id = []
            var dataSelected = []
            var data1 = table.rows({
                selected: true
            }).data()
            data1[0].file_jsea = $('#file_jsea').prop('files')[0]
            console.log(data1[0])

            var form = new FormData(this)
            form.append('data', JSON.stringify(data1[0]))

            url = "{{ route('tender.store') }}"
            $.ajax({
                url: url,
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                data: form,
                contentType: false,
                // cache: false,
                processData: false,
                // dataType: "json",
                beforeSend: function () {
                    $('#simpan').text('proses menyimpan...');
                },
                success: function (data) {
                    // console.log(data)
                    if (data.errors) {

                        toastr.success(data.errors, 'Gagal Menyimpan', {
                            timeOut: 5000
                        });
                    }
                    if (data.success) {
                        // toastr.success(data.success, 'Success', {
                        //     timeOut: 5000
                        // });
                        var id_tender_db = data.id_tender_db
                        var no_tender = data1[0].number
                        var status_kirim = data.success

                        sendMail(id_tender_db, no_tender, status_kirim, '#simpan')

                    }
                }
            })
            $('#np').val('').change()
            $('#modalconfirm').modal('toggle')
        })

        function sendMail(id_tender_db, no_tender, status_kirim, button) {
            var paramData = {
                id_tender: id_tender_db,
                no_tender: no_tender,
                unit_kerja: "k3",

            }
            $.ajax({
                url: "{{ route('mail.send')}}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramData,
                beforeSend: function () {
                    $(button).text('mengirim email...');
                },
                success: function (data) {
                    var html = '';
                    console.log(data)
                    if (data.success) {
                        toastr.success(data.success + " & " + status_kirim, 'Terkirim', {
                            timeOut: 5000
                        });
                        $('#tbl_jsea').DataTable().ajax.reload();
                        // $('#simpan').text('Simpan');
                        $(button).text('Kirim');
                        $('#modaldetail').modal('toggle');


                    }

                }
            })
        }
        var paramData = {
            tahun: new Date().getFullYear()
        }
        $.ajax({
            url: "{{ route('banner.data') }}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: paramData,
            // contentType: false,
            // cache: false,
            // processData: false,
            // dataType: "json",
            beforeSend: function () {
                $('#saveentri').text('proses menyimpan...');
            },
            success: function (data) {
                console.log(data)
                $('#belumreview').text(data.dataBlmReview)
                $('#jmlhpermintaan').text(data.dataPermintaan)
                var persenApprove = Math.round(data.persenApprove)
                var persenEvaluasi = Math.round(data.persenEvaluasi)
                var persenTerima = Math.round(data.persenTerima)

                // $('#openreview').text(data.dataOpenReview)
                $('#onprogress').text(data.dataOnProgressReview)
                $('#approve').text(data.dataApprove)
                $('#evaluasi').text(data.dataEvaluasi)
                $('#persenevaluasi').text(data.dataEvaluasi + ' dari ' + data.dataPermintaan)
                $('#persenapprove').text(data.dataApprove + ' dari ' + data.dataPermintaan)
                $('#persenterima').text(data.dataDiterima + ' dari ' + data.dataPermintaan)

                $('#progbarapprove').css({
                    "width": persenApprove + "%"
                });
                $('#progbarevaluasi').css({
                    "width": persenEvaluasi + "%"
                });
                $('#progbarterima').css({
                    "width": persenTerima + "%"
                });

                $('#openreview').text(data.dataOpenPermintaan)


                $('#diterimapengadaan').text(data.dataDiterima)


            }
        })

        // updateData(cair, ["Polos", "Ada"], [dataPieChart[0],dataPieChart[1]])
    })

</script>
@endsection
