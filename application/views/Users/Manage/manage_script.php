<script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/libs/md5.js"></script>
 

<script type="text/javascript" local-section="true">
    var manageTable = undefined;
    var userStoresList = []; 
    var validateCheck = ($t) => ( $($t).toArray().filter( f => $(f).val() == '' ) );
    var __headerGroup = [
        { title:"User Id"},
        { title:"User Name"},
        { title:"User Group"},
        { title:"User Permission"}, 
        { title:"Status"},
        { title:"Action"} 
    ]
    $(document).ready( function(){
        loaddingTableManage();
        pageLoad()
        genDerButton("input[name=userGender]");

        $("[vali=true]").on("change", function(){
            let valInput = $(this).val();
            if(valInput){
                let findLabel = $(this).closest(".form-group").find("label")
                $(this).removeClass('vlidate--empty');
                findLabel.find("small").remove(); 
            } 
            if($(this)[0]?.tagName == "SELECT"){

            }
        });
 
        $("#update--new").on("click",async function(){
            debugger;
            var checkValidate = validateCheck("[vali=true]");
            let pas = $("input[name=userLoginPass]");
            let rep = $("input[name=u-repassWord]"); 
            if( checkValidate[0] || pas.val() != rep.val() ){
                checkValidate?.forEach( e => {
                    let mess = $(e).attr("vali--message");
                    let findLabel = $(e).closest(".form-group").find("label")
                    $(e).addClass('vlidate--empty');
                    findLabel.find("small").remove();
                    findLabel.html(`${findLabel.text()}<small class="text-danger vali">${mess}</small>`);
                });
                if(pas.val() != rep.val()){
                    let mess = "Password field do not match"; 
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
                settingEdit(this, $(this).attr("id-ref"), "update"); 
            } 
        });
        $('#modal--box').on('hidden.bs.modal', function (e) {
            let findLabel = $("[vali=true]").closest(".form-group").find("label");
            $("[vali=true]").removeClass('vlidate--empty');;
            findLabel.find("small").remove(); 

            let pas = $("input[name=userLoginPass]");
            let rep = $("input[name=u-repassWord]");             
            pas.val('');
            rep.val('')
            let _plabel = pas.closest("label.form-group").find("label");
            let _rlabel = rep.closest("label.form-group").find("label");
            _plabel.find("small").remove();
            _rlabel.find("small").remove(); 
  
            pas.removeClass('vlidate--empty');
            rep.removeClass('vlidate--empty');
        }) 
    }); 
    async function pageLoad(){
        $(".selectpicker").selectpicker();
        let _per = (await gettingDataPermission())?.map( m => ({ id:m.roleId, text:m.roleName }));
        let _gup = (await gettingDataPermissionGroup())?.map( m => ({ id:m.roleGroupId, text:m.roleGroupName }));       
        setSelectPickers(_gup, $("select[name=roleGroupId]"));
        setSelectPickers(_per, $("select[name=roleId]"));
        
    }
    function settingManageTable($this, col, data, option){
        return $($this).DataTable(Object.assign({
            columns : col, 
            data:data,
            dom: '<"top"<"head--left"lB><"head--right"f>><"tbox customscroll"t><"bottom"ip><"clear">',
            destroy:true,
            initComplete:tableLoad
        },option));
    }
    function tableLoad(settings, json){
        $(".top select").attr('data-width','50px').selectpicker();
    }
    async function loaddingTableManage(){
        userStoresList = await gettingDataUserList();
        let setValue = userStoresList?.map( m => { return setRowTable(m) });
        //Toast.fire({ icon: 'success', title: 'login success na na!' })
        let ignoreSorting = __headerGroup.map( (m, i) => ( ["Action"].includes(m.title) ? i : -1) ).filter( f => f != -1 );
        let configTb = { columnDefs: [ {'targets': ignoreSorting, 'orderable': false, }], createdRow : actionRow }
        manageTable = settingManageTable( "#tb--manage", __headerGroup, setValue,  configTb ) 
    }
    async function gettingDataUserList(){
        //debugger;
        let per = await $.get("<?= base_url() ?>users/gettingMemberList")
                  .fail( e => { Toast.fire({ icon: 'error', title: 'error insert data!' }); console.log(e) });   
        return JSON.parse(per);          
    }

    async function settingActive(e, id){
        debugger;
        let ckbox = $(e);
        if( id == MemberInfo[0]?.userLoginId ){
            Toast.fire({ icon: 'warning', title: 'You cannot disable yourself.' });  
            ckbox.prop("checked", !ckbox[0].checked);
        }else{
            let res = await $.post("<?= base_url() ?>users/updatingUserActive", {loginId: id, active: ckbox[0].checked ? 1 : 0 })
                            .fail( e => { Toast.fire({ icon: 'error', title: 'error insert data!' }); console.log(e) });
            if(res){
                userStoresList.filter( f => { f.isActive = (f.userLoginId == id) ? ckbox[0].checked ? "1" : "0" : f.isActive } );    
            }            
        }

    }
 
    async function settingEdit(e, id, action = "set"){
        debugger; 
        switch(action){
            case "set" : 
                let btnAction = $(e);
                let rowAction = $(e).closest("tr"); 
                let rowData = ( userStoresList?.filter( f => f.userLoginId == rowAction.attr("id-ref") ) )[0];
                let strGender = rowData.userGender == 1 ? "male" : "female";
                document.querySelector("input[name=userLoginName]").value = rowData.userLoginName;
                document.querySelector("input[name=firstName]").value = rowData.firstName;
                document.querySelector("input[name=lastName]").value = rowData.lastName;
                document.querySelector("input[name=email]").value = rowData.email;

                $(`input[name=userGender][gen-flag=${rowData.userGender}]`).click();
                $("select[name=roleGroupId]").val(rowData.roleGroupId).selectpicker('render');
                $("select[name=roleId]").val(rowData.roleId).selectpicker('render');
                $("select[name=action]").val(rowData.userActionId).selectpicker('render');

                $("#update--new").attr("id-ref", id);
                console.log(rowData)
                $("#modal--box").modal("show");
                break;
            case "update" :
                let _actionId  = $("select[name=action]").val();
                let _actionImg = $("select[name=action]>option:selected").attr("img-value");
                let _gender = $("input[type=button][name=userGender].btn-selected");
                let _pas = $("input[name=userLoginPass]");
                let _par = {};
                $("[add--new]").toArray().map(m => _par[$(m).attr("name")] = $(m).val());
                _par = Object.assign(_par, {
                    fullName:`${_par.firstName} ${_par.lastName}`, 
                    userGender : _gender.attr("gen-flag"), 
                    userImg : `${_gender.val()}_${_actionImg}`,
                    userActionId:_actionId
                });
                _par = _pas.val() != "" ? Object.assign(_par, {userLoginPass:CryptoJS.MD5(_pas.val()).toString()}) : _par;
                console.log(_par);
               
                let res = await $.post("<?= base_url() ?>users/updatingUserLogin", {upd: _par, loginId: id})
                          .fail( e => { Toast.fire({ icon: 'error', title: 'error insert data!' }); console.log(e) });
                _par = Object.assign(_par, {
                    roleName: $("select[name=roleId]>option:selected").text(), 
                    roleGroupName: $("select[name=roleGroupId]>option:selected").text() 
                });
                           
                let _a = userStoresList?.filter( f => { return f = Object.assign(f, f.userLoginId == id ? _par : {})} );
                console.log(userStoresList);
                if( JSON.parse(res.toLowerCase()) ){
                    let new_data = userStoresList?.filter( f => f.userLoginId == id );
                    let row_update = $(`#tb--manage tbody tr[id-ref=${id}]`);
                    manageTable.row(row_update).data(setRowTable(new_data[0])).draw(false);
                    Toast.fire({ icon: 'success', title: 'Update data success!' });
                    $("#modal--box").modal("hide");
                }
                $("#update--new").removeAttr("id-ref");
                break;

            default : break;
        } 
    } 

    function setRowTable(m){
        return [
            m.userLoginName,
            m.fullName,
            m.roleGroupName,
            m.roleName,
            `<div class='div--forgroup'>
                <label class="label--forgroup">
                    <input class="tgl tgl-skewed" onchange="settingActive(this, '${m.userLoginId}')" id="cb${m.userLoginId}" type="checkbox" check--table="true" ${(m.isActive == "1" ? "checked" : "")}/>
                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="cb${m.userLoginId}"></label>
                </label>
            </div>`,
            `<div class='div--forgroup'>
                <a href="javascript:void(0)" onclick="settingEdit(this, '${m.userLoginId}', 'set');" class="tblEditBtn"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>

            </div>`
        ]                
        // <a href="javascript:void(0)" onclick="settingDeleted(this, '${m.roleId}');" class="tblDelBtn"><i class="fa fa-trash" aria-hidden="true"></i></a>
    }

    function actionRow( row, data, dataIndex ) { 
        $( row ).attr('id-ref', parseInt( userStoresList[dataIndex]?.userLoginId ) ); 
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
<script type="text/javascript" local-section="reeval">
 
</script>