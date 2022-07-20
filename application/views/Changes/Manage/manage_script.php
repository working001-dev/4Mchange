<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script> 
<script type="text/javascript" local-section="true">
    var _actionHeader = [
        { title:"4M Number"},
        { title:"Detail"},
        { title:"Request By"},
        { title:"Request Date"},
        { title:"Action"}        
    ];
    var waitActionTable = undefined
    $(document).ready(function(){
        waitActionTable = settingWaitActionTable("#tb-wait--action", _actionHeader, [])
        //Toast.fire({ icon: 'success', title: 'login success na na!' })
    });		

    function settingWaitActionTable($this, col, data, option){
        return $($this).DataTable(Object.assign({
            columns : col, 
            data:data,
            dom: '<"top"lf><"tbox customscroll"t><"bottom"ip><"clear">',
            destroy:true,
            initComplete:tableLoad
        },option));
    }
    function tableLoad(settings, json){
         $(".top select").attr('data-width','50px').selectpicker();   
    }
</script>