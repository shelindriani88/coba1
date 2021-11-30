@extends('master.app')

@section('content')
  <!--Main Navigation-->
        <main>
            <div class="container-fluid">

       <!-- Section: Button icon -->
        <section>

          <!-- Grid row -->
          <div class="row">

            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card">
                <div class="row mt-3">
                  <div class="col-md-5 col-5 text-left pl-4">
                    <a type="button" class="btn-floating btn-lg primary-color ml-4"><i class="fas fa-school" aria-hidden="true"></i></a>
                  </div>
                  <div class="col-md-7 col-7 text-right pr-5">
                    @inject('kelas','App\kelas')
                    @php
                      $ckelas = $kelas::count();
                    @endphp
                    <h5 class="ml-4 mt-4 mb-2 font-weight-bold">{{$ckelas}} </h5>
                    <p class="font-small grey-text">Kelas</p>
                  </div>
                </div>
              </div>
            </div>

             <div class="col-xl-6 col-md-6 mb-4">
              <div class="card">
                <div class="row mt-3">
                  <div class="col-md-5 col-5 text-left pl-4">
                    <a type="button" class="btn-floating btn-lg red ml-4"><i class="fas fa-users" aria-hidden="true"></i></a>
                  </div>
                  <div class="col-md-7 col-7 text-right pr-5">
                    @inject('santri','App\santri')
                    @php
                      $csantri = $santri::count();
                    @endphp
                    <h5 class="ml-4 mt-4 mb-2 font-weight-bold">{{$csantri}} </h5>
                    <p class="font-small grey-text">Santri</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- Grid row -->
          <br>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h3>5 Santri dengan Persentase Hafalan Tertinggi</h3>
                      <table class="table">
                        <thead>
                          <tr>
                            <td>#</td>
                            <td>Nama</td>
                            <td>Kelas</td>
                            <td>Kelompok</td>
                            <td>Persentase</td>
                          </tr>
                        </thead>
                        <tbody>
                          @inject('kelompok','App\kelompok')
                          @inject('nilai','App\nilai')
                          @inject('hafalan','App\Hafalan')
                          @inject('ayat','App\Ayat')
                            @php
                              @$getsantri = $santri::orderBy('id_santri')->take(5)->get();
                              $no = 1;
                            @endphp
                            @foreach ($getsantri as $gsantri)
                            @php
                              @$getkelas = $kelas::where('id_kelas','=',$gsantri->id_kelas)->first()['nama_kelas'];
                              @$getkelompok = $kelompok::where('id_kelompok','=',$gsantri->id_kelompok)->first()['nama_kelompok'];
                              $persentase = 0;
                              $jumlah_hafalan = $hafalan::where('id_santri','=',$gsantri->id_santri)->count();
                              if($jumlah_hafalan>0){
                                    $total_ayat  = $ayat::count();
                                    $persentase = ($jumlah_hafalan *100)/$total_ayat;
                        //            pembulatan
                                    $persentase = round(floor($persentase*1000)/1000,2);
                                }
                            @endphp
                              <tr>
                                <td>{{$no}}</td>
                                <td>{{$gsantri->nama_santri}}</td>
                                <td>{{$getkelas}}</td>
                                <td>{{$getkelompok}}</td>
                                <td>{{$persentase}}%</td>
                              </tr>

                              @php
                                $no++;
                              @endphp
                            @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
          </div>

        </section>
        <!-- Section: Button icon -->

        <div style="height: 5px"></div>

            </div>
        </main>
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
                <p>Dashboard</p>
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
    @endsection
