<div class="modal fade" id="form-pilih-tahun" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pilih Tahun</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="la la-lg la-times"></i> </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-info">
            Pilih tahun data yang ingin dikelola.
          </div>

          <select name="tahun" class="form-control">
            @foreach ($dataCenter as $item)
              <option value="{{$item->tahun}}"">{{$item->tahun}}</option>
            @endforeach
          </select>
          

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Kelola Data</button>
        </div>
      </div>
    </div>
</div>