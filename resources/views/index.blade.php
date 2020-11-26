@include('partials.header')

    <body class="antialiased">

        <div class="page">
            <div class="page-single my-auto">
              <div class="container">
                <div class="row">
                  <div class="col col-login mx-auto">
                    

                    <form class="card" onsubmit="return login(this)">
                      <div class="card-body">
                        <div class="card-title"> <i class="la la-lock la-lg mr-1"></i> Login ke akun Anda</div>

                        <div class="form-group">
                          <label class="form-label">Alamat Email</label>
                          <input type="email" name="email" value="user@gmail.com" class="form-control" required autocomplete="off" autofocus placeholder="Enter email">
                        </div>

                        <div class="form-group">
                          <label class="form-label">
                            Password
                          </label>
                          <input type="password" name="password" value="secret" class="form-control" required autocomplete="off" placeholder="Password">
                        </div>

                        {{-- <div class="form-group">
                          <label class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" />
                            <span class="custom-control-label">Ingat Saya</span>
                          </label>
                        </div> --}}

                        <div class="form-footer">
                          <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>

                      </div>
                    </form>

                    <div class="text-center text-muted">
                      &copy; 2020, OLAP
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        @include('partials.script')

        <script>

            function login(f){
              // el artinya element, jika kita ingin menampilkan indicator saat request atau submit form, gunakan el
              // set value el dengan DOM yang ingin diberikan indicator,
              // contoh: button dengan id = btn, maka el: $('#btn'), 
              // atau jika dengan form yang di dalamnya terdapat button submit maka el: $(f).find('button:submit')

              request.post('login', {
                  data: new FormData($(f)[0]), el: $(f).find('button:submit'),
                  success: (res) => {
                      new Toast().view(res.message)
                      moveTo('dashboard')
                  }
              })

              return false
            }

            // note: jadi disini kita akan sering menggunakan method atau fungsi get, post, put, delete dalam kelas request
            // get -> mengambil, post -> menambah, put -> mengubah, delete -> menghapus
            // contohnya pada funngsi di atas, request.post('login'), 'login' adalah url yang kita request
            // sedangkan data merupakan data-data yang ingin kita kirimkan
            // success atau error adalah kembalian dari hasil request, entah pesan error atau berhasil
        </script>
        
    </body>
</html>
