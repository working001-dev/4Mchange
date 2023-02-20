<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datepicker3.min.css" />
<style type="text/css">
    .tb-box{
        max-width: 80vw;
        margin: auto;
        overflow: auto;
        max-height: 60vh;
    }
    #tbReport thead th, #tbReport tbody td{
        border: none;
        white-space: nowrap;
    }
    #tbReport thead>tr:nth-child(1) th{
        text-align: center;
    }
    #tbReport thead>tr:nth-child(1) th{
        border: 1px solid #afafaf;
    }
    #tbReport thead>tr:nth-child(2) th{
        border: 1px solid #afafaf;
        padding: 8px 6px 8px 12px;
    }
    #tbReport thead{
        position: sticky;
        top: 0px;
        z-index: 2;
    }
    #tbReport thead tr{
        position: relative;
    }
    #tbReport thead>tr:nth-child(1) th::after,
    #tbReport thead>tr:nth-child(1) th::before,
    #tbReport thead>tr:nth-child(2) th::after,
    #tbReport thead>tr:nth-child(2) th::before {
        content: '';
        position: absolute;
        left: 0;
        width: 100%;
    }
    #tbReport thead>tr:nth-child(1) th::before {
        top: 0;
        border-top: 2px solid #afafaf;
        /* margin-top: -0.5px; */
    }  
    #tbReport thead>tr:nth-child(1) th::after {
        bottom: 0;
        border-bottom: 1px solid #afafaf; 
    } 

    #tbReport thead>tr:nth-child(2) th::before {
        top: 0;
        border-top: 1px solid #afafaf;
        /* margin-top: -0.5px; */
    }  
    #tbReport thead>tr:nth-child(2) th::after {
        bottom: 0;
        border-bottom: 1px solid #afafaf; 
    }


    #tbReport thead>tr:nth-child(2) th:nth-child(10),
    #tbReport thead>tr:nth-child(2) th:nth-child(11){
        text-align: center;
        padding: 8px 6px 8px 6px;
    } 
    #tbReport thead>tr:nth-child(1) th:nth-child(2),
    #tbReport thead>tr:nth-child(1) th:nth-child(3),
    #tbReport thead>tr:nth-child(2) th:nth-child(10), 
    #tbReport tbody>tr td:nth-child(10){
        background-color: #cdffcd;
    } 
    #tbReport thead>tr:nth-child(2) th:nth-child(11),
    #tbReport thead>tr:nth-child(2) th:nth-child(12),
    #tbReport thead>tr:nth-child(2) th:nth-child(13),
    #tbReport thead>tr:nth-child(2) th:nth-child(14),
    #tbReport tbody>tr td:nth-child(11),
    #tbReport tbody>tr td:nth-child(12),
    #tbReport tbody>tr td:nth-child(13),
    #tbReport tbody>tr td:nth-child(14){
        background-color: #ffd6d6;
    }        
    #tbReport thead>tr:nth-child(2) th:nth-child(10)>span,
    #tbReport thead>tr:nth-child(2) th:nth-child(11)>span{
        display: inline-block;
        writing-mode: vertical-lr;
        white-space: nowrap;
        transform: rotate(180deg); 
    } 
    #tbReport thead>tr:nth-child(2) th:nth-child(12),
    #tbReport thead>tr:nth-child(2) th:nth-child(13){
        min-width: 26px;
        max-width: 30px;
    }    
    #tbReport thead>tr:nth-child(2) th:nth-child(12),
    #tbReport thead>tr:nth-child(2) th:nth-child(13){
        min-width: 73px;
    }     
    #tbReport tbody tr:first td{
        border-top: none;
    }
    #tbReport tbody tr td:nth-child(8){
        text-align: center;
    }
    #tbReport th, #tbReport td{
        color: #393939;
    }
    #tbReport tbody tr td{
        border-left: 1px solid #afafaf;
        border-right: 1px solid #afafaf;
        border-top: 1px solid #afafaf;
    }
    #tbReport tbody tr:last-child td{
        border-bottom: 2px solid #afafaf;
    }

    .p-action{
        max-width: 80vw;
        margin: auto;
        padding-bottom: 8px;
        display: flex;
        justify-content: space-between;
    }
    .left-group, .right-group{
        display: flex;
    }
    #select-pd + button.dropdown-toggle.btn-primary, #select-pd + button.dropdown-toggle.btn-primary.focus, 
    .open>#select-pd + button.btn.dropdown-toggle.btn-primary:hover, #select-pd + button.dropdown-toggle.btn-primary:hover,
    #select-pd + button.dropdown-toggle.btn-primary:focus:active, #select-pd + button.dropdown-toggle.btn-primary:focus:hover
    {
        background-color: #428BCA !important;
        border-color: #428BCA !important;
        color: white !important;
    }
    /* .left-group *, .right-group *{
        margin-right:  8px;
    } */
</style>