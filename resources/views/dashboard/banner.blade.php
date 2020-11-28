
     <!-- TABLE: LATEST ORDERS -->
     <section class="col-lg-12 connectedSortable">
      <div class="row">
        @if (Auth::check())
          @role(['admin','pengadaan'])
        <div class="col-lg-3 col-6">
          <!-- small card -->
          
          <div class="small-box bg-info">
            <div class="inner">
              <h3 id='belumreview'>x</h3><sup style="font-size: 20px">Tender Tahun Ini</sup>

              <p>Belum kirim ke K3</p>
            </div>
            <div class="icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            {{-- <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a> --}}
          </div>
        </div>
        @endrole
        @endif
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3 id='jmlhpermintaan'>x</h3><sup style="font-size: 20px">Permintaan</sup>

              <p>Jumlah Seluruh Permintaan Bulan Ini</p>
            </div>
            <div class="icon">
              <i class="fas fa-file"></i>
            </div>
            {{-- <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a> --}}
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3 id='openreview'>x</h3><sup style="font-size: 20px">Permintaan</sup>

              <p>Open Permintaan Review</p>
            </div>
            <div class="icon">
              <i class="fas fa-folder"></i>
            </div>
            {{-- <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>  --}}
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3 id='onprogress'>x</h3><sup style="font-size: 20px">Permintaan</sup>
  
              <p>On Progress</p>
            </div>
            <div class="icon">
              <i class="fas fa-file-signature"></i>
            </div>
            
          </div>
        </div>
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-success" style="height: 7rem;">
          <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Approve</span>
            <span class="info-box-number" id='approve'>x</span>

            <div class="progress">
              <div class="progress-bar" id='progbarapprove' style="width: 70%"></div>
            </div>
            <span class="progress-description" id='persenapprove'>
              70% 
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-md-3 col-sm-6 col-12" >
        <div class="info-box bg-danger" style="height: 7rem;">
          <span class="info-box-icon"><i class="fas fa-comments"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Evaluasi</span>
            <span class="info-box-number" id='evaluasi'>x</span>

            <div class="progress">
              <div class="progress-bar" id='progbarevaluasi' style="width: 70%"></div>
            </div>
            <span class="progress-description" id='persenevaluasi'>
              70%
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      @if (Auth::check())
      @role(['admin','k3'])
      <div class="col-md-3 col-sm-6 col-12" >
        <div class="info-box bg-success" style="height: 7rem;">
          <span class="info-box-icon"><i class="fas fa-clipboard-check"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Diterima Pengadaan</span>
            <span class="info-box-number" id='diterimapengadaan'>x</span>

            <div class="progress">
              <div class="progress-bar" id='progbarterima' style="width: 70%"></div>
            </div>
            <span class="progress-description" id='persenterima'>
              70%
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      @endrole
      @endif
      
      <!-- /.col -->
    </div>
      </div>

     </section>