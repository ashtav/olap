<div class="modal fade" id="form-upload-absensi" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Data Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="la la-lg la-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row align-items-center">
          <div class="col-auto">
            <button class="btn btn-white" type="button" onclick="$('#file1').click()">Pilih File (.xlsx)</button>
            <input type="file" id="file1" class="d-none" onchange="onFile1(this)">
          </div>

          <div class="col-auto">
            <div id="filename1"></div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Upload File</button>
      </div>
    </div>
  </div>
</div>