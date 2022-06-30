<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script> 

<script type="text/javascript" local-section="true">
    var roleTable = undefined;
    roleTable = $(document).ready(function(){
        //Toast.fire({ icon: 'success', title: 'login success na na!' })
        $("#roleList").DataTable({
            dom: '<"top"lf><"tbox"t><"bottom"ip><"clear">',
            destroy:true,
            initComplete:tableLoad
        }); 
    }); 


    function tableLoad(settings, json){
         $(".top select").attr('data-width','50px').selectpicker();   
    }
</script>
<script type="text/javascript" local-section="reeval">
    var buttonAdd = document.querySelector(".per-click-add");

    buttonAdd.onclick = function(){ 
        $(this).toggleClass("open-add");
        if( $(this).find("i").hasClass("fa-times-circle") ){
            $(this).html( `Click for add group <i class="fa fa-plus-circle" aria-hidden="true"></i>`);
        }else{
            $(this).html(`<i class="fa fa-times-circle" aria-hidden="true"></i> Click for close panel`);
        }
        a = 3
        $(".panel-add .comp-add").toggleClass("comp-add-show");
        //console.log(parseInt(Math.random() * 100) + a);

        return false;
    }
</script>