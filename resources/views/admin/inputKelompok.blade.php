@extends('master.app')

@section('content')
	<!--Main Navigation-->
    <header>

        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-3 fixed">
            <ul class="custom-scrollbar">
            <li>
				<a class="thumbnail" href="{{ url('/') }}">
        <img class="center">
					<img class="img-fluid" class="img-fluid z-depth-4" src="LOGO.png" width="134px">
				</a>
            </li>
            <br><br>

            <li>
                <ul class="collapsible collapsible-accordion">

                <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-database"></i> Pengguna</a>
                  <div class="collapsible-body">
                      <ul>
                          <li><a href="{{ url('/dataGuru') }}" class="waves-effect">Data Ustadz/Guru</a></li>
                          <li><a href="{{ url('/dataOrtu') }}" class="waves-effect">Data OrangTua</a></li>
                          <li><a href="{{ url('/dataPengajar') }}" class="waves-effect">Data Pengajar</a></li>
                      </ul>
                  </div>
                </li>
                    <li><a href="{{ url('/dataKelas') }}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-book-reader"></i> Kelas</a></li>
                    <li><a href="{{ url('/dataSantri') }}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-user-graduate"></i> Santri</a></li>
                    <li><a href="{{ url('/dataMapel') }}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-book-reader"></i> Mata Pelajaran</a></li>
                    <li><a href="{{ url('/dataKelompok') }}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-book-reader"></i> Kelompok Hafalan</a></li>

                </ul>
            </li>
            <!--/. Side navigation links -->
            </ul>
            <div class="sidenav-bg mask-strong"></div>
        </div>
        <!--/. Sidebar navigation -->

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fa fa-bars"></i></a>
            </div>
            <div class="breadcrumb-dn mr-auto">
                <p>Tambah Kelompok</p>
            </div>
            <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item avatar dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg" class="rounded-circle z-depth-0"
            alt="avatar image">
        </a>
        <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
          aria-labelledby="navbarDropdownMenuLink-55">
          <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
        </div>
      </li>
    </ul>
            <!--/Navbar links-->
        </nav>
        <!-- /.Navbar -->

    </header>
    <!--Main Navigation-->
    <body class="fixed-sn grey-skin">
          <main>
          <div class="container">
          <div class="card">
            <div class="card-body">
              @if(\Session::has('alert'))
                    <div class="alert alert-danger">
                        <div>{{Session::get('alert')}}</div>
                    </div>
                @endif
                @if(\Session::has('alert-success'))
                    <div class="alert alert-success">
                        <div>{{Session::get('alert-success')}}</div>
                    </div>
                    <script>
                      setTimeout(function() {
                        window.location = 'dataKelompok'
                      }, 1500);
                    </script>
                @endif
            <div class="mask rgba-gradient">
              <div class="container">
                <form class="" action="inputKelompok" method="post">
                  @csrf
                          <div class="col col-lg-100">
                              <div class="md-form">
                                  <select class="mdb-select md-form" name="id_guru" searchable="Pilih Ustadz/Guru">
                                    <option value="" disabled selected>Pilih Ustadz/Guru</option>
                                    @inject('kelompok', 'App\kelompok')
                                    @foreach ($dataGuru as $guru)
                                      @php
                                        $selectGuru = $kelompok::where('id_guru','=',$guru->id_guru)->first();
                                        if ($guru->id_guru == $selectGuru['id_guru']) {
                                          continue;
                                        }
                                      @endphp
                                    <option value="{{$guru->id_guru}}">{{$guru->nama_guru}}</option>
                                    @endforeach
                                  </select>

                              </div>
                            <div class="md-form">
                              <i class="fas fa-door-open prefix"></i>
                              <input type="text" id="nama_kelompok" name="nama_kelompok" class="form-control" required>
                              <label for="orangeForm-name">Nama Kelompok</label>
                            </div>

                            <div class="text-center">
                              <button class="btn btn-indigo btn-rounded mt-5">Tambah Kelompok</button>
                            </div>

                          </div>
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>

                      </div>
            </main>
@endsection
