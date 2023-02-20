<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb"> 
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content customscroll">
    <div class="page-header"></div><!-- /.page-header -->
    <div class="section-content">
        <div class="section-dash">
            <div class="panel-summary"> 
                <div class="box-summary col-xl-3 col-lg-3 col-md-6 col-sm-12 col-sx-12">
                    <div class="box-info" style="background-color: #b8b8d1;">
                        <div class="b-icon">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>                            
                        </div>
                        <div class="b-content">
                            <div class="txt-number" id="num-total">
                                <span data-counter="counterup" data-value="0">0</span>
                            </div>
                            <div class="txt-detail">
                                <span>Total 4M Change case.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-summary col-xl-3 col-lg-3 col-md-6 col-sm-12 col-sx-12">
                    <div class="box-info" style="background-color: #ffcb80;">
                        <div class="box-info" style="background-color: #ffcb80;">
                            <div class="b-icon">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>                            
                            </div>
                            <div class="b-content">
                                <div class="txt-number" id="num-inprocess">
                                    <span data-counter="counterup" data-value="0">0</span>
                                </div>
                                <div class="txt-detail">
                                    <span>4M Change case inprocess</span>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="box-summary col-xl-3 col-lg-3 col-md-6 col-sm-12 col-sx-12">
                    <div class="box-info" style="background-color: #8bd58f;">
                        <div class="box-info" style="background-color: #8bd58f;">
                            <div class="b-icon">
                                <i class="fa fa-check-circle-o" aria-hidden="true"></i>                            
                            </div>
                            <div class="b-content">
                                <div class="txt-number" id="num-approve">
                                    <span data-counter="counterup" data-value="0">0</span>
                                </div>
                                <div class="txt-detail">
                                    <span>4M Change case approved</span>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="box-summary col-xl-3 col-lg-3 col-md-6 col-sm-12 col-sx-12">
                    <div class="box-info" style="background-color: #f28889;">
                        <div class="box-info" style="background-color: #f28889;">
                            <div class="b-icon">
                                <i class="fa fa-times-circle-o" aria-hidden="true"></i>                            
                            </div>
                            <div class="b-content">
                                <div class="txt-number" id="num-reject">
                                    <span data-counter="counterup" data-value="0">0</span>
                                </div>
                                <div class="txt-detail">
                                    <span>4M Change case rejected</span>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> 
            </div>
            <div class="panel-chart clearfix" style="width: 100%; background-color: #fffffb; padding:8px;">
                <div style="width: 100%; position: relative;display: flex;flex-wrap: wrap;">
                    <div style="height:450px;min-width:450px; width:50vw;padding:15px;border:2px solid #ebebeb; margin:0px 8px 8px 0px;">
                        <canvas id="chart-yearly" style="width: 100%;"></canvas>                        
                    </div>
                    <div style="height:450px;width:450px; padding:15px;border:2px solid #ebebeb; margin:0px 8px 8px 0px;">   
                        <canvas id="chart-caseType" style="width: 100%;"></canvas>                        
                    </div> 
                </div>
            </div>
            <div class="panel-chart clearfix" style="width: 100%; background-color: #fffffb; padding:8px;">
                <div style="width: 100%; position:relative;display:flex;flex-wrap:wrap;">
                    <div style="height:450px;min-width:450px;width:80vw;padding:15px;border:2px solid #ebebeb; margin:0px 5px 5px 0px;">
                        <canvas id="chart-monthly" style="width: 100%;"></canvas>
                    </div> 
                </div>
            </div>
        </div>
    </div><!-- /.row -->
</div><!-- /.page-content -->