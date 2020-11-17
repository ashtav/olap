@include('partials.header')

    <body class="antialiased">

      @include('dashboard.partials.aside')
        
          <div class="page">

            <div class="content">
                <div class="container">

                    <div class="page-header">
                      <div class="row align-items-center">
                        <div class="col-auto">
                          <h2 class="page-title">
                            Data Mart
                          </h2>
                        </div>

                        <div class="col-auto ml-auto">
                          <div class="input-group">
                            <input type="number" min="2005" max="2050" step="1" value="" class="form-control" id="search-input">
                            <button class="btn btn-white" type="button" onclick="_search()"> <i class="la la-lg la-search"></i> </button>
                          </div>
                        </div>

                        <div class="col-auto d-print-none">
                          <button class="btn btn-primary" onclick="_new()"> <i class="la la-lg la-chart-bar mr-1"></i> Kelola Data</button>
                        </div>
                      </div>
                    </div> 

                    <div class="card px-2 pb-3">
                      <table id="datatable" class="table m-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Oleh</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            <tr>
                              <td> 1 </td>
                              <td> Lorem </td>
                              <td> 10/02/2020  </td>
                              <td> Lorem Ipsum Name  </td>
                              <td> <button class="btn btn-white"> <i class="la la-lg la-download mr-1"></i> Download </button> </td>
                            </tr>
                          
                        </tbody>
                      </table>
                    </div>

                </div>
            </div>
        </div>

    @include('modals.form_pilih_tahun')
    @include('modals.confirm')

    <script>

      $(document).ready(function() {
          $('#datatable').DataTable({
            searching: false, info: false, bLengthChange: false, pageLength: 20
          });
      });

      function _new(){
        $('#form-pilih-tahun').modal('show').setForm((f) => submit(f))
      }
      
      function submit(f){
        let year = $(f).find('select').val()
        moveTo(`data-mart/chart?tahun=${year}&by=jenis kelamin`)
      }
      
    </script>


</body>
</html>