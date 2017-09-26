<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/images/fts_logo_60.png">
    <title>File Tracking System</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url();?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <!--alerts CSS -->
    <link href="<?php echo base_url();?>assets/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">
                <form class="form-horizontal form-material" onsubmit="frmSubmit();">
                    <h3 class="box-title m-b-20">Daftar Masuk</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input id="username" class="form-control" type="text" required="" placeholder="ID Pengguna" oninvalid="this.setCustomValidity('Sila isi ruangan ini.')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password" class="form-control" type="password" required="" placeholder="Kata Laluan" oninvalid="this.setCustomValidity('Sila isi ruangan ini.')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url();?>assets/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
    <!--Style Switcher -->
    <script src="<?php echo base_url();?>assets/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <!--Sweet Alert -->
    <script src="<?php echo base_url();?>assets/bower_components/sweetalert/sweetalert.min.js"></script>
	<script>
		function frmSubmit(){
			event.preventDefault();
			var username = $("#username").val();
			var password = $("#password").val();
			
			var datastr = '{"mode":"SignIn","Username":"'+username+'","Password":"'+password+'"}';
			$.ajax({
				url: "<?php echo base_url();?>main/ajax",
				type: "POST",
				data: {"datastr":datastr},
				success: function(data){
					if(data == "Account active"){
						window.location.replace("<?php echo base_url();?>");
					}else{
						if(data == "Account not found"){
							swal("Akaun tidak dijumpai!","","error");
						}
						else if(data == "Wrong password"){
							swal("Kata laluan salah!","","error");
						}
					}
				}
			});
		}
	</script>
</body>

</html>
