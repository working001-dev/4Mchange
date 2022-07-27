 
<script type="text/javascript" local-section="true">
    var validateCheck = ($t) => ( $($t).toArray().filter( f => $(f).val() == '' ) );
    $(document).ready(function(){
        //Toast.fire({ icon: 'success', title: 'login success na na!' });
        // debugger;
        var userName = document.querySelector("input[name=userName]");
        var firstName = document.querySelector("input[name=firstName]");
        var lastName = document.querySelector("input[name=lastName]");
        var email = document.querySelector("input[name=email]"); 

        firstName.value = MemberInfo[0]?.firstName;
        lastName.value = MemberInfo[0]?.lastName;
        email.value = MemberInfo[0]?.email;
        document.querySelector(`input[type=radio][name=userGender][gen-flag='${MemberInfo[0]?.userGender}']`).click();
    });		
    $("[vali=true]").on("change", function(){
        let valInput = $(this).val();
        if(valInput){
            let findLabel = $(this).closest(".form-group").find("label");
            $(this).removeClass("vlidate--empty");
            findLabel.find("small").remove(); 
            if( $(this)[0].tagName == "SELECT" ){
                if($(this).hasClass("selectpicker") ){
                    $(this).selectpicker('setStyle', 'vlidate--empty', 'remove');
                }else console.log("Faillllll");
            }
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
            let _old_gender = $(`input[type=radio][name=userGender][gen-flag='${MemberInfo[0]?.userGender}']`).val();
            let _gender = $("input[type=radio][name=userGender]:checked");
            let _par = {};
            $("[add--new]").toArray().map( m => _par[$(m).attr("name")] = $(m).val()  ) ;
            _par = Object.assign(_par, {
                fullName:`${_par.firstName} ${_par.lastName}`, 
                userGender : _gender.attr("gen-flag"), 
                userImg : `${MemberInfo[0]?.userImg.replace(_old_gender, _gender.val())}`,
                updateDateTime: moment(new Date).format("YYYY-MM-DD HH:mm:ss"),
                updateBy:MemberInfo[0]?.userLoginId 
            }); 
            Object.assign(MemberInfo[0], _par); 
            setStorage("info", MemberInfo);  
            let res = $.post("<?= base_url() ?>users/updatingUserLogin", {upd: _par, loginId: MemberInfo[0]?.userLoginId})
            res.fail( e => { Toast.fire({ icon: 'error', title: 'Edit fail!' }); console.log(e) });
        
            Toast.fire({ icon: 'success', title: 'Edit done!' });   
        } 
    }
</script>