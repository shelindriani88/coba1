<!DOCTYPE html>
<html lang="en">
  <head>

    <title>.....</title>
    <link rel="icon" href="{{url('')}}/uploadFoto/LOGO.jpeg">
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
                <p>Data Santri</p>
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
                  <div class="col-md-8">
                    <h4>Data Penilaian
                      @if (!empty(Request::route('semester')))
                        Semester {{Request::route('semester')}}
                      @else
                        Semester 1
                      @endif
                    </h4>
                  </div>
                <div class="col-md-4 float-rigth">
                  <select class="mdb-select md-form" name="semester" onchange='getnilai(this.value)' searchable="Pilih Semester">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                  </select>
                </div>
              </div>
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Total Hafalan</th>
                            @foreach ($mapel as $dataMapel)
                              <th><b>{{$dataMapel->nama_mapel}}</b></th>
                            @endforeach
                            <th><b>Rata-rata Nilai Mata Pelajaran Keseluruhan</b></th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                      @inject('nilaiMapel', 'App\penilaianMapel')
                      @inject('nilaiNgaji', 'App\nilai')
                      @inject('hafalan', 'App\Hafalan')
                      @foreach (@$dataSantri as $ih)
                        @php
                        @$ceknilaiG = $nilaiNgaji::where('id_santri','=',$ih->id_santri)->get()[0]['id_nilai'];
                        @$gethafalan = $hafalan::where('id_santri','=',$ih->id_santri)->count();
                        $totalnilai = 0;
                        @endphp
                      <tr>
                        <td>{{$no}}</td>
                        <td>{{$ih->nama_santri}}</td>
                        <td>{{$gethafalan}} Ayat</td>
                        @foreach ($mapel as $dataMapel)
                          @php

                          if (!empty(Request::route('semester'))) {
                            @$ceknilai = @$nilaiMapel::where('id_mapel','=',$dataMapel->id_mapel)->where('id_santri','=',$ih->id_santri)->where('semester','=',Request::route('semester'))->get()[0];
                          }else{
                            @$ceknilai = @$nilaiMapel::where('id_mapel','=',$dataMapel->id_mapel)->where('id_santri','=',$ih->id_santri)->get()[0];
                          }
                          $totalnilai += $ceknilai['nilai'];
                          $rata = $totalnilai/count($mapel);
                          $rata = round($rata,1);
                          @endphp
                          <td>{{$ceknilai['nilai'] == '' ? '-' : $ceknilai['nilai']}}</td>
                        @endforeach
                        <td>{{$rata}}</td>
                        <td> <a href="{{ url('/detailNilaiSantri/'.$ih->id_santri) }}" class="btn btn-danger btn-rounded btn-sm">Detail Santri</a>
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
      <script type="text/javascript" src="{{url('')}}/js/compiled.192.min.js"></script>
      <script type="text/javascript" src="{{url('')}}/js/popper.min.js"></script>
      <script type="text/javascript" src="{{url('')}}/js/addons/datatables.min.js"></script>
      <script type="text/javascript" src="{{url('')}}/js/sweetalert.min.js"></script>
      <script type="text/javascript" src="{{url('')}}/js/sweetalert-dev.js"></script>
      <script type="text/javascript" src="{{url('')}}/js/jquery.PrintArea.js"></script>
      <script type="text/javascript">
      function getnilai(s){
        window.location = location.origin+'/dataPenilaianSantri/'+s
      }
      </script>
      <script>
            // SideNav Initialization


            // Material Select Initialization
            $(document).ready(function () {
              $('.mdb-select').materialSelect();
              $(".button-collapse").sideNav();

              var container = document.querySelector('.custom-scrollbar');
              Ps.initialize(container, {
                  wheelSpeed: 2,
                  wheelPropagation: true,
                  minScrollbarLength: 20
              });

              // Data Picker Initialization
              $('.datepicker').pickadate();
            });

            // Tooltips Initialization
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
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
                 <script type="text/javascript">
                 $(document).ready(function() {
                   setTimeout(function() {
                   // Material Design example
                   $('#example').DataTable();
                   $('#example_wrapper').find('label').each(function () {
                   $(this).parent().append($(this).children());
                   });
                   $('#example_wrapper .dataTables_filter').find('input').each(function () {
                   $(this).attr("placeholder", "Search");
                   $(this).removeClass('form-control-sm');
                   });
                   $('#example_wrapper .dataTables_length').addClass('d-flex flex-row');
                   $('#example_wrapper .dataTables_filter').addClass('md-form');
                   $('#example_wrapper select').removeClass(
                   'custom-select custom-select-sm form-control form-control-sm');
                   $('#example_wrapper select').addClass('mdb-select');
                   $('#example_wrapper .mdb-select').materialSelect();
                   $('#example_wrapper .dataTables_filter').find('label').remove();
                 }, 100);
                 } );
               </script>

      <script type="text/javascript">
          (function() {
          'use strict';
          window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();
        </script>

    </body>
    </html>
