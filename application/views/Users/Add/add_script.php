<!-- <script src="<?= base_url() ?>assets/js/project/users-site.js"></script> -->

<script type="text/javascript" local-section="true">
    $(document).ready(function(){
        //Toast.fire({ icon: 'success', title: 'login success na na!' })
    });	
    
    $(document).on("click", "input[name=u-gender]", function(){
        $("input[name=u-gender]").removeClass("btn-selected");//.removeClass("btn-primary");
        let btnGender = $(this);
        btnGender.addClass("btn-selected");//.addClass("btn-primary");
        $("input[name=u-gender]+i").removeClass("fa-venus-mars"); 
        if( btnGender.attr("gen-flag") == "1" ){
            $("input[name=u-gender]+i").removeClass("fa-venus").addClass("fa-mars");
        }else{
            $("input[name=u-gender]+i").removeClass("fa-mars").addClass("fa-venus");
        }
    });
</script>