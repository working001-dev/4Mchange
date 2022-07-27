<link rel="stylesheet" href="<?= base_url() ?>assets/css/project/users-site.css" />
<style>
    #tb--manage{
        width: 100%;
        border-top: none;
    }
    #tb--manage thead>tr{
        position: sticky;
        top: 0;
        z-index: 2;
        background-color: white;
    }
    #tb--manage thead tr th{
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
    #tb--manage thead>tr th{
        min-width: 120px;
        /* max-width: 70px !important;  */
    }
    #tb--manage thead>tr :nth-child(5),#tb--manage thead>tr :nth-child(6){
        text-align: center;
    }
    #tb--manage thead>tr :nth-child(1),#tb--manage thead>tr :nth-child(5){
        min-width: 120px;
        max-width: 120px;
    }
    .tbox{
        overflow: auto;
        max-height: 42vh;  
        max-width: 100%;  
        padding: 0px 8px 10px;    
    }
    .modal-footer{
        display: flex;
        justify-content: flex-end;
    }
    .modal-footer button{
        min-width: 120px;
    }
</style>