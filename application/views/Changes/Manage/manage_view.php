<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb"></ul><!-- /.breadcrumb -->
</div>
<div class="page-content customscroll">
	<div class="page-header"></div><!-- /.page-header -->
	<div class="section-content">
		<div id="signup-box" class="signup-box widget-box no-border">
			<div class="widget-body">
				<div class="widget-main">
					<h4 class="header green lighter bigger"><i class="ace-icon fa fa-info-circle blue"></i>4M Change Manage</h4>
					<div class="space-6"></div>
					<div class="seection-actions">
						<div class="actions-header">
							<span class="head--waiting">Wait actions</span>
						</div>
						<div class="actions-body">
							<table class="table" id="tb-wait--action" style="width:100%"></table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.row -->
</div><!-- /.page-content -->


<div class="modal fade modal-action customscroll" id="modal--action" role="dialog" aria-labelledby="modal--actionLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-box">
				<div class="modal-header modal-action-header">
					<span class="title--action"></span> 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body modal-action-body">
					<div class="box--action">
						<button type="button" class="btn btn-white btn-sm btn--confirm" onclick="clickActionConfirmInspec(this)" action="confirm">
							<i class="fa fa fa-check-circle" aria-hidden="true"></i>
							Confirm Inspect
						</button>
						<button type="button" class="btn btn-white btn-sm btn--inspcet" onclick="clickActionInspec(this)" action="inspcet">
							<i class="fa fa fa-eye" aria-hidden="true"></i>
							Inspcet
						</button>						
						<button type="button" class="btn btn-white btn-sm btn--approve" onclick="clickActionEvent(this)" action="approve">
							<i class="fa fa-check-circle" aria-hidden="true"></i>
							Approve
						</button>
						<button type="button" class="btn btn-white btn-sm btn--reject" onclick="clickActionEvent(this)" action="reject">
							<i class="fa fa-times-circle" aria-hidden="true"></i>
							Reject
						</button>
						<button type="button" class="btn btn-warning btn-sm btn--following" onclick="clickFollowingEvent(this)" action="follow">
							<i class="fa fa-hourglass-start" aria-hidden="true"></i>
							Confirm Following
						</button>
					</div>
					<div class="box--status customscroll"> </div>
					<div class="box--detail">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="txt--group">
								<span>4M Number</span>
								<span sp-name="fourm_number">########</span>
							</div>
							<div class="txt--group">
								<span>4M Type</span>
								<span sp-name="changeTypeName">########</span>
							</div> 
							<div class="txt--group">
								<span>4M Cuase Type</span>
								<span sp-name="cuaseTypeName">########</span>
							</div>
							<div class="txt--group">
								<span>4M Cuase</span>
								<span sp-name="changeCuaseName">########</span>
							</div>
							<div class="txt--group">
								<span>4M Detail</span>
								<pre sp-name="changeDetail"></pre>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="txt--group">
								<span>Prodeuction</span>
								<span sp-name="productionName">########</span>
							</div>
							<div class="txt--group">
								<span>Line</span>
								<span sp-name="lineName">########</span>
							</div>
							<div class="txt--group">
								<span>Part Name</span>
								<span sp-name="partName">-</span>
							</div>
							<div class="txt--group">
								<span>Part Number</span>
								<span sp-name="partNumber">-</span>
							</div>
							<div class="txt--group">
								<span>Process</span>
								<span sp-name="processName">########</span>
							</div>	
							<div class="txt--group">
								<span>Attach File</span>
								<span sp-name="countAttachFile">########</span>
							</div>	
							<div class="txt--group">
								<span>Inspection Result</span>
								<span sp-name="inspect">
									<i class="ace-icon fa fa-search icon-animated-vertical"></i> 
									<a href="#" class="text-primary review--inspect" >Click to review inspection</a>
								</span>
							</div>	
							<div class="txt--group">
								<span>Quality Inspection Result</span>
								<span sp-name="qc-inspect">
									<i class="ace-icon fa fa-search icon-animated-vertical"></i> 
									<a href="#" class="text-primary review--quality" >Click to review inspection</a>
								</span>
							</div>							
						</div>
					</div>
					<div class="box--history customscroll">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<table class="table table-border" id="table--history">
								<thead>
									<tr>
										<th>Step</th>
										<th>Status</th>
										<th>Action</th>
										<th>Comment</th>
										<th>Date/Time</th>
										<th>Actor</th>
									</tr>
								</thead>
								<tbody><tr><td colspan="6">No Action</td></tr></tbody>
							</table>							
						</div> 
					</div>
				</div>

				<div class="modal-footer modal-action-footer justify-end">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<!-- <button type="button" class="btn btn-primary" onclick="add4MChange()">Save changes</button> -->
				</div>
				<div class="wait--create">
					<div class="progress progress-striped active">
						<div class="progress-bar progress-bar-blue" style="width: 0%"></div>
					</div>
					<span class="progress-status">Wait Create 4M Change</span>		
				</div>
				<!-- <div class="status--stamp" style="display:none;">
					<img src="<?=base_url()?>assets/images/results/ok.png" alt="">
				</div> -->
			</div> 
		</div>
	</div> 
