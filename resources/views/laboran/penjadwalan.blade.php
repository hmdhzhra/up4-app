@include('layouts.main.header')

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar.laboran')
    <!-- /.sidebar -->
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Penjadwalan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item active">Penjadwalan</li>
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
                <h3>{{ $jml_menunggu }}</h3>

                <p>Menunggu Penjadwalan</p>
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
                <h3>{{ $jml_proses }}</h3>

                <p>Proses Pengujian</p>
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
                <h3 class="card-title">Penjadwalan</h3>
              </div><!-- /.card-header -->
              
              <div class="card-body table-responsive">
                <table id="example2" class="table table-bordered table-striped table-responsive">
                  <thead>
                    <th>No.</th>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Nama Perusahaan</th>
                    <th>Nama Proyek</th>
                    <th>Lokasi Proyek</th>
                    <th>Tim Laboran</th>
                    <th>Tanggal Permohonan</th>
                    <th>Jadwal Pengujian</th>
                    <th>Status</th>
                    <th>Surat Tugas</th>
                    <th>Penjadwalan</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>
                  @foreach($data_penugasan as $penugasan)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $penugasan->pengujian->id }}</td>
                    <td>{{ $penugasan->pengujian->pelanggan->user->username }}</td>
                    <td>{{ $penugasan->pengujian->pelanggan->nama_pr }}</td>
                    <td>{{ $penugasan->pengujian->nama_proyek }}</td>
                    <td>{{ $penugasan->pengujian->lokasi_proyek }}</td>
                    <td>{{ $penugasan->tim_lab }}</td>
                    <td>{{ $penugasan->pengujian->tgl_permohonan }}</td>
                    <td>{{ $penugasan->pengujian->jadwal_pengujian }}</td>
                    <td>{{ $penugasan->pengujian->status }}</td>
                    <td>
                      @if($penugasan->surat_tugas)
                          <a href="{{ asset($penugasan->surat_tugas) }}" class="btn btn-primary" target="_blank">Download</a>
                      @else
                          <p> </p>
                      @endif
                    </td>
                    <td >
                      <button type="button" class="btn btn-warning btn-sm font-weight-bold" data-toggle="modal" data-target="#modal-edit{{$penugasan->id}}">
                          Penjadwalan
                      </button>
                        @include('laboran.setJadwal')
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#modal-show{{$penugasan->id}}">
                                <i class="fas fa-eye"></i>
                            </button>
                            @include('laboran.show')
                            <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#modal-status{{ $penugasan->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            @include('laboran.edit')
                        </div>
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