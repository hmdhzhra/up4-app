<!-- Modal Show Data -->
<div class="modal fade" id="modalBerkas-show{{$pengujian->id}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Berkas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="{{route('validasi_berkas', $pengujian->id)}}" method="POST"">
                @csrf
                {{ method_field('POST') }}
            <div class="modal-body">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Berkas SP : </th>
                                <td>
                                    <a href="{{ asset($pengujian->berkas_sp) }}" class="btn btn-primary" target="_blank">Tampilkan</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Berkas SPMK : </th>
                                <td>
                                    @if($pengujian->berkas_spmk)
                                        <a href="{{ asset($pengujian->berkas_spmk) }}" class="btn btn-primary" target="_blank">Tampilkan</a>
                                    @else
                                        <p>Tidak ada berkas SPMK</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Berkas KTP : </th>
                                <td>
                                    <a href="{{ asset($pengujian->berkas_ktp) }}" class="btn btn-primary" target="_blank">Tampilkan</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Berkas Gambar : </th>
                                <td>
                                    @if($pengujian->berkas_gambar)
                                        <a href="{{ asset($pengujian->berkas_gambar) }}" class="btn btn-primary" target="_blank">Tampilkan</a>
                                    @else
                                        <p>Tidak ada berkas gambar</p>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="form-group">
                            <label>Validasi Berkas</label>
                            <select class="form-control" id="validasi" name="validasi">
                              <option>--Pilih Validasi--</option>
                              <option value="Berkas Lengkap">Berkas Lengkap</option>
                              <option value="Berkas Tidak Lengkap">Berkas Tidak Lengkap</option>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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

            // document.addEventListener('DOMContentLoaded', function() {
            // // Ambil elemen input validasi
            // var validasiInput = document.getElementById('validasi');
            // // Ambil elemen input keterangan
            // var keteranganInput = document.getElementById('keterangan');

            //   // Tambahkan event listener 'change' pada input validasi
            //   validasiInput.addEventListener('change', function() {
            //     // Periksa nilai input validasi
            //     if (validasiInput.value === 'Validasi dibatalkan') {
            //       // Jika Validasi dibatalkan dipilih, aktifkan input keterangan
            //       keteranganInput.disabled = false;
            //     } else {
            //       // Jika --Pilih Validasi-- atau Validasi diterima dipilih, nonaktifkan input keterangan dan hapus nilainya
            //       keteranganInput.disabled = true;
            //       keteranganInput.value = '';
            //     }
            //   });
            // });

      </script>