</div>

<div class="modal fade modal-fileAttach customscroll" id="modal--fileAttach" role="dialog" aria-labelledby="modal--fileAttachLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-box">
				<div class="modal-header modal-fileAttach-header">
					<span class="title--fileAttach"></span> 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body modal-fileAttach-body"></div> 
 
				<div class="modal-footer modal-fileAttach-footer justify-end">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<!-- <button type="button" class="btn btn-primary" onclick="add4MChange()">Save changes</button> -->
				</div>

			</div> 
		</div>
	</div> 
</div>

<div class="modal fade modal-Inspection customscroll" id="modal--Inspection" role="dialog" aria-labelledby="modal--InspectionLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-box">
				<div class="modal-header modal-Inspection-header">
					<span class="title--Inspection"></span> 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body modal-Inspection-body">
					<a class="view--image" href="#">click to view image</a> 
					<div class="">
						<div class="" style="border: 1px solid #c2c2c2; height: 40vh;">
							<!-- <canvas id="insp--can" class="showpic" style="max-width: 100%;height: 100%; overflow:auto;"></canvas> -->
							<img src="" alt="" id="insp--img" style="width: 100%; height: 100%;" />
						</div>
					</div>
					<div class="container-row flex ">
						<div class="req-input flex flex-column width-100">
							<span class="req-title flex">ตรวจสอบจุดเปลี่ยนแปลง</span>
							<table class="table table-striped table-bordered table-hover table-input" id="table--inspecction">
								<thead>
									<tr>
										<th>จุดตรวจสอบ</th>
										<th>ค่าควบคุม ±</th>
										<th>ผลการตรวจวัด</th>
									</tr>
								</thead>
								<tbody> </tbody>
								<tfoot>
									<tr>
										<th>จุดตรวจสอบ</th>
										<th>ค่าควบคุม ±</th>
										<th>ผลการตรวจวัด</th>
									</tr>
								</tfoot>
							</table>
						</div> 
					</div>					
				</div>
				<!-- <div class="modal-footer modal-Inspection-footer justify-end">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="add4MChange()">Save changes</button>
				</div>  -->
			</div> 
		</div>
	</div> 
</div>

<div class="modal fade modal-ActionEvent customscroll action--approve " id="modal--ActionEvent" role="dialog" aria-labelledby="modal--ActionEventLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-box">
				<div class="modal-header modal-ActionEvent-header">
					<span class="title--ActionEvent"></span> 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body modal-ActionEvent-body"> 
					<div class="container-row flex ">
						<div class="req-input flex flex-column width-100">
							<span class="req-title flex">Comment</span>
							<textarea class="form-control req-textarea" name="req-description" placeholder="comment for action" rows="6"></textarea>
						</div> 
					</div>					
				</div>
				<div class="modal-footer modal-ActionEvent-footer justify-end">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="approveEvent(this)" action>Submit</button>
				</div> 
			</div> 
		</div>
	</div> 
