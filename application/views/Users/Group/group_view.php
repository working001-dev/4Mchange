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
                    <h4 class="header green lighter bigger"><i class="ace-icon fa fa-users blue"></i>Group list</h4>

                    <div class="space-6"></div>
                    <div class="addClick col-lg-6 col-md-6 col-sm-12 col-sx-12"> 
                        <button class="per-click-add"> 
                            Click for add group: 
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button> 
                    </div>  
                    <div class="panel-list col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- style="display:none;" -->
                        <div class="panel-add">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 comp-add">
                                <div class="form-group">
								    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Permission Name</label> 
								    <input type="text" name="permission" placeholder="Permission Name">
								</div>
                                <div class="form-group">
                                    <label for="form-field-8">Description</label>
                                    <textarea class="form-control" name="description" placeholder="description permission" rows="6"></textarea>
								</div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-success btn-md width-25 pull-right">CREATE</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="roleList"> 
                            <thead>
                                <tr>
                                    <th>GROUP ID</th>
                                    <th>GROUP NAME</th>
                                    <th>CREATE DATE</th>
                                    <th>DESCRIPTION</th>
                                    <th>STATUS</th>
                                </tr>                    
                            </thead>
                            <tbody></tbody> 
                        </table>                
                    </div>
                </div>
            </div>
        </div>  
    </div><!-- /.row -->
</div><!-- /.page-content -->