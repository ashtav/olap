<div class="modal fade" id="form-user" tabindex="-1" role="dialog" aria-hidden="true">
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
            <label for="" class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" placeholder="Inputkan alamat" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="" class="form-label">No. Telepon</label>
            <input type="text" name="telepon" class="form-control" placeholder="Inputkan no. telepon" autocomplete="off" maxlength="15" required>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Inputkan email" autocomplete="off" required>
          </div>

          <div class="form-group">
            <div class="form-label">Level Pengguna</div>
            <div>
              @php
                  $levels = ['admin','marketing','rektor'];
              @endphp
              @for ($i = 0; $i < count($levels); $i++)
                <label class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="level" value="{{$levels[$i]}}" {{$i == 0 ? 'checked' : ''}}>
                  <span class="form-check-label"> {{ucwords($levels[$i])}} </span>
                </label>
              @endfor

            </div>
          </div>

          <div class="alert alert-info">
            Password default adalah <b>secret</b>, silahkan ganti setelah pengguna ditambahkan.
          </div>


        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
</div>