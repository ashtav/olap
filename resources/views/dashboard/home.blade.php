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
                          Beranda
                        </h2>
                      </div>
                    </div>
                  </div>

                  <div class="alert alert-info">
                    <b>Selamat Datang {{Auth::user()->email}}</b>
                  </div>
                </div>
            </div>
        </div>

    @include('modals.modal')
    @include('partials.script')

    <script>

        function _new(){
            $('#modal').modal('show')
        }

        // get dan ekstrak data excel
        function onFile(input){
          let file = input.files[0],
              reader = new FileReader()

          reader.onload = function() {
            let fileData = reader.result
            let wb = XLSX.read(fileData, { type: 'binary' })

              wb.SheetNames.forEach(function(sheetName) {
                // konversi excel ke json
                let rowObj = XLSX.utils.sheet_to_row_object_array(
                  wb.Sheets[sheetName], { header: 0, defval: '' }
                );

                let objs = []
                    
                // konversi object header ke lowercase, ex: No -> no
                rowObj.forEach(o => {
                  objs.push(
                    Object.fromEntries(
                      Object.entries(o).map(([k, v]) => [k.toLowerCase().replaceAll(' ','_'), v])
                    )
                  )
                })

                // tentukan key yang diizinkan
                let allowed = ['no','nama','alamat','tanggal_lahir','jenis_kelamin','asal_sekolah','pekerjaan_orang_tua'];

                objs.forEach(o => {
                  Object.entries(o).map(([k, v]) => allowed.indexOf(k) < 0 ? delete o[k] : o[k])
                  console.log(o)
                })




              })

          }

          reader.readAsBinaryString(file)
        }

    </script>


</body>
</html>