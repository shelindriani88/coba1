<!DOCTYPE html>
<html lang="en">
  <head>

    <title>.....</title>
    <link rel="icon" href="LOGO.png">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/mdb.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/modules/animations-extended.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/print.css" media="print">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/css/tagify.css">
    <script type="text/javascript" src="{{url('')}}/js/jquery-3.3.1.min.js"></script>
    </head>

<body class="fixed-sn grey-skin">
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
                    <li><a href="{{ url('/santriKelas') }}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-book-reader"></i> Penilaian</a></li>
                </ul>
                <ul class="collapsible collapsible-accordion">
                    <li><a href="{{ url('/inputSikap') }}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-book-reader"></i> Input Sikap Santri</a></li>
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
                <p>Dashboard Pengajar</p>
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

      <footer class="page-footer pt-0 mt-5 mdb-color lighten-4">

          <!--Copyright-->
          <div class="footer-copyright py-3 text-center">
                <div class="container-fluid">
                   Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved

              </div>
          </div>
          <!--/.Copyright-->

      </footer>

      <script type="text/javascript" src="{{url('')}}/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="{{url('')}}/js/mdb.min.js"></script>
      <script type="text/javascript" src="{{url('')}}/js/popper.min.js"></script>
      <script type="text/javascript" src="{{url('')}}/js/sweetalert.min.js"></script>
      <script type="text/javascript" src="{{url('')}}/js/sweetalert-dev.js"></script>
      <script type="text/javascript" src="{{url('')}}/js/jquery.PrintArea.js"></script>
      {{-- <script type="text/javascript">
        (function notif(){
          $('#notif').html('');
          setTimeout(function(){
          $.ajax({
          type: 'GET',
          url: '{{url('/jsonBok')}}',
          dataType: 'json',
          success: function (data) {
              var cnotif = data.length;
              $('#cnotif').html(cnotif);
          }
      });
      notif();
    }, 1000);
    })(0);
      </script> --}}
    	<script>
            // SideNav Initialization


            // Material Select Initialization
            $(document).ready(function () {
              $(".button-collapse").sideNav();

              var container = document.querySelector('.custom-scrollbar');
              Ps.initialize(container, {
                  wheelSpeed: 2,
                  wheelPropagation: true,
                  minScrollbarLength: 20
              });

              // Data Picker Initialization
              $('.datepicker').pickadate();
                $('.mdb-select').material_select();
            });

            // Tooltips Initialization
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        {{-- <script>
            // Small chart
            $(function () {
                $('.min-chart#chart-sales').easyPieChart({
                    barColor: "#4285F4",
                    onStep: function (from, to, percent) {
                        $(this.el).find('.percent').text(Math.round(percent));
                    }
                });
            });



            //bar
            var ctxB = document.getElementById("barChart").getContext('2d');
            var myBarChart = new Chart(ctxB, {
                type: 'bar',
                data: {
                    labels: ["January", "Febuary", "March", "April", "May"],
                    datasets: [{
                        label: '# of Votes',
                        data: [13, 19, 8, 11, 5],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.3)',
                            'rgba(41, 182, 246, 0.3)',
                            'rgba(255, 187, 51, 0.3)',
                            'rgba(66, 133, 244, 0.3)',
                            'rgba(153, 102, 255, 0.3)',

                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(41, 182, 246, 1)',
                            'rgba(255, 187, 51, 1)',
                            'rgba(66, 133, 244, 1)',
                            'rgba(153, 102, 255, 1)',

                        ],
                        borderWidth: 2
                    }]
                },
                optionss: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script> --}}
    </body>
    </html>
