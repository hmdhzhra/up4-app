@include('layouts.main.header')

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar.bendahara')
    <!-- /.sidebar -->
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0">Validasi Berkas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Validasi Berkas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      

        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $jml_validasi }}</h3>

                <p>Menunggu Validasi</p>
              </div>
              <div class="icon">

              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $jml_ditolak }}</h3>

                <p>Validasi Ditolak</p>
              </div>
              <div class="icon">

              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        @if(session()->has('toast_success'))
            <div class="container-fluid">
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('toast_success') }}
            </div>
            </div>
        @endif

        <!-- TABEL DATA -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Validasi Berkas</h3>
              </div><!-- /.card-header -->
              
              
              
              
              <div class="card-body table-responsive">
                <table id="example2" class="table table-bordered table-striped table-responsive">
                  <thead>
                    <th>No.</th>
                    <th>ID</th>
                    <th>No. SKRD</th>
                    <th>Nama</th>
                    <th>Nama Perusahaan</th>
                    <th>Nama Proyek</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Berkas</th>
                    <th style="width: 120px;">Upload SSRD</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>
                  @foreach($data_pengujian as $pengujian)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengujian->id }}</td>
                    <td>{{ $pengujian->no_skrd }}</td>
                    <td>{{ $pengujian->pelanggan->nama_lengkap }}</td>
                    <td>{{ $pengujian->pelanggan->nama_pr }}</td>
                    <td>{{ $pengujian->nama_proyek }}</td>
                    <td>{{ $pengujian->status }}</td>
                    <td>{{ $pengujian->keterangan }}</td>
                    <td>
                      <button type="button" class="btn btn-warning btn-sm font-weight-bold" data-toggle="modal" data-target="#modalBerkas-show{{$pengujian->id}}">
                        Berkas
                      </button>
                      @include('bendahara.berkasShow')
                    </td>
                    <td class="d-flex justify-content-between">
                      @if ($pengujian->layanan && $pengujian->layanan->status_pembayaran == 'paid')
                        <!-- Tidak ada tindakan yang dilakukan -->
                        <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#modal-edit{{ $pengujian->id }}">
                          <i class="far fa-check-square"></i>
                        </button>
                      @endif

                      @if ($pengujian->berkas_skrd)
                        <a href="{{ asset($pengujian->berkas_skrd) }}" class="btn btn-info btn-sm" target="_blank">
                          <i class="fas fa-file-contract"></i>
                        </a>
                      @endif
                    </td>

                      @include('bendahara.validasi.edit')
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-show{{$pengujian->id}}">
                        <i class="fas fa-eye"></i>
                        </button>

                        @include('bendahara.validasi.show')
                    </td>

                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@include('layouts.main.footer')
