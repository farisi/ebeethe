<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/all.css')}}" rel="stylesheet" />
    @yield('styles')

    <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.2.4/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyArfY_Lq1UL56t3WpnJ4gZhd6f5jrIgAtM",
    authDomain: "caleg-87d1e.firebaseapp.com",
    databaseURL: "https://caleg-87d1e.firebaseio.com",
    projectId: "caleg-87d1e",
    storageBucket: "caleg-87d1e.appspot.com",
    messagingSenderId: "775048594118",
    appId: "1:775048594118:web:fbdf6c57be42bfab"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
</script>

<link href="{{request()->root()}}/public/manifest.json" rel="manifest">

</head>
<body>
    <div id="app">
        <div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="white">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo">
        <a href="{{url('/home')}}" class="simple-text logo-mini">
          <img src="{{asset('css/assets/img/logo.png')}}" width="80" height="80">
        </a>
        <a href="{{url('/home')}}" class="simple-text logo-normal">
          {{ config('app.name', 'Laravel') }}
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
        @php $routeName = \Request::route()->getName() @endphp
          <li class="nav-item {{$routeName=='dashboard' || $routeName=='home' ? 'active' :''}}  ">
            <a class="nav-link" href="{{url('/home')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          
          <li class="nav-item  {{explode('.',$routeName)[0] === 'status' || explode('.',$routeName)[0] ==='companies' ? 'active' :''}} ">
            <a class="nav-link" href="javascript:void()">
              <i class="material-icons">settings</i>
              <p>Setting</p>
            </a>
        </li>
          <li class="nav-item {{explode('.',$routeName)[0] === 'taxes' ? 'active' :''}}">
            <a class="nav-link" href="{{route('taxes.index')}}">
              <i class="material-icons">assignment_ind</i>
              <p>STPD</p>
            </a>
          </li>
          <li class="nav-item {{explode('.',$routeName)[0] === 'teguran' ? 'active' :''}}  ">
            <a class="nav-link" href="{{route('teguran.index')}}">
              <i class="material-icons">assignment_late</i>
              <p>Teguran</p>
            </a>
          </li>

          <li class="nav-item  {{explode('.',$routeName)[0] === 'problems' ? 'active' :''}} ">
              <a class="nav-link" href="{{route('problems.index')}}">
                <i class="material-icons">notifications</i>
                <p>Data Bermasalah</p>
              </a>
          </li>

          
        <li class="nav-item  {{explode('.',$routeName)[0] === 'users' ? 'active' :''}} ">
          <a class="nav-link" href="{{route('users.index')}}">
            <i class="material-icons">account_box</i>
            <p>Pengguna</p>
          </a>
      </li>

          <li class="nav-item  {{explode('.',$routeName)[0] === 'reports' ? 'active' :''}} ">
            <a class="nav-link" href="{{route('reports.index')}}">
              <i class="material-icons">report</i>
              <p>Laporan</p>
            </a>
        </li>



          <!-- your sidebar here -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
         
          <div class="navbar-wrapper">
            
            <a class="navbar-brand" href="{{url(explode(".",$routeName)[0])}}">{{strlen(\Request::route()->getPrefix()) ===0 ? ucfirst(explode(".",$routeName)[0])  :ucfirst(ltrim(\Request::route()->getPrefix(), '/'))}}</a>
            
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="{{route('problems.index')}}">
                  <i class="material-icons">notifications</i><span class="badge badge-danger badge-pill mynotif">0</span> Notifications
                </a>
              </li>
              <li class="nav-item dropdown ">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                <div class="ripple-container"></div></a>
                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="{{route('companies.index')}}">Objek Pajak</a>
                  <a class="dropdown-item" href="{{route('status.index')}}">Status</a>
                  <a class="dropdown-item" href="{{route('company_categories.index')}}">Jenis Objek Pajak</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
              </li>
              <!-- your navbar here -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          @yield('content')
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="{{route('dashboard')}}">
                  PERPAJAKAN
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, Dibuat  <i class="material-icons">favorite</i> Oleh
            <a href="{{route('dashboard')}}" target="_blank">Walikota</a> Bidang Pajak.
          </div>
          <!-- your footer here -->
        </div>
      </footer>
    </div>
  </div>
    </div>
    <script>
      $(document).ready(function(){
        setInterval(function(){
          $.ajax({
            url:"{{route('api.taxes.findnotif')}}",
            success:function(res){
                 $('.mynotif').html(res);
            }
         });
        },30000);
      });
    </script>
    @yield('scripts')
</body>
</html>
