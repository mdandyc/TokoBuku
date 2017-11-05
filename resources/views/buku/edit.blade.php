@if (Auth::user()->role == 'admin')
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Menu</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ URL::asset('css/skin-blue.min.css') }}">

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <script src="https://use.fontawesome.com/75341ac20c.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>T</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Toko</b>Buku</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
           
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><i class="fa fa-user-circle" aria-hidden="true"></i> Admin</span>

            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
          
                  <img src="\images\default.jpg" class="img-circle" alt="User Image"><br>
                <p> - User
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a>


                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
        
                  <img src="\images\default.jpg" class="img-circle" alt="User Image"><br>
        </div>
        <div class="pull-left info">
          <a href=""><h5>User!</h5></a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="/buku/search" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="keyword" class="form-control" placeholder="Search Branch Name..." required>
          <span class="input-group-btn">
              <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        @if (Auth::user()->role !== 'admin')
        <li class=""><a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
        
         </a></li>
        <li class="active">
          <a href="/penjualan">
            <i class="fa fa-handshake-o"></i> <span>Penjualan</span><span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
           </span> 
          </a>
        </li>
      @else
      <li class=""><a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
        
         </a></li>
        <li class=""><a href="/kasir"><i class="fa fa-user"></i> <span>Kasir</span>
        
         </a></li>
        <li class="">
          <a href="/distributor"><i class="fa fa-user-circle"></i> <span>Distributor</span>
          </a>
        </li>
        <li class="active">
          <a href="/buku">
            <i class="fa fa-book"></i> <span>Buku</span><span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
           </span> 
          </a>
        </li>
        <li class="">
          <a href="/pasok">
            <i class="fa fa-newspaper-o"></i> <span>Pasok</span>
                        
          </a>

        </li>
        <li class="">
          <a href="/penjualan">
            <i class="fa fa-handshake-o"></i> <span>Penjualan</span>
                        
          </a>

        </li>
      </ul>
      @endif
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        List Detail
        <small><a href="/buku/create">Input</a></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    <div class="row">

        <div class="container">
            
<form action="/buku/{{$buku->id_buku}}" method="POST">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" placeholder="Judul" class="form-control" value="{{$buku->judul}}">
    </div>
    <div class="form-group">
        <label>isbn</label>
        <input type="text" name="isbn" placeholder="isbn" class="form-control" value="{{$buku->isbn}}">
    </div>
    <div class="form-group">
        <label>penulis</label>
        <input type="text" name="penulis" placeholder="penulis" class="form-control" value="{{$buku->penulis}}">
    </div>
    <div class="form-group">
        <label>penerbit</label>
        <input type="text" name="penerbit" placeholder="penerbit" class="form-control" value="{{$buku->penerbit}}">
    </div>
    <div class="form-group">
        <label>tahun</label>
        <input type="text" name="tahun" placeholder="tahun" class="form-control" value="{{$buku->tahun}}">
    </div>
    <div class="form-group">
        <label>stok</label>
        <input type="text" name="stok" placeholder="stok" class="form-control" value="{{$buku->stok}}">
    </div>
    <div class="form-group">
        <label>harga_pokok</label>
        <input type="text" name="harga_pokok" placeholder="harga_pokok" class="form-control" value="{{$buku->harga_pokok}}">
    </div>
    <div class="form-group">
        <label>harga_jual</label>
        <input type="text" name="harga_jual" placeholder="harga_jual" class="form-control" value="{{$buku->harga_jual}}">
    </div>
    <div class="form-group">
        <label>ppn</label>
        <input type="text" name="ppn" placeholder="ppn" class="form-control" value="{{$buku->ppn}}">
    </div>
    <div class="form-group">
        <label>diskon</label>
        <input type="text" name="diskon" placeholder="diskon" class="form-control" value="{{$buku->diskon}}">
    </div>
    

    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="_method" value="PUT">
    <input type="submit" value="SUBMIT" class="btn btn-primary">
</form>
        </div>

      </div>
      <center>

      </center>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
   <strong>© Powered By<a href="#">  </a>2017</strong> .
  </footer>

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ URL::asset('js/jquery-3.1.1.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::asset('js/app.js') }}"></script>
<!-- ownerLTE App -->
<script src="{{ URL::asset('js/Adminlte.min.js') }}"></script>

</body>
</html>
@else
<meta http-equiv="refresh" content="0; url=/">
@endif

