<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb"></ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
	<div class="page-header"></div><!-- /.page-header -->
	<div class="section-content">
		<div id="signup-box" class="signup-box widget-box no-border">
			<div class="widget-body">
				<div class="widget-main">
					<h4 class="header green lighter bigger"><i class="ace-icon fa fa-info-circle blue"></i>4M Change Manage</h4>
					<div class="space-6"></div>
					<div class="seection-actions">
						<div class="actions-header">
							<!-- <h4>Wait actions</h4> -->
						</div>
						<div class="actions-body">
							<table class="table" id="tb--manage" style="width:100%"></table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.row -->
</div><!-- /.page-content -->

<div id="modal--box" class="modal fade" tabindex="-1" data-backdrop="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Edit user information</h3>
			</div>
			<div class="modal-body">
				<div class="clearfix">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label class="block clearfix form-group">
							<label for="userLoginName">Username</label>
							<span class="block input-icon input-icon-right">
								<input type="text" class="form-control" placeholder="Username" name="userLoginName" vali="true" readonly/>
								<i class="ace-icon fa fa-user"></i>
							</span>
						</label>
						<label class="block clearfix form-group">
							<label for="firstName">First Name</label>
							<span class="block input-icon input-icon-right">
								<input type="email" class="form-control" placeholder="First name" name="firstName" vali="true" vali--message="Please input First name for update user." add--new="user" autocomplete="off" />
								<i class="ace-icon fa fa-address-card-o"></i>
							</span>
						</label>
						<label class="block clearfix form-group">
							<label for="lastName">Last Name</label>
							<span class="block input-icon input-icon-right">
								<input type="email" class="form-control" placeholder="Last name" name="lastName" vali="true" vali--message="Please input Last name for update user." add--new="user" autocomplete="off" />
								<i class="ace-icon fa fa-address-card-o"></i>
							</span>
						</label> 
					</div>

					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 p-md-0">
						<label class="block clearfix form-group">
							<label for="role">User group</label>
							<select class="selectpicker show-menu-arrow" title="please select Permission group" data-width="100%" name="roleGroupId" vali="true" vali--message="Please choose User Group" add--new="user"></select>
						</label>
						<label class="block clearfix form-group">
							<label for="role">User permission</label>
							<select class="selectpicker show-menu-arrow" title="please select Permission" data-width="100%" name="roleId" vali="true" vali--message="Please choose User Permission" add--new="user"></select>
						</label>

						<label class="block clearfix form-group">
							<label for="role">User action</label>
							<select class="selectpicker show-menu-arrow" title="please select user action" data-width="100%" name="action">
								<option value="99" img-value="admin">Admin</option>
								<option value="3" img-value="supperapprove">Supper Approve</option>
								<option value="1" img-value="approve">Review Approve</option>
								<option value="2" img-value="qc">Insprect Approve</option>
								<option value="0" img-value="issue">Issuer</option>
							</select>
						</label>
					</div> 
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label class="block clearfix col-lg-6 form-group">
							<label for="email">Email</label>
							<span class="block input-icon input-icon-right">
								<input type="email" class="form-control" placeholder="Email" name="email" add--new="user" />
								<i class="ace-icon fa fa-envelope"></i>
							</span>
						</label>
						<label class="block clearfix col-lg-6 form-group" for="userGender">
							<label for="#">Gender</label>
							<span class="flex">
								<input type="button" class="form-control btn-switch" name="userGender" gen-flag="1" value="male" vali--message="Please Choose Gender for create user." autocomplete="off" />
								<input type="button" class="form-control btn-switch" name="userGender" gen-flag="2" value="female" />
								<i class="i-show-gender fa fa-venus-mars"></i>
							</span>
						</label>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label class="block clearfix col-lg-6 form-group">
							<label for="userLoginPass">Password</label>
							<span class="block input-icon input-icon-right">
								<input type="password" class="form-control" placeholder="Password" name="userLoginPass" autocomplete="off" />
								<i class="ace-icon fa fa-lock"></i>
							</span>
						</label> 
						<label class="block clearfix col-lg-6 form-group">
							<label for="u-repassWord">Repeat password</label>
							<span class="block input-icon input-icon-right">
								<input type="password" class="form-control" placeholder="Repeat password" name="u-repassWord" autocomplete="off" />
								<i class="ace-icon fa fa-retweet"></i>
							</span>
						</label>
						<label class="block clearfix col-lg-12 form-group">
							<span class="text-danger" style="font-weight: 600; font-size: 10px;">* ถ้าไม่ต้องการเปลี่ยนพาสเวิร์ด ไม่ต้องใส่ข้อมูล ช่อง Password, Repeat password</span>
						</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-success pull-right" id="update--new">
					<i class="fa fa-check" aria-hidden="true"></i>
					Update
				</button>
				<button class="btn btn-sm btn-danger pull-right"  data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Close
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>