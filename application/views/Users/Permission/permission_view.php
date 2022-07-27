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
                    <h4 class="header green lighter bigger"><i class="ace-icon fa fa-key blue"></i>Permission list</h4>

                    <div class="space-6"></div>
                    <div class="addClick col-lg-6 col-md-6 col-sm-12 col-sx-12"> 
                        <button class="per-click-add"> 
                            Click for add permission: 
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button> 
                    </div>  
                    <div class="panel-list col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- style="display:none;" -->
                        <div class="panel-add">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 comp-add">
                                <div class="form-group">
								    <label class="control-label no-padding-right" for="form-field-1">Permission Name</label> 
								    <input type="text" name="permission" placeholder="Permission Name" vali="true" vali--message="Please input name for create permisstion." add--new="user">
								</div>
                                <div class="form-group">
                                    <label for="form-field-8">Description</label>
                                    <textarea class="form-control" name="description" placeholder="description permission" rows="6" add--new="user"></textarea>
								</div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-success btn-md width-25 pull-right" id="create--new">CREATE</button>
                                    <button type="button" class="btn btn-btn-corner btn-md width-25 pull-right dnone-btn" id="update--new">UPDATE</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="roleList"> </table>                
                    </div>
                </div>
            </div>
        </div>  
    </div><!-- /.row -->
</div><!-- /.page-content -->