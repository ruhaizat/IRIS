			<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Kemaskini Fail</h4> </div>
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
                            <form class="form" method="post" action="<?php echo base_url();?>FailKerja/update/<?php echo $FailData->FID;?>">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">No. Fail</label>
                                    <div class="col-10">
                                        <input name="NoFail" class="form-control" type="text" value="<?php echo $FailData->NoFail;?>" placeholder="XXXX/X/XX/000-0-0/00-0000" required="" oninvalid="this.setCustomValidity('Sila isi ruangan ini.')" oninput="setCustomValidity('')" <?php if($this->session->userdata("LoggedUser")["Group"] != 1):echo "readonly";endif;?>>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Nama Kerani</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" value="<?php echo $FailData->FullName;?>" readonly>
                                        <input name="KeraniID" type="hidden" value="<?php echo $FailData->KeraniID;?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Jenis Fail</label>
                                    <div class="col-10">
										<?php foreach($JenisFailList as $eachJenisFail):?>
                                            <?php if($FailData->JenisFailID == $eachJenisFail->ID):$SelJenisFailID = $eachJenisFail->ID;$SelJenisFailName = $eachJenisFail->NamaJenisFail;endif;?>
										<?php endforeach;?>
										<?php if($this->session->userdata("LoggedUser")["Group"] == 1):?>
                                        <select required="" name="JenisFailID" class="custom-select col-12" oninvalid="this.setCustomValidity('Sila pilih dari senarai ini.')" oninput="setCustomValidity('')" >
                                            <option value="">Sila Pilih...</option>
											<?php foreach($JenisFailList as $eachJenisFail):?>
                                            <option <?php if($FailData->JenisFailID == $eachJenisFail->ID):$SelJenisFailName = $eachJenisFail->NamaJenisFail;echo 'selected';endif;?> value="<?php echo $eachJenisFail->ID;?>"><?php echo $eachJenisFail->NamaJenisFail;?></option>
											<?php endforeach;?>
                                        </select>
										<?php else:?>
                                        <input name="JenisFailID" type="hidden" value="<?php echo $SelJenisFailID;?>">
                                        <input class="form-control" type="text" value="<?php echo $SelJenisFailName;?>" readonly>
										<?php endif;?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Keterangan</label>
                                    <div class="col-10">
                                        <textarea name="Keterangan" class="form-control" rows="5" <?php if($this->session->userdata("LoggedUser")["Group"] != 1):echo "readonly";endif;?>><?php echo $FailData->Keterangan;?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Tarikh Permohonan / Dokumen</label>
                                    <div class="col-10">
                                        <input name="TarikhPermohonan" class="form-control datepickerEdit" type="text" value="<?php echo date('d/m/Y', strtotime($FailData->TarikhPermohonan));?>" <?php if($this->session->userdata("LoggedUser")["Group"] != 1):echo "readonly";endif;?>>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Tarikh Buka Fail</label>
                                    <div class="col-10">
                                        <input name="TarikhBukaFail" class="form-control datepickerEdit" type="text" value="<?php echo date('d/m/Y', strtotime($FailData->TarikhBukaFail));?>" <?php if($this->session->userdata("LoggedUser")["Group"] != 1):echo "readonly";endif;?>>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Nama SO</label>
                                    <div class="col-10">
                                        <select required="" name="SOID" class="custom-select col-12" oninvalid="this.setCustomValidity('Sila pilih dari senarai ini.')" oninput="setCustomValidity('')">
                                            <option value="">Sila Pilih...</option>
											<?php foreach($SOList as $eachSO):?>
                                            <option <?php if($FailData->SOID == $eachSO->ID):echo 'selected';endif;?> value="<?php echo $eachSO->ID;?>"><?php echo $eachSO->FullName;?></option>
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
                                            <option <?php if($FailData->JenisKerjaID == $eachJenisKerja->ID):echo 'selected';endif;?> value="<?php echo $eachJenisKerja->ID;?>"><?php echo $eachJenisKerja->NamaJenisKerja;?></option>
											<?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
								<?php if($this->session->userdata("LoggedUser")["Group"] == 2 OR $this->session->userdata("LoggedUser")["Group"] == 1):?>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Tarikh Terima</label>
                                    <div class="col-10">
                                        <input name="TarikhTerima" class="form-control" type="text" value="<?php if($FailData->TarikhTerima != "0000-00-00"):echo date('d/m/Y', strtotime($FailData->TarikhTerima));endif;?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Tarikh Siap</label>
                                    <div class="col-10">
                                        <input name="TarikhSiap" class="form-control" type="text" value="<?php if($FailData->TarikhSiap != "0000-00-00"):echo date('d/m/Y', strtotime($FailData->TarikhSiap));endif;?>">
                                    </div>
                                </div>
								<?php endif;?>
								<?php if($this->session->userdata("LoggedUser")["Group"] == 2):?>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Catatan</label>
                                    <div class="col-10">
										<?php foreach($CatatanList as $eachCatatan):?>
											<div class="form-check">
												<label class="custom-control custom-radio">
													<input <?php if($FailData->Catatan == $eachCatatan->ID):echo 'checked';endif;?> name="Catatan" type="radio" class="custom-control-input" value="<?php echo $eachCatatan->ID;?>">
													<span class="custom-control-indicator"></span>
													<span class="custom-control-description"><?php echo $eachCatatan->NamaCatatan;?></span>
												</label>
											</div>
										<?php endforeach;?>
										Nyatakan: <input name="CatatanSebab" class="form-control" type="text" value="<?php echo $FailData->CatatanSebab;?>" placeholder="Nyatakan huraian bagi catatan di atas">
                                    </div>
                                </div>
								<?php endif;?>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Simpan</button>
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
					var dateToday = new Date();			
					$("input[name=TarikhSiap],.datepickerEdit").datepicker({
						format: "dd/mm/yyyy"
					});					
					$("input[name=TarikhTerima]").datepicker({
						format: "dd/mm/yyyy",
						<?php if($this->session->userdata("LoggedUser")["Group"] != 1):?>
						<?php if($FailData->TarikhTerima == "0000-00-00"):?>
						startDate: dateToday
						<?php else:?>
						startDate: "<?php echo date('d/m/Y', strtotime($FailData->TarikhTerima));?>"
						<?php endif;?>
						<?php endif;?>
					});
				});
			</script>