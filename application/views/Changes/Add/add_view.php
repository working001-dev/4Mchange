<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb"></ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
	<div class="page-header">
	</div><!-- /.page-header -->
	<div class="section-content">
		<div id="signup-box" class="signup-box widget-box no-border">
			<div class="widget-body">
				<div class="widget-main">
					<h4 class="header green lighter bigger"><i class="ace-icon fa fa-info-circle blue"></i>Change Request</h4>
					<div class="space-6"></div>
					<div>
						<button type="button" class="btn-change-add" onclick="$(`#modal-sheet-add`).modal('show');">
							<span>Add new change request</span>
							<i class="fa fa-plus-square" aria-hidden="true"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.row -->
</div><!-- /.page-content -->

<div class="modal fade modal-change-add" id="modal-sheet-add"  role="dialog" aria-labelledby="modal-sheet-addLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header modal-change-add-header">
				<div class="content-request">
					<div class="request-box">
						<div class="flex flex-row flex-wrap">
							<div class="flex flex-column width-50 req-section">
								<div class="container-row">
									<span class="titleSheet">4M CHANGE CONTROL SYSTEM</span>	
								</div>
								<div class="container-row"> 
									<div class="container-ctype">
										<label style="min-width:100px; margin-bottom:0px;"><span class="lbl" >Change(s) in</span></label> 
										<ul>
											<li>
												<label>
													<input type="radio" class="ace" name="changeType" id="method" value="1">
													<div class="check"></div>
													<label for="method"> Method</label>  			
												</label> 
											</li> 
											<li>
												<label>
													<input type="radio" class="ace" name="changeType" id="meterial" value="2">	
													<div class="check"></div>
													<label for="meterial"> Meterial</label>  
												</label> 
											</li> 
											<li>
												<label>
													<input type="radio" class="ace" name="changeType" id="machine" value="3">
													<div class="check"></div>
													<label for="machine"> Machine</label>  
												</label> 
											</li>
											<li>
												<label>
													<input type="radio" class="ace" name="changeType" id="man" value="4">
													<div class="check"></div>
													<label for="man"> Man</label>  
												</label> 
											</li>
										</ul>
									</div>
								</div> 
							</div>
							<div class="flex flex-column width-50 req-section">
								<div class="container-row flex aligns-end"> 
									<div class="flex sp-between width-100">
										<label>
											<span class="req-title">No.</span>
											<span class="req-value" autoset="changenumber">Wait created</span>	
										</label> 
										<label>
											<span class="req-title" >Date.</span>
											<span class="req-value" autoset="datetime">#</span>	
										</label> 
									</div> 
								</div>
								<div class="container-row">
									<div class="req-input flex aligns-center">
										<span class="req-title flex">Line</span>
										<select class="from-control width-100" name="req-line" style="width: 100%"></select>
									</div>
									<div class="req-input flex aligns-center">
										<span class="req-title flex">Part Number</span>
										<select class="from-control width-100" name="req-partnumber" style="width: 100%"></select>
									</div>
									<div class="req-input flex aligns-center">
										<span class="req-title flex">Part Name</span>
										<select class="from-control width-100" name="req-partname" style="width: 100%"></select>
									</div>
									<div class="req-input flex aligns-center">
										<span class="req-title flex">Process</span>
										<select class="from-control width-100" name="req-process" style="width: 100%"></select>
									</div>
								</div>						
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body modal-change-add-body">
				<div class="content-request">
					<div class="request-box">
						<div class="flex flex-row flex-wrap">
							<div class="flex flex-column width-100">
								<div class="container-row">
									<span class="title-subject">1. สาเหตุ / ความจำเป็นในการเปลี่ยนแปลง</span>	
								</div>
								<div class="container-row req-dubdetail">
									<div class="container-ctype">
										<label style="min-width:150px; margin-bottom:0px;"><span class="lbl" >รูปแบบการเปลี่ยนแปลง</span></label> 
										<ul>
											<li>
												<label>
													<input type="radio" class="ace" name="causeType" id="temporary" value="1">
													<div class="check"></div>
													<label for="temporary"> แก้ไขชั่วคราว</label>  			
												</label> 
											</li> 
											<li>
												<label>
													<input type="radio" class="ace" name="causeType" id="permanent" value="2">	
													<div class="check"></div>
													<label for="permanent"> เปลี่ยนแปลงถาวร (ECR, Revised 3M Condition, etc.)</label>  
												</label> 
											</li>  
										</ul>
									</div>									
								</div>
								<div class="container-row req-dubdetail">
									<div class="req-input flex aligns-center">
										<span class="req-title flex">สาเหตุ</span>
										<select class="from-control width-100" name="req-cuase" style="width: 60%"></select>
									</div>									
								</div>	
							</div>
							<div class="flex flex-column width-100">
								<div class="container-row">
									<span class="title-subject">2. รายละเอียดการเปลี่ยนแปลง</span>	
								</div>
								<div class="container-row req-dubdetail">
									<label for="form-field-8">รายละเอียด</label>
                                    <textarea class="form-control req-textarea" name="req-description" placeholder="รายละเอียด การเปลี่ยนแปลง" rows="6"></textarea> 
								</div>
								<div class="container-row req-dubdetail">
									<div class="req-input flex aligns-center">
										<span class="req-title flex">สาเหตุ</span>
										<select class="from-control width-100" name="req-cuase" style="width: 60%"></select>
									</div>									
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>