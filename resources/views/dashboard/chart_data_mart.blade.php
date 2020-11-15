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
                            Chart Data Mart
                          </h2>
                        </div>

                        {{-- <div class="col-auto ml-auto">
                          <div class="input-group">
                            <input type="number" min="2005" max="2050" step="1" value="" class="form-control" id="search-input">
                            <button class="btn btn-white" type="button" onclick="_search()"> <i class="la la-lg la-search"></i> </button>
                          </div>
                        </div> --}}

                        <div class="col-auto ml-auto">
                          {{-- <button class="btn btn-outline-primary mr-2" onclick="_reDrawChart()"> <i class="la la-lg la-refresh mr-1"></i> Perbarui</button> --}}
                          <button class="btn btn-primary" onclick="_new()"> <i class="la la-lg la-save mr-1"></i> Simpan Data</button>
                        </div>
                      </div>
                    </div>

                    <div class="alert alert-info" style="display: inline-block">
                      <i class="la la-lg la-file-alt mr-1"></i> Diambil dari data tahun <b>{{app('request')->input('tahun')}}</b> dengan jumlah data sebanyak <b id="jumlahData">-</b>
                    </div>

                    <div class="mb-3">
                      <div class="form-label">Tampilkan Berdasarkan</div>
                      <div class="view-by">
                        @php
                            $by = ['jenis kelamin','alamat','asal sekolah','pekerjaan orang tua'];
                        @endphp

                        @foreach ($by as $item)
                          <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="{{$item}}" name="by" onclick="_select(this)">
                            <span class="form-check-label"> {{ucwords($item)}} </span>
                          </label>
                        @endforeach

                      </div>
                    </div>

                    <div id="loader">Memuat grafik, mohon menunggu...</div>
                    
                    <div id="chart"></div>

                </div>
            </div>
        </div>

    @include('modals.confirm')
      
    <script>

      let dataCenter = []

      function _select(e){
        let tahun = urlp('tahun')
        window.history.pushState('page2', 'Title', `/data-mart/chart?tahun=${tahun}&by=${e.value}`);
        _reDrawChart()
      }
      
      function initChart(){
        let tahun = urlp('tahun'), by = urlp('by') || 'jenis kelamin'

        // check radio selected
        $('.view-by input').each(function(){
          if($(this).attr('value') == by.replace('%20',' ')){
            $(this).prop('checked', true)
          }
        })

        request.post(`data-mart/chart`, { // get data by tahun
          data: { tahun: tahun },
          success: (res) => {
            dataCenter = res.data
            $('#jumlahData').html(res.data.length)
            $('#loader').hide()
            
            setTimeout(() => _reDrawChart(), 200); // buat dan tampilkan grafik dalam waktu 0.2 detik
          }
        })
      }

      $(document).ready(function(){
        initChart()
      })

      function drawChart(params){
        let data = params.data, axis = params.axis

        c3.generate({
          bindto: '#chart',
          data: data,
          axis: axis
        });
      }

      function _reDrawChart(){
        let by = urlp('by') || 'jenis kelamin', data = dataCenter

        switch (by) {
          // tampilkan berdasarkan jenis kelamin
          case 'jenis kelamin': {
              let l = data.filter((e) => e.jenis_kelamin == 'L').length,
                  p = data.filter((e) => e.jenis_kelamin == 'P').length
              
              drawChart({
                data: {
                  columns: [
                    ['data1', l],
                    ['data2', p]
                  ],
                  type: 'bar',
                  names: {
                    data1: 'Laki-Laki', data2: 'Perempuan'
                  }
                },
                axis: {
                  y: {
                    label: {
                      text: 'Jumlah Calon Siswa',
                      position: 'outer-middle'
                    }
                  },
                }
              })
            }
            
            break
          
            // tampilkan berdasarkan asal sekolah
          case 'asal sekolah': {
              let res = groupByKey(data, 'asal_sekolah'), i = 1, c3data = [], c3names = {}

              for (const key in res) {
                c3data.push([
                  `data${i}`, res[key].length
                ])

                c3names[`data${i}`] = key

                i++
                if(i == 16) break // ambil 20 data saja
              }
              
              // urutkan dari terbesar ke terkecil
              c3data.sort(function(a, b){ return b[1] - a[1] });

              drawChart({
                data: {
                  columns: c3data,
                  type: 'bar',
                  names: c3names
                },
                axis: {
                  y: {
                    label: {
                      text: 'Jumlah Sekolah',
                      position: 'outer-middle'
                    }
                  },
                }
              })
            }

            break
          
          case 'pekerjaan orang tua': {
              let res = groupByKey(data, 'pekerjaan_orang_tua'), i = 1, c3data = [], c3names = {}
              delete res[''] // hapus nama pekerjaan yang kosong

              for (const key in res) {

                if(res[key].pekerjaan_orang_tua != ''){
                  c3data.push([
                    `data${i}`, res[key].length
                  ])

                  c3names[`data${i}`] = key

                  i++
                  if(i == 15) break // ambil 20 data saja
                }
              }
              
              // urutkan dari terbesar ke terkecil
              c3data.sort(function(a, b){ return b[1] - a[1] });

              drawChart({
                data: {
                  columns: c3data,
                  type: 'bar',
                  names: c3names
                },
                axis: {
                  y: {
                    label: {
                      text: 'Jumlah Pekerjaan',
                      position: 'outer-middle'
                    }
                  },
                }
              })
            }

            break
        
          default:
            break;
        }
      }


      // $(document).ready(function(){

      //   var chart = c3.generate({
      //       bindto: '#chart',
      //       data: {
      //         columns: [
      //           ['data1', 30],
      //           ['data2', 50]
      //         ],
      //         // axes: {
      //         //   data2: 'y2'
      //         // },
      //         types: {
      //           data1: 'bar',
      //           data2: 'bar' // ADD
      //         }
      //       },
      //       axis: {
      //         y: {
      //           label: {
      //             text: 'Jumlah Calon Siswa',
      //             position: 'outer-middle'
      //           }
      //         },
      //         // y2: {
      //         //   show: true,
      //         //   label: {
      //         //     text: 'Y2 Label',
      //         //     position: 'outer-middle'
      //         //   }
      //         // }
      //       }
      //   });

      // })
      
    </script>


</body>
</html>