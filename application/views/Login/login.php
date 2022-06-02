<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login Page - 4M Change</title>
		<link rel="icon" href="<?=base_url()?>assets/images/logo/4mlogo.ico" type="image/ico">
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" /> 
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />  
		<!-- ace styles -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/ace.min.css" /> 
		<link rel="stylesheet" href="<?=base_url()?>assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="<?=base_url()?>assets/css/site.css" />
		 
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
				/* display: flex; */
				/* align-items: center; */
				/* justify-content: flex-end;  */
				/* flex-wrap: nowrap; */
				width:46px;
				height: 48px;
                font-size: 24px;
                border-radius: 0px; 
				text-align:end;
                transition: width 0.8s, text-align 0.8s cubic-bezier(0.22, 0.61, 0.36, 1);
            }
			.block-login button:focus, .block-login button:active, .block-login button:focus:active{
				outline:none;  
				width: 100%;
			}
            .block-login button:hover{  
				width: 100%;
			}
			.block-login button:hover>span,.block-login button:focus>span, .block-login button:active>span, .block-login button:focus:active>span{   
				opacity: 1; 
			}
 
			.block-login button>span{
				display: block;
				position: absolute;
    			top: 8px;
    			left: 10px;
				font-size: 16px;
				font-weight: 100; 
				opacity: 0;
				transition: opacity 0.5s;
			}
			.social-or-login:before { 
				border-top: 1px solid #394557;
			}
			.social-or-login :first-child { 
				color: #394557; 
			}
			.loging-btn{
				width: 100% !important; 
			}
			.loging-btn>span{
				opacity: 1 !important;
			}
			.loging-btn>span:after{ 
				content: ' ';
				font-family: 'Glyphicons Halflings';
				animation-name: loging;
    			animation-duration: 2s; 
				animation-iteration-count: infinite; 
				font-size: 10px;
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
									<span class="c-text" id="id-text2">CHANGE CONTROL SYSTEM</span>
                                    <span class="c-text"></span>
                                    <span class="fa fa-cog i-text"></span>
								</div>
							</div>

							<div class="space-6"></div>

							<div class="position-relative" style="box-shadow: 3px 5px 8px 2px #949292b5;">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-exclamation-circle green"></i>
												Please Enter Your Information
											</h4>

											<div class="space-6"></div>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" name="userName"
															onblur="if($(this).val() != '') $(this).css('border','1px solid #D5D5D5')"
															/>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" name="passWord"
															onblur="if($(this).val() != '') $(this).css('border','1px solid #D5D5D5')"
															/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="block-login clearfix">  
														<button type="button" class="btn btn-sm btn-primary btn-login">
															<span class="">Login</span>
															<i class="ace-icon fa fa-arrow-circle-right"></i> 
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
 
		<script src="<?=base_url()?>assets/js/jquery-2.1.4.min.js"></script>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="<?=base_url()?>assets/js/project/site.js"></script>		 
 
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$(document).on("click", ".btn-login", function(){
				let btn = $(this);
				let input = $(this).closest("fieldset").find("input");
				let checkEmpty= input.toArray().filter( f => !$(f).val() ).map( e => { $(e).css({"border": "2px solid red"}); return e });
				if( !checkEmpty[0] ){
					$(this).addClass("loging-btn").attr("disabled", "true");
					$(this).closest("fieldset").find("input").attr("readonly", "true");
					let $_u = $(this).closest("fieldset").find("input[name=userName]").val();		
					let $_p = $(this).closest("fieldset").find("input[name=passWord]").val();
					setTimeout( function(){
						$.post( `${_UrlProject}`,{userName:$_u, passWord:$_p},function( data ) {
							console.log( JSON.parse( data ) );
						});
					}, 1500);
				}else{
					Toast.fire({ icon: 'error', title: 'Please fill out the information completely.' })
				}

			})
			
		</script>
	</body>
</html>