</div>
<div class="modal fade modal-ActionInspec customscroll action--inspec" id="modal--ActionInspec" role="dialog" aria-labelledby="modal--ActionInspecLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-box">
				<div class="modal-header modal-ActionInspec-header">
					<span class="title--ActionInspec"></span> 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body modal-ActionInspec-body"> 
					<div class="flex flex-row flex-wrap modal-row">
					<div class="flex flex-column section-input-request col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="container-row req-subdetail flex ">
								<div class="req-input flex flex-column width-100">
									<span class="req-title flex">ตรวจสอบชิ้นงานตัวอรก หลังเปลี่ยนแปลง</span>
									<div class="tbox customscroll" style="z-index:3; max-height: 60vh;">
										<table class="table table-striped table-hover table-input" id="reviewList" style="margin:0px !important;">
											<thead style="position:sticky; top:0; z-index:3;">
												<tr>
													<th>จุดตรวจสอบ</th>
													<th>ค่าควบคุม ±</th>
													<th>ผลการตรวจวัด</th>
												</tr> 
											</thead>
											<tbody></tbody>
											<tfoot style="position:sticky; bottom:-1px; z-index:3; background: repeat-x #F2F2F2;background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
												<tr style="position:sticky; bottom:-1px; background: repeat-x #F2F2F2;background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
													<td colspan="3">คลิกปุ่ม + เพื่อเพิ่มข้อมูล</td> 
												</tr> 
											</tfoot>
										</table>										
									</div> 
								</div>
								<button type="button" class="btn-add-review" onclick="addReview('#reviewList', this)" style="left: 32px;">
									<i class="fa fa-plus-square-o" aria-hidden="true"></i>
								</button>
							</div>								
						</div>							
						<div class="flex flex-column section-input-request col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="container-row req-subdetail">
								<span class="req-title flex">เอกสารแนบเพื่อการตรวจวัด</span>
								<div class="container-row req-child doc--forapprove">
									<div class="req-input flex flex-column">
										<span class="req-title flex">CMM Data</span>
										<label for="file-tochange" class="attach-component">
											<input type="file" name="file-tochange" style="display: none;"  subject-doc="11"  name-doc="MSR" attach-request />
											<span class="sp-filename">กรุณาแนบไฟล์</span>
											<button class="btn-attach"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
										</label>
									</div>
									<div class="req-input flex flex-column">
										<span class="req-title flex">อื่นๆ</span>
										<label for="file-tochange" class="attach-component">
											<input type="file" name="file-tochange" style="display: none;"  subject-doc="12"  name-doc="MTH" attach-request />
											<span class="sp-filename">กรุณาแนบไฟล์</span>
											<button class="btn-attach"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
										</label>
									</div>
									<div class="req-input flex flex-column">
										<span class="req-title flex">อื่นๆ</span>
										<label for="file-tochange" class="attach-component">
											<input type="file" name="file-tochange" style="display: none;"  subject-doc="12"  name-doc="MTH" attach-request />
											<span class="sp-filename">กรุณาแนบไฟล์</span>
											<button class="btn-attach"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
										</label>
									</div>
									<div class="req-input flex flex-column">
										<span class="req-title flex">สรุปผลการตรวจสอบ</span>
										<div class="group--btn-result">
											<button class="btn-result btn-ok" res="OK">
												<i class="fa fa-check-circle" aria-hidden="true"></i>
											</button>
											<button class="btn-result btn-ng" res="NG">
												<i class="fa fa-times-circle" aria-hidden="true"></i>
											</button>	
										</div>
										<div class="group--btn-result">
											<span class="spn-result spn-ok">
												OK
											</span>
											<span class="spn-result spn-ng">
												NG
											</span>	
										</div>	
									</div>									
								</div>

							</div>							
						</div> 
					</div> 
				</div>
				<div class="modal-footer modal-ActionInspec-footer justify-end">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary btn-submit" onclick="approveinspectEvent(this)" disabled>Submit</button>
				</div> 
				<div class="wait--create">
					<div class="progress progress-striped active">
						<div class="progress-bar progress-bar-blue" style="width: 0%"></div>
					</div>
					<span class="progress-status">Wait Create 4M Change</span>		
				</div>
			</div> 
		</div>
	</div> 
