<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
    </ul><!-- /.breadcrumb -->
</div> 
<div class="page-content">
    <div class="page-header"></div><!-- /.page-header -->
    <div class="section-content">
        <div id="signup-box" class="signup-box widget-box no-border">
            <div class="widget-body">
                <div class="widget-main">
                    <h4 class="header green lighter bigger"><i class="ace-icon fa fa-unlock-alt blue"></i>Change Password</h4>

                    <div class="space-6"></div>
                    <p> Enter your details to begin: </p>
					<form>
					    <fieldset> 
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label class="block clearfix">
                                    <label for="userName">Username</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="form-control" placeholder="Username" name="userName" value="<?=$this->session->user?>" readonly/>
                                        <i class="ace-icon fa fa-user"></i>
                                    </span>
                                </label>

                                <label class="block clearfix">
                                    <label for="old-passWord">Old Password</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="password" class="form-control" placeholder="Old Password" name="u-passWord"/>
                                        <i class="ace-icon fa fa-lock"></i>
                                    </span>
                                </label>

                                <label class="block clearfix">
                                    <label for="new-passWord">New password</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="password" class="form-control" placeholder="New password"  name="new-passWord" />
                                        <i class="ace-icon fa fa-retweet"></i>
                                    </span>
                                </label> 

                                <label class="block clearfix">
                                    <label for="new-repassWord">Repeat password</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="password" class="form-control" placeholder="Repeat password"  name="new-repassWord" />
                                        <i class="ace-icon fa fa-retweet"></i>
                                    </span>
                                </label>                                 
                            </div> 
							<!-- <div class="space-24"></div> --> 
							<div class="u-sticky col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2"> 
								<button type="button" class="width-20 pull-center btn btn-sm btn-success u-btn-register" style="background: green; margin-top: 15px;min-width: 160px; max-width: 160px;">
									<span class="bigger-110">Change Password</span> 
									<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
								</button>
							</div>
					    </fieldset>
					</form>
                </div>
            </div>
        </div>  
    </div><!-- /.row -->
</div><!-- /.page-content -->