<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/images/fts_logo_60.png">
    <title>Sistem Pemantauan Laporan Tanah Bersepadu (IRIS)</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url();?>assets/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?php echo base_url();?>assets/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo base_url();?>assets/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <!--DataTable -->
    <link href="<?php echo base_url();?>assets/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!--alerts CSS -->
    <link href="<?php echo base_url();?>assets/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- color CSS -->
    <link href="<?php echo base_url();?>assets/css/colors/default-dark.css" id="theme" rel="stylesheet">
    <!--Date Picker -->
    <link href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="index.html"><b><img src="<?php echo base_url();?>assets/images/fts_logo_small_white.png" alt="home" /></b><span class="hidden-xs"><strong>IRIS</strong></span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <b class="hidden-xs"><?php echo $this->session->userdata("LoggedUser")["FullName"];?></b> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="#"><i class="ti-user"></i> Akaun Saya</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo base_url();?>main/logout"><i class="fa fa-power-off"></i> Keluar</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="user-pro">
                        <a href="#" class="waves-effect"> <span class="hide-menu"> <?php echo $this->session->userdata("LoggedUser")["FullName"];?><span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="javascript:void(0)"><i class="ti-user"></i> Akaun Saya</a></li>
                            <li><a href="<?php echo base_url();?>main/logout"><i class="fa fa-power-off"></i> Keluar</a></li>
                        </ul>
                    </li>
                    <li class="nav-small-cap m-t-10">--- Menu Utama</li>
                    <li> <a href="javascript:void(0);" class="waves-effect<?php if($activeMenu == 'PU'):echo ' active';else: echo '';endif;?>"><i class="linea-icon linea-basic fa-fw" data-icon="a"></i> <span class="hide-menu"> Paparan Utama <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url();?>main">Lihat</a> </li>
                        </ul>                    
					</li>
                    <li> <a href="javascript:void(0);" class="waves-effect<?php if($activeMenu == 'FK'):echo ' active';else: echo '';endif;?>"><i class="linea-icon linea-basic fa-fw" data-icon="&#xe00a;"></i> <span class="hide-menu"> Fail Kerja <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url();?>FailKerja/senarai">Senarai</a> </li>
							<?php if($this->session->userdata("LoggedUser")["Group"] == 3):?>
                            <li> <a href="<?php echo base_url();?>FailKerja/index">Tambah</a> </li>
							<?php endif;?>
                        </ul>
                    </li>
					<?php if($this->session->userdata("LoggedUser")["Group"] == 1):?>
                    <li><a href="javascript:void(0);" class="waves-effect<?php if($activeMenu == 'L'):echo ' active';else: echo '';endif;?>"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Laporan <span class="fa arrow"></span></span></a>
					    <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url();?>Laporan/index">Jana</a> </li>
                        </ul>  
                    </li>
                    <li><a href="javascript:void(0);" class="waves-effect<?php if($activeMenu == 'P'):echo ' active';else: echo '';endif;?>"><i class="linea-icon linea-basic fa-fw ti-user"></i> <span class="hide-menu">Pengguna <span class="fa arrow"></span></span></a>
					    <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url();?>Penggun">Senarai</a> </li>
                            <li> <a href="<?php echo base_url();?>Penggun">Tambah</a> </li>
                        </ul>  
                    </li>
					<?php endif;?>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
		<!-- Page Content -->
        <div id="page-wrapper">