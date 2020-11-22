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
                            Akun Saya
                          </h2>
                        </div>
                        
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-5 col-md-7 col-sm-12">
                        <div class="card">
                          <div class="card-body">
                              <div class="row mb-3">
                                <div class="col-auto pos-relative">
                                  <span class="avatar avatar-lg" style="background-image: url({{ $data->detail->foto == null ? asset('assets/images/profile.png') : url('images/'.$data->detail->foto)}})"></span>
                                  <div class="change-avatar-toggle" onclick="$('#foto').click()">
                                    <i class="la la-lg la-camera"></i>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="d-flex h-100">
                                    <div class="justify-content-center align-self-center">
                                      <h3 class="my-auto"> {{$data->detail->nama}} </h3>
                                      <label class=""> {{$data->email}} </label>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <ul class="list-group">
                                <li class="list-group-item">
                                  <h5 class="m-0">Tempat & Tanggal Lahir</h5>
                                  {{$data->detail->tempat_lahir.', '.date('d-m-Y',strtotime($data->detail->tanggal_lahir))}}
                                </li>

                                <li class="list-group-item">
                                  <h5 class="m-0">Jenis Kelamin</h5> {{ucwords($data->detail->jenis_kelamin)}}
                                </li>

                                <li class="list-group-item">
                                  <h5 class="m-0">Alamat</h5> {{$data->detail->alamat}}
                                </li>
                              </ul>

                              <ul class="list-group mt-3">
                                <li class="list-group-item">
                                  <h5 class="m-0">Email</h5>
                                  {{$data->email}}
                                </li>

                                <li class="list-group-item">
                                  <h5 class="m-0">Password</h5> ***************
                                </li>
                              </ul>
                              
                              <div class="mt-3">
                                <div class="btn-group justify-content-between">
                                  <button class="btn btn-white" onclick="_editAccount(JSON.stringify({{$data}}))"> <i class="la la-lg la-lock mr-1"></i> Edit Akun</button>
                                  <button class="btn btn-white" onclick="_edit(JSON.stringify({{$data}}))"> <i class="la la-lg la-user mr-1"></i> Edit Profil</button>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>
            </div>
        </div>

    @include('modals.form_profile')
    @include('modals.form_account')
    @include('modals.form_foto')
    {{-- @include('partials.script') --}}

    <script>
      
      // fungsi untuk edit data profil
      function submit(f, id){ // fungsi submit form
        request.put(`akun/${id}`, { // request
          data: new FormData(f), el: $(f).find('button:submit'),
          success: (res) => {
            new Toast().view(res.message)
            moveTo('.', {delay: 1000})
          }
        })
      }

      // tampilkan form edit profil
      function _edit(row){
        const data = JSON.parse(row);

        $('#form-profile').modal('show').modalConfig((f) => submit(f, data.id), {
          title: 'Edit Profil',
          initData: {
            'nama': data.detail.nama,
            'tempat_lahir': data.detail.tempat_lahir,
            'tanggal_lahir': data.detail.tanggal_lahir,
            'jenis_kelamin': data.detail.jenis_kelamin,
            'alamat': data.detail.alamat,
          }
        })
      }

      // tampilkan form edit akun
      function _editAccount(row){
        const data = JSON.parse(row);

        $('#form-account').modal('show').modalConfig((f) => submitChangeAccount(f), {
          title: 'Edit Akun',
          initData: {
            'email': data.email
          }
        })
      }

      // fungsi untuk mengubah akun (email, dan password)
      function submitChangeAccount(f){
        let pass = $('#pass').val(), cpass = $('#cpass').val()

        if(pass.length < 6){
          new Toast().view('Minimal password 6 karakter'); $('#pass').focus(); return
        }else{
          if(pass != cpass){
            new Toast().view('Konfirmasi password tidak sesuai')
            $('#cpass').focus(); return
          }
        }

        request.post('akun/update-akun', { // request
          data: new FormData(f), el: $(f).find('button:submit'),
          success: (res) => {
            new Toast().view(res.message)
            moveTo('.', {delay: 2000})
          }
        })
      }

      // fungsi untuk melihat atau menyembunyikan password
      function _obsecure(e){
        let pass = $('.input-password')
        if(pass.attr('type') == 'password'){
          pass.attr('type','text'); $(e).html('Sembunyikan Password')
        }else{
          pass.attr('type','password'); $(e).html('Tampilkan Password')
        }
      }

      let file // tempat base64 url disimpan untuk dikirim ke server

      // fungsi untuk menampilkan gambar sebelum diupload
      function previewImg(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('#preview-img').attr('src', e.target.result);
            file = e.target.result // set base64 url

            $('#form-foto').modal('show').modalConfig((f) => submitChangePhoto(f), {
              title: 'Perbarui Foto'
            })
          }
          
          reader.readAsDataURL(input.files[0]);
        }
      }

      function submitChangePhoto(f){
        // pada modal form foto, karena element input:file diset hidden maka oleh formData dianggap tidak ada,
        // maka dari itu kita buat formData terpisah kemudian diset url fotonya

        let formData = new FormData()
        formData.append('foto', dataURLtoFile(file, 'file.png'))

        request.post('akun/update-foto', { // request
          data: formData, el: $(f).find('button:submit'),
          success: (res) => {
            new Toast().view(res.message)
            moveTo('.', {delay: 1000})
          }
        })
      }

    </script>


</body>
</html>