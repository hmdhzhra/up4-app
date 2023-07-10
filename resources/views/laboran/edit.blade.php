<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- ... -->
<!-- Modal Edit Data -->
<div class="modal fade" id="modal-status{{$penugasan->id}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Status</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="{{route('penjadwalan.status_material', $penugasan->id)}}" method="POST">
                @csrf
                {{ method_field('POST') }}
                <div class="modal-body">
                
                    <div class="card-body">

                    <div class="form-group">
                            <label>Status Material Pengujian</label>
                            <select class="form-control" id="status_material" name="status_material">
                              <option>--Pilih Status--</option>
                              <option value="Menunggu Material Pengujian">Menunggu Material Pengujian</option>
                              <option value="Material Pengujian Diterima">Material Pengujian Diterima</option>
                            </select>
                      </div>
                        <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan')is-invalid @enderror" id="keterangan" name="keterangan" placeholder="Masukkan keterangan jika diperlukan" value="{{ old('keterangan') }}">
                        @error('no_order')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->