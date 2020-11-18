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
                            Pengguna
                          </h2>
                        </div>

                        @if (Auth::user()->level == 'admin')
                        <div class="col-auto ml-auto d-print-none">
                          <button class="btn btn-primary" onclick="_add()"> <i class="la la-lg la-plus mr-1"></i> Tambah</button>
                        </div>
                        @endif
                      </div>
                    </div>

                    <div class="card px-2 pb-3">
                      <table id="datatable" class="table m-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Level</th>
                                @if (Auth::user()->level == 'admin') <th></th> @endif
                            </tr>
                        </thead>
                        <tbody>
                          @php $index = 1 @endphp
                          @foreach ($users as $row)
                          
                            <tr>
                              <td> {{$index++}} </td>
                              <td> {{$row->detail->nama}} </td>
                              <td> {{$row->detail->alamat}} </td>
                              <td> {{$row->email}} </td>
                              <td> {{$row->detail->telepon}} </td>
                              <td> {{$row->level}} </td>
                              @if (Auth::user()->level == 'admin')
                                <td>
                                  <div class="btn-group">
                                    <button class="btn btn-white" onclick="_edit(JSON.stringify({{$row}}))"> <i class="la la-lg la-pen"></i> </button>
                                    <button class="btn btn-danger" onclick="_delete({{$row->id}})"> <i class="la la-lg la-trash"></i> </button>
                                  </div>
                                </td>
                                @endif
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                </div>
            </div>
        </div>

    @include('modals.form_user')
    @include('modals.confirm')
    {{-- @include('partials.script') --}}

    <script>
      $(document).ready(function() {
          $('#datatable').DataTable({
            searching: false, info: false, bLengthChange: false, pageLength: 20
          });
      });

      function _add(){ // tampilkan modal dan set form config
        $('#form-user').modal('show').modalConfig((f) => submit(f), {
          title: 'Tambah Pengguna'
        })
      }

      function submit(f, id){
        if(!id){
          request.post('user', { // request
            data: new FormData(f), el: $(f).find('button:submit'),
            success: (res) => {
              new Toast().view(res.message)
              moveTo('.', {delay: 1000})
            }
          })
        }else{
          request.put(`user/${id}`, { // request
            data: new FormData(f), el: $(f).find('button:submit'),
            success: (res) => {
              new Toast().view(res.message)
              moveTo('.', {delay: 1000})
            }
          })
        }
      }

      function _edit(row){
        const data = JSON.parse(row)

        $('#form-user').modal('show').modalConfig((f) => submit(f, data.id), {
          title: 'Edit Pengguna',
          initData: {
            'nama': data.detail.nama,
            'alamat': data.detail.alamat,
            'telepon': data.detail.telepon,
            'email': data.email,
            'level': data.level
          }
        })
      }

      function _delete(id){
        $('#confirm').modal('show').onConfirm((p) => {
          request.delete(`user/${id}`, { // request
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