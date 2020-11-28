<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
                <h3 class="card-title-center text-center">Daftar Tender</h3>
                <button type="button" name="refresh" id="refresh" class="btn btn-success "><i class="fa fa-sync-alt"></i>
                    Refresh</button>
                {{-- <h5 id='title_konfirmasi' class="card-title-center">Daftar Form JSEA</h5> --}}
               
        </div>
        <div class="card-body">
           
            <table id="tbl_evaluasi" class="table table-bordered table-striped" style="width:100%;" >
                <thead>
                    <tr>
                        <th>No. </th> 
                        <th>No. Tender</th> 
                        <th>No. SPPJ</th> 
                        <th>No. JSEA </th>
                        <th>Nama Tender </th>
                        <th>Status Tender</th>
                        <th>Tgl. Dibuat</th>
                        <th>Tgl. Update</th>
                        <th>Vendor</th>  
                        {{-- <th>File</th>
                        <th>Doc. Upload</th> --}}
                        <th>Status Review</th>
                        {{-- <th>Action</th> --}}
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>
                 
            </table>
        </div>
    </div>
</div>

{{-- tender = prcmts
no tender = prcmts.number
vendor = vendors
no vendor = vendors.code
dokumen umum = prcmt_docs relasi ke prcmts.id --}}

{{-- PLJ/2018/00144

JASA RENOVASI TOILET SBU UANG RI PERUM PERURI KARAWANG

6e965f96-dd6d-4ddc-a2d2-45a8f0ca3b5e
PLJ/2019/00258
JASA PERBAIKAN KAMERA CCTV MONOPOLE

participant_id
86266164-4be6-4fdf-a80e-973fff59ebfe
vendor_id
32ac227a-c0f5-4992-9109-3a3c1a087e1c --}}

{{-- <h4><span style="color: #333333;">Waktu pelaksanaan : 90 (sembilan puluh) hari kalender</span></h4><h4><span style="color: #333333;">​Ket:</span></h4><h4><span style="color: #333333;">​1. Rekanan melampirkan surat penawaran harga berkop perusahaan dalam attachment. Apabila terdapat perbedaan maka yang digunakan data yang diinput ke aplikasi e-procurement</span></h4><h4><span style="color: #333333;">​2. BQ/Spesifikasi teknis, TOR dan Form JSEA (Job Safety Environment Analysis) terlampir pada dokumen umum</span></h4><h4><span style="color: #333333;">3. Semua Pajak dan Retribusi yang Harus Dibayar oleh Penyedia Jasa dalam Pelaksanaan Kontrak serta Pengeluaran Lainnya Sudah Termasuk dalam Harga Penawaran, Termasuk Biaya Pembuatan ID Card Sebesar Rp 50.000,-/Orang</span></h4> --}}



{{-- 5ffa2402-cd19-44aa-9ec7-5fd2817adfff
PLJ/2019/00254
JASA RENOVASI RENOVASI RUANG TEKNISI MEKANIKAL DAN ELEKTRIKAL DEP.HARTEK PRODUKSI UANG LOGAM --}}