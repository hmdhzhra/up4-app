<!-- Modal Tambah Data -->
<div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="{{route('user.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                
                    <div class="card-body">
                      <div class="form-group">
                        <label for="username">User Name</label>
                        <input type="text" class="form-control @error('username')is-invalid @enderror" id="username" name="username" placeholder="Masukkan User Name" required value="{{ old('username') }}">
                      </div>
                      <!-- Error Message -->
                      @error('username')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                      @enderror
    
                      
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control @error('email')is-invalid @enderror" id="email" name="email" placeholder="Masukkan Email" required value="{{ old('email') }}">
                      </div>
                      <!-- Error Message -->
                      @error('email')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                      @enderror
    
    
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password')is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password">
                      </div>
                      <div class="form-group">
                        <label for="password">Password Confirmation</label>
                        <input type="password" class="form-control @error('password_confirmation')is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password">
                      </div>
                      <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" id="role" name="role">
                          <option>admin</option>
                          <option>pelanggan</option>
                          <option>bendahara</option>
                          <option>tatausaha</option>
                          <option>laboran</option>
                          <option>bidang</option>
                        </select>
                      </div>
                      <div class="form-group" id="select-laboran" style="display: none;">
                        <label>Tim Laboran</label>
                        <select class="form-control" id="jenis_lab" name="jenis_lab">
                          <option value="">Pilih Jenis Lab</option>
                          <option value="Tim Campuran Beraspal">Tim Campuran Beraspal</option>
                          <option value="Tim Aspal">Tim Aspal</option>
                          <option value="Tim Penyelidikan Lapangan">Tim Penyelidikan Lapangan</option>
                          <option value="Tim Agregat, Tanah, dan Beton">Tim Agregat, Tanah, dan Beton</option>
                          <option value="Tim Pengukuran">Tim Pengukuran</option>
                        </select>
                      </div>

                    <div class="form-group" id="select-bidang" style="display: none;">
                      <label>Bidang</label>
                      <select class="form-control" id="jenis_bidang" name="jenis_bidang">
                        <option value="">Pilih Jenis Bidang</option>
                        <option value="Jalan dan Jembatan">Jalan dan Jembatan</option>
                        <option value="Prasarana Sarana Utilitas Kota">Prasarana Sarana Utilitas Kota</option>
                        <option value="Penerangan Jalan Sarana Umum">Penerangan Jalan Sarana Umum</option>
                        <option value="Kelengkapan Jalan">Kelengkapan Jalan</option>
                        <option value="SDBM Jakarta Timur">SDBM Jakarta Timur</option>
                        <option value="SDBM Jakarta Barat">SDBM Jakarta Barat</option>
                        <option value="SDBM Jakarta Selatan">SDBM Jakarta Selatan</option>
                        <option value="SDBM Jakarta Pusat">SDBM Jakarta Pusat</option>
                        <option value="SDBM Jakarta Utara">SDBM Jakarta Utara</option>
                        </select>
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
        document.addEventListener('DOMContentLoaded', function() {
          // Ambil elemen input role
          var roleInput = document.getElementById('role');
          // Ambil elemen input select-laboran
          var selectLaboran = document.getElementById('select-laboran');
          // Ambil elemen input select-bidang
          var selectBidang = document.getElementById('select-bidang');

          // Tambahkan event listener 'change' pada input role
          roleInput.addEventListener('change', function() {
            // Periksa nilai input role
            if (roleInput.value === 'laboran') {
              // Jika laboran dipilih, tampilkan select-laboran
              selectLaboran.style.display = 'block';
              // Sembunyikan select-bidang
              selectBidang.style.display = 'none';
            } else if (roleInput.value === 'bidang') {
              // Jika bidang dipilih, tampilkan select-bidang
              selectBidang.style.display = 'block';
              // Sembunyikan select-laboran
              selectLaboran.style.display = 'none';
            } else {
              // Jika pilihan lain dipilih, sembunyikan kedua select
              selectLaboran.style.display = 'none';
              selectBidang.style.display = 'none';
            }
          });
        });
      </script>