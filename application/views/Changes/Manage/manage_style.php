<link rel="stylesheet" href="<?= base_url() ?>assets/css/project/changes-site.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/daterangepicker.min.css" />

<style>
    #tb-wait--action{
        width: 100%;
    }
    #tb-wait--action thead tr th,
    #tb-wait--action tbody tr td
    {
        white-space: nowrap !important;
        min-width: 100px !important;
    }
    #tb-wait--action thead tr>th:nth-child(2),
    #tb-wait--action tbody tr>td:nth-child(2)
    {
        min-width: 450px !important;
        max-width: 450px !important;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    } 
    #tb-wait--action tbody tr:nth-child(even){
        background-color: #eff2fb;
    }
    .tbox{
        max-width: 100%;
        max-height: 40vh;
        overflow: auto;
        padding: 0px 2px;
    }
    #tb-wait--action .btn-xs{
        padding: 0px;
        width: 26px;
        height: 18px;
    }
    #tb-wait--action .btn-xs>.ace-icon {
        margin-right: 0px;
        width: 16px;
        height: 16px;
    }
    #tb-wait--action .btn-group{
        display: flex;
        flex-wrap: nowrap;
    }

    #modal--action{ 
        background-color: #7986a3; 
    }
    #modal--action .modal-dialog{
        width:100%;
        margin: 0px;
    }
    #modal--action .modal-content {
        padding: 4px 2vw;
        background: #00000005;
        border: none;
    }
    #modal--action .modal-action-header{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    #modal--action .modal-box{
        background: aliceblue;
    }
    #modal--action .title--action{
        display: block;
        width: 100%;        
    }
    #modal--action .box--action{
        display: flex;
        justify-content: flex-end;
        padding: 4px 8px;
        border-bottom: 1px solid #dee8f1;
    }
    #modal--action .box--action .btn{
        min-width: 70px;
        height: 26px;
        border: 2px solid;
        font-size: 10px;
        padding: 4px 4px 4px 4px;
        margin-left: 5px;
    }
    #modal--action .box--action .btn--approve{
        border-color: #6d89ef;
        color: #6d89ef !important;
    }
    #modal--action .box--action .btn--reject{
        border-color: #df7474;
        color: #df7474 !important;
    }
    #modal--action .box--action .btn i{
        margin-right: 8px;
    }
    #modal--action .box--status{
        display: flex;
        padding: 15px 20px 8px;
        overflow: auto;
        max-width: 100%;
        border-bottom: 1px solid #dee8f1;
    }
    #modal--action .box--status .box--step{
        display: flex;
        flex-direction: column;
    }
    #modal--action .box--status .box--step .step--detail{
        display: flex;
        flex-direction: column;
        padding: 15px;
        box-sizing: border-box;
    }
    .step--detail i{
        margin-right: 5px;
    }
    .step--detail span.txt--02 span{
        margin-right: 8px;
    }


    #modal--action .box--status .box--step .step--title{
        height: 40px;
        width: 246px;
        background-color: #63ef63;
        display: flex;
        padding: 8px 8px 8px 34px;
        font-size: 14px;
        align-items: center;
        position: relative;
    }
    #modal--action .box--status .box--step:first-child .step--title{ 
        border-top-left-radius: 34px;
        border-bottom-left-radius: 34px;
        padding-left: 8px;
    }
    #modal--action .box--status .box--step:last-child .step--title{ 
        border-top-right-radius: 34px;
        border-bottom-right-radius: 34px;
    }
    .step--title:after{
        content: '';
        display: block;
    }

    .step--title:before{
        content: '';
        display: block;
    }
    #modal--action .box--status .box--step:nth-child(n+2) .step--title:before{ 
        content: '';
        display: block;
        height: 40px;
        width: 30px;
        position: absolute;
        background-color: #fbfbfb;
        top: 0px;
        left: -15px;
        border-top: 20px solid aliceblue;
        border-bottom: 20px solid aliceblue;
        border-left: 14px solid #63ef63;
        border-right: 15px solid aliceblue;
    }
    #modal--action .box--status .box--step:nth-child(n+2) .step--title:after{ 
        content: '';
        display: block;
        height: 40px;
        width: 30px;
        position: absolute;
        background-color: #fbfbfb;
        top: 0px;
        left: 12px;
        border-top: 20px solid #63ef63;
        border-bottom: 20px solid #63ef63;
        border-left: 14px solid aliceblue;
        border-right: 14px solid #63ef63;
    }
    /* #ffb568 */
    #modal--action .box--status .box--step.no--action:last-child .step--title{
        background-color: #3f76f1;
    }
    #modal--action .box--status .box--step.no--action:nth-last-child(1) .step--title:after{  
        border-top: 20px solid #3f76f1;
        border-bottom: 20px solid #3f76f1;
        border-left: 14px solid aliceblue;
        border-right: 14px solid #3f76f1;
    } 
    #modal--action .box--status .box--step.ok--action .step--title{
        background-color: #1c0974;
    }    
    #modal--action .box--status .box--step.ok--action+.box--step .step--title:before{  
        border-top: 20px solid aliceblue;
        border-bottom: 20px solid aliceblue;
        border-left: 14px solid #1c0974;
        border-right: 14px solid aliceblue;
    } 
    #modal--action .box--status .box--step.ok--action .step--title:after{  
        border-top: 20px solid #1c0974;
        border-bottom: 20px solid #1c0974;
        border-left: 14px solid aliceblue;
        border-right: 14px solid #1c0974;
    }  
   
    #modal--action .box--status .box--step.ng--action .step--title:after{  
        border-top: 20px solid #ad3131;
        border-bottom: 20px solid #ad3131;
        border-left: 14px solid aliceblue;
        border-right: 14px solid #ad3131;
    }     
    #modal--action .box--status .box--step.ng--action .step--title{
        background-color: #ad3131;
    }
    #modal--action .box--status .box--step.ng--action+.box--step .step--title:before{  
        border-top: 20px solid aliceblue;
        border-bottom: 20px solid aliceblue;
        border-left: 14px solid #ad3131;
        border-right: 14px solid aliceblue;
    }    
    #modal--action .box--status .box--step.ng--action .step--title:after{  
        border-top: 20px solid #ad3131;
        border-bottom: 20px solid #ad3131;
        border-left: 14px solid aliceblue;
        border-right: 14px solid #ad3131;
    }

    #modal--action .box--status .box--step.fw--action .step--title:after{  
        border-top: 20px solid #ebab1b;
        border-bottom: 20px solid #ebab1b;
        border-left: 14px solid aliceblue;
        border-right: 14px solid #ebab1b;
    }     
    #modal--action .box--status .box--step.fw--action .step--title{
        background-color: #ebab1b;
    }
    #modal--action .box--status .box--step.fw--action+.box--step .step--title:before{  
        border-top: 20px solid aliceblue;
        border-bottom: 20px solid aliceblue;
        border-left: 14px solid #ebab1b;
        border-right: 14px solid aliceblue;
    }    
    #modal--action .box--status .box--step.fw--action .step--title:after{  
        border-top: 20px solid #ebab1b;
        border-bottom: 20px solid #ebab1b;
        border-left: 14px solid aliceblue;
        border-right: 14px solid #ebab1b;
    }                  
    .step--title i{
        font-size: 32px;
        margin-right: 14px;
        color: white;
        font-weight: bold;
        z-index: 2;
    }
    .step--title .step--text{
        font-size: 14px;
        color: white;
        font-weight: 500;
        letter-spacing: 1.2px;
    }

    .box--detail{
        display: flex;
        flex-wrap: wrap;
        padding: 15px 20px 8px;   
        width: 100%;    
        border-bottom: 1px solid #dee8f1;
    }
    .box--detail .txt--group span:first-child{
        display: inline-block;
        min-width: 130px;
    }
    .box--detail .txt--group{
        padding: 3px 15px;
        font-size: 10px;
    }
    .box--detail .txt--group i{
        margin-right: 8px;
    }    
    .box--detail .txt--group span:last-child{
        display: inline-block;
        min-width: 130px;
    }
    .box--detail .txt--group span:last-child{
        display: inline-block;
        min-width: 130px;
    }
    .box--detail pre {
        padding: 3px 4px;
        margin: 5px 0 5px;
        font-size: 10px;
        color: #727272;
        word-break: break-all;
        word-wrap: break-word;
        background-color: aliceblue;
        border: 1px solid #ccc;
        border-radius: 1px;
        min-width: 30vw;
        min-height: 10vh;
    }
    .txt--01, .txt--02{
        padding: 3px 0px;
    }
    .box--history{
        margin-top: 5px;
        display: flex;
        justify-content: flex-end;
        padding: 0px 8px 5px;
        border-bottom: 1px solid #dee8f1;
        max-width: 100%;
        overflow: auto;
        min-height: 28vh;
        max-height: 28vh;
    }
    #table--history{
        width: 100%;
    }
    #table--history thead{
        position: sticky;
        top: 0;         
    }
    #table--history thead tr{
        background-image: none;
        background-color: #e0edff;

        position: relative;
    }
    #table--history>tr th::after,
    #table--history>tr th::before{
        content: '';
        position: absolute;
        left: 0;
        width: 100%;
    }
    #table--history>tr th::before {
        top: 0;
        border-top: 2px solid #F1F1F1;
        /* margin-top: -0.5px; */
    }  
    #table--history>tr th::after {
        bottom: 0;
        border-bottom: 1px solid #F1F1F1; 
    } 

    #table--history tbody tr:nth-child(even){
        background-color: #eff2fb;
    }
    #table--history thead tr th,
    #table--history tbody tr td{
        padding: 5px 12px 5px;
        font-size: 11px;
        min-width: 100px;
        white-space: nowrap;
        
    }
    #table--history thead tr th{
        border-right: 1px solid #ddd;
    }
    #table--history thead tr th:last-child{
        border-right: none;
    }
    #table--history thead tr th:nth-child(4){
        min-width: 200px;
    }
    #table--history pre{
        background: #ff000000 !important;
        border: none !important;
        font-size: 11px !important;
        padding: 0px !important;
        font-family: 'Quicksand', 'Sarabun', sans-serif;
    }
    /* #tb-wait--action thead>tr th:nth-child(1),
    #tb-wait--action thead>tr th:nth-child(3),
    #tb-wait--action thead>tr th:nth-child(4),
    #tb-wait--action thead tr>th:nth-child(5){
        min-width: 80px !important;
        max-width: 80px !important; 
        
    }  */

    #modal--fileAttach, #modal--Inspection{
        max-height: 100%;
        overflow: auto;
    }
    #modal--fileAttach .modal-content,
    #modal--Inspection .modal-content,
    #modal--Quality .modal-content,
    #modal--ActionEvent .modal-content,
    #modal--ActionInspec .modal-content,
    #modal--Following .modal-content{
        background: #00000000;
    }
    #modal--fileAttach .modal-box,
    #modal--Inspection .modal-box,
    #modal--ActionEvent .modal-box,
    #modal--ActionInspec .modal-box,
    #modal--Quality .modal-box,
    #modal--Following .modal-box{
        background-color: #fff;
    }

    #modal--Inspection .modal-dialog,
    #modal--Quality .modal-dialog{
        margin-top: 2px;
    }
    #modal--Inspection .modal-content,
    #modal--Quality .modal-content,
    #modal--Following .modal-content{
        padding: 30px 10vw;
    }
    #modal--ActionEvent .modal-content,
    #modal--ActionInspec .modal-content{
        padding: 10px 10px; 
    }
    #modal--ActionInspec.action--inspec .modal-content{ 
        background: #252525;
    }
    #modal--ActionEvent.action--approve .modal-content{ 
        background: #b1e1b1;
    }
    #modal--ActionEvent.action--reject .modal-content{ 
        background: #e0838f;
    }    
    #modal--ActionEvent .modal-box{
        background: #ffffff;
    }
    #modal--ActionInspec{
        /* padding: 12px 30px !important; */
        padding: 6px 20px !important;
        
    }
    #modal--ActionInspec .modal-dialog.modal-lg{ 
        width: 100%;
        margin: 0px;
    }
    #modal--ActionEvent .modal-box{
        background: #ffffff;
    }    
    #modal--QualityConfirm{
        padding: 5px 10vw;
    }
    #modal--QualityConfirm .modal-box{
        background: #ffffff;
    }  
    #modal--QualityConfirm .modal-dialog.modal-lg{ 
        width: 100%;
        margin: 0px;
    }  
    .box--attach-file{
        align-items: center;
        margin-bottom: 8px;
    }
    
    .req-title-attach{
        padding: 5px;
        margin-right: 10px;
        background-image: linear-gradient(0deg, #98b5cf, #c7d6edd4, #98b5cf);
        border-radius: 4px;     
        border: 2px solid #b9b9b9d4;
        box-shadow: 1px 1px 0px 0px #cccccc87; 
        color: #242424;  
    }
    #table--inspecction{
        width: 100%;
    }
    #table--inspecction thead tr{
        background-image: none;
        background-color: #e0edff; 
    }
    #table--inspecction tbody tr:nth-child(even){
        background-color: #eff2fb;
    }
    #table--inspecction thead tr th,
    #table--inspecction tfoot tr th,
    #table--inspecction tbody tr td{
        padding: 5px 12px 5px;
        font-size: 11px;
        min-width: 80px;
        white-space: nowrap;
        vertical-align: middle;        
    }
    #table--inspecction thead tr th{
        border-right: 1px solid #ddd;
    }
    #table--inspecction thead tr th:last-child{
        border-right: none;
    }
    #table--inspecction thead tr th:nth-child(3){
        min-width: 100px !important;
        max-width: 100px !important;
        width: 100px;
    }    
    #table--inspecction tbody tr td:nth-child(3){
        text-align: center;
        font-size: 15px;
    }
    #table--inspecction tbody tr td:nth-child(3) .fa-times-circle{
        color: #df7474;
    }    
    #table--inspecction tbody tr td:nth-child(3) .fa-check-circle{
        color: #63ef63;
    } 
    #modal--ActionInspec table tbody tr td{
        vertical-align: middle;
    }
    .table>thead:first-child>tr:first-child>th {
        border-top: 0;
        white-space: nowrap;
    }    
    .modal-body {
        position: relative;
        padding: 5px 15px;
    }
    .head--waiting{
        display: block;
        padding: 2px 50px 2px 12px;
        font-size: 16px;
        background-color: #16394d;
        margin-bottom: 8px;
        color: white;
    }
    .group--btn-result{
        display: flex;
        justify-content: center;
        padding-top: 12px;
    }
    .btn-result{
        width: 36vh;
        height: 20vh;
        font-size: 90px;
        /* border-radius: 10vw; */
        border: 0px solid #fff;
        background-color: #dfd9d9;
        color: #a6a6a7;
        transition: all 0.2s linear;      
    }
    .btn-ok.clicked{
        background-color: #40e86a;
        box-shadow: inset 0px 0px 4px 1px #b5abab;
        color: white;
        border-top-left-radius: 5vh;
        border-bottom-left-radius: 5vh;
    }
    .btn-ng.clicked{
        background-color: #b73a3a;
        box-shadow: inset 0px 0px 4px 1px #b5abab;
        color: white;
        border-top-right-radius: 5vh;
        border-bottom-right-radius: 5vh;
    }
    .btn-result:focus:active {
        box-shadow: inset 0px 0px 4px 1px #b5abab;
    }
    .group--btn-result .spn-result{
        width: 30vw;
        text-align: center;
        font-size: 24px;
    }
    .inp-check .req-input{
        padding-left: 20px;
    }
    .inp-check label>input[type=checkbox], .inp-check label>input[type=radio]{
        display: none;
    }
    .inp-check label>span.tree-item-name>i {
        height: 20px;
        width: 20px;
        border: 2px solid #090909;
        border-radius: 2px;
        color: #030303;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }
    .inp-check label{
        cursor: pointer;
    }
    .inp-check label>span{
        display: flex;
        align-items: center;
    }
    .inp-check label>span.tree-item-name>i:before {
        content: "\f00d";
    }
    .inp-check label>input:checked + span.tree-item-name>i{
        color: #ffffff;  
        background-color:#090909;
    }
    .inp-check label>input:checked + span.tree-item-name>i:before{
        content: "\f00c"    
    }
    .status--stamp{
        display: flex;
        position: absolute;
        top: 150px;
        right: 0px;
        /* width: 100%; */
        justify-content: flex-end;
        transform: rotate(330deg);
    }
    .status--stamp img{
        width: 180px;
    }
    .title-inbox{
        width: 100%;
        padding: 1px;
        background: black;
        position: relative;    
    }
    .title-inbox>span{
        display: block;
        position: absolute;
        background: white;
        top: -12px;
        left: 0;
        font-size: 16px;
        font-weight: 600;
        padding-right: 12px;
    }
    @media (max-width: 1120px){
        .modal-row {
            flex-direction: column;
        } 
        .modal-row > div{
            width: 100% !important;
        }       
    }

</style>