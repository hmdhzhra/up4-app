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
        @endif

        <!-- FORM -->
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Permohonan Pengujian</h3>
            </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form action="#" method="POST">
              @csrf
              @method('PUT')
                <div class="card-body">

                  <div class="form-group">
                    <label for="nama_proyek">Nama Proyek</label>
                    <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" placeholder="Masukkan Nama Proyek" >
                    @error('nama_proyek')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="lokasi_proyek">Lokasi Proyek</label>
                    <input type="text" class="form-control @error('lokasi_proyek')is-invalid @enderror" id="lokasi_proyek" name="lokasi_proyek" placeholder="Masukkan Lokasi Proyek" required>
                    @error('lokasi_proyek')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Bidang / Sudin / Umum :</label><br>
                    
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" value="jalan_jembatan" checked>
                          <label class="form-check-label">Jalan dan Jembatan</label><br>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" value="prasarana_kota">
                          <label class="form-check-label">Prasarana Sarana Utilitas Kota</label><br>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" value="penerangan_jalan">
                          <label class="form-check-label">Penerangan Jalan Sarana Umum</label><br>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" value="kelengkapan_jalan">
                          <label class="form-check-label">Kelengkapan Jalan</label><br>
                        </div>
                      </div> <!-- /.col-sm-4 -->

                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" value="sdbm_timur">
                          <label class="form-check-label">SDBM Jakarta Timur</label><br>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" value="sdbm_barat">
                          <label class="form-check-label">SDBM Jakarta Barat</label><br>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" value="sdbm_selatan">
                          <label class="form-check-label">SDBM Jakarta Selatan</label><br>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" value="sdbm_pusat">
                          <label class="form-check-label">SDBM Jakarta Pusat</label><br>
                        </div>
                      </div><!-- /.col-sm-4 -->

                      <div class="col-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" value="sdbm_utara">
                          <label class="form-check-label">SDBM Jakarta Utara</label><br>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" id="tombol_swasta" value="swasta">
                          <label class="form-check-label">Swasta</label><br>
                        </div>
                      <div><!-- /.col-sm-4 -->
                      <input type="text" name="radio_swasta" id="textbox1" disabled = "true" />
                    
                    </div> <!-- /.row -->
                  </div> <!-- /.form-group --> 
                </div>
              </div>
              
              <!-- FILE INPUT -->
              <label>Berikut ini beberapa syarat yang harus dilampirkan (file bentuk pdf) :</label><br>
              <div class="form-group row">

                <div class="col-sm-6">
                  <label for="exampleInputFile1">Surat Permohonan</label>
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
                  @error('berkas_sp')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
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
             <!--/.FILE INPUT -->


             <div class="box box-success" style="overflow: auto; height:400px;">
                <div class="box-header with-border success">
                    <a id="tambah" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> <b>Tambah</b></a>
                </div>
                <div class="box-body" id="dinamis">
                  <div class="form-group row">
                      <div class="col-sm-12 mb-3 mb-sm-0">
                          <label>Jenis Layanan :</label>
                          <select type="text" name="layanan[]" id="js-example-basic-single" class="form-control select2" autocomplete="off" required>
                            <option value=""></option>
                              <?php foreach ($jenis_layanan as $layanan) : ?>
                                <option value="<?php echo $layanan->id ?>">
                                <?php echo $layanan->nama_layanan ?> | 
                                <?php echo $layanan->harga ?> | 
                                <?php echo $layanan->satuan ?>
                              </option>
                            <?php endforeach ?>
                          </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-6 mb-6 mb-sm-0">
                          <label>Harga :</label>
                          <input type="text" name="harga[]" id="harga" class="form-control harga harga1" autocomplete="off" readonly required>
                          <input type="hidden" name="hargavieww[]" class="form-control out1" readonly>
                      </div>
                      <div class="col-sm-6 mb-6 mb-sm-0">
                          <label>Satuan :</label>
                          <input type="text" name="satuan[]" id="satuan" class="form-control" autocomplete="off" readonly required>
                      </div>
                      <div class="col-sm-6 mb-6 mb-sm-0">
                          <label>Kuantitas :</label>
                          <input type="number" min="0" name="kuantitas[]" class="form-control kuantitas kuantitas1" autocomplete="off" required>
                          <input type="hidden" name="kuantitasvieww[]" class="form-control out2" readonly>
                      </div>
                      <div class="col-sm-6 mb-6d mb-sm-0">
                          <label>Total :</label>
                          <input type="text" name="hasilView" class="form-control hasilView" readonly="">
                          <input type="hidden" name="hasilvieww[]" class="form-control hasilVieww" autocomplete="off">
                          <input type="hidden" name="hasil[]" class="form-control hasil" autocomplete="off">
                      </div>
                  </div>
                </div>
             </div>

             
             <!-- JENIS LAYANAN -->
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

  <script src="{{asset('assets')}}/plugins/jquery-2.2.3.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <script>
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

    $(".harga1").on('keyup', function() {
      var harga = $(this).val();
      $(this).parent().parent().parent().find(".out1").val(harga);
    });

    $(".kuantitas1").on('keyup', function() {
      var kuantitas = $(this).val();
      $(this).parent().parent().parent().find(".out2").val(kuantitas);
    });


    $(document).ready(function() {
        $('#js-example-basic-single').on('change', function() {
            var optionsText = this.options[this.selectedIndex].text;
            // alert(optionsText);
            // console.log(this);
            var harga_  = optionsText.split(" | ");
            var satuan_ = optionsText.split(" | ");

            harga_  = harga_[1];
            satuan_ = satuan_[0];

            $("#harga").val(harga_);
            $("#satuan").val(satuan_);

        });
    });


    $(".kuantitas").on('keyup', function() {
      var kuantitas = $(this).val();
      var harga = $(this).parent().parent().find(".harga").val();

      if (kuantitas != "" && harga != "") {
          var hasil = parseInt(kuantitas) * parseInt(harga);
          $(this).parent().parent().find(".hasil").val(hasil);
          $(this).parent().parent().parent().find(".hasilVieww").val(hasil);
          $(this).parent().parent().find(".hasilView").val(convertToRupiah(hasil));
      } else {
          $(this).parent().parent().find(".hasil").val('');
          $(this).parent().parent().find(".hasilVieww").val('');
          $(this).parent().parent().find(".hasilView").val('');
      }
    });


    function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
    }

    
    $("#tambah").click(function() {
        // alert("The paragraph was clicked.");
        $("#dinamis").append(`
            <div class="box-body" id="dinamis">
                <a class="btn btn-danger btn-hapus btn-xs"><i class="fa fa-remove"></i><b> Hapus</b></a><br><br>
                  <div class="form-group row">
                      <div class="col-sm-12 mb-3 mb-sm-0">
                          <label>Jenis Layanan :</label>
                          <select type="text" name="layanan[]" class="form-control js-example-basic-single2" autocomplete="off">
                            <option value=""></option>
                              <?php foreach ($jenis_layanan as $layanan) : ?>
                                <option value="<?php echo $layanan->id ?>">
                                <?php echo $layanan->nama_layanan ?> | 
                                <?php echo $layanan->harga ?> | 
                                <?php echo $layanan->satuan ?>
                              </option>
                            <?php endforeach ?>
                          </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-6 mb-6 mb-sm-0">
                          <label>Harga :</label>
                          <input type="text" name="harga[]" class="form-control input-hargaa harga2" autocomplete="off" readonly required>
                          <input type="hidden" name="hargavieww[]" class="form-control _out1" readonly>
                      </div>
                      <div class="col-sm-6 mb-6 mb-sm-0">
                          <label>Satuan :</label>
                          <input type="text" name="satuan[]" class="form-control input-satuaan" autocomplete="off" readonly required>
                      </div>
                      <div class="col-sm-6 mb-6 mb-sm-0">
                          <label>Kuantitas :</label>
                          <input type="number" min="0" name="kuantitas[]" class="form-control kuantitas kuantitas2" autocomplete="off" required>
                          <input type="hidden" name="kuantitasvieww[]" class="form-control _out2" readonly>
                      </div>
                      <div class="col-sm-6 mb-6d mb-sm-0">
                          <label>Total :</label>
                          <input type="text" name="hasilView" class="form-control hasilView" readonly="">
                          <input type="hidden" name="hasilvieww[]" class="form-control hasilVieww" autocomplete="off">
                          <input type="hidden" name="hasil[]" class="form-control hasil" autocomplete="off">
                      </div>
                  </div>
                <hr />
            </div>
        `);

        $(".harga2").on('keyup', function() {
            var harga = $(this).val();
            $(this).parent().parent().find("._out1").val(harga);
        });

        $(".kuantitas2").on('keyup', function() {
            var kuantitas = $(this).val();
            $(this).parent().parent().find("._out2").val(kuantitas);
        });

        $('.js-example-basic-single2').on('change', function() {
            var optionsText = this.options[this.selectedIndex].text;
            // alert(optionsText);
            // console.log(this);
            var harga_  = optionsText.split(" | ");
            var satuan_ = optionsText.split(" | ");

            harga_  = harga_[1];
            satuan_ = satuan_[0];
            // console.log($(this).parent());
            $(this).parent().parent().parent().find(".input-hargaa").val(harga_);
            $(this).parent().parent().parent().find(".input-satuaan").val(satuan_);
        });

        $(".btn-hapus").click(function() {
            $(this).parent().remove();
        });

        $(document).ready(function() {
            $('.js-example-basic-single2').select2();
        });

        $(".kuantitas").on('keyup', function() {
            var kuantitas = $(this).val();
            var harga = $(this).parent().parent().find(".harga2").val();

            if (kuantitas != "" && harga != "") {
                var hasil = parseInt(kuantitas) * parseInt(harga);
                $(this).parent().parent().find(".hasil").val(hasil);
                $(this).parent().parent().find(".hasilView").val(convertToRupiah(hasil));
            } else {
                $(this).parent().parent().find(".hasil").val('');
                $(this).parent().parent().find(".hasilView").val('');
            }
        });

        function convertToRupiah(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
            return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
        }

    });
    
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
  </script>


  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('layouts.main.footer')
