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
                                            <th>No. Fail</th>
                                            <th>Kerani</th>
                                            <th>Jenis Fail</th>
                                            <th>Keterangan</th>
                                            <th>Tarikh Permohonan</th>
                                            <th>Tarikh Buka Fail</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($FailList as $eachFail):?>
                                        <tr>
                                            <td><?php echo $eachFail->NoFail;?></td>
                                            <td><?php echo $eachFail->FullName;?></td>
                                            <td><?php echo $eachFail->NamaJenisFail;?></td>
                                            <td><?php echo $eachFail->Keterangan;?></td>
                                            <td><?php echo date("d/m/Y", strtotime($eachFail->TarikhPermohonan));?></td>
                                            <td><?php echo date("d/m/Y", strtotime($eachFail->TarikhBukaFail));?></td>
                                            <td><a href="<?php echo base_url();?>FailKerja/kemaskini/<?php echo $eachFail->FailID;?>" title="Kemaskini"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a href="#" title="Padam" onclick="DeleteFile('<?php echo $eachFail->ID;?>','<?php echo $eachFail->NoFail;?>');"><i class="fa fa-trash"></i></a></td>
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