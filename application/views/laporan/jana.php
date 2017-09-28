			<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Jana Laporan</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Utama</a></li>
                            <li class="active">Laporan</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Pilihan Laporan</h3>
                            <p class="text-muted m-b-30 font-13"> Sila pilih jenis penjanaan laporan </p>
                            <form class="form" method="post" action="<?php echo base_url();?>Laporan/papar">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Bulan</label>
                                    <div class="col-10">
                                        <select required="" name="Bulan" class="custom-select col-12" oninvalid="this.setCustomValidity('Sila pilih dari senarai ini.')" oninput="setCustomValidity('')">
                                            <option value="">Sila Pilih...</option>
											<?php foreach($BulanTahun as $eachBulanTahun):?>
                                            <option value="<?php echo $eachBulanTahun->Year.'_'.$eachBulanTahun->Month;?>"><?php echo $eachBulanTahun->MonthYearStr;?></option>
											<?php endforeach;?>
                                        </select>
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
                                    <label for="example-text-input" class="col-2 col-form-label">Jenis</label>
                                    <div class="col-10">
                                        <select required="" name="Sasaran" class="custom-select col-12" oninvalid="this.setCustomValidity('Sila pilih dari senarai ini.')" oninput="setCustomValidity('')">
                                            <option value="">Sila Pilih...</option>
                                            <option value="S">Semua</option>
                                            <option value="W">Dalam tempoh 14 hari</option>
                                            <option value="M">Lebih dari 14 hari</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Jana</button>
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
			</script>