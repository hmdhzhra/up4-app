@include('layouts.main.header')

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar.admin')
    <!-- /.sidebar -->
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $jumlah_data }}</h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $jumlah_pelanggan }}</h3>

                <p>Pelanggan</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="{{ route('pelanggan.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <h3 class="card-title">Data User</h3>
                <button type="button" class="btn btn-primary plus float-right" data-toggle="modal" data-target="#modal-tambah">
                    <i class="fas fa-plus"></i>
                    Tambah Data
                </button>
                @include('admin.user.tambah')
              </div><!-- /.card-header -->
              
              
              
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <th>No.</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Laboran</th>
                    <th>Bidang</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>
                    @foreach ($data_user as $user)
                    <tr>
                      <td>{{ $loop->iteration }} </td>
                      <td>{{ $user->username }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->role }}</td>
                      <td>{{ $user->jenis_lab }}</td>
                      <td>{{ $user->jenis_bidang }}</td>
                      <td>

                        <form action="{{route('user.destroy', $user->id)}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit{{$user->id}}">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button type="submit" onclick="return confirm ('Apakah Anda yakin untuk menghapus data {{$user->username}}?')" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
                        @include('admin.user.edit')
                      
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
