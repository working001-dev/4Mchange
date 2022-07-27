<script src="<?= base_url() ?>assets/js/project/users-site.js"></script>
<script src="<?= base_url() ?>assets/libs/md5.js"></script>
<script type="text/javascript" local-section="true">
    var validateCheck = ($t) => ( $($t).toArray().filter( f => $(f).val() == '' ) );
    $(document).ready(function(){
        genDerButton("input[name=userGender]");
        pageLoad();


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
        $("#btn--adduser").on("click", async function(){
            //debugger;
            let checkValidate = validateCheck("[vali=true]");
            let genderClick = $("input[name=userGender]").toArray().filter( f => !$(f).hasClass("btn-selected") );
            let pas = $("input[name=userLoginPass]");
            let rep = $("input[name=u-repassWord]"); 
            
            if( checkValidate[0] || genderClick.length == 2 || pas.val() != rep.val() ){
                checkValidate?.forEach( d => {
                    let mess = $(d).attr("vali--message");
                    let findLabel = $(d).closest("label.form-group").find("label");
                    findLabel.find("small").remove();
                    findLabel.html(`${findLabel.text()}<small class="text-danger vali">${mess}</small>`);    
                    $(d).addClass("vlidate--empty");
                    if( $(d)[0].tagName == "SELECT" ){
                        if($(d).hasClass("selectpicker") ){
                            $(d).selectpicker('setStyle', 'vlidate--empty');
                        }else console.log("Faillllll");
                    }
                });
                if( genderClick.length == 2 ){
                    let gender = $("input[name=userGender][vali--message]");
                    let mess = gender.attr("vali--message");
                    let findLabel = gender.closest("label.form-group").find("label");
                    findLabel.find("small").remove();
                    findLabel.html(`${findLabel.text()}<small class="text-danger vali">${mess}</small>`); 
                    $("input[name=userGender]").addClass('vlidate--empty');
                }else if(pas.val() != rep.val()){
                    let mess = "Confirm Password Field do not match"; 
                    let _plabel = pas.closest("label.form-group").find("label");
                    let _rlabel = rep.closest("label.form-group").find("label");
                    _plabel.find("small").remove();
                    _rlabel.find("small").remove();

                    _plabel.html(`${_plabel.text()}<small class="text-danger vali">${mess}</small>`);
                    _rlabel.html(`${_rlabel.text()}<small class="text-danger vali">${mess}</small>`); 
                    pas.addClass('vlidate--empty');
                    rep.addClass('vlidate--empty');
                } 
            }else{ 
                
                let _action = $("select[name=action]").val();
                let _gender = $("input[type=button][name=userGender].btn-selected");
                let _par = {};
                $("[add--new]").toArray().map( m => _par[$(m).attr("name")] = $(m).val()  ) ;
                _par = Object.assign(_par, {
                    fullName:`${_par.firstName} ${_par.lastName}`, 
                    userGender : _gender.attr("gen-flag"), 
                    userImg : `${_gender.val()}_${_action}`,
                    userLoginPass: CryptoJS.MD5(_par.userLoginPass).toString()
                });
                console.log(_par);

                let res = await $.post("<?= base_url() ?>users/settingUserLogin", {ins: _par})
                          .fail( e => { Toast.fire({ icon: 'error', title: 'error insert data!' }); console.log(e) });
                debugger;
                let inserted = JSON.parse(res);
                if(!inserted[0]){
                    if( inserted == 1 ){  
                        Toast.fire({ icon: 'success', title: 'User created!' });
                        $("[add--new]").val(''); 
                        $("[vali=true]").val(''); 
                        $(".selectpicker").val('').selectpicker('render');
                        $("input[name=userGender]").removeClass("btn-selected").removeClass("btn-unselected"); 
                    }else Toast.fire({ icon: 'error', title: 'insert fail!' });                    
                }else Toast.fire({ icon: 'error', title: 'This user already exists !' }); 

            } 
        });
    });	
    async function pageLoad(){
        let _per = (await gettingDataPermission())?.map( m => ({ id:m.roleId, text:m.roleName }));
        let _gup = (await gettingDataPermissionGroup())?.map( m => ({ id:m.roleGroupId, text:m.roleGroupName }));       
        setSelectPickers(_gup, $("select[name=roleGroupId]"));
        setSelectPickers(_per, $("select[name=roleId]"));
        
    }

    async function setSelectPickers(_data, _elm){
        for( let _s of _data){
            let _d = _s?.id;
            let _t = _s?.text;
            $(_elm).append(`<option value="${_d}">${_t}</option>`);
        }
        $(_elm).selectpicker('refresh');
    }

    function genDerButton(btn){
        let btnGender = document.querySelectorAll(btn);
        btnGender.forEach( f => {
            f.onclick = function(){
                $("input[name=userGender]").removeClass("btn-selected").removeClass("btn-unselected");//.removeClass("btn-primary");
                let btnGender = $(this);
                if(btnGender.hasClass("vlidate--empty")){
                    let findLabel = btnGender.closest(".form-group").find("label");
                    findLabel.find("small").remove();               
                    $("input[name=userGender]").removeClass("vlidate--empty");                    
                }

                btnGender.addClass("btn-selected");//.addClass("btn-primary");
                $("input[name=userGender]+i").removeClass("fa-venus-mars");  

                if( btnGender.attr("gen-flag") == "1" ){
                    $("input[name=userGender]+i").removeClass("fa-venus").addClass("fa-mars");
                    $("input[name=userGender][gen-flag=2]").addClass("btn-unselected");
                }else if( btnGender.attr("gen-flag") == "2" ) {
                    $("input[name=userGender]+i").removeClass("fa-mars").addClass("fa-venus");
                    $("input[name=userGender][gen-flag=1]").addClass("btn-unselected");
                }
            }
        });        
    }

    async function gettingDataPermissionGroup(){ 
        let group = await $.get("<?= base_url() ?>users/gettingRoleGroup", {ign:1})
                              .fail( e => { Toast.fire({ icon: 'error', title: 'error getting data!' }); console.log(e) });  
        return JSON.parse(group);          
    }
    async function gettingDataPermission(){ 
        let per = await $.get("<?= base_url() ?>users/gettingRole", {ign:1})
                              .fail( e => { Toast.fire({ icon: 'error', title: 'error getting data!' }); console.log(e) });   
        return JSON.parse(per);          
    }
</script>