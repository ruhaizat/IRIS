			<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Fail</h4> </div>
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
                            <h3 class="box-title m-b-0">Maklumat Fail</h3>
                            <p class="text-muted m-b-30 font-13"> Sila isi dengan lengkap </p>
                            <form class="form" method="post" action="<?php echo base_url();?>FailKerja/tambah">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">No. Fail</label>
                                    <div class="col-10">
                                        <input name="NoFail" class="form-control" type="text" value="" placeholder="XXXX/X/XX/000-0-0/00-0000" required="" oninvalid="this.setCustomValidity('Sila isi ruangan ini.')" oninput="setCustomValidity('')">
										<div style="padding-top:10px;">
											<button style="width:150px;" class="btn btn-outline btn-rounded btn-default" onclick="event.preventDefault();SemakNoFail();">Semak No. Fail</button>
											<span id="sStatus"></span>
										</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Nama Kerani</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" value="<?php if($this->session->userdata("LoggedUser")["Group"] == 3):echo $this->session->userdata("LoggedUser")["FullName"];endif;?>" readonly>
                                        <input name="KeraniID" type="hidden" value="<?php if($this->session->userdata("LoggedUser")["Group"] == 3):echo $this->session->userdata("LoggedUser")["UserID"];endif;?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Jenis Fail</label>
                                    <div class="col-10">
                                        <select required="" name="JenisFailID" class="custom-select col-12" oninvalid="this.setCustomValidity('Sila pilih dari senarai ini.')" oninput="setCustomValidity('')">
                                            <option value="">Sila Pilih...</option>
											<?php foreach($JenisFailList as $eachJenisFail):?>
                                            <option value="<?php echo $eachJenisFail->ID;?>"><?php echo $eachJenisFail->NamaJenisFail;?></option>
											<?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Keterangan</label>
                                    <div class="col-10">
                                        <textarea name="Keterangan" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Tarikh Permohonan / Dokumen</label>
                                    <div class="col-10">
                                        <input name="TarikhPermohonan" class="form-control datepickerAdd" type="text" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Tarikh Buka Fail</label>
                                    <div class="col-10">
                                        <input name="TarikhBukaFail" class="form-control datepickerAdd" type="text" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Nama SO</label>
                                    <div class="col-10">
                                        <select required="" name="SOID" class="custom-select col-12" oninvalid="this.setCustomValidity('Sila pilih dari senarai ini.')" oninput="setCustomValidity('')">
                                            <option value="">Sila Pilih...</option>
											<?php foreach($SOList as $eachSO):?>
                                            <option value="<?php echo $eachSO->ID;?>"><?php echo $eachSO->FullName;?></option>
											<?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Jenis Kerja</label>
                                    <div class="col-10">
                                        <select required="" name="JenisKerja" class="custom-select col-12" oninvalid="this.setCustomValidity('Sila pilih dari senarai ini.')" oninput="setCustomValidity('')">
                                            <option value="">Sila Pilih...</option>
											<?php foreach($JenisKerjaList as $eachJenisKerja):?>
                                            <option value="<?php echo $eachJenisKerja->ID;?>"><?php echo $eachJenisKerja->NamaJenisKerja;?></option>
											<?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <button id="btnTambah" type="submit" class="btn btn-success waves-effect waves-light m-r-10">Tambah</button>
                                <button type="submit" class="btn btn-inverse waves-effect waves-light">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
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
				});
				
				function SemakNoFail(){
					var NoFail = $("input[name=NoFail]").val();
					var datastr = '{"mode":"SemakNoFail","NoFail":"'+NoFail+'"}';
					//alert(datastr);
					$.ajax({
						url: "<?php echo base_url();?>main/ajax",
						type: "POST",
						data: {"datastr":datastr},
						success: function(data){
							if(data === "OK"){
								$("#sStatus").attr("style", "color:green;");
								$("#sStatus").text("No Fail boleh digunakan!");
								$("#btnTambah").attr("disabled",false);
							}else if(data === "WUJUD"){
								$("#sStatus").attr("style", "color:red;");
								$("#sStatus").text("No Fail telah wujud di dalam sistem!");
								$("#btnTambah").attr("disabled",true);
							}
						}
					});
				}
			</script>