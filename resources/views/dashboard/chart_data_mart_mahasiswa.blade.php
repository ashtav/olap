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
              <button class="btn btn-primary" onclick="_saveDataMart()"> <i class="la la-lg la-save mr-1"></i> Simpan
                Data</button>
            </div>
          </div>
        </div>

        <div class="alert alert-info" style="display: inline-block">
          <i class="la la-lg la-file-alt mr-1"></i> Diambil dari data
          dengan jumlah data sebanyak <b id="jumlahData">-</b>
        </div>

        <div class="mb-3">
          <div class="form-label">Tampilkan Berdasarkan</div>
          <div class="view-by">
            @php
            $by = ['absensi','alumni'];
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
              <h3><i class="la la-info-circle mr-1"></i> Rekomendasi Strategi Marketing (Terbanyak)</h3>
              Promosi diarahkan ke <span class="place">daerah</span> yang segmen pasarnya tinggi. Dengan kata lain
              promosi difokuskan ke <span class="place">daerah</span> yang banyak peminatnya.
            </div>

          </div>

          <div class="col-md-6">
            <div class="alert alert-warning my-5">
              <h3><i class="la la-info-circle mr-1"></i> Rekomendasi Strategi Marketing (Paling Sedikit)</h3>
              Membangun awareness dengan lebih banyak promosi secara kontinyu. Menggunakan metode AIDA (Attention,
              Interset, Desire, Action)
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6" id="row">

            <div class="card">
              <div class="card-body">
                <table class="table table-striped" id="table">
                  <tbody></tbody>
                </table>
              </div>
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
    function uniq(a) {
    return a.sort().filter(function(item, pos, ary) {
        return !pos || item != ary[pos - 1];
    });
}

      let stiparGPS = [-8.630368, 115.176738], dataCenter = [], dataResult = []

      function _select(e){
        let tahun = urlp('tahun')
        // window.history.pushState('page2', 'Title', `/data-mart/chart-mahasiswa?tahun=${tahun}&by=${e.value}`);
        window.history.pushState('page2', 'Title', `/data-mart/chart-mahasiswa?by=${e.value}`);
        initChart()
      }
      
      function initChart(){
        let tahun = urlp('tahun'), by = urlp('by') || 'absensi'

        // check radio selected
        $('.view-by input').each(function(){
          if($(this).attr('value') == by.replace('%20',' ')){
            $(this).prop('checked', true)
          }
        })

        request.post(`data-mart-mahasiswa/chart`, { // get data by tahun
          data: { by: by },
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
        let by = urlp('by') || 'absensi', data = dataCenter

        $('#spk').hide()
        $('#table').find('tbody').html('')


        let viewIf = ['kota','asal sekolah']
        if(viewIf.indexOf(by) > -1){
          $('#spk').show()
          $('.place').html(viewIf[viewIf.indexOf(by)].replace('asal ',''))
        }

        switch (by) {
          case 'absensi': {

            let absensi = []

            const sourceItemsByName = {};
            for (const obj of data) {
              if (!sourceItemsByName[obj.id_mahasiswa]) {
                sourceItemsByName[obj.id_mahasiswa] = [];
              }
              sourceItemsByName[obj.id_mahasiswa].push(obj);
            }

            const output = Object.values(sourceItemsByName);
            
            for (let i = 0; i < output.length; i++) {
              let jmlK = 0

              output[i].forEach(o => {
                jmlK += o.jumlah_kehadiran
              })


              absensi.push({
                nim: output[i][0].mahasiswa.nim,
                nama: output[i][0].mahasiswa.nama_mahasiswa,
                kehadiran: ((jmlK / 800) * 100).toFixed(1)
              })
            }

            dataResult = absensi

            let yAxisValue = [0]
            let res = groupByKey(absensi, 'nama'), i = 1, c3data = [], c3names = {}, c3data1 = [], c3names1 = {}

            for (const key in res) {

              // console.log(res[key][0])
              c3data.push([
                `data${i}`, res[key][0].kehadiran
              ])

              yAxisValue.push(res[key].length)

              c3names[`data${i}`] = key

              i++
              if(i == 16) break // ambil 15 data saja
            }

            for (const key in res) {
              c3data1.push([
                `data${i}`, res[key][0].kehadiran
              ])
              c3names1[`data${i}`] = key
              i++
            }
            
            // urutkan dari terbesar ke terkecil
            c3data.sort(function(a, b){ return b[1] - a[1] });
            c3data1.sort(function(a, b){ return b[1] - a[1] });

            let n = 1
            c3data1.forEach((v) => {
              $('#table').find('tbody').append(
                  `
                  <tr>
                    <td width="30">${n++}.</td>
                    <td>${c3names1[v[0]]}</td>
                    <td>${v[1]}%</td>
                  </tr>
                  `
                )
            })

            drawChart({
              data: {
                columns: c3data,
                type: 'bar',
                names: c3names
              },
              axis: {
                y: {
                  tick: {
                    values: yAxisValue
                  },
                  label: {
                    text: 'Kehadiran',
                    position: 'outer-middle'
                  }
                },
              }
            })
          }

          break
          
            // tampilkan berdasarkan asal sekolah
          case 'alumni': {

            let alumni = []

            data.forEach(e => {
              alumni.push({
                tahun: e.tahun_lulus,
                nama: e.mahasiswa.nama_mahasiswa
              })
            })

            dataResult = alumni

              let yAxisValue = [0]
              let res = groupByKey(alumni, 'nama'), i = 1, c3data = [], c3names = {}, c3data1 = [], c3names1 = {}

              for (const key in res) {
                c3data.push([
                  `data${i}`, res[key][0].tahun
                ])

                yAxisValue.push(res[key].length)

                c3names[`data${i}`] = key

                i++
                if(i == 16) break // ambil 20 data saja
              }

              for (const key in res) {
                c3data1.push([
                  `data${i}`, res[key][0].tahun
                ])
                c3names1[`data${i}`] = key
                i++
              }
              
              // urutkan dari terbesar ke terkecil
              c3data.sort(function(a, b){ return b[1] - a[1] });
              c3data1.sort(function(a, b){ return b[1] - a[1] });

              let n = 1
              c3data1.forEach((v) => {
                $('#table').find('tbody').append(
                    `
                    <tr>
                      <td width="30">${n++}.</td>
                      <td>${c3names1[v[0]]}</td>
                      <td>${v[1]}</td>
                    </tr>
                    `
                  )
              })

              drawChart({
                data: {
                  columns: c3data,
                  type: 'bar',
                  names: c3names
                },
                axis: {
                  y: {
                    tick: {
                      values: yAxisValue //from({length: (c3data[0][1] + 1)}, (_, i) => i)
                    },
                    label: {
                      text: 'Jumlah Sekolah',
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

          case 'absensi': {
            let res = groupByKey(dataResult, 'nama'), i = 1, c3data = [], c3names = {}

            for (const key in res) {
              c3data.push([
                `data${i}`, res[key][0].kehadiran
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
                  $(li).html('<b>'+c3names[c3data[i][0]]+'</b> <span class="float-right">'+c3data[i][1]+'%</span>')
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

          case 'alumni': {
            let res = groupByKey(dataResult, 'nama'), i = 1, c3data = [], c3names = {}

            for (const key in res) {
              c3data.push([
                `data${i}`, res[key][0].tahun
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