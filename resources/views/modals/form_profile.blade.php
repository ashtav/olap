<div class="modal fade" id="form-profile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="la la-lg la-times"></i> </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Inputkan nama" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Tempat & Tanggal Lahir</label>
            <div class="row">
              <div class="col-6">
                <input type="text" name="tempat_lahir" placeholder="Inputkan tempat lahir" class="form-control" autocomplete="off" required>
              </div>
              <div class="col-6">
                <input type="date" name="tanggal_lahir" class="form-control" autocomplete="off" required>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label">Jenis Kelamin</div>
            <div>
              @php
                  $gender = ['laki-laki','perempuan'];
              @endphp
              @for ($i = 0; $i < count($gender); $i++)
                <label class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="jenis_kelamin" value="{{$gender[$i]}}" {{$i == 0 ? 'checked' : ''}}>
                  <span class="form-check-label"> {{ucwords($gender[$i])}} </span>
                </label>
              @endfor

            </div>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" placeholder="Inputkan alamat" autocomplete="off" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
</div>