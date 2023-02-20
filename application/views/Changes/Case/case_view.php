<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb"></ul><!-- /.breadcrumb -->
</div>
<div class="page-content customscroll">
	<div class="page-header"></div><!-- /.page-header -->
	<div class="section-content">
		<div id="signup-box" class="signup-box widget-box no-border">
			<div class="widget-body">
				<div class="widget-main">
					<h4 class="header green lighter bigger"><i class="ace-icon fa fa-th-list blue"></i>4M Change Cases</h4>
					<div class="space-6"></div>
					<div class="seection-actions">
						<div class="actions-header">
							<button class="btn btn-info btn-sm btn--filter tooltip-info" data-rel="tooltip" data-placement="top" title="" data-original-title="Filter 4M case">
								<i class="fa fa-filter" aria-hidden="true"></i> 
							</button>
							<div class="panl--search" style="display: none;">
								<div class="panl--box">
									<div class="flex flex-column box--filter">
										<label >4M NUMBER</label> 
										<select class="from-control width-100" name="sec-fourm" style="width: 100%" sel-for="fourm_number" seTwo></select>
									</div>
									<div class="flex flex-column box--filter">
										<label >REQUEST BY</label> 
										<select class="from-control width-100" name="sec-reqBy" style="width: 100%" sel-for="createBy" seTwo></select>
									</div>
									<div class="flex flex-column box--filter">
										<label >REQUEST DATE</label> 
										<input type="text" class="form-control" name="date-range-picker" />
									</div>
									<div class="flex flex-column box--filter">
										<label >PRODUCTION(PD)</label> 
										<select class="from-control width-100" name="sec-pd" style="width: 100%" sel-for="productionId"></select seTwo>
									</div>
								</div>
								<div class="panl--box">
									<div class="flex flex-column box--filter">
										<label >GROUP</label> 
										<select class="from-control width-100" name="sec-group" style="width: 100%" sel-for="changeDetailGroupId" seBot>
											<option value="all">Choose ALL select</option>
										</select>
									</div>
									<div class="flex flex-column box--filter">
										<label >STATUS</label> 
										<select class="from-control width-100" name="sec-status" style="width: 100%" sel-for="statusId" seBot>
											<option value="all">Choose ALL select</option>
										</select>
									</div>
									<div class="flex flex-column box--filter">
										<label >CUASE</label> 
										<select class="from-control width-100" name="sec-cuase" style="width: 100%" sel-for="changeCuaseId" seTwo></select>
									</div>
									<div class="flex flex-column box--filter">
										<label >LINE</label> 
										<select class="from-control width-100" name="sec-line" style="width: 100%" sel-for="lineId" seTwo></select>
									</div>
								</div>
								<div class="panl--box">
									<div class="flex flex-row">
										<button class="btn btn-md btn-info" onclick="searchFourm()">SEARCH</button>
										<button class="btn btn-md btn-danger" onclick="searchReset(this)">RESET</button>
									</div> 
								</div>								
							</div>
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
					<!-- <div class="box--action">
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
					</div> -->
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
				<div class="status--stamp" style="display:none;">
					<img src="<?=base_url()?>assets/images/results/ok.png" alt="">
				</div>
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
				<div class="modal-footer modal-Inspection-footer justify-end">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
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
 