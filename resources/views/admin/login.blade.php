<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{url('')}}/uploadFoto/LOGO.jpeg">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/mdb.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
  <link rel="stylesheet" type="text/css" href="css/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="css/modules/animations-extended.min.css">
  <link rel="stylesheet" type="text/css" href="css/print.css" media="print">
  <link rel="stylesheet" type="text/css" href="css/tagify.css">
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
</head>
<body class="bg-light">
	<div class="container justify-content-center align-items-center">
		<div class="py-5">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4 mb-4">
					<div class="card">

					  <h5 class="card-header blue white-text text-center py-4">
					    <strong>Login</strong>
					  </h5>
					  <div class="card-body px-lg-5 pt-0">
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
					    <form action="{{ url('/loginAdminPost') }}" method="post" class="text-center needs-validation" style="color: #757575;" novalidate>
								@csrf
					      <div class="md-form">
					        <input type="text" name="username" class="form-control" required autofocus>
					        <label>Username</label>
					        <div class="invalid-feedback">
					          Tolong Diisi.
					        </div>
					      </div>

					      <div class="md-form">
					        <input type="password" name="password" class="form-control" required>
					        <label>Password</label>
					        <div class="invalid-feedback">
					          Tolong Diisi.
					        </div>
					      </div>

					      <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="submit" type="submit">Login</button>

					    </form>

					  </div>

					</div>
				</div>
			</div>
		</div>
	</div>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <script type="text/javascript" src="js/popper.min.js"></script>
        <script type="text/javascript" src="js/sweetalert.min.js"></script>
        <script type="text/javascript" src="js/sweetalert-dev.js"></script>
        <script type="text/javascript" src="js/jquery.PrintArea.js"></script>
	<script type="text/javascript">
		// Example starter JavaScript for disabling form submissions if there are invalid fields
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
