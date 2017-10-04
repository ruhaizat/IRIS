			<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Senarai Pengguna</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Utama</a></li>
                            <li class="active">Pengguna</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Senarai Pengguna</h3>
                            <p class="text-muted m-b-30 font-13">  </p>
                            <div class="table-responsive">
                                <table id="table_senarai" class="table display">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;vertical-align:middle;">Nama</th>
                                            <th style="text-align:center;vertical-align:middle;">Alamat Emel</th>
                                            <th style="text-align:center;vertical-align:middle;">Jenis Pengguna</th>
                                            <th style="text-align:center;vertical-align:middle;">Jawatan</th>
                                            <th style="text-align:center;vertical-align:middle;">Unit</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($UserList as $eachUser):?>
                                        <tr>
                                            <td><?php echo $eachUser->FullName;?></td>
                                            <td><?php echo $eachUser->EmailAddress;?></td>
                                            <td><?php echo $eachUser->GroupName;?></td>
                                            <td><?php echo $eachUser->Jawatan;?></td>
                                            <td><?php echo $eachUser->Unit;?></td>
                                            <td><a href="<?php echo base_url();?>Pengguna/kemaskini/<?php echo $eachUser->UID;?>" title="Kemaskini"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a href="#" title="Padam" onclick="DeleteUser('<?php echo $eachUser->UID;?>','<?php echo $eachUser->FullName;?>');"><i class="fa fa-trash"></i></a></td>
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
							"targets": 5,
							"orderable": false
							}]
					});
				});
				
				function DeleteUser(ID, UName){
					swal({
						html: true,
						title: "Adakah anda pasti?",   
						text: "Pengguna bernama <b><u>" + UName + "</u></b> akan dipadam dari sistem secara kekal dan tidak dapat dikembalikan semula!",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Padam!", 
						cancelButtonText: "Batal", 
						closeOnConfirm: false 
					}, function(){
						var datastr = '{"mode":"DeleteUser","ID":"'+ID+'"}';
						$.ajax({
							url: "<?php echo base_url();?>main/ajax",
							type: "POST",
							data: {"datastr":datastr},
							success: function(data){
								swal({
									html: true,
									title: "Telah dipadam!",   
									text: "Pengguna bernama <b><u>" + UName + "</u></b> telah dipadam dari sistem.",   
									type: "success"
								})
							}
						});
					});
				}
			</script>