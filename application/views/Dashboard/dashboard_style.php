<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/css/project/changes-site.css" /> --> 

 

<style type="text/css">
    .section-dash{
        display: grid;
        row-gap: 10px;
    }
    .panel-summary{ 
        width: 100%;
        position: relative;
        box-sizing: border-box; 
    }
    .panel-summary>.box-summary{
        height: 160px; 
        padding: 8px;
        box-sizing: border-box;
    }
    .box-info{
        height: 100%;
        position: relative;
    }
    .panel-chart{
        min-height: 340px;
        position: relative;
        box-sizing: border-box; 
    }
    .b-icon{
        position: absolute;
        right: 0;
        padding: 0px 15px 0px 0px;
        top: 0;
        bottom: 0;
        font-size: 92px;
        color: #fffffb52;
        opacity: 0.9;
    }
    .b-content{
        height: 100%;
        display: grid;
        grid-template-rows: auto 42px;
        z-index: 2;
        padding-left: 32px;
        /* padding-right: 100px; */
        /* vertical-align: middle; */
        letter-spacing: 1px;
    }
    .txt-number{
        font-size: 2.4vw;
        display: flex;
        align-items: flex-end;
        font-weight: 900;
        color: #fffffa;
        /* border-bottom: 1px solid #e4e7ec; */
        letter-spacing: 2.7px;        
    }
    .txt-number>span{
        border-bottom: 1px solid #e4e7ec;
    }
    .txt-detail{
        display: flex;
        align-items: center;
        font-size: 0.9vw;
        letter-spacing: 1px;
        color: #fffffa;
        font-weight: 600;        
    }
    .txt-number>span::after{
        content:'case.';
        font-size: 30%;
    }
 
</style>