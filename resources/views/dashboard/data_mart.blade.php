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
                            <input type="text" placeholder="Cari data mart" class="form-control" id="search-input">
                          </div>
                        </div>
                        
                        @if (Auth::user()->level == 'admin')
                        <div class="col-auto d-print-none">
                          <button class="btn btn-primary" onclick="_new()"> <i class="la la-lg la-chart-bar mr-1"></i> Kelola Data</button>
                        </div>
                        @endif
                      </div>
                    </div> 

                    <div class="card px-2 pb-3">
                      <table id="datatable" class="table m-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Berdasarkan</th>
                                <th>Tanggal</th>
                                <th>Oleh</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @php $index = 1 @endphp
                          @foreach ($dataMart as $item)
                          
                            <tr>
                              <td> {{$index++}} </td>
                              <td> {{$item->judul}} </td>
                              <td> {{$item->berdasarkan}} </td>
                              <td> {{date('d-m-Y', strtotime($item->created_at))}}  </td>
                              <td> {{$item->user->nama}}  </td>
                              <td> <button class="btn btn-white" onclick="_download(JSON.stringify({{$item}}))"> <i class="la la-lg la-download mr-1"></i> Download </button> </td>
                            </tr>

                          @endforeach
                          
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
          const dt = $('#datatable').DataTable({
            info: false, bLengthChange: false, pageLength: 20,
            'sDom': '"top"i'
          });

          $('#search-input').keyup((o) => dt.search(o.currentTarget.value).draw())
      });

      function _new(){
        $('#form-pilih-tahun').modal('show').setForm((f) => submit(f))
      }
      
      function submit(f){
        let year = $(f).find('select').val()
        moveTo(`data-mart/chart?tahun=${year}&by=jenis kelamin`)
      }

      function _download(row){
        const data = JSON.parse(row), _data = JSON.parse(data.data)

        switch (data.berdasarkan) {
          case 'Jarak': {
            createExcel(data.judul, {
              filename: data.judul.replaceAll(' ','_'),
              data: _data
            })
          } break;

          case 'Jenis Kelamin': {
            createExcel(data.judul, {
              filename: data.judul.replaceAll(' ','_'),
              data: [_data]
            })
          } break
        
          default:
            createExcel(data.judul, {
              filename: data.judul.replaceAll(' ','_'),
              data: _data
            })
            break;
        }

      }

      function createExcel(judul, params){ // fungsi untuk generate data json ke file excel
        var data = XLSX.utils.json_to_sheet(params.data, {
          origin: "A3"
        })

        

        var wb = XLSX.utils.book_new() // make Workbook of Excel
        XLSX.utils.book_append_sheet(wb, data, 'sheet') // sheet is name of Worksheet

        XLSX.utils.sheet_add_json(wb.Sheets.sheet,
        [{note: judul.ucwords()}],
        {
          skipHeader:true,
          origin: {r:0, c:0}
        }
      );


        XLSX.writeFile(wb, params.filename+'.xlsx')
      }
      
    </script>


</body>
</html>