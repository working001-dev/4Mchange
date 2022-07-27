<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
    </div><!-- /.page-header -->
    <div class="section-content">
        <div id="signup-box" class="signup-box widget-box no-border">
            <div class="widget-body">
                <div class="widget-main">
                    <h4 class="header green lighter bigger"><i class="ace-icon fa fa-link blue"></i>Mapping permission menus</h4> 
                    <div class="space-6"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- PAGE CONTENT BEGINS --> 
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="widget-box widget-color-blue2">
                                <div class="widget-headers">
                                    <div>
                                        <h4 class="widget-title lighter smaller">Permission</h4>    
                                    </div>
                                    <div>
                                        <span class="flex input-icon input-icon-left" style="align-items: center;">
                                            <input type="text" class="form-control" placeholder="enter permission name" name="roleSearch" onkeyup="filterRole(this)"/>
                                            <i class="ace-icon-permission fa fa-search"></i>
                                        </span>                                            
                                    </div> 
                                </div> 
                                <div class="widget-body widget-body-inside customscroll">
                                    <div class="widget-main padding-8">
                                        <div class="list-group" id="listRole"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="widget-box widget-color-blue2">
                                <div class="widget-headers">
                                    <h4 class="widget-title lighter smaller">Choose Categories</h4> 
                                </div> 
                                <div class="widget-body widget-body-inside customscroll">
                                    <div class="reload-tree"><span><i class="fa fa-refresh fa-spin" aria-hidden="true"></i></span></div>
                                    <div class="widget-main padding-8">
                                        <ul id="treeMenu" class="list-group">
                                            <li class="placeholder-list">Please choose permission</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>  

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div>
            </div>
        </div> 
    </div><!-- /.row -->
</div><!-- /.page-content -->