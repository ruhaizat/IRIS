            <footer class="footer text-center"> 2017 &copy; Sistem Pemantauan Laporan Tanah Bersepadu (IRIS) dibangunkan oleh <a href="http://ruhaizat.my" target="_blank">ruhaizat.my</a> </footer>
        </div>
        <!-- /#page-wrapper -->
	</div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url();?>assets/js/waves.js"></script>
    <!--Counter js -->
    <script src="<?php echo base_url();?>assets/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--Morris JavaScript -->
    <script src="<?php echo base_url();?>assets/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/morrisjs/morris.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dashboard1.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="<?php echo base_url();?>assets/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/toast-master/js/jquery.toast.js"></script>
    <!--Date Picker -->
    <script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!--DataTable -->
    <script src="<?php echo base_url();?>assets/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!--Sweet Alert -->
    <script src="<?php echo base_url();?>assets/bower_components/sweetalert/sweetalert.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".datepickerAdd").datepicker({
				format: "dd/mm/yyyy"
			});
			$(".datepickerAdd").datepicker("setDate", new Date());
			
			$(".datepickerEdit").datepicker({
				format: "dd/mm/yyyy"
			});
			
			$('#table_senarai').DataTable();
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
    <!--Style Switcher -->
    <script src="<?php echo base_url();?>assets/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
