<!-- Modal Edit Data -->
<div class="modal fade" id="modal-edit{{$data_pelanggan->id}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit {{$title}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

        <form action="{{route('pelanggan.update' , $data_pelanggan->id)}}" method="POST">
            {{ method_field('PATCH') }}
            @csrf
            <div class="modal-body">
            
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_lengkap">User Name</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{$data_pelanggan->user->username}}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{$data_pelanggan->nama_lengkap}}">
                  </div>
                  <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{$data_pelanggan->nik}}">
                  </div>
                  <div class="form-group">
                    <label for="telp">No. Telp/HP</label>
                    <input type="text" class="form-control" id="telp" name="telp" value="{{$data_pelanggan->telp}}">
                  </div>
                  <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{$data_pelanggan->jabatan}}">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{$data_pelanggan->alamat}}">
                  </div>
                  <div class="form-group">
                    <label for="nama_pr">Nama Perusahaan</label>
                    <input type="text" class="form-control" id="nama_pr" name="nama_pr" value="{{$data_pelanggan->nama_pr}}">
                  </div>
                  <div class="form-group">
                    <label for="email_pr">Email Perusahaan</label>
                    <input type="text" class="form-control" id="email_pr" name="email_pr" value="{{$data_pelanggan->email_pr}}">
                  </div>
                  <div class="form-group">
                    <label for="alamat_pr">Alamat Perusahaan</label>
                    <input type="text" class="form-control" id="alamat_pr" name="alamat_pr" value="{{$data_pelanggan->alamat_pr}}">
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