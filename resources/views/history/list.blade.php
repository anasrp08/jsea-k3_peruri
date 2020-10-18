@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <style>
        #tbl_evaluasi tbody tr {
    
    cursor: pointer;
    }
        </style>
<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-tabs">
        <div class="card-header">
            <h4 id='title_konfirmasi' class="modal-title">Data Tender</h4>
        </div>
        <div class="card-body"> 
            @include('history.tbl_daftar_jsea')  
        </div> 
    </div>
    </div>
    @include('history.detail')
    <!-- /.card -->

    {{-- <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            {{-- Dashboard Kapasitas & Kuota 
          </h3>
          <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item">
                <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Kapasitas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#sales-chart" data-toggle="tab">Kadaluarsa</a>
              </li>
            </ul>
          </div>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content p-0">
            <!-- Morris chart - Sales -->
            <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
                 <div class="row">
                    <!-- Left col -->
                    @include('dashboard.kuotalimbah')
             
            
                </div>
            
                <div class="row">
                    <!-- Left col -->
                    @include('dashboard.kapasitastps')
            
            
                </div>
                 
             </div>
            <div class="chart tab-pane" id="sales-chart" style="position: relative;">
                <div class="row">
                    <!-- Left col -->
                    @include('dashboard.penghasil')
            
                </div>
            </div>  
          </div>
        </div><!-- /.card-body -->
      </div> --}}


</section>
{{-- </div> --}}

@endsection
@section('scripts')
{{-- <script src="{{ asset('/adminlte3/chartjs/Chart.bundle.min.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script> --}}

<script>
    $(document).ready(function () { 
        var table = $('#tbl_evaluasi').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            scrollX: true,
            paging:true,
            dom: '<"right">lrtip<"clear">',
            
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
                    data: 'no_tender',
                    name: 'no_tender'
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
               
                // {
                //     data: 'file_uid',
                //     name: 'file_uid'
                // },
                
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
                 
                
            ]
        });
        var pProv={
            tes:'tes'
        }
        
        function isVisible(isVisible){
            if(isVisible=='k3'){
                $('#file_jsea').hide() 
                $('#down_dok_jsea').show()
            }else{
                $('#file_jsea').show()
                $('#down_dok_jsea').hide()
            }
        }
        $('#simpan').on('click', function () {
            isVisible('k3')
        })
        function goToReview(id){
            var url = '{{ route("dashboard.data")}}';
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
        $('#tbl_evaluasi tbody').on('click', 'tr', function () {
            user_id = $(this).data('id');
            // $("#success-alert").hide();
            isVisible('pengadaan')
          
            var data = table.row($(this).closest('tr')).data();
            console.log(data)
            var tgl_dibuat=moment(data.tender_dibuat).format('DD/MM/YYYY');
            var tgl_update=moment(data.tender_update).format('DD/MM/YYYY');
            var tgl_dikirim=moment(data.created_at).format('DD/MM/YYYY');
            var tgl_review=moment().format('DD/MM/YYYY');
            $('#nama_tender').text(data.nama_pekerjaan);
            $('#vendor').text(data.vendor);
            $('#no_tender').text(data.no_tender);
            $('#no_pr').text(data.no_pr);
            $('#no_jsea').text(data.no_jsea);
            $('#tgl_dibuat').text(tgl_dibuat);
            $('#tgl_updated').text(tgl_update);
            $('#dok_jsea').text(data.file_uid);
            $('#dok_evaluasi').text(data.file_uid);
            $('#status_tender').text(data.status_tender);
            $('#status_review').text(data.status_review);
            $('#tgl_review').text(tgl_review);
            $('#tgl_dikirim').text(tgl_dikirim);
            if(data.evaluasi_jsea=='-'){
                $('#lihat').hide() 
            }else{
                
                $('#review').hide() 
                $('#accept').hide() 

            } 
            $('#modaldetail').modal();
        });
       
        // updateData(cair, ["Polos", "Ada"], [dataPieChart[0],dataPieChart[1]])
    })

</script>
@endsection
