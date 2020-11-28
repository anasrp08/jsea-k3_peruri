<div class="modal fade" id="modelEdit">
  <div class="modal-dialog modal-lg" style="width:70%;">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Detail Data User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body"> 
            <form method="post" id="edit_data" enctype="multipart/form-data">
              @csrf
              <div class="col-md-4">
                <div id="formkantor" class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" name="nama_edit" id="nama_edit" class="form-control" placeholder="Nama Pegawai">
                </div>

                <div id="formkantor" class="form-group">
                    <label>NP Pegawai</label>
                    <input type="text" name="np_edit" id="np_edit" class="form-control" placeholder="Nomor Pegawai">
                </div>
                <div id="formkantor" class="form-group">
                    <label>Unit Kerja</label>
                    <select name="unit_edit" id="unit_edit" class="form-control select2bs4"
                        style="width: 100%;">
                        {{-- <option value="" disabled selected>-</option> --}}
                        <option value="pengadaan">Unit Pengadaan Jasa</option>
                        <option value="k3">Unit K3</option>
                       
                    </select>
                </div>
                <input type="hidden" name="id_user" id="id_user" class="form-control" placeholder="Nama Pegawai">

            </div>
            <!-- no surat -->
            <div class="col-md-4"> 

                <div id="formkantor" class="form-group">
                    <label>Email</label>
                    <input type="text" name="email_edit" id="email_edit" class="form-control" placeholder="email">
                </div>
            </div>
            </div>
            <button  class="btn btn-primary btn-block" id='simpan'><b>Simpan</b></button>
            </form>
             
                
               
              </div>
              <!-- /.card-body -->
            </div>
                   
       
                  {{-- </div> --}}
              {{-- </div> --}}

          {{-- </div> --}}

          {{-- <div class="modal-footer justify-content-between">

              <button type="button" class="btn btn-primary" id="proses">Proses</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div> --}}
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
