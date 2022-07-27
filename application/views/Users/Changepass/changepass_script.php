

<script type="text/javascript" local-section="true">
    var validateCheck = ($t) => ( $($t).toArray().filter( f => $(f).val() == '' ) );
    $(document).ready(function(){
        //Toast.fire({ icon: 'success', title: 'login success na na!' })
    });
    $("[vali=true]").on("change", function(){
        let valInput = $(this).val();
        if(valInput){
            let findLabel = $(this).closest(".form-group").find("label");
            $(this).removeClass("vlidate--empty");
            findLabel.find("small").remove(); 
        } 
    });
    async function changeDetail(e){
        var checkValidate = validateCheck("[vali=true]");
        if( checkValidate[0] ){
            checkValidate?.forEach( e => {
                let mess = $(e).attr("vali--message");
                let findLabel = $(e).closest(".form-group").find("label")
                $(e).addClass("vlidate--empty");
                findLabel.find("small").remove();
                findLabel.html(`${findLabel.text()}<small class="text-danger vali">${mess}</small>`);
            });
        }else{
            let _old_passWord = $(`input[name=old-passWord]`);
            let _new_passWord = $(`input[name=new-passWord]`);
            let _ren_passWord = $(`input[name=new-repassWord]`);
            let _loginId = MemberInfo[0].userLoginId; 

            let _ckPass = JSON.parse((await $.post("<?= base_url() ?>users/checkPassWord", {us: _loginId, ps: _old_passWord.val()})));  
            if(_new_passWord.val() == _ren_passWord.val()){
                if(_ckPass[0]?.res){
                    let parm = {old_pass:_old_passWord.val(), new_pass:_new_passWord.val(), userId:_loginId};
                    let res = $.post("<?= base_url() ?>users/updatingNewPassword", {update:parm});
                    res.fail( e => {Toast.fire({ icon: 'error', title: 'Change password fail!' });});
                    Toast.fire({ icon: 'success', title: 'Change password done!' });    
                }else{
                    Toast.fire({ icon: 'error', title: 'wrong password!' });
                    let mess = "enter a wrong password on the sytem"
                    let findLabel = _old_passWord.closest(".form-group").find("label")
                    _old_passWord.addClass("vlidate--empty");
                    findLabel.find("small").remove();
                    findLabel.html(`${findLabel.text()}<small class="text-danger vali">${mess}</small>`);    
                }                
            }else{
                Toast.fire({ icon: 'error', title: 'password not match!' });
                let mess = "Confirm Password Field do not match"
                let _plabel = _new_passWord.closest("label.form-group").find("label");
                let _rlabel = _ren_passWord.closest("label.form-group").find("label");
                _plabel.find("small").remove();
                _rlabel.find("small").remove();

                _plabel.html(`${_plabel.text()}<small class="text-danger vali">${mess}</small>`);
                _rlabel.html(`${_rlabel.text()}<small class="text-danger vali">${mess}</small>`); 
                pas.addClass('vlidate--empty');
                rep.addClass('vlidate--empty');  
            }

            // let res = $.post("<?= base_url() ?>users/updatingUserLogin", {upd: _par, loginId: MemberInfo[0]?.userLoginId})
            // res.fail( e => { Toast.fire({ icon: 'error', title: 'Edit fail!' }); console.log(e) });
        
            // Toast.fire({ icon: 'success', title: 'Edit done!' });   
        } 
    }		
</script>