<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		
		<title>Dashboard - Ace Admin</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="icon" href="<?=base_url()?>assets/images/logo/4mlogo.ico" type="image/ico">
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />  
		<link rel="stylesheet" href="<?=base_url()?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" /> 
		<link rel="stylesheet" href="<?=base_url()?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/ace-rtl.min.css" /> 

		<link rel="stylesheet" href="<?=base_url()?>assets/css/site.css" />
		<!-- <script src="assets/js/ace-extra.min.js"></script>  -->
	</head>

	<body class="no-skin"> 
		<?php include dirname(__FILE__).'/navbar.php' ?>
		<div class="main-container ace-save-state" id="main-container">  
            <?php include dirname(__FILE__).'/sidebar.php' ?>  
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li><i class="ace-icon fa fa-home home-icon"></i><a href="#">Home</a></li>
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb --> 
					</div>

					<div class="page-content">  
						<div class="page-header">
							<h1>Dashboard<small><i class="ace-icon fa fa-angle-double-right"></i> overview &amp; stats</small></h1>
						</div><!-- /.page-header -->

						<div class="row">
							<?php include $contents["content"] ?>
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
						</span> 
						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#"> <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i></a> 
							<a href="#"><i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i></a> 
							<a href="#"><i class="ace-icon fa fa-rss-square orange bigger-150"></i></a>
						</span>
					</div>
				</div>
			</div> 
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?=base_url()?>assets/js/jquery-2.1.4.min.js"></script> 
		<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>  
 
		<script src="<?=base_url()?>assets/js/ace-elements.min.js"></script>
		<script src="<?=base_url()?>assets/js/ace.min.js"></script>
		<script src="<?=base_url()?>assets/js/sweetalert2@11.js"></script> 
		<script src="<?=base_url()?>assets/js/project/site.js"></script>
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
 
		</script>  
		<?php include $contents["scripts"] ?>	 
		
	</body>
</html>
