<div class="modal fade" id="modaldetail">
  <div class="modal-dialog modal-lg" style="width:70%;">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Detail Data Rekanan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body"> 
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                

                <h3 class="profile-username text-center" id='nama_tender'>Nina Mcintire</h3>

                <b><p class="text-muted text-center" id="vendor" >Software Engineer</p></b>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>No. Tender</b> <a class="float-right" id='no_tender'>1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>No. PR</b> <a class="float-right" id='no_pr'>543</a>
                  </li>
                  <li class="list-group-item">
                    <b>No. JSEA</b>  <a class="float-right" id='no_jsea'>-</a>
                  </li>
                  <li class="list-group-item">
                    <b>Tanggal Dibuat</b> <a class="float-right" id='tgl_dibuat'>13,287</a>
                  </li>
                  <li class="list-group-item">
                    <b>Tanggal Updated</b> <a class="float-right" id='tgl_updated'>13,287</a>
                  </li>
                  <li class="list-group-item">
                    <b>Dokumen JSEA</b>
                    <form method="post" id="save_upload" enctype="multipart/form-data">
                      @csrf
                    <input type="file" class="float-right form-control" id='file_jsea' name="file_jsea" accept=".pdf" multiple />
                     
                  <button type="submit" id="down_dok_jsea" class="float-right btn btn-primary"
                      value="Upload">Download</button>
                    
                     
                  </li>
                  <li class="list-group-item">
                    <b>Evaluasi JSEA</b> 
                    
                    <span id='cek_review' class="float-right badge badge-info">Belum Review</span>
                     
                  </li>
                  <li class="list-group-item">
                    <b>Status Tender</b> <span id='status_tender' class="float-right badge badge-info">Belum Review</span>
                  </li>
                  <li class="list-group-item">
                    <b>Tanggal Review</b> <a class="float-right" id='tgl_review'>13,287</a>
                  </li>
                  <li class="list-group-item">
                    <b>Status Review</b> <span id='status_review' class="float-right badge badge-info">Belum Review</span>
                  </li>

                </ul>

                <button  class="btn btn-primary btn-block" id='simpan'><b>Kirim</b></button>
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
