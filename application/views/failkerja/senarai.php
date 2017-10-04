			<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Senarai Fail</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Utama</a></li>
                            <li class="active">Fail Kerja</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Senarai Fail</h3>
                            <p class="text-muted m-b-30 font-13">  </p>
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
                                            <th style="text-align:center;vertical-align:middle;">Jenis Kerja</th>
                                            <th style="text-align:center;vertical-align:middle;">Tarikh Terima</th>
                                            <th style="text-align:center;vertical-align:middle;">Tarikh Siap</th>
                                            <th style="text-align:center;vertical-align:middle;">Jumlah Hari</th>
                                            <th style="text-align:center;vertical-align:middle;">Catatan</th>
                                            <th></th>
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
                                            <td><?php echo $eachFail->JenisKerjaName;?></td>
                                            <td><?php if($eachFail->TarikhTerima != "0000-00-00"):echo date("d/m/Y", strtotime($eachFail->TarikhTerima));endif;?></td>
                                            <td><?php if($eachFail->TarikhSiap != "0000-00-00"):echo date("d/m/Y", strtotime($eachFail->TarikhSiap));endif;?></td>
                                            <td><?php echo $eachFail->JumlahHari;?></td>
                                            <td><?php if($eachFail->Catatan == 1):echo "Dalam Semakan";elseif($eachFail->Catatan == 2):echo "Dalam Proses";elseif($eachFail->Catatan == 3):echo "Maklum Balas / Kuiri";endif;?></td>
                                            <td><a href="<?php echo base_url();?>FailKerja/kemaskini/<?php echo $eachFail->FailID;?>" title="Kemaskini"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a href="#" title="Padam" onclick="DeleteFile('<?php echo $eachFail->FailID;?>','<?php echo $eachFail->NoFail;?>');"><i class="fa fa-trash"></i></a></td>
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
            </div>
            <!-- /.container-fluid -->
			<script>
				$(document).ready(function(){
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
							"targets": 11,
							"orderable": false
							}]
					});
				});
				
				function DeleteFile(ID, NoFail){
					swal({
						html: true,
						title: "Adakah anda pasti?",   
						text: "File bernombor <b><u>" + NoFail + "</u></b> akan dipadam dari sistem secara kekal dan tidak dapat dikembalikan semula!",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Padam!", 
						cancelButtonText: "Batal", 
						closeOnConfirm: false 
					}, function(){
						var datastr = '{"mode":"DeleteFile","ID":"'+ID+'"}';
						$.ajax({
							url: "<?php echo base_url();?>main/ajax",
							type: "POST",
							data: {"datastr":datastr},
							success: function(data){
								swal({
									html: true,
									title: "Telah dipadam!",   
									text: "File bernombor <b><u>" + NoFail + "</u></b> telah dipadam dari sistem.",   
									type: "success"
								})
							}
						});
					});
				}
			</script>