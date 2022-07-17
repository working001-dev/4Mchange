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
					<h4 class="header green lighter bigger"><i class="ace-icon fa fa-info-circle blue"></i>4M Change Request</h4>
					<div class="space-6"></div>
					<div>
						<button type="button" class="btn-change-add" onclick="$(`#modal-sheet-add`).modal('show');" title="TEST DATA">
							<span>Add new change request</span>
							<i class="fa fa-plus-square" aria-hidden="true"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.row -->
</div><!-- /.page-content -->

<div class="modal fade modal-change-add customscroll" id="modal-sheet-add"  role="dialog" aria-labelledby="modal-sheet-addLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-box">
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
								<div class="flex flex-column width-100 section-input-request">
									<div class="container-row">
										<span class="title-subject">1. สาเหตุ / ความจำเป็นในการเปลี่ยนแปลง</span>	
									</div>
									<div class="container-row req-subdetail">
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
									<div class="container-row req-subdetail">
										<div class="req-input flex aligns-center">
											<span class="req-title flex">สาเหตุ</span>
											<select class="from-control width-100" name="req-cuase" style="width: 60%"></select>
										</div>									
									</div>	
								</div>
								<div class="flex flex-column width-50 section-input-request">
									<div class="container-row">
										<span class="title-subject">2. รายละเอียดการเปลี่ยนแปลง</span>	
									</div>
									<div class="container-row req-subdetail">
										<div class="req-input flex flex-column">
											<span class="req-title flex">รายละเอียด</span>
											<textarea class="form-control req-textarea" name="req-description" placeholder="รายละเอียด การเปลี่ยนแปลง" rows="6"></textarea> 
										</div> 
									</div>
									<div class="container-row req-subdetail">
										<div class="req-input flex flex-column">
											<span class="req-title flex">สภาพก่อนเปลี่ยนแปลง / สภาพปกติ</span>
											<label for="file-beforechange" class="attach-component width-100">
												<input type="file" name="file-beforechange" style="display: none;" attach-request/>
												<span class="sp-filename">กรุณาแนบไฟล์</span>
												<button class="btn-attach"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
											</label>
										</div>									
									</div>
									<div class="container-row req-subdetail">
										<div class="req-input flex flex-column">
											<span class="req-title flex">สภาพที่จะเปลี่ยนแปลง</span>
											<label for="file-tochange" class="attach-component width-100">
												<input type="file" name="file-tochange" style="display: none;" attach-request/>
												<span class="sp-filename">กรุณาแนบไฟล์</span>
												<button class="btn-attach"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
											</label>
										</div>									
									</div>	
									<div class="container-row req-subdetail">
										<div class="req-input flex flex-column width-100">
											<span class="req-title flex">เอกสารแนบเพื่อการอนุมัติ</span>
											<div class="container-row req-child">
												<div class="req-input flex flex-column">
													<span class="req-title flex">ใบแจ้งซ่อม (คืนสภาพแล้ว หรือชั่วคราว)</span>
													<label for="file-tochange" class="attach-component">
														<input type="file" name="file-tochange" style="display: none;" attach-request/>
														<span class="sp-filename">กรุณาแนบไฟล์</span>
														<button class="btn-attach"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
													</label>
												</div>
												<div class="req-input flex flex-column">
													<span class="req-title flex">Revised 3M Conditions</span>
													<label for="file-tochange" class="attach-component">
														<input type="file" name="file-tochange" style="display: none;" attach-request/>
														<span class="sp-filename">กรุณาแนบไฟล์</span>
														<button class="btn-attach"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
													</label>
												</div>
												<div class="req-input flex flex-column">
													<span class="req-title flex">ECR , ใบขอใช้กรณีพิเศษ (Special Use ทั้งภายนอกและภายใน)</span>
													<label for="file-tochange" class="attach-component">
														<input type="file" name="file-tochange" style="display: none;" attach-request/>
														<span class="sp-filename">กรุณาแนบไฟล์</span>
														<button class="btn-attach"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
													</label>
												</div>
												<div class="req-input flex flex-column">
													<span class="req-title flex">EWR (Material : นำงาน Rework มาเข้ากระบวนการ)</span>
													<label for="file-tochange" class="attach-component">
														<input type="file" name="file-tochange" style="display: none;" attach-request/>
														<span class="sp-filename">กรุณาแนบไฟล์</span>
														<button class="btn-attach"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
													</label>
												</div>
												<div class="req-input flex flex-column">
													<span class="req-title flex">ผลการตรวจสอบ,ผลการ Sorting</span>
													<label for="file-tochange" class="attach-component">
														<input type="file" name="file-tochange" style="display: none;" attach-request/>
														<span class="sp-filename">กรุณาแนบไฟล์</span>
														<button class="btn-attach"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
													</label>
												</div>
												<div class="req-input flex flex-column">
													<span class="req-title flex">ใบประเมินพนักงาน,รายงานการทดลองผลิต</span>
													<label for="file-tochange" class="attach-component">
														<input type="file" name="file-tochange" style="display: none;" attach-request/>
														<span class="sp-filename">กรุณาแนบไฟล์</span>
														<button class="btn-attach"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
													</label>
												</div>
												<div class="req-input flex flex-column">
													<span class="req-title flex">อื่น</span>
													<label for="file-tochange" class="attach-component">
														<input type="file" name="file-tochange" style="display: none;" attach-request/>
														<span class="sp-filename">กรุณาแนบไฟล์</span>
														<button class="btn-attach"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
													</label>
												</div>									
											</div>	
										</div> 
									</div>	
								</div>
								<div class="flex flex-column width-50 section-input-request">
									<div class="container-row">
										<span class="title-subject">3. การตรวจสอบเบื้องต้น</span>	
									</div>
									<div class="container-row req-subdetail">
										<div class="req-input flex flex-column">
											<span class="req-title flex">ภาพร่าง ตำแหน่งชิ้นงานที่มีผลกระทบจากการเปลี่ยนแปลง</span>
											<label for="file-imagechange" class="attach-component width-100">
												<input type="file" name="file-imagechange" onchange="upload()" id="finput" style="display: none;" attach-request/>
												<span class="sp-filename">กรุณาแนบไฟล์</span>
												<button class="btn-attach">
													<i class="fa fa-paperclip" aria-hidden="true"></i>
												</button> 
											</label>  
										</div> 
									</div>
									<div class="container-row req-subdetail">
										<div class="req-input flex justify-center" style="border: 1px solid #c2c2c2; height: 40vh;"> 
											<canvas id="can" class="showpic" style="max-width: 100%;height: 100%; overflow:auto;"></canvas>
										</div> 
									</div>
									<div class="container-row req-subdetail flex ">
										<div class="req-input flex flex-column width-100">
											<span class="req-title flex">ตรวจสอบจุดเปลี่ยนแปลง</span>
											<table class="table table-striped table-bordered table-hover table-input" id="reviewList" style=""> 
											<thead>
												<tr>
													<th>จุดตรวจสอบ</th>
													<th>ค่าควบคุม</th>
													<th>ผลการตรวจวัด</th> 
												</tr>                    
											</thead>
											<tbody> 
												
											</tbody> 
											<tfoot>
												<tr><td colspan="3">คลิกปุ่ม + เพื่อเพิ่มข้อมูล</td></tr>
											</tfoot>
											</table> 
										</div> 
										<button type="button" class="btn-add-review" onclick="addReview('#reviewList', this)"><i class="fa fa-plus-square-o" aria-hidden="true"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer modal-change-add-footer justify-end">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>				
			</div> 
		</div>
	</div>
</div>

<template for-site="add-button--intable"> 
	<tr>
		<td><input type="text" class="from-coltrol"/></td>
		<td><input type="text" class="from-coltrol"/></td>
		<td>
			<div class="btn-confirm-group">
				<button class="btn btn-sm btn-success" title="ผ่าน" data--tooltip="tooltip-table"><i class="fa fa-check-circle" aria-hidden="true" ></i></button>
				<button class="btn btn-sm btn-danger" title="ไม่ผ่าน" data--tooltip="tooltip-table"><i class="fa fa-times-circle" aria-hidden="true" ></i></button>
				<button class="btn btn-sm btn-warning" onclick="removeRow(this)" title="ยกเลิก" data--tooltip="tooltip-table"><i class="fa fa-minus-circle" aria-hidden="true" ></i></button>
			</div> 
		</td>
	</tr> 
</template>

<template for-site="toottip--template"> 
	<div class="tooltip" role="tooltip"><div class="arrow" style="z-index:9999; background:red;"></div><div class="tooltip-inner"></div></div> 
</template>
 