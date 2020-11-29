<!-- TABLE: LATEST ORDERS -->
<div class="card">

    <div class="card-body">

        <div class="row">
            <div class="col-md-6">
              <div class="row">
                @if (Auth::check())
                @role(['admin','pengadaan'])
               
                    <div class="col-lg-6 col-6">
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
                    <div class="col-lg-6 col-6">
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
                    <div class="col-lg-6 col-6">
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
                    <div class="col-lg-6 col-6">
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
                    <div class="col-md-6 col-sm-6 col-12">
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
                    <div class="col-md-6 col-sm-6 col-12">
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
                    <div class="col-md-6 col-sm-6 col-12">
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

            <div class="col-md-6">
                <div class="row">
                    {{-- <div class="col-md-12">
                        <div class="form-group">

                            <label>Periode</label>
                            <input type="text" id="period" name="period" class="entridate form-control float-right"
                                autocomplete="off">
                        </div>
                    </div> --}}
                    <div class="col-md-12">
                    <div class="form-group">
                      <label>Tahun</label>
                      <select name="period" id="period" class="form-control select2bs4" style="width: 100%;">
                          {{-- <option value="" disabled selected>-Tahun-</option> --}}
                          <option value="2020" selected>2020</option>
                          <option value="2021">2021</option>
                          <option value="2022">2022</option>
                          <option value="2023">2023</option>
                          <option value="2024">2024</option>
                          <option value="2025">2025</option>
                          {{-- @foreach($penghasilLimbah as $data)
                          <option value="{{$data->id}}">{{$data->seksi}}</option>
                          @endforeach --}}
                      </select>
                  </div>
                    </div>


                </div>
                <canvas id="permintaan" style="height: 100px;"></canvas>
            </div>
        </div>

    </div>
