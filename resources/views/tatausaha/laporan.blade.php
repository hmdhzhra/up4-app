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
            <h1 class="m-0">Laporan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item active">Laporan</li>
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

        <!-- TABEL DATA -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Laporan</h3>
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
                    <th>Laporan Lab</th>
                    <th>Laporan Final</th>
                    <th>Upload Laporan</th>
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
                    <td>
                      @if($pengujian->penugasan->laporan_lab)
                          <a href="{{ asset($pengujian->penugasan->laporan_lab) }}" class="btn btn-warning" target="_blank">Download</a>
                      @else
                          <p> </p>
                      @endif
                    </td>
                    <td>
                      @if($pengujian->laporan)
                          <a href="{{ asset($pengujian->penugasan->laporan) }}" class="btn btn-success" target="_blank">Tampilkan</a>
                      @else
                          <p> </p>
                      @endif
                    </td>
                    <td style="justify-content:center;">
                      <button type="button" class="btn btn-info btn-sm font-weight-bold" data-toggle="modal" data-target="#modal-upload{{$pengujian->id}}">
                            Upload Laporan
                      </button>
                      @include('tatausaha.uploadLaporan')
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