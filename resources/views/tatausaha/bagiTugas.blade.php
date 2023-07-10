<!-- Modal Edit Data -->
<div class="modal fade" id="modal-edit{{ $pengujian->id }}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Bagi Tugas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="{{route('bagitugas.update', $pengujian->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="modal-body">
                
                    <div class="card-body">
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="id" name="ide" value="{{$pengujian->id}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{$pengujian->pelanggan->user->username}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_proyek">Nama Proyek</label>
                            <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" value="{{$pengujian->nama_proyek}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="lokasi_proyek">Lokasi Proyek</label>
                            <input type="text" class="form-control" id="lokasi_proyek" name="lokasi_proyek" value="{{$pengujian->lokasi_proyek}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jns_layanan">Jenis Layanan</label>
                            <input type="text" class="form-control" id="jns_layanan" name="jns_layanan" value="{{$pengujian->layanan->jenisLayanan->nama_layanan}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tim Laboran</label>
                            <select class="form-control" id="tim_lab" name="tim_lab">
                              <option value="">--Pilih Tim--</option>
                              <option value="Tim Campuran Beraspal" @if(optional($pengujian->penugasan)->tim_lab == "Tim Campuran Beraspal") selected @endif>Tim Campuran Beraspal</option>
                              <option value="Tim Aspal" @if(optional($pengujian->penugasan)->tim_lab == "Tim Aspal") selected @endif>Tim Aspal</option>
                              <option value="Tim Penyelidikan Lapangan" @if(optional($pengujian->penugasan)->tim_lab == "Tim Penyelidikan Lapangan") selected @endif>Tim Penyelidikan Lapangan</option>
                              <option value="Tim Agregat, Tanah, dan Beton" @if(optional($pengujian->penugasan)->tim_lab == "Tim Agregat, Tanah, dan Beton") selected @endif>Tim Agregat, Tanah, dan Beton</option>
                              <option value="Tim Pengukuran" @if(optional($pengujian->penugasan)->tim_lab == "Tim Pengukuran") selected @endif> Tim Pengukuran</option>

                            </select>
                      </div>

                    </div>
                </div>
                
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