</div>
<div class="modal fade modal-QualityConfirm customscroll" id="modal--QualityConfirm" role="dialog" aria-labelledby="modal--QualityConfirmLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-box">
				<div class="modal-header modal-QualityConfirm-header">
					<span class="title--QualityConfirm"></span> 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body modal-QualityConfirm-body inp-check">
					<div class="container-row flex flex-column">
						<label>
							<input type="radio" for-status="Approved" name="inp-confirm" value="1" onchange="selectCondition(this)">
							<span class="tree-item-name flex">
								<i class="icon-item ace-icon fa fa-times"></i>
								<span class="tree-label">ให้มีการผลิตได้ตามปกติ</span>
							</span> 
						</label> 
					</div>						 
					<div class="container-row flex flex-column">
						<label>
							<input type="radio" for-status="Following" name="inp-confirm" value="2" onchange="selectCondition(this)">
							<span class="tree-item-name flex">
								<i class="icon-item ace-icon fa fa-times"></i>
								<span class="tree-label">ให้มีการผลิตได้ โดยมีเงื่อนไขดังนี้(ต้องติดตามผล)</span>
							</span> 
						</label>
						<div class="block--group condition--group blocked">
							<div class="req-input flex flex-column width-100">
								<span class="req-title flex">รายละเอียด</span>
								<textarea class="form-control req-textarea" name="req-condition-des" placeholder="รายละเอียดเงื่อนไข" rows="6" disabled></textarea>
							</div>
							<div class="req-input flex flex-column width-100">
								<span class="req-title flex">กำหนดช่วงเวลาการควบคุมพิเศษ</span>
								<div class="input-daterange input-group">
									<input type="text" class="input-sm form-control" name="start" value="<?=date('Y/m/d');?>" style="padding-left: 25px;" disabled>
									<span class="input-group-addon">
										<i class="fa fa-exchange"></i>
									</span> 
									<input type="text" class="input-sm form-control" name="end" value="<?=date('Y/m/d');?>" style="padding-left: 25px;" disabled>
								</div>	 
							</div>
							<div class="block--action"></div>							
						</div> 
					</div>
					<div class="container-row flex flex-column">
						<label>
							<input type="radio" for-status="Rejected" name="inp-confirm" value="3" onchange="selectCondition(this)">
							<span class="tree-item-name flex">
								<i class="icon-item ace-icon fa fa-times"></i>
								<span class="tree-label">ห้ามผลิต</span>
							</span> 
						</label> 
					</div>										
				</div>
				<div class="modal-footer modal-QualityConfirm-footer justify-end">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="approveJudgment(this)">Submit</button>
				</div> 
				<div class="wait--create">
					<div class="progress progress-striped active">
						<div class="progress-bar progress-bar-blue" style="width: 0%"></div>
					</div>
					<span class="progress-status">Wait Create 4M Change</span>		
				</div>

			</div> 
		</div>
	</div> 
</div>
<div class="modal fade modal-Quality customscroll" id="modal--Quality" role="dialog" aria-labelledby="modal--QualityLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-box">
				<div class="modal-header modal-Quality-header">
					<span class="title--Quality"></span> 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body modal-Quality-body">
					<div class="container-row flex flex-column attach--quality"></div>
					<div class="container-row flex ">
						<div class="req-input flex flex-column width-100">
							<span class="req-title flex">ตรวจสอบจุดเปลี่ยนแปลง</span>
							<table class="table table-striped table-bordered table-hover table-input" id="table--inspecction">
								<thead>
									<tr>
										<th>จุดตรวจสอบ</th>
										<th>ค่าควบคุม ±</th>
										<th>ผลการตรวจวัด</th>
									</tr>
								</thead>
								<tbody> </tbody>
								<tfoot>
									<tr>
										<th>จุดตรวจสอบ</th>
										<th>ค่าควบคุม ±</th>
										<th>ผลการตรวจวัด</th>
									</tr>
								</tfoot>
							</table>
						</div> 
					</div>	
				</div>
				<div class="modal-footer modal-Quality-footer justify-end">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
				</div> 
				<div class="wait--create">
					<div class="progress progress-striped active">
						<div class="progress-bar progress-bar-blue" style="width: 0%"></div>
					</div>
					<span class="progress-status">Wait Create 4M Change</span>		
				</div>

			</div> 
		</div>
	</div> 
