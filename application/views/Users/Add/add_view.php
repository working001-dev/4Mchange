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
				    <h4 class="header green lighter bigger"><i class="ace-icon fa fa-user-plus blue"></i> New User Registration</h4>

					<div class="space-6"></div>
					<p> Enter your details to begin: </p>

					<form>
					    <fieldset> 
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label class="block clearfix form-group">
                                    <label for="userLoginName">Username</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="form-control" placeholder="Username" name="userLoginName" vali="true" vali--message="Please input username for create user." add--new="user" autocomplete="off"/>
                                        <i class="ace-icon fa fa-user"></i>
                                    </span>
                                </label>
                                <label class="block clearfix form-group">
                                    <label for="firstName">First Name</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="email" class="form-control" placeholder="First name" name="firstName" vali="true" vali--message="Please input First name for create user." add--new="user"  autocomplete="off"/>
                                        <i class="ace-icon fa fa-address-card-o"></i>
                                    </span>
                                </label>
                                <label class="block clearfix form-group">
                                    <label for="lastName">Last Name</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="email" class="form-control" placeholder="Last name" name="lastName" vali="true" vali--message="Please input Last name for create user." add--new="user"  autocomplete="off"/>
                                        <i class="ace-icon fa fa-address-card-o"></i>
                                    </span> 
                                </label>  
                                <label class="block clearfix form-group">
                                    <label for="userLoginPass">Password</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="password" class="form-control" placeholder="Password" name="userLoginPass" vali="true" vali--message="Please input Password for create user." add--new="user" autocomplete="off"/>
                                        <i class="ace-icon fa fa-lock"></i>
                                    </span>
                                </label> 
                                <label class="block clearfix form-group">
                                    <label for="u-repassWord">Repeat password</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="password" class="form-control" placeholder="Repeat password"  name="u-repassWord" vali="true" vali--message="Please Confirm password for create user." autocomplete="off"/>
                                        <i class="ace-icon fa fa-retweet"></i>
                                    </span>
                                </label>                                  
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 p-md-0">
                                <label class="block clearfix form-group">
                                    <label for="role">User group</label>
                                    <select class="selectpicker show-menu-arrow" title="please select Permission group"  data-width="100%" name="roleGroupId" vali="true" vali--message="Please choose User Group for create user." add--new="user"></select> 
                                </label>  
                                <label class="block clearfix form-group">
                                    <label for="role">User permission</label>
                                    <select class="selectpicker show-menu-arrow" title="please select Permission"  data-width="100%" name="roleId" vali="true" vali--message="Please choose User Permission for create user." add--new="user"></select> 
                                </label>
                              
                                <label class="block clearfix form-group">
                                    <label for="role">User action</label>
                                    <select class="selectpicker show-menu-arrow" title="please select user action"  data-width="100%" name="action">
                                        <option value="99" img-value="admin">Admin</option>
                                        <option value="3" img-value="supperapprove">Supper Approve</option>
                                        <option value="1" img-value="approve">Review Approve</option>
                                        <option value="2" img-value="qc">Insprect Approve</option>
                                        <option value="0" img-value="issue">Issuer</option>
                                    </select> 
                                </label> 
                                <label class="block clearfix form-group">
                                    <label for="email">Email</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="email" class="form-control" placeholder="Email" name="email" add--new="user"/>
                                        <i class="ace-icon fa fa-envelope"></i>
                                    </span>
                                </label>
                                <label class="block clearfix form-group" for="userGender">
                                    <label for="#">Gender</label>
                                    <span class="flex">
                                        <input type="button" class="form-control btn-switch" name="userGender" gen-flag = "1" value="male" vali--message="Please Choose Gender for create user." autocomplete="off"/>
                                        <input type="button" class="form-control btn-switch" name="userGender" gen-flag = "2" value="female" />
                                        <i class="i-show-gender fa fa-venus-mars"></i>
                                    </span>
                                </label>  
                            </div> 

							<div class="u-sticky col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<button type="reset" class="width-25 pull-left btn btn-sm u-btn-reset" style="background: #333;">
									<i class="ace-icon fa fa-refresh"></i>
									<span class="bigger-110">Reset</span>
								</button>

								<button type="button" class="width-25 pull-right btn btn-sm btn-success u-btn-register" id="btn--adduser">
									<span class="bigger-110">Register</span>

									<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
								</button>
							</div>
					    </fieldset>
					</form>
			    </div> 
		    </div><!-- /.widget-body -->
		</div><!-- /.signup-box -->
    </div><!-- /.row -->
</div><!-- /.page-content -->