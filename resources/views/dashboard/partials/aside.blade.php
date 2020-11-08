<aside class="navbar navbar-vertical navbar-expand-lg navbar-light">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a href="." class="navbar-brand navbar-brand-autodark">
        {{-- <img src="./static/logo-white.svg" alt="Tabler" class="navbar-brand-image"> --}}
      </a>
      <div class="navbar-nav flex-row d-lg-none">
        <div class="nav-item dropdown d-none d-md-flex mr-3">
          <a href="#" class="nav-link px-0" data-toggle="dropdown" tabindex="-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
            <span class="badge bg-red"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-card">
            <div class="card">
              <div class="card-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad amet consectetur exercitationem fugiat in ipsa ipsum, natus odio quidem quod repudiandae sapiente. Amet debitis et magni maxime necessitatibus ullam.
              </div>
            </div>
          </div>
        </div>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
            <span class="avatar" style="background-image: url(./static/avatars/000m.jpg)"></span>
            <div class="d-none d-xl-block pl-2">
              <div>Paweł Kuna</div>
              <div class="mt-1 small text-muted">UI Designer</div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><circle cx="12" cy="12" r="3" /></svg>
              Action
            </a>
            <a class="dropdown-item" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
              Another action
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Separated link</a>
          </div>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navbar-menu">
        <ul class="navbar-nav pt-lg-3">

          <li class="nav-item">
            <a class="nav-link" href="{{url('dashboard')}}" data-href="dashboard">
              <span class="nav-link-title">
                <i class="la la-lg la-home mr-1"></i> Beranda
              </span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('data-center')}}" data-href="data-center">
              <span class="nav-link-title">
                <i class="la la-lg la-database mr-1"></i> Data Center
              </span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('data-mart')}}" data-href="data-mart">
              <span class="nav-link-title">
                <i class="la la-lg la-server mr-1"></i> Data Mart
              </span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('user')}}" data-href="user">
              <span class="nav-link-title">
                <i class="la la-lg la-user mr-1"></i> Pengguna
              </span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('akun')}}" data-href="akun">
              <span class="nav-link-title">
                <i class="la la-lg la-lock mr-1"></i> Akun
              </span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('logout')}}">
              <span class="nav-link-title text-danger">
                <i class="la la-lg la-sign-out mr-1"></i> Logout
              </span>
            </a>
          </li>
          
          {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-extra" data-toggle="dropdown" role="button" aria-expanded="false" >
              <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" /></svg>
              </span>
              <span class="nav-link-title">
                Extra
              </span>
            </a>
            <ul class="dropdown-menu">
              <li >
                <a class="dropdown-item" href="./invoice.html" >
                  Invoice
                </a>
              </li>
              <li >
                <a class="dropdown-item" href="./blog.html" >
                  Blog cards
                </a>
              </li>
              <li >
                <a class="dropdown-item" href="./snippets.html" >
                  Snippets
                </a>
              </li>
              <li >
                <a class="dropdown-item" href="./search-results.html" >
                  Search results
                </a>
              </li>
              <li >
                <a class="dropdown-item" href="./pricing.html" >
                  Pricing cards
                </a>
              </li>
              <li >
                <a class="dropdown-item" href="./users.html" >
                  Users
                </a>
              </li>
              <li >
                <a class="dropdown-item" href="./gallery.html" >
                  Gallery
                </a>
              </li>
              <li >
                <a class="dropdown-item" href="./profile.html" >
                  Profile
                </a>
              </li>
              <li >
                <a class="dropdown-item" href="./music.html" >
                  Music
                </a>
              </li>
            </ul>
          </li> --}}
          
        </ul>
      </div>
    </div>
</aside>

@include('partials.script')

<script>
    $(document).ready(function(){
        $('#navbar-menu ul').find('li').each(function(){
            let href = $(this).find('a').attr('data-href')
            if(urlp().indexOf(href) > -1){
                $(this).addClass('active')
            }
        })
    })
</script>