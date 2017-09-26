            <footer class="footer text-center"> 2017 &copy; File Tracking System brought to you by <a href="http://ruhaizat.my" target="_blank">ruhaizat.my</a> </footer>
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
    <!--Style Switcher -->
    <script src="<?php echo base_url();?>assets/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <!--Date Picker -->
    <script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!--DataTable -->
    <script src="<?php echo base_url();?>assets/bower_components/datatables/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".datepicker").datepicker({
				format: "dd/mm/yyyy"
			});
			$(".datepicker").datepicker("setDate", new Date());
			$('#table_senarai').DataTable();
		});
	</script>
</body>

</html>
