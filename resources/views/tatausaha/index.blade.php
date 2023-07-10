@include('layouts.main.header')

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar.tatausaha')
    <!-- /.sidebar -->
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pengendalian Tugas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item active">Pengendalian Tugas</li>
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
                <h3>{{ $jml_dibayar }}</h3>

                <p>Dibayar</p>
              </div>
              <div class="icon">
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $jml_penjadwalan }}</h3>

                <p>Menunggu Penjadwalan</p>
              </div>
              <div class="icon">
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $jml_selesai }}</h3>

                <p>Selesai</p>
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
                <h3 class="card-title">Pengendalian Tugas</h3>
              </div><!-- /.card-header -->
              
              <div class="card-body table-responsive">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <th>No.</th>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Nama Proyek</th>
                    <th>Status</th>
                    <th>Tim Laboran</th>
                    <th>Penugasan</th>
                    <th>Surat Tugas</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>
                  @foreach($data_pengujian as $pengujian)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengujian->id }}</td>
                    <td>{{ $pengujian->pelanggan->user->username }}</td>
                    <td>{{ $pengujian->nama_proyek }}</td>
                    <td>{{ $pengujian->status }}</td>
                    <td>{{ optional($pengujian->penugasan)->tim_lab }}</td>
                    <td >
                      <button type="button" class="btn btn-warning btn-sm font-weight-bold" data-toggle="modal" data-target="#modal-edit{{$pengujian->id}}">
                          Bagi Tugas
                      </button>
                        @include('tatausaha.bagiTugas')
                    </td>
                    <td style="justify-content:center;">
                      <button type="button" class="btn btn-info btn-sm font-weight-bold" data-toggle="modal" data-target="#modal-upload{{$pengujian->id}}">
                            Upload Surat Tugas
                      </button>
                      @include('tatausaha.suratTugas')
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-show{{$pengujian->id}}">
                          <i class="fas fa-eye"></i>
                      </button>
                      @include('tatausaha.show')
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