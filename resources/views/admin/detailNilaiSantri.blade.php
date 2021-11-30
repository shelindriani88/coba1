@extends('master.app')

@section('content')
    <header>

        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-3 fixed">
            <ul class="custom-scrollbar">
            <li>
				<a class="thumbnail" href="{{ url('/pageAdmin') }}">
        <img class="center">
					<img class="img-fluid" class="img-fluid z-depth-4" src="{{url('')}}/uploadFoto/LOGO.jpeg" width="134px">
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
                <p>Persentase Santri</p>
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
                <div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-4">
							<img src="{{$detailSantri->foto}}"  height="330px" width="280px"><br><br>
              <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdgantifoto">
  Ganti Foto
</button>

<!-- Modal -->
<div class="modal fade" id="mdgantifoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" method="post" enctype="multipart/form-data">
          @csrf
          <input type="file" name="foto" value="">
          <button type="submit" class="btn btn-primary">Ganti</button>
        </form>
      </div>
    </div>
  </div>
</div>
				              						</div>
						<div class="col-md-8">
              @inject('kelas', 'App\kelas')
              @inject('kelompok', 'App\kelompok')
              @inject('sikap', 'App\nilaiSikap')
              @php
                $getKelas = $kelas::where('id_kelas','=',$detailSantri->id_kelas)->first();
                $getKelompok = $kelompok::where('id_kelompok','=',$detailSantri->id_kelompok)->first();
                $getSikap = $sikap::where('id_santri','=',$detailSantri->id_santri)->first();
              @endphp
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th scope="col">Nama Santri</th><td>{{@$detailSantri->nama_santri}}</td>
									</tr>
                  <tr>
										<th scope="col">Nama OrangTua Santri</th><td>{{@$dataOrtu->nama_orangtua}}</td>
									</tr>
									<tr>
										<th scope="col">Alamat</th><td>{{@$detailSantri->alamat}}</td>
									</tr>
                  <tr>
										<th scope="col">Tempat Lahir</th><td>{{@$detailSantri->tempat_lahir}}</td>
									</tr>
                  <tr>
										<th scope="col">Tanggal Lahir</th><td>{{strftime('%d %B %Y', strtotime(@$detailSantri->tanggal_lahir))}}</td>
									</tr>
                  <tr>
										<th scope="col">Jenis Kelamin</th><td>{{@$detailSantri->jenis_kelamin}}</td>
									</tr>
                  <tr>
										<th scope="col">Kelas</th><td>{{@$getKelas->nama_kelas}}</td>
									</tr>
                  <tr>
										<th scope="col">Kelompok Hafalan Al-Quran</th><td>{{@$getKelompok->nama_kelompok}}</td>
									</tr>
                  <tr>
										<th scope="col">Sikap</th><td><h5><u>{{@$getSikap->sikap}}</u></h5></td>
									</tr>
                  <tr>
										<th scope="col">Status</th><td>{{@$detailSantri->status == 1 ? 'Aktif' : 'Lulus'}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<hr>
				</div>
        <div class="col-md-12">
        <h2><i class="fa fa-calendar"></i> Persentase Hafalan Santri</h2>
              <div class="progress md-progress" style="height: 20px">
                @inject('hafalan','App\Hafalan')
                @inject('ayat','App\Ayat')
                @php
                $persentase = 0;
                $jumlah_hafalan = $hafalan::where('id_santri','=',$detailSantri->id_santri)->count();
                if($jumlah_hafalan>0){
                      $total_ayat  = $ayat::count();
                      $persentase = ($jumlah_hafalan *100)/$total_ayat;
          //            pembulatan
                      $persentase = round(floor($persentase*1000)/1000,2);
                  }
                @endphp
                <div class="progress-bar" role="progressbar" style="width: {{@$persentase < 1 ? 1 : $persentase}}px;height: 20px" aria-valuenow="25"  aria-valuemin="0" aria-valuemax="100">{{@$persentase < 1 ? 1 : $persentase}}%</div>


              </div>
              <center>{{@$persentase}}%</center>
              <center>
                @if (@$nilaiSantri->persentase > 0 && @$nilaiSantri->persentase <= 30)
                  Sikap Buruk
                @elseif (@$nilaiSantri->persentase > 30 && @$nilaiSantri->persentase <= 70)
                  Sikap Baik
                @elseif (@$nilaiSantri->persentase > 70 && @$nilaiSantri->persentase <= 100)
                  Sikap Sangat Baik
                @endif
              </center>
              <br>
              <h2>Data Nilai Hafalan Santri</h2>
              <button type="button" id="cetak" class="btn btn-primary btn-sm">Cetak</button>
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Surah</th>
                            <th>Jumlah Ayat</th>
                            <th>Ayat Yang Sudah di Hafal</th>
                            <th>Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                      @inject('surah', 'App\Surah')
                      @inject('getsantri','App\santri')
                      @php
                        $getsurah = $surah::get();
                      @endphp
                      @foreach ($getsurah as $ih)
                        @php
                        $persensurah = 0;
                        $gethafalsurah = $hafalan->where('id_surah',$ih->id_surah)->get();
                  //      dd($hafalan);
                        if(sizeof($gethafalsurah)>0){
                            $jumlah_hafalan = $gethafalsurah->count();
                            $persensurah = round($jumlah_hafalan/$ih->ayat*100,2);
                        }
                        $jumlah_hafalan = $hafalan::where('id_surah','=',$ih->id_surah)->where('id_santri','=',$detailSantri->id_santri)->count();
                        @endphp
                      <tr>
                        <td>{{$no}}</td>
                        <td>{{$ih->nama}}</td>
                        <td>{{$ih->ayat}}</td>
                        <td>{{$jumlah_hafalan}}</td>
                        <td>{{$persensurah}}%</td>
                      </tr>
                        <?php $no++;?>
                      @endforeach
                    </tbody>
                </table>

                <div id="tableprint" style="display:none;">
                  <print id="areaprint">
                    <center>
                      <h3>Report Hafalan Santri</h3>
                      <h4>{{$detailSantri->nama_santri}}</h4>
                    </center>
                    <hr>
                    <table class="table table-striped table-bordered" style="width:100%">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Nama Surah</th>
                              <th>Jumlah Ayat</th>
                              <th>Ayat Yang Sudah di Hafal</th>
                              <th>Persentase</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;?>
                        @inject('surah', 'App\Surah')
                        @inject('getsantri','App\santri')
                        @php
                          $getsurah = $surah::get();
                        @endphp
                        @foreach ($getsurah as $ih)
                          @php
                          $persensurah = 0;
                          $gethafalsurah = $hafalan->where('id_surah',$ih->id_surah)->get();
                    //      dd($hafalan);
                          if(sizeof($gethafalsurah)>0){
                              $jumlah_hafalan = $gethafalsurah->count();
                              $persensurah = round($jumlah_hafalan/$ih->ayat*100,2);
                          }
                          $jumlah_hafalan = $hafalan::where('id_surah','=',$ih->id_surah)->count();
                          @endphp
                        <tr>
                          <td>{{$no}}</td>
                          <td>{{$ih->nama}}</td>
                          <td>{{$ih->ayat}}</td>
                          <td>{{$jumlah_hafalan}}</td>
                          <td>{{$persensurah}}%</td>
                        </tr>
                          <?php $no++;?>
                        @endforeach
                      </tbody>
                      </table>
                  </print>
                </div>

              </div>


              <div class="col-md-12">
                    <h2>Data Nilai Mata Pelajaran Santri
                      @if (!empty(Request::route('semester')))
                        Semester {{Request::route('semester')}}
                      @else
                        Semester 1
                      @endif
                    </h2>
                    <div class="row">
                      <div class="col-md-8">
                        <button type="button" id="cetak2" class="btn btn-primary btn-sm">Cetak</button>
                      </div>
                    <div class="col-md-4 float-rigth">
                      <select class="mdb-select md-form" name="semester" onchange='getnilai(this.value)' searchable="Pilih Semester">
                        <option value="" disabled selected>Choose your option</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                      </select>
                    </div>
                  </div>

                    <table id="example1" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                              <tr>
                                  <th>Nama Mata Pelajaran</th>
                                  <th>Nilai Mata Pelajaran</th>
                                  <th>Grade</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php $no = 1;?>
                            @inject('nilaiMapel', 'App\penilaianMapel')
                            @foreach (@$mapel as $ih)
                              @php
                              if (!empty(Request::route('semester'))) {
                                $ceknilai = @$nilaiMapel::where('id_mapel','=',$ih['id_mapel'])->where('id_santri','=',$detailSantri['id_santri'])->where('semester','=',Request::route('semester'))->get()[0];
                              }else{
                                $ceknilai = @$nilaiMapel::where('id_mapel','=',$ih['id_mapel'])->where('id_santri','=',$detailSantri['id_santri'])->get()[0];
                              }
                              @endphp
                            <tr>
                              <td>{{$ih['nama_mapel']}}</td>
                              <td>{{$ceknilai['nilai']}}</td>
                              <td>
                                @if (@$ceknilai['nilai'] > 0 && @$ceknilai['nilai'] <= 10)
                                  E
                                @elseif (@$ceknilai['nilai'] > 10 && @$ceknilai['nilai'] <= 30)
                                  D
                                @elseif (@$ceknilai['nilai'] > 30 && @$ceknilai['nilai'] <= 60)
                                  C
                                @elseif (@$ceknilai['nilai'] > 60 && @$ceknilai['nilai'] <= 80)
                                  B
                                @elseif (@$ceknilai['nilai'] > 80 && @$ceknilai['nilai'] <= 100)
                                  A
                                @endif
                              </td>
                            </tr>
                              <?php $no++;?>
                            @endforeach
                          </tbody>
                      </table>

                      <div id="tableprint2" style="display:none;">
                        <print id="areaprint2">
                          <center>
                            <h3>Report Hafalan Santri</h3>
                            <h4>{{$detailSantri->nama_santri}}</h4>
                          </center>
                          <hr>
                          <table id="example1" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama Mata Pelajaran</th>
                                        <th>Nilai Mata Pelajaran</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $no = 1;?>
                                  @inject('nilaiMapel', 'App\penilaianMapel')
                                  @foreach (@$mapel as $ih)
                                    @php
                                    if (!empty(Request::route('semester'))) {
                                      $ceknilai = @$nilaiMapel::where('id_mapel','=',$ih['id_mapel'])->where('id_santri','=',$detailSantri['id_santri'])->where('semester','=',Request::route('semester'))->get()[0];
                                    }else{
                                      $ceknilai = @$nilaiMapel::where('id_mapel','=',$ih['id_mapel'])->where('id_santri','=',$detailSantri['id_santri'])->get()[0];
                                    }
                                    @endphp
                                  <tr>
                                    <td>{{$ih['nama_mapel']}}</td>
                                    <td>{{$ceknilai['nilai']}}</td>
                                    <td>
                                      @if (@$ceknilai['nilai'] > 0 && @$ceknilai['nilai'] <= 10)
                                        E
                                      @elseif (@$ceknilai['nilai'] > 10 && @$ceknilai['nilai'] <= 30)
                                        D
                                      @elseif (@$ceknilai['nilai'] > 30 && @$ceknilai['nilai'] <= 60)
                                        C
                                      @elseif (@$ceknilai['nilai'] > 60 && @$ceknilai['nilai'] <= 80)
                                        B
                                      @elseif (@$ceknilai['nilai'] > 80 && @$ceknilai['nilai'] <= 100)
                                        A
                                      @endif
                                    </td>
                                  </tr>
                                    <?php $no++;?>
                                  @endforeach
                                </tbody>
                            </table>
                        </print>
                      </div>

                    </div>
      </div>
    </div>
            </div>
              </div>
            </div>
            </div>
        </main>
@endsection
