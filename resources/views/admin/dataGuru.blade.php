@extends('master.app')

@section('content')
    <header>

        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-3 fixed">
            <ul class="custom-scrollbar">
            <li>
				<a class="thumbnail" href="{{ url('/pageAdmin') }}">
        <img class="center">
					<img class="img-fluid" class="img-fluid z-depth-4" src="{{url('')}}/uploadFoto/LOGO.jpeg" width="120px" height="80px">
				</a>
            </li>
            <br><br><br><br>

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
                    <li><a href="{{ url('/dataPenilaianSantri') }}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-book-reader"></i> Penilaian Santri</a></li>
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
                <p>Data Ustadz/Guru</p>
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
              <a href="{{ url('/inputGuru') }}" class="btn btn-info">Tambah Ustadz/Guru</a>
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ustadz/Guru</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Nomer Handphone</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                      @foreach ($dataGuru as $ih)
                      <tr>
                        <td>{{$no}}</td>
                        <td>{{$ih->nama_guru}}</td>
                        <td>{{$ih->jenis_kelamin}}</td>
                        <td>{{$ih->tanggal_lahir}}</td>
                        <td>{{$ih->tempat_lahir}}</td>
                        <td>{{$ih->alamat}}</td>
                        <td>{{$ih->noHp}}</td>
                        <td> <a href="{{ url('/hapusDataGuru/'.$ih->id_guru) }}" class="btn btn-danger btn-rounded btn-sm" onclick="return confirm('Apa Anda Yakin Ingin Menghapus?');">Hapus</a> <a href="{{ url('/editDataGuru/'.$ih->id_guru) }}" class="btn btn-info btn-rounded btn-sm">Edit</a> </td>
                      </tr>
                        <?php $no++;?>
                      @endforeach
                    </tbody>
                </table>
              </div>

            </div>
              </div>
            </div>
            </div>
        </main>
      @endsection
