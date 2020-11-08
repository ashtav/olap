<div class="modal fade" id="form-data-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload Data Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="la la-lg la-times"></i> </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="" class="form-label">Nama File *</label>
            <input type="text" name="nama_file" class="form-control" placeholder="ex: data sekolah blabla" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Data Tahun *</label>
            <input type="text" name="tahun" class="form-control" placeholder="ex: 2020" autocomplete="off" maxlength="4" required>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Keterangan</label>
            <textarea name="keterangan" placeholder="Keterangan" class="form-control"></textarea>
          </div>

          <div class="row align-items-center">
            <div class="col-auto">
              <button class="btn btn-white" type="button" onclick="$('#file').click()">Pilih File (.xlsx)</button>
              <input type="file" id="file" class="d-none" onchange="onFile(this)">
            </div>

            <div class="col-auto">
              <div id="filename"></div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Upload File</button>
        </div>
      </div>
    </div>
</div>