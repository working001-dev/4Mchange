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
                    <h4 class="header green lighter bigger"><i class="ace-icon fa fa-user blue"></i>User profile</h4>

                    <div class="space-6"></div>
                    <p> Enter your details to begin: </p>
                    <form>
                        <fieldset>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label class="block clearfix">
                                    <label for="userName">Username</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="form-control" placeholder="Username" name="userName" value="<?= $this->session->user ?>" readonly />
                                        <i class="ace-icon fa fa-user"></i>
                                    </span>
                                </label>

                                <label class="block clearfix">
                                    <label for="firstName">First Name</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="form-control" placeholder="First Name" name="firstName" />
                                        <i class="ace-icon fa fa-address-card-o"></i>
                                    </span>
                                </label>

                                <label class="block clearfix">
                                    <label for="lastName">Last Name</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="form-control" placeholder="Last Name" name="lastName" />
                                        <i class="ace-icon fa fa-address-card-o"></i>
                                    </span>
                                </label>

                                <label class="block clearfix">
                                    <label for="email">Email</label>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" class="form-control" placeholder="Email" name="email" />
                                        <i class="ace-icon fa fa-envelope"></i>
                                    </span>
                                </label>

                                <label class="block clearfix">
                                    <label for="email">Gender</label>
                                    <span class="block input-icon input-icon-right">
                                        <div class="radio">
                                            <label>
                                                <input  type="radio" class="ace" name="gender" value="1">
                                                <span class="lbl"> Male <i class="fa fa-male" aria-hidden="true"></i></span>
                                            </label>
                                            <label>
                                                <input   type="radio" class="ace" name="gender" value="2">
                                                <span class="lbl"> Female<i class="fa fa-female" aria-hidden="true"></i></span>
                                            </label>                                            
                                        </div> 
                                    </span> 
                                </label> 
 
                            </div>
                            <!-- <div class="space-24"></div> -->
                            <div class="u-sticky col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2">
                                <button type="button" class="width-20 pull-center btn btn-sm btn-success u-btn-register" style="background: green; margin-top: 15px;min-width: 160px; max-width: 160px;">
                                    <span class="bigger-110">Save Change</span>
                                    <i class="ace-icon fa fa-floppy-o icon-on-right"></i>
                                </button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
</div><!-- /.page-content -->