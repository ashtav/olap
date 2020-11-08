<div class="modal fade" id="form-foto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="la la-lg la-times"></i> </button>
        </div>
        <div class="modal-body">
          <img src="" alt="" id="preview-img" style="width: 100%">
          <input type="file" name="foto" id="foto" class="d-none" onchange="previewImg(this)">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" onclick="$('#foto').click()">Pilih Foto</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
</div>