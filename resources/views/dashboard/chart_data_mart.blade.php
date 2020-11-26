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
                          <button class="btn btn-primary" onclick="_saveDataMart()"> <i class="la la-lg la-save mr-1"></i> Simpan Data</button>
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
                            $by = ['jenis kelamin','kota','asal sekolah','pekerjaan orang tua','jarak'];
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

                    <div class="text-center my-3">
                      <button class="btn btn-white btn-pill" onclick="_detailDataChart()">Lihat Semua</button>
                    </div>

                    <div class="row" id="spk">
                      <div class="col-md-6">

                        <div class="alert alert-info my-5">
                          <h3><i class="la la-info-circle mr-1"></i>  Rekomendasi Strategi Marketing (Terbanyak)</h3>
                          Promosi diarahkan ke daerah yang segmen pasarnya tinggi. Dengan kata lain promosi difokuskan ke daerah yang banyak peminatnya.
                        </div>

                      </div>

                      <div class="col-md-6">
                        <div class="alert alert-warning my-5">
                          <h3><i class="la la-info-circle mr-1"></i>  Rekomendasi Strategi Marketing (Paling Sedikit)</h3>
                          Membangun awareness dengan lebih banyak promosi secara kontinyu. Menggunakan metode AIDA (Attention, Interset, Desire, Action)
                        </div>
                      </div>
                    </div>

                </div>
            </div>

        </div>

    @include('modals.confirm')
    @include('modals.detail_data_chart')
    @include('modals.save_data_mart')
      
    <script>

      let stiparGPS = [-8.630368, 115.176738], dataCenter = []

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

        $('#spk').hide()

        let viewIf = ['kota','asal sekolah','jarak']
        if(viewIf.indexOf(by) > -1){
          $('#spk').show()
        }

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

          case 'kota': {
            let res = groupByKey(data, 'kota'), i = 1, c3data = [], c3names = {}

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
                    text: 'Jumlah Kota',
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
                  if(i == 16) break // ambil 15 data saja
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

          case 'jarak': {
            let temp = [], c3data = [], c3names = {}
            
            for (let i = 0; i < data.length; i++) {
              if(data[i].gps.trim() != ''){
                let gps = data[i].gps.split(', '),
                jarak = calcCrow(stiparGPS[0], stiparGPS[1], gps[0], gps[1]).toFixed(1)

                // bagi range jarak 0 - 10, 10 - 50, 50 - 100, dst max 500
                let range = ''

                if(jarak < 10){ range = '0-10 km' }
                else if(jarak >= 10 && jarak < 50){ range = '10-50 km' }
                else if(jarak >= 50 && jarak < 100){ range = '50-100 km' }
                else if(jarak >= 100 && jarak < 150){ range = '100-150 km' }
                else if(jarak >= 150 && jarak < 200){ range = '150-200 km' }
                else if(jarak >= 200 && jarak < 250){ range = '200-250 km' }
                else if(jarak >= 250 && jarak < 300){ range = '250-300 km' }
                else if(jarak >= 300 && jarak < 350){ range = '300-350 km' }
                else if(jarak >= 400 && jarak < 450){ range = '400-450 km' }
                else{ range = '>450 km' }

                temp.push({
                  kota: data[i].kota,
                  jarak: calcCrow(stiparGPS[0], stiparGPS[1], gps[0], gps[1]).toFixed(1),
                  range: range
                })
              }
            }

            let res = groupByKey(temp, 'range'), i = 1

              for (const key in res) {
                c3data.push([
                  `data${i}`, res[key].length
                ])

                c3names[`data${i}`] = res[key][0].kota+', '+ key

                i++
                if(i == 16) break // ambil 15 data saja
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
                      text: 'Jumlah Siswa',
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

      function _detailDataChart(showModal = true){
        let mod = $('#detail-data-chart'), by = urlp('by') || 'jenis kelamin', data = dataCenter
        let ul = '<ul class="list-group">', li = '<li class="list-group-item">'
        
        if(showModal){
          mod.find('.modal-body').html('')
        }

        switch (by) {
          case 'jenis kelamin': {
              let l = data.filter((e) => e.jenis_kelamin == 'L').length,
                  p = data.filter((e) => e.jenis_kelamin == 'P').length

              if(showModal){
                mod.find('.modal-body').append(
                  $(ul).append(
                    $(li).html('<b>Laki-Laki</b> <span class="float-right">'+l+'</span>'),
                    $(li).html('<b>Perempuan</b> <span class="float-right">'+p+'</span>')
                  )
                )
              }else{
                let json = {laki_laki: l, perempuan: p}
                return JSON.stringify(json)
              }
          }

          break

          case 'kota': {
            let res = groupByKey(data, 'kota'), i = 1, c3data = [], c3names = {}

            for (const key in res) {
              c3data.push([
                `data${i}`, res[key].length
              ])

              c3names[`data${i}`] = key

              i++
            }
            
            // urutkan dari terbesar ke terkecil
            c3data.sort(function(a, b){ return b[1] - a[1] });
            
            if(showModal){
              mod.find('.modal-body').append($(ul))
              for (let i = 0; i < c3data.length; i++) {
                mod.find('.modal-body ul').append(
                  $(li).html('<b>'+c3names[c3data[i][0]]+'</b> <span class="float-right">'+c3data[i][1]+'</span>')
                )
              }
            }else{
              let json = []
              for (let i = 0; i < c3data.length; i++) {
                json.push({
                  kota: c3names[c3data[i][0]],
                  jumlah: c3data[i][1]
                })
              }

              return JSON.stringify(json)
            }
          }

          break

          case 'asal sekolah': {
            let res = groupByKey(data, 'asal_sekolah'), i = 1, c3data = [], c3names = {}

            for (const key in res) {
              c3data.push([
                `data${i}`, res[key].length
              ])

              c3names[`data${i}`] = key

              i++
            }
            
            // urutkan dari terbesar ke terkecil
            c3data.sort(function(a, b){ return b[1] - a[1] });
            
            if(showModal){
              mod.find('.modal-body').append($(ul))
              for (let i = 0; i < c3data.length; i++) {
                mod.find('.modal-body ul').append(
                  $(li).html('<b>'+c3names[c3data[i][0]]+'</b> <span class="float-right">'+c3data[i][1]+'</span>')
                )
              }
            }else{
              let json = []
              for (let i = 0; i < c3data.length; i++) {
                json.push({
                  sekolah: c3names[c3data[i][0]],
                  jumlah: c3data[i][1]
                })
              }

              return JSON.stringify(json)
            }
          }

          break

          case 'pekerjaan orang tua': {
            let res = groupByKey(data, 'pekerjaan_orang_tua'), i = 1, c3data = [], c3names = {}

            for (const key in res) {
              c3data.push([
                `data${i}`, res[key].length
              ])

              c3names[`data${i}`] = key

              i++
            }
            
            // urutkan dari terbesar ke terkecil
            c3data.sort(function(a, b){ return b[1] - a[1] });

            if(showModal){
              mod.find('.modal-body').append($(ul))
              for (let i = 0; i < c3data.length; i++) {
                mod.find('.modal-body ul').append(
                  $(li).html('<b>'+c3names[c3data[i][0]]+'</b> <span class="float-right">'+c3data[i][1]+'</span>')
                )
              }
            }else{
              let json = []
              for (let i = 0; i < c3data.length; i++) {
                json.push({
                  pekerjaan: c3names[c3data[i][0]],
                  jumlah: c3data[i][1]
                })
              }

              return JSON.stringify(json)
            }
          }

          break

          case 'jarak': {
            let temp = [], c3data = [], c3names = {}
            
            for (let i = 0; i < data.length; i++) {
              if(data[i].gps.trim() != ''){
                let gps = data[i].gps.split(', '),
                jarak = calcCrow(stiparGPS[0], stiparGPS[1], gps[0], gps[1]).toFixed(1)

                // bagi range jarak 0 - 10, 10 - 50, 50 - 100, dst max 500
                let range = ''

                if(jarak < 10){ range = '0-10 km' }
                else if(jarak >= 10 && jarak < 50){ range = '10-50 km' }
                else if(jarak >= 50 && jarak < 100){ range = '50-100 km' }
                else if(jarak >= 100 && jarak < 150){ range = '100-150 km' }
                else if(jarak >= 150 && jarak < 200){ range = '150-200 km' }
                else if(jarak >= 200 && jarak < 250){ range = '200-250 km' }
                else if(jarak >= 250 && jarak < 300){ range = '250-300 km' }
                else if(jarak >= 300 && jarak < 350){ range = '300-350 km' }
                else if(jarak >= 400 && jarak < 450){ range = '400-450 km' }
                else{ range = '>450 km' }

                temp.push({
                  kota: data[i].kota,
                  jarak: calcCrow(stiparGPS[0], stiparGPS[1], gps[0], gps[1]).toFixed(1),
                  range: range
                })
              }
            }

            let res = groupByKey(temp, 'range'), i = 1

            for (const key in res) {
              c3data.push([
                `data${i}`, res[key].length
              ])

              c3names[`data${i}`] = res[key][0].kota+', '+ key

              i++
            }

            c3data.sort(function(a, b){ return b[1] - a[1] });
            
            if(showModal){
              mod.find('.modal-body').append($(ul))
              for (let i = 0; i < c3data.length; i++) {
                mod.find('.modal-body ul').append(
                  $(li).html('<b>'+c3names[c3data[i][0]]+'</b> <span class="float-right">'+c3data[i][1]+'</span>')
                )
              }
            }else{
              let json = []
              for (let i = 0; i < c3data.length; i++) {
                let kab = c3names[c3data[i][0]].replace('>','+')

                json.push({
                  kabupaten: kab,
                  jumlah: c3data[i][1]
                })
              }

              return JSON.stringify(json)
            }
          }
        
          default:
            break;
        }

        mod.modal('show')
      }
      
      // fungsi untuk mengukur jarak antar kordinat atau gps
      function calcCrow(lat1, lon1, lat2, lon2){
        var R = 6371; // km
        var dLat = toRad(lat2-lat1);
        var dLon = toRad(lon2-lon1);
        var lat1 = toRad(lat1);
        var lat2 = toRad(lat2);

        var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
          Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
        var d = R * c;
        return d;
      }

      // Converts numeric degrees to radians
      function toRad(Value){
          return Value * Math.PI / 180;
      }

      // console.log(
      //   calcCrow(-8.654983, 115.195425, -8.651478, 115.195437).toFixed(1)+' km'
      // )

      function _saveDataMart(){
        let by = urlp('by') || 'jenis kelamin'

        let mod = $('#save-data-mart')
        mod.modal('show').modalConfig((f) => submit(f), {
          title: 'Simpan Hasil'
        })

        mod.find('#by').val(by.ucwords())
      }

      function submit(f){
        let formData = new FormData(f)
        formData.append('data', _detailDataChart(false))

        request.post('data-mart/save-result', { // request
          data: formData, el: $(f).find('button:submit'),
          success: (res) => {
            new Toast().view(res.message)
            $('#save-data-mart').modal('hide')
            $(f)[0].reset()
          }
        })
      }
      
    </script>


</body>
</html>