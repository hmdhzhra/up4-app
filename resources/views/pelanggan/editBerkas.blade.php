<!-- Modal Edit Data -->
<div class="modal fade" id="modal-edit{{ $pengujian->id }}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Berkas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="{{route('permohonan.update', $pengujian->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="modal-body">

                <label>Masukkan berkas yang salah/kurang sesuai keterangan! (file dalam bentuk pdf)</label><br>
                <br>
                <div class="form-group row">

                    <div class="col-sm-6">
                    <label for="berkas_sp">Surat Permohonan</label>
                    @error('berkas_sp')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    <div class="input-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input @error('berkas_sp') is-invalid @enderror" id="berkas_sp" name="berkas_sp" onchange="updateFileName('berkas_sp')">
                        <label class="custom-file-label" for="berkas_sp">Choose file</label>
                        </div>
                        <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    <small class="text-muted">WAJIB</small>
                    </div>

                    <div class="col-sm-6">
                    <label for="berkas_spmk">SPMK/ E-Purchasing</label>
                    <div class="input-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input @error('berkas_spmk') is-invalid @enderror" id="berkas_spmk" name="berkas_spmk">
                        <label class="custom-file-label" for="berkas_spmk">Choose file</label>
                        </div>
                        <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    <small class="text-muted">wajib untuk proyek Dinas Bina Marga dan Suku Dinas Bina Marga</small>
                    @error('berkas_spmk')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                    <label for="berkas_ktp">KTP</label>
                    <div class="input-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input @error('berkas_ktp') is-invalid @enderror" id="berkas_ktp" name="berkas_ktp">
                        <label class="custom-file-label" for="berkas_ktp">Choose file</label>
                        </div>
                        <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    <small class="text-muted">WAJIB</small>
                    @error('ktp')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                    <label for="berkas_gambar">Gambar</label>
                    <div class="input-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input @error('berkas_gambar') is-invalid @enderror" id="berkas_gambar" name="berkas_gambar">
                        <label class="custom-file-label" for="berkas_gambar">Choose file</label>
                        </div>
                        <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    <small class="text-muted">wajib untuk penyelidikan lapangan dan pengukuran</small>
                    @error('berkas_gambar')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>


                    </div>
                </div>
                
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
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