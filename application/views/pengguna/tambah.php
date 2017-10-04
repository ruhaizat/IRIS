			<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Pengguna</h4> </div>
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
                            <h3 class="box-title m-b-0">Maklumat Pengguna</h3>
                            <p class="text-muted m-b-30 font-13"> Sila isi dengan lengkap </p>
                            <form class="form" method="post" action="<?php echo base_url();?>Pengguna/tambah">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">ID Pengguna / Alamat Emel</label>
                                    <div class="col-10">
                                        <input name="ID" class="form-control" type="text" value="" placeholder="email@web.com" required="" oninvalid="this.setCustomValidity('Sila isi ruangan ini.')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Kata Laluan</label>
                                    <div class="col-10">
                                        <input name="Password" class="form-control" type="password" value="" placeholder="k@t@l@lu@n" required="" oninvalid="this.setCustomValidity('Sila isi ruangan ini.')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Nama Penuh</label>
                                    <div class="col-10">
                                        <input name="Nama" class="form-control" type="text" value="" placeholder="Ali bin Abu" required="" oninvalid="this.setCustomValidity('Sila isi ruangan ini.')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Jenis Pengguna</label>
                                    <div class="col-10">
                                        <select required="" name="JenisPengguna" class="custom-select col-12" oninvalid="this.setCustomValidity('Sila pilih dari senarai ini.')" oninput="setCustomValidity('')">
                                            <option value="">Sila Pilih...</option>
											<?php foreach($JenisPenggunaList as $eachJenisPengguna):?>
                                            <option value="<?php echo $eachJenisPengguna->ID;?>"><?php echo $eachJenisPengguna->GroupName;?></option>
											<?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Jawatan</label>
                                    <div class="col-10">
                                        <input name="Jawatan" class="form-control" type="text" value="" placeholder="Juruteknik Komputer">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Unit</label>
                                    <div class="col-10">
                                        <input name="Unit" class="form-control" type="text" value="" placeholder="Admin">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Tambah</button>
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
			</script>