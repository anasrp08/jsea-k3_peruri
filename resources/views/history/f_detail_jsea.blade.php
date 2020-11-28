<div class="col-md-4">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
         

        <h3 class="profile-username text-center" id='nama_tender'>-</h3>

                <b><p class="text-muted text-center" id="vendor">-</p></b>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>No. Tender</b> <a class="float-right" id='no_tender'>-</a>
                  </li>
                  <li class="list-group-item">
                    <b>No. PR</b> <a class="float-right" id='no_pr'>-</a>
                  </li>
                  <li class="list-group-item">
                    <b>No. JSEA</b>
                    <a class="float-right" id='no_jsea'>-</a> 
                  </li>
                  <li class="list-group-item">
                    <b>Tgl Dibuat</b> <a class="float-right" id='tgl_dibuat'>-</a>
                    {{-- <b>Tgl Dibuat</b> <a class="float-right" id='tgl_dibuat'>{{ date('d-M-y', strtotime($dataDetail->tgl_tender)) }}</a> --}}
                  </li>
                  <li class="list-group-item">
                    <b>Tgl Updated</b> <a class="float-right" id='tgl_updated'>-</a>
                  </li> 
                  <li class="list-group-item">
                    <b>Tgl Permintaan</b> <a class="float-right" id='tgl_dikirim'>-</a>
                  </li>
                  
                  <li class="list-group-item">
                    <b>Tgl Review K3</b> <a class="float-right" id='tgl_review'>-</a>
                  </li>
                
                  <li class="list-group-item">
                    <b>Status Tender</b> <span id='status_tender' class="float-right badge badge-info">-</span>
                  </li>
                  <li class="list-group-item">
                    <b>Status</b> <span id='status_review' class="float-right badge badge-info">-</span>
                  </li>
                  
                  <input type="hidden" id='idTender' name='idTender' value='{{$id_tender_db}}'/>
                  <li class="list-group-item">
                  <div class="form-group"> 
                    <label>Nomor Pegawai Pemeriksa</label>
                    <input type="text" id="np1" name="np" class="form-control float-right" autocomplete="off">
                </div>
                 <div class="form-group">
                     <label>Nama Pegawai Pemeriksa</label>
                     <input type="text" id="nama_pegawai1" name="nama_pegawai" class="form-control float-right" autocomplete="off">
                 </div>
                  </li>
                </ul>

               
               
                <div class="justify-content-between">
                  
                  <button type="submit" id="terima" class="btn btn-success btn-block btn-flat">Terima</button>
                   
  
              </div>

         
      </div>
      <!-- /.card-body -->
    </div> 
     
  </div>
  <!-- /.col -->
  <div class="col-md-8">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" id="tab_activity" href="#activity" data-toggle="tab">Form JSEA</a></li>
          <li class="nav-item"><a class="nav-link" id="tab_setting" href="#settings"   data-toggle="tab">Buat Memo Evaluasi</a></li>
          <li class="nav-item"><a class="nav-link" id="tab_timeline" href="#timeline"  data-toggle="tab">Hasil Evaluasi JSEA</a></li>
          
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
          
          
            <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div id="pdfviewer" style="width:100%; height:600px;"></div>
            <!-- /.post -->
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <button type="submit" id="generate_pdf" class="btn btn-primary btn-block btn-flat">Generate pdf</button>
            {{-- <div id="hasilevaluasi" style="width:100%; height:600px;"></div> --}}
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="settings">
            <form method="post" id="save_evaluasi" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="text-center">
                                <label>1. Pelaksanaan Pekerjaan</label>
                            </div>
                            <textarea id='pelaksanaan' name='pelaksanaan' class="review textarea" placeholder="Place some text here"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <label>2. Alat Pelindung Diri</label>
                            </div>
                            <textarea id='pelindung' name='pelindung' class="review textarea" placeholder="Place some text here"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <label>3. Peralatan Kerja</label>
                            </div>
                            <textarea id='peralatan' name='peralatan' class="review textarea" placeholder="Place some text here"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                        <div class="form-group">
                           <div class="text-center">
                               <label>4. Bahan / Material</label>
                           </div>
                           <textarea id='bahan' name='bahan' class="review textarea" placeholder="Place some text here"
                               style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                       </div>
            
                        
                        
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                           <div class="text-center">
                               <label>5. Urutan Pelaksanaan Kerja</label>
                           </div>
                           <textarea id='urutan' name='urutan' class="review textarea" placeholder="Place some text here"
                               style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                       </div>
                        <div class="form-group">
                            <div class="text-center">
                                <label>6. Bahaya - Resiko / Aspek - Dampak</label>
                            </div>
                            <textarea id='bahaya' name='bahaya' class="review textarea" placeholder="Place some text here"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                       
                        <div class="form-group">
                            <div class="text-center">
                                <label>7. Tindakan Pengendalian</label>
                            </div>
                            <textarea id='pengendalian' name='pengendalian' class="review textarea" placeholder="Place some text here"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                        <div class="form-group">
            
                           <label>Nomor Pegawai Pemeriksa</label>
                           <input type="text" id="np" name="np" class="form-control float-right" autocomplete="off">
                       </div>
                        <div class="form-group">
                            <label>Nama Pegawai Pemeriksa</label>
                            <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control float-right" autocomplete="off">
                        </div>
            
                    </div> 
                </div>
            
                <div class="form-group">
                <input type="hidden" name="id_tender_db" id="id_tender_db" value="{{$id_tender_db}}">
                <input type="hidden" name="action" id="action" value="">
                <input type="hidden" name="status_data" id="status_data" value="">
               </div>
                <div class="text-center">
                    <input type="submit" name="simpan" id="simpan" class="btn btn-primary" value="Simpan" />
                    <input type="submit" name="send" id="send" class="btn btn-success" value="Posting Evaluasi" />
                </div>
                </div>
            
                <div class="box-footer">
            
                    {{-- <button id="submit" type="submit" class="btn btn-primary" >Submit</button> --}}
                </div>
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>

  {{-- @include('history.f_pdfViewer') --}}