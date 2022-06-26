
<script src="<?= base_url() ?>assets/js/project/users-site.js"></script>

<script type="text/javascript" local-section="true">
    $(document).ready(function(){
        //Toast.fire({ icon: 'success', title: 'login success na na!' })
        let btnGender = document.querySelectorAll("input[name=u-gender]");
        btnGender.forEach( f => {
            f.onclick = function(){
                $("input[name=u-gender]").removeClass("btn-selected").removeClass("btn-unselected");//.removeClass("btn-primary");
                let btnGender = $(this);
                btnGender.addClass("btn-selected");//.addClass("btn-primary");
                $("input[name=u-gender]+i").removeClass("fa-venus-mars"); 
                console.log(btnGender.attr("gen-flag"));
                if( btnGender.attr("gen-flag") == "1" ){
                    $("input[name=u-gender]+i").removeClass("fa-venus").addClass("fa-mars");
                    $("input[name=u-gender][gen-flag=2]").addClass("btn-unselected");
                }else if( btnGender.attr("gen-flag") == "2" ) {
                    $("input[name=u-gender]+i").removeClass("fa-mars").addClass("fa-venus");
                    $("input[name=u-gender][gen-flag=1]").addClass("btn-unselected");
                }
            }
        });
    });	

    // $(document).on("click", "input[name=u-gender]", function(){
    //     $("input[name=u-gender]").removeClass("btn-selected").removeClass("btn-unselected");//.removeClass("btn-primary");
    //     let btnGender = $(this);
    //     btnGender.addClass("btn-selected");//.addClass("btn-primary");
    //     $("input[name=u-gender]+i").removeClass("fa-venus-mars"); 
    //     console.log(btnGender.attr("gen-flag"));
    //     if( btnGender.attr("gen-flag") == "1" ){
    //         $("input[name=u-gender]+i").removeClass("fa-venus").addClass("fa-mars");
    //         $("input[name=u-gender][gen-flag=2]").addClass("btn-unselected");
    //     }else{
    //         $("input[name=u-gender]+i").removeClass("fa-mars").addClass("fa-venus");
    //         $("input[name=u-gender][gen-flag=1]").addClass("btn-unselected");
    //     }
    // });
</script>