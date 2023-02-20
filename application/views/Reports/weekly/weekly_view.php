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
					<h4 class="header green lighter bigger"><i class="ace-icon fa fa-info-circle blue"></i>4M Change Weekly</h4>
					<div class="space-6"></div>
					<div class="p-action">
						<div class="left-group">
							<button class="btn btn-sm btn-success" onclick="ExportToExcel('xlsx')">
								<i class="fa fa-file-excel-o" aria-hidden="true"></i>
								Export report
							</button>

							<div class="input-group" style="margin-left: 8px;">
								<select class="selectpicker show-menu-arrow btn-primary" id="select-pd" data-style="btn-primary" data-width="120px">
									<option value="all">All</option>
								</select>	
								<span class="input-group-addon">
									PD
								</span>
							</div>					
						</div>
						<div class="right-group">
							<div class="input-group" style="margin-right: 8px;">
								<input class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="yyyy-MM-dd" value="<?=date('Y-m-d')?>" style="width: 120px;"/>
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
									<span>this day to 7 day ago</span>
								</span>
							</div>							
						</div> 
					</div>
					<div class="tb-box customscroll"style="border-radius: 3px;"> 
						<table class="table" id="tbReport" style="margin: 0px;">
							<thead>
								<tr>
									<th colspan="9" >Changes</th>
									<th colspan="2" >Type</th>
									<th colspan="3">Monitoring</th>
									
									<th rowspan="2">Remark</th>
								</tr> 
								<tr>
									<th><span>No</span></th>
									<th><span>Date</span></th>
									<th><span>Production</span></th>
									<th><span>4M No.</span></th>
									<th><span>Line</span></th>
									<th><span>Process</span></th>
									<th><span>Related Production</span></th>
									<th><span>4MType</span></th>
									<th><span>Detail of Change</span></th> 
									<th><span>Permanent</span></th>
									<th><span>Temporary</span></th>
									<th><span>Start</span></th>
									<th><span>Duedate</span></th>
									<th><span>Status</span></th> 
								</tr>
							</thead>
							<tbody>
								<tr><td colspan="15">Data Empty.</td></tr>
							</tbody>
						</table>
					</div>
				</div> 
			</div>
		</div>
	</div><!-- /.row -->
</div><!-- /.page-content -->