</div>
<div class="modal fade modal-Following customscroll" id="modal--Following" role="dialog" aria-labelledby="modal--FollowingLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-box">
				<div class="modal-header modal-Following-header">
					<span class="title--Following"></span> 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body modal-Following-body inp-check">
					<div class="container-row flex flex-column">
						<label>
							<input type="checkbox" name="inp-follow" value="1" ckUsed>
							<span class="tree-item-name flex">
								<i class="icon-item ace-icon fa fa-times"></i>
								<span class="tree-label">ปฏิบัติตามเงื่อนไขควบคุมพิเศษ ได้อย่างครบถ้วน</span>
							</span> 
						</label>
						<label>
							<input type="checkbox" name="inp-follow" value="2" ckUsed>
							<span class="tree-item-name flex">
								<i class="icon-item ace-icon fa fa-times"></i>
								<span class="tree-label">มีการชี้บ่งการเปลี่ยนแปลงได้ครบถ้วน (Tag)</span>
							</span> 
						</label> 
						<label>
							<input type="checkbox" name="inp-follow" value="3" ckUsed>
							<span class="tree-item-name flex">
								<i class="icon-item ace-icon fa fa-times"></i>
								<span class="tree-label">สุ่มตรวจสอบชิ้นงานดี ได้ผล OK</span>
							</span> 
						</label> 
						<label>
							<input type="checkbox" name="inp-follow" value="4" ckUsed>
							<span class="tree-item-name flex">
								<i class="icon-item ace-icon fa fa-times"></i>
								<span class="tree-label">อัตราของเสียอยู่ในเกณฑ์ที่ยอมรับได้</span>
							</span> 
						</label> 
						<label>
							<input type="checkbox" name="inp-follow" value="5" ckUsed>
							<span class="tree-item-name flex">
								<i class="icon-item ace-icon fa fa-times"></i>
								<span class="tree-label">มีการจัดการของเสียที่เกิดขึ้นได้อย่างถูกต้อง</span>
							</span> 
						</label> 																								 
					</div>						 
					<div class="container-row flex flex-column" style="min-height: 20px;">
						<div class="title-inbox">
							<span>การสิ้นสุดการควบคุม 4M Changes</span>
						</div> 
					</div>
					<div class="container-row flex flex-column">
						<label>
							<input type="radio" for-status="Approved" name="inp-follow-juds" value="1" onchange="selectJudment(this)" ckUsed>
							<span class="tree-item-name flex">
								<i class="icon-item ace-icon fa fa-times"></i>
								<span class="tree-label"><i class="fa fa-check text-success" aria-hidden="true" style="margin-right: 10px;"></i>อนุมัติการสิ้นสุดการควบคุม</span>
							</span> 
						</label> 
						<label>
							<input type="radio" for-status="Rejected" name="inp-follow-juds" value="2" onchange="selectJudment(this)" ckUsed>
							<span class="tree-item-name flex">
								<i class="icon-item ace-icon fa fa-times"></i>
								<span class="tree-label"><i class="fa fa-times text-danger" aria-hidden="true" style="margin-right: 10px;"></i>พบความผิดปกติในการควบคุม 4M</span>
							</span> 
						</label> 
						<div class="block--group condition--group blocked">
							<div class="container-row flex flex-column" style="padding-left: 28px;">
								<label>
									<input type="checkbox" name="inp-error-action" value="1" ckUsed>
									<span class="tree-item-name flex">
										<i class="icon-item ace-icon fa fa-times"></i>
										<span class="tree-label">เริ่มกระบวนการ 4M ใหม่</span>
									</span> 
								</label>
								<label>
									<input type="checkbox" name="inp-error-action" value="2" ckUsed>
									<span class="tree-item-name flex">
										<i class="icon-item ace-icon fa fa-times"></i>
										<span class="tree-label">ออกใบแจ้งการจัดการปัญหาคุณภาพ QMW</span>
									</span> 
								</label> 
								<label>
									<input type="checkbox" name="inp-error-action" value="3" ckUsed>
									<span class="tree-item-name flex">
										<i class="icon-item ace-icon fa fa-times"></i>
										<span class="tree-label">8D Analysis</span>
									</span> 
								</label> 
								<label>
									<input type="checkbox" name="inp-error-action" value="4" ckUsed>
									<span class="tree-item-name flex">
										<i class="icon-item ace-icon fa fa-times"></i>
										<span class="tree-label">อื่นๆ</span>
									</span> 
								</label> 
								<div class="flex flex-column width-100"> 
									<textarea class="input-sm form-control" name="inp-error-oth" disabled style="max-width:100%;"></textarea>
								</div>																 
							</div>
							<div class="block--action"></div>							
						</div>  
					</div>										
				</div>
				<div class="modal-footer modal-Following-footer justify-end">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary actioned" onclick="approveFollow(this)" disabled>Submit</button>
				</div> 
				<div class="wait--create">
					<div class="progress progress-striped active">
						<div class="progress-bar progress-bar-blue" style="width: 0%"></div>
					</div>
					<span class="progress-status">Wait Create 4M Change</span>		
				</div>

			</div> 
		</div>
	</div> 
</div>
<template for-site="add-button--intable">
	<tr>
		<td><input type="text" class="from-coltrol" /></td>
		<td><input type="text" class="from-coltrol" /></td>
		<td>
			<div class="btn-confirm-group">
				<button class="btn btn-sm btn-success conf" onclick="confirmRow(this, 1)" title="ผ่าน"   data--tooltip="tooltip-table"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
				<button class="btn btn-sm btn-danger conf"  onclick="confirmRow(this, 2)" title="ไม่ผ่าน" data--tooltip="tooltip-table"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
				<button class="btn btn-sm btn-warning" onclick="removeRow(this)" title="ยกเลิก" data--tooltip="tooltip-table"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
			</div>
		</td>
	</tr>
</template>