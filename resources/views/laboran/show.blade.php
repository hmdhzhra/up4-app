<!-- Modal Show Data -->
<div class="modal fade" id="modal-show{{$penugasan->id}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Data Pengujian</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">total
                <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$penugasan->pengujian->id}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="no_skrd">No. SKRD</label>
                        <input type="text" class="form-control" id="no_skrd" name="no_skrd" value="{{$penugasan->pengujian->no_skrd}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="no_order">No. Order</label>
                        <input type="text" class="form-control" id="no_order" name="no_order" value="{{$penugasan->pengujian->no_order}}" readonly>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap">Nama</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{$penugasan->pengujian->pelanggan->nama_lengkap}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap">No. Telepon</label>
                        <input type="text" class="form-control" id="telp" name="telp" value="{{$penugasan->pengujian->pelanggan->telp}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_pr">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama_proyek" name="nama_pr" value="{{$penugasan->pengujian->pelanggan->nama_pr}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_proyek">Nama Proyek</label>
                        <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" value="{{$penugasan->pengujian->nama_proyek}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="lokasi_proyek">Lokasi Proyek</label>
                        <input type="text" class="form-control" id="lokasi_proyek" name="lokasi_proyek" value="{{$penugasan->pengujian->lokasi_proyek}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="bidang">Bidang</label>
                        <input type="text" class="form-control" id="bidang" name="bidang" value="{{$penugasan->pengujian->bidang}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Layanan</label>
                        <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="{{ $penugasan->pengujian->layanan->jenisLayanan->nama_layanan}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total">Total Bayar</label>
                        <input type="text" class="form-control" id="total" name="total" value="{{$penugasan->pengujian->layanan->total}}" readonly>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
