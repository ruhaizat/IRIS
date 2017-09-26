            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Paparan Utama</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Utama</a></li>
                            <li class="active">Paparan Utama</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="row row-in">
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="&#xe00a" class="linea-icon linea-basic"></i>
                                            <h5 class="text-muted vb">JUMLAH FAIL</h5> </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-success"><?php echo $JF->val;?></h3> </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00a;"></i>
                                            <h5 class="text-muted vb">PELUPUSAN</h5> </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-primary"><?php echo $LUPUS->val;?></h3> </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00a;"></i>
                                            <h5 class="text-muted vb">PEMBANGUNAN</h5> </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-primary"><?php echo $BANGUN->val;?></h3> </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6  b-0">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00a;"></i>
                                            <h5 class="text-muted vb">LEBIH 14 HARI</h5> </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-danger"><?php echo $EXCEED->val;?></h3> </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Jumlah Fail Mengikut Tahun Permohonan</h3>
                            <ul class="list-inline text-right">
                                <li>
                                    <h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>Pelupusan</h5> </li>
                                <li>
                                    <h5><i class="fa fa-circle m-r-5" style="color: #fb9678;"></i>Pembangunan</h5> </li>
                            </ul>
                            <div id="morris-area-chart" style="height: 340px;"></div>
                        </div>
                    </div>
				</div>
            </div>
            <!-- /.container-fluid -->	
			<script>
				$(document).ready(function(){
					$(".datepickerAdd").datepicker({
						format: "dd/mm/yyyy"
					});
					$(".datepickerAdd").datepicker("setDate", new Date());
					
					$(".datepickerEdit").datepicker({
						format: "dd/mm/yyyy"
					});
					
					$('#table_senarai').DataTable({
						"oLanguage": {
							"sSearch": "Cari",
							"sLengthMenu": "Papar _MENU_ rekod",
							"sInfo": "Papar _START_ hingga _END_ dari _TOTAL_ data",
							"oPaginate": {
								"sFirst": "Pertama",
								"sLast": "Terakhir",
								"sNext": "Seterusnya",
								"sPrevious": "Sebelumnya"
							},
							"sInfoFiltered": "(tapis dari _MAX_ data)"
						},
						"columnDefs": [{
							"targets": 10,
							"orderable": false
							}]
					});
					
					Morris.Area({
						element: 'morris-area-chart',
						data: [
						<?php foreach($JFY as $eachJFY):?>
							{
								period: '<?php echo $eachJFY->YearStr;?>',
								Pelupusan: <?php echo $eachJFY->Lupus;?>,
								Pembangunan: <?php echo $eachJFY->Bangun;?>
							},
						<?php endforeach;?>
						],
						xkey: 'period',
						ykeys: ['Pelupusan', 'Pembangunan'],
						labels: ['Pelupusan', 'Pembangunan'],
						pointSize: 2,
						fillOpacity: 0,
						pointStrokeColors:['#00bfc7', '#fb9678'],
						behaveLikeLine: true,
						gridLineColor: '#e0e0e0',
						lineWidth: 1,
						hideHover: 'auto',
						lineColors: ['#00bfc7', '#fb9678'],
						resize: true
						
					});
				});
			</script>