<!DOCTYPE html>
<html lang="en">
  <head>

    <title>aa</title>
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

  @yield('content')

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
 <script type="text/javascript" src="{{url('')}}/js/addons/datatables.min.js"></script>
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
