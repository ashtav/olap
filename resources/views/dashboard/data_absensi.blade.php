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
                                Data Absensi
                            </h2>
                        </div>

                        <div class="col-auto ml-auto">
                            <div class="input-group">
                                <input type="number" min="2005" max="2050" step="1" value="{{$tahun}}"
                                    class="form-control" id="search-input">
                                <button class="btn btn-white" type="button" onclick="_search()"> <i
                                        class="la la-lg la-search"></i>
                                </button>
                            </div>
                        </div>

                        @if (Auth::user()->level == 'admin')
                        <div class="col-auto d-print-none">
                            <button class="btn btn-primary" onclick="_upload()"> <i
                                    class="la la-lg la-file-excel mr-1"></i> Upload
                                Excel</button>
                        </div>

                        <div class="col-auto">
                            <button class="btn btn-danger" type="button" onclick="_delete()"> <i
                                    class="la la-lg la-trash py-1"></i>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>

                @if (!isset($data))
                <div class="text-center">Tidak ada data</div>
                @else

                <div class="card px-2 pb-3">
                    <table id="datatable" class="table m-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Tanggal Lahir</th>
                                <th>JK</th>
                                <th>Asal Sekolah</th>
                                <th>Pekerjaan Orang Tua</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $index = 1 @endphp
                            @foreach ($data as $item)

                            <tr>
                                <td> {{$index++}} </td>
                                <td> {{$item->nama}} </td>
                                <td> {{$item->alamat}} </td>
                                <td> {{date("d-m-Y", strtotime($item->tanggal_lahir))}} </td>
                                <td> {{$item->jenis_kelamin}} </td>
                                <td> {{$item->asal_sekolah}} </td>
                                <td> {{$item->pekerjaan_orang_tua}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @endif

            </div>
        </div>
    </div>

    @include('modals.form_upload_absensi')
    @include('modals.confirm')
    {{-- @include('partials.script') --}}

    <script>
        $(document).ready(function() {
          $('#datatable').DataTable({
            searching: false, info: false, bLengthChange: false, pageLength: 20
          });
      });

      const _search = () => moveTo('data-center?tahun='+$('#search-input').val())

      let files = []

      function _upload(){ // tampilkan modal dan set form config
        $('#form-upload-absensi').modal('show').setForm((f) => submit(f))
      }


      function submit(f){ // fungsi submit form
        if(files.length == 0){ // jika file belum dipilih
          new Toast().view('Anda belum memilih file')
          return
        } 
        
        let formData = new FormData(f) // set data yang akan diinput
        formData.append('data', JSON.stringify(files))

        request.post('data-center', { // request
          data: formData, el: $(f).find('button:submit'),
          success: (res) => {
            new Toast().view(res.message)
            moveTo('.', {delay: 1000})
          },
          error: (err) => {
            console.log(err)
          }
        })
      }

      // get dan ekstrak data excel
      function onFile(input){
        let file = input.files[0],
            reader = new FileReader()

        reader.onload = function() {
          $('#filename').html(file.name)

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
              let allowed = ['nama','alamat','kota','gps','tanggal_lahir','jenis_kelamin','asal_sekolah','pekerjaan_orang_tua'];

              objs.forEach(o => { // set hanya yang diizinkan
                Object.entries(o).map(([k, v]) => allowed.indexOf(k) < 0 ? delete o[k] : o[k])
              })

              // cek key atau header, jika satu saja tidak terpenuhi maka gagal
              let available = []

              for (const key in objs[0]) {
                if(allowed.indexOf(key) > -1){
                  available.push(key)
                }
              }

              if(allowed.length != available.length){
                new Toast().view('File excel tidak valid!')
                $('#filename').html('')
                $('#file').val('')
                files = []
                return
              }

              // rapikan data "capitalize each word"
              let objs1 = [], setUppercase = ['asal_sekolah','pekerjaan_orang_tua','alamat'],
              pattern = [
                // disini kita isi apa aja yang mau kita uppercase
                'sma','smk','pns','ntt'
              ]

              // ganti huruf atau kata tertentu dengan jenis kelamin yang benar,
              // isi disini kata apa saja yang ingin kita ganti

              let replaceGenderM = [ // untuk laki-laki
                'L','Laki'
              ], replaceGenderF = [ // untuk perempuan
                'P','Cewe'
              ]

              objs.forEach(o => {
                let _o = {}
                Object.entries(o).map(([k, v]) => 
                  _o[k] = k == 'jenis_kelamin' ? replaceGenderM.includes(v) ? 'Laki-laki' : replaceGenderF.includes(v) ? 'Perempuan' : v
                      : o[k].toString().ucwords(true))

                objs1.push(_o)
              })

              // set huruf tertentu yang ingin di uppercase
              let fixData = []

              objs1.forEach(o => {
                let _o = {}
                
                Object.entries(o).map(([k, v]) => {
                  _o[k] = v

                  if(setUppercase.indexOf(k) > -1){
                    pattern.forEach(p => {
                      let vlower = v.toString().toLowerCase()

                      if(vlower.includes(p)){
                        _o[k] = k == 'alamat' ? vlower.replaceAll(p, p.toString().toUpperCase()).ucwords() : vlower.replaceAll(p, p.toString().toUpperCase()).ucwords()
                      }
                    })
                  }
                })

                fixData.push(_o)
              })

              console.log(fixData)

              files = fixData
            })

        }

        reader.readAsBinaryString(file)
      }

      function _delete(){
        $('#confirm').modal('show').onConfirm((p) => {

          request.delete('data-center/'+urlp('tahun'), { // request
            success: (res) => {
              $(p.button).html(p.default)

              new Toast().view(res.message)
              moveTo('.', {delay: 1000})
            },
            error: (err) => {
              new OnError().check(err)
              $(p.button).html(p.default).dis(false)

              $('#confirm').modal('hide')
            }
          })

        })
      }

    </script>


</body>

</html>