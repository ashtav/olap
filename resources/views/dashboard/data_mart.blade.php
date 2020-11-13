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

                </div>
            </div>
        </div>

    @include('modals.form_pilih_tahun')
    @include('modals.confirm')

    <script>

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