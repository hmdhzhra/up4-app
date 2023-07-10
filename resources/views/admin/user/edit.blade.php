<!-- Modal Edit Data -->
<div class="modal fade" id="modal-edit{{$user->id}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

        <form action="{{route('user.update' , $user->id)}}" method="POST">
            {{ method_field('PATCH') }}
            @csrf
            <div class="modal-body">
            
                <div class="card-body">
                  <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}">
                  </div>
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                  </div>
                  <div class="form-group">
                    <label for="password">Password Confirmation</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password">
                  </div>
                  <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" id="role" name="role">
                          <option value="admin" @if($user->role == "admin") selected @endif >Admin</option>
                          <option value="pelanggan" @if($user->role == "pelanggan") selected @endif>Pelanggan</option>
                          <option value="bendahara" @if($user->role == "bendahara") selected @endif>Bendahara</option>
                          <option value="tatausaha" @if($user->role == "tatausaha") selected @endif>Tata Usaha</option>
                          <option value="laboran" @if($user->role == "laboran") selected @endif>Laboran</option>
                          <option value="bidang" @if($user->role == "bidang") selected @endif>Bidang</option>
                        </select>
                  </div>
                    <div class="form-group" id="select-laboran">
                        <label>Tim Laboran</label>
                        <select class="form-control" id="jenis_lab" name="jenis_lab">
                          <option value="">Pilih Jenis Lab</option>
                          <option value="Tim Campuran Beraspal">Campuran Beraspal</option>
                          <option value="Tim Aspal">Aspal</option>
                          <option value="Tim Penyelidikan Lapangan">Penyelidikan Lapangan</option>
                          <option value="Tim Agregat, Tanah, dan Beton">Agregat, Tanah, dan Beton</option>
                          <option value="Tim Pengukuran">Pengukuran</option>
                        </select>
                      </div>

                    <div class="form-group" id="select-bidang">
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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
  $(document).on('DOMContentLoaded', function() {
    // Ambil elemen input role
    var roleInput = $('#role');
    // Ambil elemen input select-laboran
    var selectLaboran = $('#select-laboran');
    // Ambil elemen input select-bidang
    var selectBidang = $('#select-bidang');

    // Tambahkan event listener 'change' pada input role
    roleInput.on('change', function() {
      // Periksa nilai input role
      if (roleInput.val() === 'laboran') {
        // Jika laboran dipilih, tampilkan select-laboran
        selectLaboran.show();
        // Sembunyikan select-bidang
        selectBidang.hide();
      } else if (roleInput.val() === 'bidang') {
        // Jika bidang dipilih, tampilkan select-bidang
        selectBidang.show();
        // Sembunyikan select-laboran
        selectLaboran.hide();
      } else {
        // Jika pilihan lain dipilih, sembunyikan kedua select
        selectLaboran.hide();
        selectBidang.hide();
      }
    });

    // Inisialisasi tampilan berdasarkan nilai awal input role
    if (roleInput.val() === 'laboran') {
      selectLaboran.show();
    } else if (roleInput.val() === 'bidang') {
      selectBidang.show();
    }
  });
</script>
