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
          <div class="col-sm-6">
          <h1 class="m-0">Hi, {{$username}}!</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
                <h3>{{ $validasi }}</h3>

                <p>MENUNGGU VALIDASI</p>
              </div>
              <div class="icon">
                <i class="ion-android-checkbox-outline"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $validasi_ditolak }}</h3>

                <p>VALIDASI DITOLAK</p>
              </div>
              <div class="icon">
                <i class="ion-android-close"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $stats_pembayaran }}</h3>

                <p>PEMBAYARAN</p>
              </div>
              <div class="icon">
                <i class="far fa-money-bill-alt"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $selesai }}</h3>

                <p>LAPORAN SELESAI</p>
              </div>
              <div class="icon">
                 <i class="ion-document-text"></i>
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
                <h3 class="card-title">Riwayat Pengujian</h3>
                <a type="button" class="btn btn-primary plus float-right" href="{{ route('permohonan.index') }}">
                    <i class="fas fa-plus"></i>
                    Ajukan Permohonan
                </a>
              </div><!-- /.card-header -->
              
              
              
              
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped table-responsive">
                  <thead>
                    <th>No.</th>
                    <th>ID</th>
                    <th>No. SKRD</th>
                    <th>No. Order</th>
                    <th>Nama Proyek</th>
                    <th>Tanggal Permohonan</th>
                    <th>Jadwal Pengujian</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Berkas</th>
                    <th>Download SKRD</th>
                    <th>Download Laporan</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>
                  @foreach($data_pengujian as $pengujian)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengujian->id }}</td>
                    <td>{{ $pengujian->no_skrd }}</td>
                    <td>{{ $pengujian->no_order }}</td>
                    <td>{{ $pengujian->nama_proyek }}</td>
                    <td>{{ $pengujian->tgl_permohonan }}</td>
                    <td>{{ $pengujian->jadwal_pengujian }}</td>
                    <td>{{ $pengujian->status }}</td>
                    <td>{{ $pengujian->keterangan }}</td>
                    <td  style="display: flex; justify-content:center;">
                      @if ($pengujian->status == 'Validasi ditolak')
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit{{ $pengujian->id }}">
                              <i class="fas fa-edit"></i>
                          </button>
                      @else
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit{{ $pengujian->id }}" disabled>
                              <i class="fas fa-edit"></i>
                          </button>
                      @endif
                      @include('pelanggan.editBerkas')
                    </td>

                    <td>
                      @if($pengujian->berkas_skrd)
                          <a href="{{ asset($pengujian->berkas_skrd) }}" class="btn btn-primary" target="_blank">Download</a>
                      @else
                          <p> </p>
                      @endif
                    </td>

                    <td>
                    @if($pengujian->laporan)
                          <a href="{{ asset($pengujian->laporan) }}" class="btn btn-success" target="_blank">Download</a>
                    @else
                          <p> </p>
                    @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-show{{$pengujian->id}}">
                        <i class="fas fa-eye"></i>
                        </button>

                        @include('pelanggan.pengujian.show')
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
