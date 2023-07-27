@include('layouts.main.header')

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar.pelanggan')
    <!-- /.sidebar -->
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Permohonan Pengujian</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        @if(session()->has('toast_success'))
          <div class="container-fluid">
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('toast_success') }}
            </div>
          </div>
        @elseif(session()->has('toast_error'))
          <div class="container-fluid">
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('toast_error') }}
            </div>
          </div>
        @endif

        <!-- FORM -->
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Permohonan Pengujian</h3>
            </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form action="{{route('permohonan.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-body">

                  <div class="form-group">
                    <label for="nama_proyek">Nama Proyek</label>
                    <input type="text" class="form-control @error('nama_proyek') is-invalid @enderror" id="nama_proyek" name="nama_proyek" placeholder="Masukkan Nama Proyek" value="{{ old('nama_proyek') }}" required>
                    @error('nama_proyek')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="lokasi_proyek">Lokasi Proyek</label>
                    <input type="text" class="form-control @error('lokasi_proyek')is-invalid @enderror" id="lokasi_proyek" name="lokasi_proyek" placeholder="Masukkan Lokasi Proyek" value="{{ old('lokasi_proyek') }}" required>
                    @error('lokasi_proyek')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Bidang / Sudin / Umum :</label><br>
                    
                    <span id="radiobutt">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" value="Jalan dan Jembatan" checked><td>&nbsp;&nbsp;</td>Jalan dan Jembatan<br>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" value="Prasarana Sarana Utilitas Kota"><td>&nbsp;&nbsp;</td>Prasarana Sarana Utilitas Kota<br>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" value="Penerangan Jalan Sarana Umum"><td>&nbsp;&nbsp;</td>Penerangan Jalan Sarana Umum<br>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" value="Kelengkapan Jalan"><td>&nbsp;&nbsp;</td>Kelengkapan Jalan<br>
                          </div>
                        </div> <!-- /.col-sm-4 -->

                        <div class="col-sm-4">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" value="SDBM Jakarta Timur"><td>&nbsp;&nbsp;</td>SDBM Jakarta Timur<br>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" value="SDBM Jakarta Barat"><td>&nbsp;&nbsp;</td>SDBM Jakarta Barat<br>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" value="SDBM Jakarta Selatan"><td>&nbsp;&nbsp;</td>SDBM Jakarta Selatan<br>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" value="SDBM Jakarta Pusat"><td>&nbsp;&nbsp;</td>SDBM Jakarta Pusat<br>
                          </div>
                        </div><!-- /.col-sm-4 -->

                        <div class="col-sm-4">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" value="SDBM Jakarta Utara"><td>&nbsp;&nbsp;</td>SDBM Jakarta Utara<br>
                            <input class="form-check-input" type="radio" name="radio1" id="tombol_swasta" value="Swasta"><td>&nbsp;&nbsp;</td>Swasta<br>
                          </div>
                        <div><!-- /.col-sm-4 -->
                        <div>
                          <input type="text" name="radio_swasta" id="textbox1" disabled = "true"/>
                        </div>
                      </div> <!-- /.row -->
                      
                    </span>   
                  </div> <!-- /.form-group --> 
                
                </div><!-- /.card-body--> 
              </div>

                           <!-- JENIS LAYANAN -->
             <div class="form-group">
               <div class="box box-primary">
                 <table class="table table-bordered table-striped table-responsive" id="table1">
                   <tr>
                     <th>Jenis Layanan</th>
                     <th>Kuantitas</th>
                     <th>Harga</th>
                     <th>Satuan</th>
                     <th>Total</th>
                   </tr>
                   <tr>
                      <td>
                        <div class="form-group">
                          <select id="jenis_id" type="text"  required name="m_harga[id_barang][]" class="form-control js-example-basic-single2" autocomplete="off">
                              <option value=""></option>
                              <?php foreach ($jenis_layanan as $layanan) : ?>
                                <option value="<?php echo $layanan->id ?>" data-satuan="<?php echo $layanan->satuan ?>" data-harga="<?php echo $layanan->harga ?>"><?php echo $layanan->id ?>|<?php echo $layanan->nama_layanan ?> | <?php echo $layanan->satuan ?> | <?php echo $layanan->harga ?></option>
                                  <?php endforeach ?>
                          </select>
                        </div>
                      </td>

                      <td>
                         <input type="text" name="m_harga[jumlah_barang][]" id="p"  onkeyup="getItems()"  class="form-control jumlah-input" autocomplete="off" required>
                      
                      </td>
                      <td>
                        <input type="text" name="m_harga[harga][]" id="harga_3[0]" class="form-control harga-input" autocomplete="off" readonly>

                      </td>
                      <td>
                        <input type="text" name="satuan" id="satuan_3" class="form-control satuan-input" autocomplete="off" readonly>
                      </td>
                      <td>
                        <input type="text" name="tot" id="p"  class="form-control total-input" autocomplete="off" readonly>
                      </td>
                   </tr>
                 </table>
               </div>
             </div>
              
              <!-- FILE INPUT -->
              <label>Berikut ini beberapa syarat yang harus dilampirkan :</label><br>
              <div class="form-group row">

                <div class="col-sm-6">
                  <label for="berkas_sp">Surat Permohonan (Pdf*)</label>
                  <div class="input-group">
                    <div class="custom-file">
                      @error('berkas_sp')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                        @enderror
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
                  <label for="berkas_spmk">SPMK/ E-Purchasing (Pdf*)</label>
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
                  <label for="berkas_ktp">KTP (Pdf*)</label>
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
             <!--/.FILE INPUT -->

             
             
             



            </div>
            <!-- /.card-body -->
            

            <div class="card-footer">
              <button type="button" class="btn btn-default" onclick="window.location.href='{{ route('dashboard') }}'">Cancel</button>
              <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>

          </form>

        </div><!-- /.card Primary -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('assets')}}/plugins/jquery-2.2.3.min.js"></script>
