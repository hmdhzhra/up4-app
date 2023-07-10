<!-- Modal Edit Data -->
<div class="modal fade" id="modal-edit{{ $pengujian->id }}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Validasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="{{route('validasi.update', $pengujian->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="modal-body">
                
                    <div class="card-body">
                      <div class="form-group">
                        <label for="no_skrd">No. SKRD</label>
                        <input type="text" class="form-control @error('no_skrd')is-invalid @enderror" id="no_skrd" name="no_skrd" placeholder="Masukkan No. SKRD" value="{{ $pengujian->no_skrd ?? old('no_skrd') }}">
                        @error('no_skrd')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="no_skrd">No. Order</label>
                        <input type="text" class="form-control @error('no_order')is-invalid @enderror" id="no_order" name="no_order" placeholder="Masukkan No. Order" value="{{ $pengujian->no_order ?? old('no_order') }}">
                        @error('no_order')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <div class="form-group">
                            <label>Validasi</label>
                            <select class="form-control" id="validasi" name="validasi">
                              <option>--Pilih Validasi--</option>
                              <option>Validasi diterima</option>
                              <option>Validasi dibatalkan</option>
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

                      <div class="form-group">
                            <label for="berkas_skrd">SKRD</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="berkas_skrd" name="berkas_skrd">
                                    <label class="custom-file-label" for="berkas_skrd">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
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
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
            // Ambil elemen-elemen input file
            var fileInputs = document.querySelectorAll('input[type="file"]');

            // Loop melalui setiap input file
            fileInputs.forEach(function(input) {
            // Tambahkan event listener 'change' untuk setiap input
                input.addEventListener('change', function() {
                // Perbarui label dengan nama file yang dipilih
                var fileName = this.files[0].name;
                var label = this.nextElementSibling;
                label.innerText = fileName;
            });
            });

            document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen input validasi
            var validasiInput = document.getElementById('validasi');
            // Ambil elemen input keterangan
            var keteranganInput = document.getElementById('keterangan');

              // Tambahkan event listener 'change' pada input validasi
              validasiInput.addEventListener('change', function() {
                // Periksa nilai input validasi
                if (validasiInput.value === 'Validasi dibatalkan') {
                  // Jika Validasi dibatalkan dipilih, aktifkan input keterangan
                  keteranganInput.disabled = false;
                } else {
                  // Jika --Pilih Validasi-- atau Validasi diterima dipilih, nonaktifkan input keterangan dan hapus nilainya
                  keteranganInput.disabled = true;
                  keteranganInput.value = '';
                }
              });
            });

      </script>