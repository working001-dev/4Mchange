<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>

 

<script type="text/javascript" local-section="true">
    $(document).ready(function(){
        //Toast.fire({ icon: 'success', title: 'login success na na!' })
        $("#roleList").DataTable({
            dom: '<"top"lf><"tbox"t><"bottom"ip><"clear">',
        });
    });		
    $(document).on("click", ".per-click-add", function(){ 
        $(this).toggleClass("open-add")
        $(".panel-add .comp-add").toggleClass("comp-add-show"); 
    })
</script>