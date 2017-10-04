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
    <link href="<?php echo base_url();?>assets/bower_components/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
	<style>
		#table_senarai {
			border-collapse: collapse;
			font-size:10px;
		}

		#table_senarai, #table_senarai>th, #table_senarai>td {
			border: 1px solid #f1f2f7;
		}
	</style>
</head>

<body style="background-color:white;">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper" style="margin:50px;">
        <div class="row">	
            <div class="col-sm-12">
                <div class="white-box">
				<br/>
				<br/>
                    <h3 class="box-title m-b-0">Senarai Fail</h3>
					<table>
						<tr>
							<td><span class="m-b-30 font-13">Tahun </span></td>
							<td><span class="m-b-30 font-13">: </span></td>
							<td><span class="m-b-30 font-13"><?php echo $YearStr;?></span></td>
						</tr>                
						<tr>                 
							<td><span class="m-b-30 font-13">Nama SO</span></td>
							<td><span class="m-b-30 font-13">: </span></td>
							<td><span class="m-b-30 font-13"><?php echo $SOName;?></span></td>
						</tr>                
						<tr>                 
							<td><span class="m-b-30 font-13">Jenis</span></td>
							<td><span class="m-b-30 font-13">: </span></td>
							<td><span class="m-b-30 font-13"><?php echo $SasaranFilter;?></span></td>
						</tr>                
						<tr>                 
							<td><span class="m-b-30 font-13">Jenis Fail</span></td>
							<td><span class="m-b-30 font-13">: </span></td>
							<td><span class="m-b-30 font-13"><?php echo $JenisFailFilter;?></span></td>
						</tr>
					</table>
					<br/>
                    <div class="table-responsive">
                        <table id="table_senarai" class="table display">
                            <thead>
                                <tr>
                                    <th style="text-align:center;vertical-align:middle;">No. Fail</th>
                                    <th style="text-align:center;vertical-align:middle;">Kerani</th>
                                    <th style="text-align:center;vertical-align:middle;">Jenis Fail</th>
                                    <th style="text-align:center;vertical-align:middle;">Keterangan</th>
                                    <th style="text-align:center;vertical-align:middle;">Tarikh Permohonan</th>
                                    <th style="text-align:center;vertical-align:middle;">Tarikh Buka Fail</th>
                                    <th style="text-align:center;vertical-align:middle;">Nama SO</th>
                                    <th style="text-align:center;vertical-align:middle;">Tarikh Terima</th>
                                    <th style="text-align:center;vertical-align:middle;">Tarikh Siap</th>
                                    <th style="text-align:center;vertical-align:middle;">Jumlah Hari</th>
                                    <th style="text-align:center;vertical-align:middle;">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($FailList as $eachFail):?>
                                <tr>
                                    <td><?php echo $eachFail->NoFail;?></td>
                                    <td><?php echo $eachFail->KeraniName;?></td>
                                    <td><?php echo $eachFail->NamaJenisFail;?></td>
                                    <td><?php echo $eachFail->Keterangan;?></td>
                                    <td><?php echo date("d/m/Y", strtotime($eachFail->TarikhPermohonan));?></td>
                                    <td><?php echo date("d/m/Y", strtotime($eachFail->TarikhBukaFail));?></td>
                                    <td><?php echo $eachFail->SOName;?></td>
                                    <td><?php if($eachFail->TarikhTerima != "0000-00-00"):echo date("d/m/Y", strtotime($eachFail->TarikhTerima));endif;?></td>
                                    <td><?php if($eachFail->TarikhSiap != "0000-00-00"):echo date("d/m/Y", strtotime($eachFail->TarikhSiap));endif;?></td>
                                    <td><?php echo $eachFail->JumlahHari;?></td>
                                    <td><?php if($eachFail->Catatan == 1):echo "Dalam Semakan";elseif($eachFail->Catatan == 2):echo "Dalam Proses";elseif($eachFail->Catatan == 3):echo "Maklum Balas / Kuiri";endif;?></td>
                                </tr>
								<?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
	</div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/bootstrap-table/dist/bootstrap-table.ints.js"></script>
</body>

</html>
