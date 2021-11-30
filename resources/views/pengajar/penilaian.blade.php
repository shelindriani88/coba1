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
                <p>Penilaian Santri</p>
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
          <div class="container">
            <a href="{{url('/santriKelas')}}"><i class="fa fa-arrow-left"></i> Kembali Ke Tabel</a>
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
                @endif
                <form class="" action="" method="post">
                  @csrf
                  <select class="mdb-select md-form" name="semester" onchange='getnilai("{{$id_santri}}",this.value)' searchable="Pilih Semester">
                    <option value="" disabled selected>Pilih Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                  </select>
                  <br><br>
                      <div class="row">
                          @foreach ($mapel as $ih)
                            @inject('penilaianMapel', 'App\penilaianMapel')
                            @php
                              $ceknilai = @$penilaianMapel::where('id_mapel','=',$ih->id_mapel)->where('id_santri','=',$id_santri)->get()[0];
                            @endphp
                            <div class="col-6">
                                <label>{{$ih->nama_mapel}}</label>
                                <input type="hidden" name="id_mapel[]" value="{{$ih->id_mapel}}">
                                <div class="md-form">
                                  <input type="number" id="nilai{{$ih->id_mapel}}" name="nilai[]" class="form-control">
                                  <label>Nilai {{$ih->nama_mapel}}</label>
                                </div>
                                <div class="md-form">
                                  <textarea class="md-textarea form-control" id="keterangan{{$ih->id_mapel}}" name="keterangan[]"></textarea>
                                  <label>Keterangan</label>
                                </div>
                              </div>
                          @endforeach
                        </div>
                            <div class="text-center">
                              <button class="btn btn-indigo btn-rounded mt-5">Tambah Nilai</button>
                            </div>
                          </form>
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
      <script type="text/javascript" src="{{url('')}}/js/sweetalert.min.js"></script>
      <script type="text/javascript" src="{{url('')}}/js/sweetalert-dev.js"></script>
      <script type="text/javascript" src="{{url('')}}/js/jquery.PrintArea.js"></script>
      <script type="text/javascript">
      function getnilai(id,s){
        $('input[name="nilai[]"]').val('');
        $('textarea[name="keterangan[]"]').html('');
        $.ajax({
        type: 'GET',
        url: '{{url('/getNilaiS')}}/'+id+'/'+s,
        dataType: 'json',
        success: function (data) {
          $.each(data, function(k, v) {
            $('#nilai'+v.id_mapel).val(v.nilai);
            $('#keterangan'+v.id_mapel).html(v.keterangan);
          });
        }
    });
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
