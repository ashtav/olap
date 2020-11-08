<div class="modal fade" id="form-account" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="la la-lg la-times"></i> </button>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label for="" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Inputkan email" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Password Lama</label>
            <div class="input-group input-group-flat">
              <input type="password" name="password" class="form-control input-password" placeholder="Inputkan password lama" autocomplete="off" required>
              <span class="input-group-text">
                <span class="input-group-link click-able text-primary pl-2" onclick="_obsecure(this)">Tampilkan Password</span>
              </span>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Password Baru</label>
            <input type="password" id="pass" name="new_password" class="form-control input-password" placeholder="Inputkan password baru" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" id="cpass" name="confirm_password" class="form-control input-password" placeholder="Inputkan konfirmasi password baru" autocomplete="off" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
</div>