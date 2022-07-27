<script src="<?= base_url() ?>assets/js/tree.min.js"></script>


<script type="text/javascript" local-section="true">
    var roleData = undefined;
    var groupMenuData = undefined;
    var groupData = undefined;
    $(document).ready(function(){ 
        pageLoad();



        console.log("ready done.")

    });		
    async function pageLoad(){
        roleData = await gettingDataPermission(); 
        settingRoleList(roleData);
        $("#listRole a[in--action]").on('click', async function (event) {
            // debugger;
            event.preventDefault();
            $(this).closest(".list-group").find(".list-group-item").removeClass("active");
            $(this).addClass("active");
            $("#treeMenu").attr("roleId", $(this).attr("roleId") ).empty();
            $("#treeMenu").closest(".widget-body-inside").toggleClass("running");
            await loadGroupMenu($(this).attr("roleId"));
            setTimeout( ()=> { $("#treeMenu").closest(".widget-body-inside").toggleClass("running") }, 1000 );
        });

        console.log("load done.");
    }
    async function loadGroupMenu(roldId){
        let roleMenu = undefined;
        if( !groupMenuData ){
            groupMenuData = await gettingDataMenu(0);
            groupData = [...new Map(groupMenuData.map(m => [m["groupMenuId"], ({groupMenuId:m.groupMenuId, groupMenuName:m.groupMenuName, icon:m.icon}) ])).values()];
            menuData = [...new Map(groupMenuData.map(m => [m["menuId"], ({groupMenuId:m.groupMenuId, menuName:m.menuName, menuId:m.menuId, isPer:m.isPer}) ])).values()];            
            settingGroupMenuList(groupData);
            roleMenu = await gettingDataMenu(roldId);
            runningChecked(roleMenu);
            checkSelectMenu(groupData);
        }else {
            settingGroupMenuList(groupData);
            roleMenu = await gettingDataMenu(roldId);
            runningChecked(roleMenu);
            checkSelectMenu(groupData);
        }
        //console.log(roleMenu);
    }
    async function settingRoleMenu(par){
        let per = await $.post("<?= base_url() ?>users/settingRoleMenu", {ins:par}).fail( e => { Toast.fire({ icon: 'error', title: 'error insert data!' }); console.log(e) });  
               
    }
    async function deletingRoleMenu(par){
        let per = await $.post("<?= base_url() ?>users/deletingRoleMenu", {ins:par}).fail( e => { Toast.fire({ icon: 'error', title: 'error insert data!' }); console.log(e) });  
             
    }
    async function gettingDataPermission(){
        //debugger;
        let per = await $.get("<?= base_url() ?>users/gettingRole", {ign:0}).fail( e => { Toast.fire({ icon: 'error', title: 'error getting data!' }); console.log(e) });  
        return JSON.parse(per);          
    }
    async function gettingDataMenu(id){
        //debugger;
        let rst = await $.get("<?= base_url() ?>users/gettingMenu?roleId=" + id).fail( e => { Toast.fire({ icon: 'error', title: 'error getting data!' }); console.log(e) });  
        return JSON.parse(rst);          
    }

    function settingRoleList(roleData){ 
        for( let l of roleData ){
            let lName = l.roleName;
            let lId = l.roleId
            let thisRole = MemberInfo[0]?.roleId;
            //$("#listRole").append(`<li roleId="${lId}">${lName}</li>`); ${lId == thisRole ? "no--action" : "in--action"} ${l.isActive == 0 ? "no--action" : "in--action"
            if(l.isActive != 0 ) $("#listRole").append(`<a class="list-group-item" roleId="${lId}" href="#" in--action }>${lName}</a>`);  
        }
    }
    function settingGroupMenuList(groupData){
        for( let g of groupData ){
            let gName = g.groupMenuName?.toUpperCase();
            let gId = g.groupMenuId; 
            
            //$("#listRole").append(`<li roleId="${lId}">${lName}</li>`);
            $("#treeMenu").append(`
                <li class="list-group-items menu--close" gm="${gId}">
                    <a class="" gm="${gId}" href="#" menu--select>
                        <i class="icon-item ace-icon ${g.icon} mr-2"></i>
                        ${gName}  
                        <span class="item-total">(0/0)</span>
                    </a> 
                </li>
            `);
            settingMenuList(gId, menuData);  
            $("#treeMenu a[menu--select]").on('click', function (event) {
                // debugger;
                event.preventDefault();
                $(this).closest(".list-group-items").toggleClass("menu--close"); 
            });
            $('#treeMenu input[mId]').on('click', async function () {
                // debugger; 
                let chk = $(this);
                let roleId = $("#treeMenu").attr("roleId");
                let roleMenuId = chk.attr("rId");
                let menuId = chk.attr("mId");
                let groupId = chk.closest(".list-group-items").attr("gm");
                let setPar = { roleId:roleId, groupMenuId:groupId, menuId:menuId, roleMenuId:roleMenuId };
                if( chk[0].checked ){
                    settingRoleMenu(setPar);
                }else  deletingRoleMenu(setPar); 
                checkSelectMenu(groupData);
            });
        }
    }
    function settingMenuList(groupId, menuData){
        let _menu = menuData.filter( f => f.groupMenuId == groupId );
        let _t = _menu.length;
        let _p = 0;
        $(`li[gm=${groupId}]`).append("<ul class='group-list--inside'></ul>");
        for( let m of _menu ){
            $(`li[gm=${groupId}]>ul`).append(`
            <li class="list-group-item--inside" menu="${m.menuId}">
                <label>
                    <input type="checkbox" rId="0" mId="${m.menuId}" id="menu--${m.menuId}" ${(m.isPer != 0)? "checked" : ""} />
                    <span class="tree-item-name">
                        <i class="icon-item ace-icon fa fa-times"></i>
                        <span class="tree-label">${m.menuName}</span>
                    </span> 
                </label>
            </li>`); 
            if(m.isPer != 0) _p++;
        }
        $(`li[gm=${groupId}]`).find(".item-total").text(`(${_p}/${_t})`);
        if(_p == _t ) $(`li[gm=${groupId}]`).removeClass("menu--close");
    }
    function runningChecked(roleMenu){
        roleMenu.forEach( f =>{ 
            if(f.isPer == 1){
                let inp = $(`#menu--${f.menuId}`);
                inp.prop("checked", "true");
                inp.attr("rId", f.roleMenuId);                
            } 
        });
    }
    function checkSelectMenu(groupData){
        groupData.forEach( f => {
        let _a = $(`li[gm=${f.groupMenuId}] input[mId]`);
        let _isChecked = _a.toArray().filter( s => $(s)[0].checked );
            if( _a.length == _isChecked.length ){
                _a.closest(".list-group-items").removeClass("menu--close");  
            } 
            $(`li[gm=${f.groupMenuId}]`).find(".item-total").text(`(${_isChecked.length}/${_a.length})`);
        });
    }
    function filterRole(f){
        let sea = $(f);
        let u = $("#listRole a").toArray();
        let _v = sea.val().toLowerCase() || "";
        console.log(_v);
        u.forEach( e => {
            if( $(e).text().toLowerCase().includes(_v) ){
                $(e).show(100);   
            }else $(e).hide(100); 
        }); 
    }
</script>