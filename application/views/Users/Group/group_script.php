<script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.dataTables.bootstrap.min.js"></script> 

<script type="text/javascript" local-section="true">
    var roleTable = undefined;
    var validateCheck = ($t) => ( $($t).toArray().filter( f => $(f).val() == '' ) );
    var __headerGroup = [
        { title:"GROUP ID"},
        { title:"GROUP NAME"},
        { title:"DESCRIPTION"}, 
        { title:"STATUS"},
        { title:"ACTION"} 
    ]
    $(document).ready( function(){
        loaddingTableManage();
 

        $("[vali=true]").on("change", function(){
            let valInput = $(this).val();
            if(valInput){
                let findLabel = $(this).closest(".form-group").find("label")
                $(this).attr("style","");
                findLabel.find("small").remove(); 
            } 
        });
 
        $("#create--new").on("click",async function(){
            debugger;
            var checkValidate = validateCheck("[vali=true]");
            if( checkValidate[0] ){
                checkValidate?.forEach( e => {
                    let mess = $(e).attr("vali--message");
                    let findLabel = $(e).closest(".form-group").find("label")
                    $(e).css("border","1px solid red") 
                    findLabel.find("small").remove();
                    findLabel.html(`${findLabel.text()}<small class="text-danger vali">${mess}</small>`);
                });
            }else{
                debugger;
                let gupPermission = $("input[name=groupPermission]").val();
                let desPermistion = $("textarea[name=description]").val();
                let res = await $.post("<?= base_url() ?>users/settingRoleGroup", {ins: { roleGroupName: gupPermission, description:desPermistion }})
                                 .fail( e => { Toast.fire({ icon: 'error', title: 'error insert data!' }); console.log(e) });
                let inserted = JSON.parse(res);
                if( inserted[0] ){ 
                    roleTable.row.add( (setRowTable(inserted[0])) ).draw(false);
                    Toast.fire({ icon: 'success', title: 'User created!' });
                    $("[add--new]").val('');
                    $(".per-click-add").click();
                }  
            } 
        });
        $("#update--new").on("click",async function(){
            settingEdit(this, $(this).attr("id-ref"), "update");       
        });
    }); 

    function settingWaitActionTable($this, col, data, option){
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
        let permissionGroup =  await gettingDataPermissionGroup();
            //Toast.fire({ icon: 'success', title: 'login success na na!' })
        let ignoreSorting = __headerGroup.map( (m, i) => ( ["STATUS", "ACTION"].includes(m.title) ? i : -1) ).filter( f => f != -1 );
        let configTb = { columnDefs: [ {'targets': ignoreSorting, 'orderable': false, }], createdRow : actionRow }
        roleTable = settingWaitActionTable( "#roleList", __headerGroup, permissionGroup,  configTb ) 
    }
    async function gettingDataPermissionGroup(){
        //debugger;
        let perGroup = await $.get("<?= base_url() ?>users/gettingRoleGroup")
                              .fail( e => { Toast.fire({ icon: 'error', title: 'error insert data!' }); console.log(e) });  
        let setValue = JSON.parse(perGroup)?.map( m => { 
            return setRowTable(m)
        });
        return setValue;          
    }
    async function settingActive(e, id){
        debugger;
        let ckbox = $(e);
        //let id = ckbox.attr("roleGroupId");
        let res = await $.post("<?= base_url() ?>users/updatingRoleGroupActive", {id: id, active: ckbox[0].checked ? 1 : 0 })
                         .fail( e => { Toast.fire({ icon: 'error', title: 'error insert data!' }); console.log(e) });
    }
    async function settingDeleted(e, id){
        debugger;
        let btnAction = $(e);
        let rowAction = $(e).closest("tr");
        //let id = ckbox.attr("roleGroupId");
        let res = await $.post("<?= base_url() ?>users/updatingRoleGroupDeleted", {id: id})
                         .fail( e => { Toast.fire({ icon: 'error', title: 'error insert data!' }); console.log(e) });
        roleTable.row(rowAction).remove().draw(false);
    }
    async function settingEdit(e, id, action = "set"){
        debugger;
        switch(action){
            case "set" : 
                let btnAction = $(e);
                let rowAction = $(e).closest("tr");
                let rowData = roleTable.row(rowAction).data();       
                $("input[name=groupPermission]").val(rowData[1]);
                $("textarea[name=description]").val(rowData[2]);  
                
                
                // $("#create--new").addClass("dnone-btn");
                // $("#update--new").removeClass("dnone-btn");
                $("#create--new").hide();
                $("#update--new").show();
                $("#update--new").attr("id-ref", id);
                $(".per-click-add").click();
                break;
            case "update" :
                let gupPermission = $("input[name=groupPermission]").val();
                let desPermistion = $("textarea[name=description]").val();  
                let parameter = { groupName : gupPermission, description : desPermistion }
                //let id = ckbox.attr("roleGroupId");
                let res = await $.post("<?= base_url() ?>users/updatingRoleGroupData", {id: id, values : parameter })
                                .fail( e => { Toast.fire({ icon: 'error', title: 'error insert data!' }); console.log(e); throw e.response; });
                if(res){
                    roleTable.cell( $(`#roleList tbody tr[id=${id}]>td:nth-child(2)`) ).data(gupPermission).draw(false);
                    roleTable.cell( $(`#roleList tbody tr[id=${id}]>td:nth-child(3)`) ).data(desPermistion).draw(false);   
                    $("[add--new]").val('');
                    // $("#create--new").removeClass("dnone-btn");
                    // $("#update--new").addClass("dnone-btn");  
                    $("#create--new").show();
                    $("#update--new").hide();
                    $(".per-click-add").click();     
                    Toast.fire({ icon: 'success', title: 'update data done.' });          
                }

                break;

            default : break;
        }

    }    
    function setRowTable(m){
        return [
            m.roleGroupId.padStart(4, '0'),
            m.roleGroupName,
            m.description,
            `<div class='div--forgroup'>
                <label class="label--forgroup">
                    <input class="tgl tgl-skewed" onchange="settingActive(this, '${m.roleGroupId}')" id="cb${m.roleGroupId}" type="checkbox" check--table="true" ${(m.isActive == "1" ? "checked" : "")}/>
                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="cb${m.roleGroupId}"></label>
                </label>
            </div>`,
            `<div class='div--forgroup'>
                <a href="javascript:void(0)" onclick="settingEdit(this, '${m.roleGroupId}', 'set');" class="tblEditBtn"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                <a href="javascript:void(0)" onclick="settingDeleted(this, '${m.roleGroupId}');" class="tblDelBtn"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </div>`
        ]
    }
    function actionRow( row, data, dataIndex ) { 
        $( row ).attr('id', parseInt( data[0] ) ); 
    }
</script>
<script type="text/javascript" local-section="reeval">
    var buttonAdd = document.querySelector(".per-click-add");
 
    buttonAdd.onclick = function(){ 
        $(this).toggleClass("open-add");
        if( $(this).find("i").hasClass("fa-times-circle") ){
            $(this).html( `Click for add group <i class="fa fa-plus-circle" aria-hidden="true"></i>`);
            $("[add--new]").val('');
            // $("#create--new").removeClass("dnone-btn");
            // $("#update--new").addClass("dnone-btn");
            $("#create--new").show();
            $("#update--new").hide();
        }else{
            $(this).html(`<i class="fa fa-times-circle" aria-hidden="true"></i> Click for close panel`);
        }
        a = 3
        $(".panel-add .comp-add").toggleClass("comp-add-show");
        //console.log(parseInt(Math.random() * 100) + a);

        return false;
    }
</script>