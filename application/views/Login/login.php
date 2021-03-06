<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login Page - Ace Admin</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="assets/css/site.css" />
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
        <style>
            body{
                background-image: url("<?=base_url()?>assets/images/vector_2620.jpg");
                background-repeat: round;
            }
            .social-or-login i.glyphicon{
                padding: 0;
            }
            .block-login{
                display: flex;
            }
            .block-login button{
                font-size: 24px;
                border-radius: 12px;
                transition: width 1.4s;
            }
            
        </style>
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-4">
						<div class="login-container">
							<div class="center">
								<div class="head-project">
									<!-- <i class="ace-icon fa fa-leaf green"></i> -->
									<span class="h-text">4M</span>
									<span class="c-text" id="id-text2">Application</span>
                                    <span class="c-text"></span>
                                    <span class="fa fa-cog i-text"></span>
                                    
								</h1>
								
							</div>

							<div class="space-6"></div>

							<div class="position-relative" style="box-shadow: 3px 5px 8px 2px #464646b5;">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Please Enter Your Information
											</h4>

											<div class="space-6"></div>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="block-login clearfix">  
														<button type="button" class="btn btn-sm btn-primary">
															<i class="ace-icon fa fa-arrow-circle-right"></i>
															<!-- <span class="bigger-110">Login</span> -->
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

											<div class="social-or-login center">
												<span class="bigger-110">
                                                    <i class="glyphicon glyphicon-user"></i>
                                                    <i class="glyphicon glyphicon-cog"></i>
                                                    <i class="glyphicon glyphicon-wrench"></i>
                                                    <i class="glyphicon glyphicon-random"></i>
                                                </span>
											</div>

											<div class="space-6"></div>
 
										</div><!-- /.widget-main -->

										<!-- <div class="toolbar clearfix">
 
										</div> -->
									</div><!-- /.widget-body -->
								</div><!-- /.login-box --> 
							</div><!-- /.position-relative -->   
                            <div class="center"><h4 class="blue" id="id-company-text">&copy; Company Name</h4></div>
                            
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
            <script src="assets/js/jquery-1.11.3.min.js"></script>
        <![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
 
 
		</script>
	</body>
</html>
