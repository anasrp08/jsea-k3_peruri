@extends('layouts.app')

<style type="text/css">
    td {
        white-space: nowrap;
    }

    td.wrapok {
        white-space: normal
    }

</style>


<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Daftar Penerima Email</title>
@section('title')
<h1>Daftar Penerima Email</h1>

@endsection


@section('content')

<!-- Main content --
<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Tambah Data</h3>
    </div>
    <div class="card-body">
        <form method="post" id="save_email" enctype="multipart/form-data">
            @csrf
        <div class="row">
            
                <div class="col-md-6">
                    <div id="formkantor" class="form-group">
                        <label>Nama Pegawai</label>
                        <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control"
                            placeholder="Nama Pegawai">
                    </div>

                    <div id="formkantor" class="form-group">
                        <label>NP Pegawai</label>
                        <input type="text" name="np_pegawai" id="np_pegawai" class="form-control"
                            placeholder="Nomor Pegawai">
                    </div>



                </div>
                <!-- no surat -->
                <div class="col-md-6"> 
                    <div id="formkantor" class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="email">
                    </div>
                    <div id="formkantor" class="form-group">
                        <label>Unit Kerja</label>
                        <select name="unit_kerja" id="unit_kerja" class="form-control select2bs4" style="width: 100%;">
                            <option value="" disabled selected>-</option>
                            <option value="pengadaan">Unit Pengadaan Jasa</option>
                            <option value="k3">Unit K3</option>

                        </select>
                    </div>
                </div>
        </div>
        <div class="box-footer text-center">

            <button type="submit" name="add" id="add" class="btn btn-success "><i class="fa  fa-save"></i>
                Simpan</button>

        </div>
        </form>
    </div>

</div>
<!-- /.box-body -->
</div>

<div class="card card-info">
    <div class="card-header">
        <button type="button" name="refresh" id="refresh" class="btn btn-success "><i class="fa  fa-refresh"></i>
            Refresh</button>
        <button type="button" name="refresh" id="refresh" class="btn btn-success "><i class="fa  fa-refresh"></i>
            Download Excel</button>
    </div>
    <div class="card-body">
        <table id="daftar_email" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Nama Pegawai</th>
                    <th>Nomor Pegawai</th>
                    <th>Unit Kerja</th>
                    <th>Email</th>
                    <th>Dibuat</th>
                    <th>Action</th>

                </tr>
            </thead>

            </tbody>
        </table>
    </div>
</div>

<!-- modal -->
@include('manageuser.edit')
@include('layouts.confimdelete')



</section>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#nonb3').hide()
        // $('.select2').select2()

        $('#refresh').click(function () {

            $('#daftar_email').DataTable().ajax.reload();

        })
        var table = $('#daftar_email').DataTable({
            processing: true,
            serverSide: true,
            // scrollCollapse: true,
            // scrollX: true,
            columnDefs: [{
                    className: 'text-center',
                    targets: [1, 2, 3]
                },
                {
                    className: 'dt-body-nowrap',
                    targets: -1
                }
            ],
            language: {
                emptyTable: "Tidak Ada Data"
            },
            search: {
                caseInsensitive: false
            },
            ajax: {
                url: "{{ route('user_email.data') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: function (d) {



                }
            },
            bFilter: false,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama',
                    name: 'nama',

                },
                {
                    data: 'np',
                    name: 'np'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan',
                    render: function (data, type, row) {
                        if(data=='pengadaan'){
                            return 'Unit Pengadaan Jasa'

                        }else if(data=='k3'){
                            return 'Unit K3'
                        }else{
                            return ''
                        }

}

                },
                // {
                //     data: 'satuan',
                //     name: 'satuan'
                // },
                {
                    data: 'email',
                    name: 'email',

                },


                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function (data, type, row) {

                        return moment(data).format('DD/MM/YYYY');

                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false

                }
            ]
        });
        $('#save_email').on('submit', function (event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('user_email.simpan') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                    $('#add').text('menyimpan...');
                },
                success: function (data) {
                    var html = '';
                    if (data.errors) {
                        toastr.error(data.errors, 'Gagal Tersimpan', {
                            timeOut: 5000
                        });
                        $('#save_email')[0].reset();
                        $('#action_button').val('Simpan');
                    }
                    if (data.success) {
                        toastr.success(data.success, 'Tersimpan', {
                            timeOut: 5000
                        });
                        $('#save_email')[0].reset();
                        $('select[name="unit_kerja"]').find('option[value=""]').attr("selected", true).change();
                        $('#add').text('Simpan');
                        $('#daftar_email').DataTable().ajax.reload();
                        
                    }
                }
            });

        })



        

        var user_id;
        $('body').on('click', '.edit', function () {

            var id = $(this).data('id');
            var data = table.row($(this).closest('tr')).data();
            $('select[name="unit_edit"]').find('option[value="' +data.keterangan + '"]').attr("selected", true).change();
           
            $('#nama_edit').val(data.nama)
            $('#np_edit').val(data.np) 
            $('#email_edit').val(data.email) 
            $('#id_user').val(data.id)  
            $('#modelEdit').modal(); 
        });

        $('#edit_data').on('submit', function (event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('user_email.update') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                    $('#simpan').text('menyimpan...');
                },
                success: function (data) {
                    var html = '';
                    if (data.errors) {
                        toastr.error(data.errors, 'Gagal tersimpan', {
                            timeOut: 5000
                        });
                        $('#form_result').html(html);
                        $('#action_button').val('Simpan');
                    }
                    if (data.success) {
                        toastr.success(data.success, 'Tersimpan', {
                            timeOut: 5000
                        });
                        $('#modelEdit').modal('toggle'); 
                        $('#edit_data')[0].reset();
                        $('select[name="unit_edit"]').find('option[value=""]').attr("selected", true).change();
                        $('#simpan').text('Simpan');
                        $('#daftar_email').DataTable().ajax.reload();
                    }
                }
            });

        })

        $(document).on('click', '.delete', function () {
            user_id = $(this).data('id');
            $("#success-alert").hide();
            var data = table.row($(this).closest('tr')).data();

            $('#confirmModal').modal();

        });
        $('#ok_button').click(function () {
            $.ajax({
                url: "/manage/destroy/" + user_id,
                beforeSend: function () {
                    $('#ok_button').text('Deleting...');
                },
                success: function (data) {
                    toastr.success(data.success, 'Terhapus', {
                        timeOut: 5000
                    });
                    setTimeout(function () {
                        $('#ok_button').text('OK');
                        $('#confirmModal').modal('hide');
                        $('#daftar_email').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });



    })

</script>
@endsection
