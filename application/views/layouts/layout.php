<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		
		<title>Change Control</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="icon" href="<?=base_url()?>assets/images/logo/4mlogo.ico" type="image/ico">
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/font-awesome/4.7.0/css/font-awesome.min.css" />  
		<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" /> 
		<link rel="stylesheet" href="<?=base_url()?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/ace-rtl.min.css" /> 

		<link rel="stylesheet" href="<?=base_url()?>assets/libs/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/libs/select2/css/select2.min.css" /> 
		<link rel="stylesheet" href="<?=base_url()?>assets/libs/sweetalert/sweetalert2.min.css" />	 
		<link rel="stylesheet" href="<?=base_url()?>assets/libs/daterangepicker-master/daterangepicker.css" />	 	
 
		<link rel="stylesheet" href="<?=base_url()?>assets/css/project/site.css" />
		<link style-section />
		<!-- <script src="assets/js/ace-extra.min.js"></script>  -->
	</head>

	<body class="no-skin"> 
		<?php include dirname(__FILE__).'/navbar.php' ?>
		<div class="main-container ace-save-state" id="main-container">  
            <?php include dirname(__FILE__).'/sidebar.php' ?>  
			<div class="main-content"> 
				<div class="main-content-inner">
					<?php include $contents["content"] ?>
				</div> 
			</div><!-- /.main-content -->
			<div class="main-content-load" data-text="WAITING LOADING PAGE"><span class="wait-load-page"></span></div>
			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">4M</span>
							Change Control &copy; 2022
						</span> 
						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#"> <i class="ace-icon glyphicon glyphicon-user light-blue bigger-90"></i></a> 
							<a href="#"><i class="ace-icon glyphicon glyphicon-cog text-primary bigger-90"></i></a> 
							<a href="#"><i class="ace-icon glyphicon glyphicon-wrench orange bigger-90"></i></a>
							<a href="#"><i class="ace-icon glyphicon glyphicon-random red bigger-90"></i></a>
						</span>
					</div>
				</div>
			</div> 
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?=base_url()?>assets/js/jquery-2.1.4.min.js"></script>  
		<script src="<?=base_url()?>assets/js/jquery-ui.min.js"></script> 
		<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>  
		<script src="<?=base_url()?>assets/libs/sweetalert/sweetalert2.all.min.js"></script> 
		<script src="<?=base_url()?>assets/libs/daterangepicker-master/moment.min.js"></script>
		<script src="<?=base_url()?>assets/libs/daterangepicker-master/daterangepicker.js"></script>
		<script src="<?=base_url()?>assets/libs/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js"></script>
		<script src="<?=base_url()?>assets/libs/select2/js/select2.min.js"></script>
		<script src="<?=base_url()?>assets/js/ace-elements.min.js"></script>
		<script src="<?=base_url()?>assets/js/ace.min.js"></script>

		<script type="text/javascript">var __u = "<?=base64_encode(base_url())?>";</script> 
		<script src="<?=base_url()?>assets/js/project/site.js"></script>
		<!-- inline scripts related to this page -->
		<script script-section></script>
		<script type="text/javascript">
 
		</script>  

		<?php include $contents["scripts"] ?>	 
		
	</body>
</html>
