<!-- Modal Edit Data -->
<div class="modal fade" id="modal-upload{{$pengujian->id}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Upload Laporan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="{{route('monitoring.update', $pengujian->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="modal-body">
                
                    <div class="card-body">

                      <div class="form-group">
                            <label for="laporan_lab">Laporan</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="laporan_lab" name="laporan_lab">
                                    <label class="custom-file-label" for="laporan_lab">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
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
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
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