<script src="{{asset('assets')}}/serverside/bootstrap/js/bootstrap.min.js"></script>
<script src="{{asset('assets')}}/serverside/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/serverside/datatables/js/dataTables.bootstrap.min.js"></script>
<script>
  // script untuk radiobutton
  $(document).ready(function() {
      // Mematikan input teks pada awalnya
      $('#textbox1').prop('disabled', true);

      // Mematikan input teks jika pilihan selain "Swasta" dipilih
      $('input[name="radio1"]').not('#tombol_swasta').on('change', function() {
        if ($(this).is(':checked')) {
          $('#textbox1').prop('disabled', true);
        }
      });

      // Mengaktifkan input teks jika pilihan "Swasta" dipilih
      $('#tombol_swasta').on('change', function() {
        if ($(this).is(':checked')) {
          $('#textbox1').prop('disabled', false);
        }
      });

        // Menangkap perubahan opsi pada select
        document.querySelector('.js-example-basic-single2').addEventListener('change', function() {
        // Mengambil opsi yang dipilih
        var selectedOption = this.options[this.selectedIndex];

         // Mendapatkan nilai jenis_id dari opsi yang dipilih
        var jenisId = selectedOption.getAttribute('value');

        // Mendapatkan nilai harga dari opsi yang dipilih
        var harga = selectedOption.getAttribute('data-harga');

        // Mendapatkan nilai satuan dari opsi yang dipilih
        var satuan = selectedOption.getAttribute('data-satuan');

        // Menambahkan nilai id_barang ke input jenis_id
        document.getElementById('jenis_id').value = jenisId;

        // Menambahkan nilai harga ke input harga
        document.getElementById('harga_3[0]').value = harga;

        // Menambahkan nilai satuan ke input satuan
        document.getElementById('satuan_3').value = satuan;
      });

  // Mengambil elemen input jumlah dan menambahkan event listener onkeyup
  var jumlahInput = document.querySelector('.jumlah-input');
    jumlahInput.addEventListener('keyup', getItems);

    function getItems() {
      var sum = 0;
      var jumlahBarangInputs = document.querySelectorAll('[name="m_harga[jumlah_barang][]"]');
      var hargaInputs = document.querySelectorAll('[name="m_harga[harga][]"]');

      for (var i = 0; i < jumlahBarangInputs.length; i++) {
        var qty = +jumlahBarangInputs[i].value;
        var price = +hargaInputs[i].value;
        sum += qty * price;
      }

      $('[name="tot"]').val(sum);
    }

  });

  function convertToRupiah(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
            return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
        }

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
  const placesAutocomplete = places({
  appId: 'OLL6BLBCLJ', // Ganti dengan App ID dari proyek Anda di Algolia
  apiKey: '632a2b3f5ab8356c626748ddcfa17e6d', // Ganti dengan API key "Search-Only" dari proyek Anda di Algolia
  container: document.querySelector('#lokasi_proyek'),
});

placesAutocomplete.on('change', (e) => {
  // Mendapatkan informasi lokasi terpilih
  const location = e.suggestion;
  
  // Gunakan informasi lokasi (misalnya, nama, alamat, kota, dll.) dalam aplikasi Anda
  console.log(location.name);
  console.log(location.value);
  console.log(location.city);
  // ... tambahkan atribut lain yang Anda butuhkan ...
});
placesAutocomplete.on('error', (e) => {
  console.error(e);
});
</script>
@include('layouts.main.footer')
