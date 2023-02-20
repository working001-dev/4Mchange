<script src="<?=base_url()?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.dataTables.bootstrap.min.js"></script> 
<script src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script> 
<script src="<?= base_url() ?>assets/js/project/changes-site.js"></script>
<script type="text/javascript" local-section="true">
    var _actionHeader = [
        { title:"4M Number"},
        { title:"Detail"},
        { title:"Request By"},
        { title:"Request Date"},
        { title:"Last Action Date"}, 
        { title:"Status"},
        { title:"Action"}        
    ];
    var waitActionTable = undefined;
    var caseInfo = undefined;
    var caseAction = undefined;
    var dataInspection = [];
    var inpcIndex = 0;
    $(document).ready(function(){
        
        pageLoad();
        $('[data-rel=tooltip]').tooltip();
        //Toast.fire({ icon: 'success', title: 'login success na na!' })

        $('#modal--action').on('show.bs.modal', async function (e) {
            $(this).addClass("wait-loadding");   
            let _changeRef = $(this).attr("for-change");
            caseAction = caseInfo.filter( f=>f.changeDetailId == _changeRef );
            modalLoad(this, _changeRef);
        });
        
        $('#modal--action').on('hidden.bs.modal', function (e) {
            $(".progress-bar").css("width", "0%"); 
        });

        $(".btn--filter").on("click", function(){
            //debugger;
            $(this).toggleClass("fil--click");
            if($(this).hasClass("fil--click")){
                $(".panl--search").show("slide", { direction: "left" }, 40);
            }else{
                $(".panl--search").hide("slide", { direction: "left" }, 40)
            }
        });

        searchReset();
    });		
    async function pageLoad(){
        settingTableCase();
        let u = "<?= base_url() ?>changes/"; 
        let uSelect = `${u}getting_detail_master`;
        setting_search("select[name=sec-line]", uSelect,{placeholder :"choose line"},{t:"l"});
        setting_search("select[name=sec-pd]", uSelect,{placeholder :"choose production(pd)"},{t:"p"});
        setting_search("select[name=sec-fourm]", uSelect,{placeholder :"choose 4M Number"},{t:"f"});
        setting_search("select[name=sec-reqBy]", uSelect,{placeholder :"choose Actor"},{t:"r"});
        setting_search("select[name=sec-cuase]", uSelect,{placeholder :"choose Cuase"},{t:"c"}); 

        $('input[name=date-range-picker]').daterangepicker({
            "autoApply": true,
            "startDate": "08/02/2022",
            "endDate": "08/08/2022",
            "drops": "auto"
		});
        let _gup = await gettingDataMaster(uSelect, "g");
        let _per = await gettingDataMaster(uSelect, "s");
        setSelectPickers(_gup, $("select[name=sec-group]"));
        setSelectPickers(_per, $("select[name=sec-status]"));
        // setting_search("select[name=req-partnumber]", uSelect, {placeholder :"choose part number"});
        // setting_search("select[name=req-partname]", uSelect, {placeholder :"choose part name"});
        // setting_search("select[name=req-process]", uSelect, {placeholder :"choose process"});
        // setting_search("select[name=req-cuase]", uSelect, {  placeholder :"choose cuase"}, {t:cuaseType});
       // console.log(_c);
    }
    async function modalLoad(_m, changeId){ 
       
        let _appInfo = await settingStep(changeId);
        if( caseAction[0]?.statusId == 2 ){
            $(".btn--approve").hide();
            $(".btn--reject").hide();
            $(".btn--confirm").hide();
            $(".btn--inspcet").show();
        }else if( caseAction[0]?.statusId == 1 ){
            $(".btn--approve").show();
            $(".btn--reject").show();
            $(".btn--confirm").hide();
            $(".btn--inspcet").hide();
        }else if( caseAction[0]?.statusId == 14 ){
            $(".btn--approve").hide();
            $(".btn--reject").hide();
            $(".btn--confirm").show();
            $(".btn--inspcet").hide();
        }else{
            $(".btn--approve").hide();
            $(".btn--reject").hide();
            $(".btn--inspcet").hide(); 
            $(".btn--confirm").hide();           
        }
        $('.input-daterange').datepicker({autoclose:true, format: 'yyyy/mm/dd'});

        await ( () => new Promise( (r,j) => { $("#modal--action .progress-bar").css("width", "20%"); setTimeout( () => { r("done.") }, 80) } ) )();
        let _changeDetail = await settingChangeDetail(changeId);
        await ( () => new Promise( (r,j) => { $("#modal--action .progress-bar").css("width", "40%"); setTimeout( () => { r("done.") }, 80) } ) )();
        let _hisProcess = await settingApproveHistory(_appInfo);
        await ( () => new Promise( (r,j) => { $("#modal--action .progress-bar").css("width", "60%"); setTimeout( () => { r("done.") }, 80) } ) )();
        let _attachFile = await settingAttachFile(changeId);
        await ( () => new Promise( (r,j) => { $("#modal--action .progress-bar").css("width", "80%"); setTimeout( () => { r("done.") }, 80) } ) )();
        let _inspection = await settingInspcetion(changeId);
        let _quality = await settingQuality(changeId);
        await ( () => new Promise( (r,j) => { $("#modal--action .progress-bar").css("width", "100%"); setTimeout( () => { r("done.") },80) } ) )();
        $(".progress-status").text('getting done.');
        setTimeout( () => { $(_m).removeClass("wait-loadding"); }, 80);

        $(".attach--info", _m).on("click", function(){ 
            let _4mNumber = $("[sp-name=fourm_number]").text() || " - ";
            $("#modal--fileAttach").attr("for-change", changeId);
            $("#modal--fileAttach").find(".title--fileAttach").html(`<strong>File Attach for 4M Change number - ${_4mNumber}</strong>`);
            $("#modal--fileAttach").modal("show");
        });

        $(".review--inspect", _m).on("click", function(){ 
            inpcIndex = 0;
            let _4mNumber = $("[sp-name=fourm_number]").text() || " - ";
            $("#modal--Inspection").attr("for-change", changeId);
            $("#modal--Inspection").find(".title--Inspection").html(`<strong>Inspection for 4M Change number - ${_4mNumber}</strong>`);
            $("#modal--Inspection").modal("show");
        });  

        $(".review--quality", _m).on("click", function(){ 
            inpcIndex = 0;
            let _4mNumber = $("[sp-name=fourm_number]").text() || " - ";
            $("#modal--Quality").attr("for-change", changeId);
            $("#modal--Quality").find(".title--Quality").html(`<strong>Quality Inspection for 4M Change number - ${_4mNumber}</strong>`);
            $("#modal--Quality").modal("show");
        });         
    }
    async function settingTableCase(){ 
        let _c = await gettingCase();
        let ignoreSorting = _actionHeader.map( (m, i) => ( ["Action", "Status"].includes(m.title) ? i : -1) ).filter( f => f != -1 );
        let configTb = { 
            lengthMenu: [ [10,50, 100,-1], [10,50, 100,'All']],
            order: [[4, 'desc']],
            columnDefs: [ {'targets': ignoreSorting, 'orderable': false, }], 
            createdRow : actionRow 
        }
        waitActionTable = settingWaitActionTable("#tb-wait--action", _actionHeader, _c, configTb);
    }

    function settingStep(_c){ 
        return new Promise( async (_r,_j)=>{
            $("#modal--action .box--status").html('');
            let _approve = await gettingApproveInfo(_c);
            for( let _ap of _approve){

                let strStaus = `
                <div class="box--step ${getActionStep(_ap?.approveName)}">
                    <div class="step--title">
                        <i class="fa ${getIconForStatus(_ap?.approveName)}" aria-hidden="true"></i>
                        <span class="step--text">${_ap?.approveName}</span>
                    </div>
                    <div class="step--detail">
                        <span class="txt--01">${_ap?.action} ${_ap?.user ? `by ${_ap?.user}` : ""}</span>
                        <span class="txt--02"> 
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span>${_ap?.date || "-"}</span>
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <span>${_ap?.time || "-"}</span>
                        </span>
                    </div>
                </div>`;
                $("#modal--action .box--status").append(strStaus);

                setttinStampResult((_ap?.action == "Closed") ? "CN" : "NO")
            }
            setTimeout( ()=>{  
                $(".progress-status").text('getting 4m process approve')
                _r(_approve);
            }, 80)
        }); 
    }
    function settingChangeDetail(_c){ 
        return new Promise( async (_r,_j)=>{ 
            let _cahngeInfo = await gettingDetailInfo(_c);
            let isClosed = ["Rejected", "Approved"].includes(caseAction[0]?.statusName)
             if(_cahngeInfo[0]?.qualityJudgment && isClosed) setttinStampResult(_cahngeInfo[0]?.qualityJudgment);
            for( let _v of _cahngeInfo){
                for (const [key, value] of Object.entries(_v)) {
                    switch(key){
                        case "countAttachFile" :
                            if( value ){
                                let txtGroup = $(`[sp-name=${key}]`).closest(".txt--group"); 
                                $(`[sp-name=${key}]`).html(`<i class="ace-icon fa fa-bell icon-animated-bell text-danger"></i>`);
                                txtGroup.find("a").remove();
                                txtGroup.append(`<a href="#" class="text-success attach--info" >File attach ${value} files.</a>`)                                
                            }else $(`[sp-name=${key}]`).html(`-`);

                            break;
                        default :
                            $(`[sp-name=${key}]`).text( value || "-");
                            break;
                    } 
                }
            }
            setTimeout( ()=>{  
                $(".progress-status").text('getting 4m detail')
                _r(_cahngeInfo);
            }, 80)
        }); 
    }
    function settingApproveHistory(_c){ 
        return new Promise( async (_r,_j)=>{
            let _approve = _c;
            $("#modal--action #table--history tbody").html('');
            for( let _ap of _approve){
                let strStaus = `
                <tr>
                    <td>${_ap?.step || "-"}</td>
                    <td>${_ap?.approveName || "-"}</td>
                    <td>${_ap?.action || "-"}</td>
                    <td><pre>${_ap?.comment || "-"}</pre></td>
                    <td>${_ap?.approveDateTime || "-"}</td>
                    <td>${_ap?.user || "-"}</td>
                </tr>`;
                $("#modal--action #table--history tbody").prepend(strStaus);
            }
            setTimeout( ()=>{  
                $(".progress-status").text('getting 4m history approve')
                _r("done.");
            }, 80)
        }); 
    }

    function settingAttachFile(_c){ 
        return new Promise( async (_r,_j)=>{
            let _document =  await gettingDocumentInfo(_c);
            $("#modal--fileAttach .modal-fileAttach-body").html('');
            $("#modal--Quality .modal-Quality-body .attach--quality").html('');
            for( let _dc of _document){
                if( !(["SWP", "MSR", "MTH"].includes( _dc.txt )) ){
                    let strDoc = `
                    <div class="box--attach-file flex flex-row">
                        <span class="req-title-attach flex">${_dc.documentGroupName}</span> 
                        <a href="<?=base_url()?>${_dc.filePath}" target="<?=base_url()?>${_dc.filePath}">
                            <i class="fa fa-paperclip" aria-hidden="true"></i>
                            ${_dc.fileName}
                        </a>
                    </div> `;
                    $("#modal--fileAttach .modal-fileAttach-body").append(strDoc);                    
                }else if( "SWP" == _dc.txt ){
                    $("#insp--img").attr("src", `<?=base_url()?>${_dc.filePath}`);
                    $("a.view--image").attr("href", `<?=base_url()?>${_dc.filePath}`);
                    $("a.view--image").attr("target", `<?=base_url()?>${_dc.filePath}`);
                    // setImageInspect("insp--can", `<?=base_url()?>${_dc.filePath}`);
                }else{
                    let strDoc = `
                    <div class="box--attach-file flex flex-row">
                        <span class="req-title-attach flex">${_dc.documentGroupName}</span> 
                        <a href="<?=base_url()?>${_dc.filePath}" target="<?=base_url()?>${_dc.filePath}">
                            <i class="fa fa-paperclip" aria-hidden="true"></i>
                            ${_dc.fileName}
                        </a>
                    </div> `;
                    $("#modal--Quality .modal-Quality-body .attach--quality").append(strDoc);  
                }
            }
            setTimeout( ()=>{  
                $(".progress-status").text('getting 4m attach file')
                _r("done.");
            }, 80)
        }); 
    }    
    function settingInspcetion(_c){ 
        return new Promise( async (_r,_j)=>{
            let _inspection =  await gettingInspectionInfo(_c);
            $("#table--inspecction tbody").html('');
            for( let _ip of _inspection){ 
                let strInp = `
                <tr>
                    <td>${_ip?.inspectionLocation || "-"}</td>
                    <td>${_ip?.inspectionControl || "-"}</td>
                    <td><i class="fa ${_ip?.inspectionControlResult == 1 ? "fa-check-circle" : "fa-times-circle"}" aria-hidden="true"></i></td> 
                </tr>`;
                $("#modal--Inspection #table--inspecction tbody").append(strInp);  
            }
            setTimeout( ()=>{  
                $(".progress-status").text('getting 4m inspection')
                _r("done.");
            }, 80)
        }); 
    }
    function settingQuality(_c){ 
        return new Promise( async (_r,_j)=>{
            let _inspection =  await gettingQuality(_c);
            if(_inspection[0]){
                $("#modal--Quality #table--inspecction tbody").html('');
                for( let _ip of _inspection){ 
                    let strInp = `
                    <tr>
                        <td>${_ip?.inspectionLocation || "-"}</td>
                        <td>${_ip?.inspectionControl || "-"}</td>
                        <td><i class="fa ${_ip?.inspectionControlResult == 1 ? "fa-check-circle" : "fa-times-circle"}" aria-hidden="true"></i></td> 
                    </tr>`;
                    $("#modal--Quality #table--inspecction tbody").append(strInp);  
                }
                setTimeout( ()=>{ 
                    $("span[sp-name=qc-inspect]").closest(".txt--group").show(); 
                    $(".progress-status").text('getting 4m quality')
                    _r("done.");
                }, 80)                
            }else{
                 
                $("span[sp-name=qc-inspect]").closest(".txt--group").hide();
               _r("done.");  
            } 

        }); 
    }    
    function setttinStampResult(_c){
        if( _c == "OK"){
            $(".status--stamp img").attr("src", "<?=base_url()?>assets/images/results/ok_noback.png");
            $(".status--stamp").show();
        }else if( _c == "NG"){
            $(".status--stamp img").attr("src", "<?=base_url()?>assets/images/results/ng_noback.png");
            $(".status--stamp").show();
        }else if( _c == "CN"){
            $(".status--stamp img").attr("src", "<?=base_url()?>assets/images/results/cn_noback.png");
            $(".status--stamp").show();
        }else{
            $(".status--stamp").hide();
        }
    } 
    async function gettingCase(){
        caseInfo = await $.get("<?=base_url()?>/changes/getCase", 
        {
            roleGroupId:MemberInfo[0]?.roleGroupId, 
            userActionId:MemberInfo[0]?.userActionId,
            roleId:MemberInfo[0]?.roleId
        });
        let rowInfo = caseInfo.map( m => setRowTable(m));
        return rowInfo;
    }
    async function queryCase(con){
        caseInfo = await $.post("<?=base_url()?>/changes/getQueryCase", {where:con});
        let rowInfo = caseInfo.map( m => setRowTable(m));
        return rowInfo;
    }
    function setRowTable(m){
        return [
            m.fourm_number, 
            m.description,
            m.requestBy,
            m.requestDate,
            m.lastActionDate,
            `<span class="label ${getClassForStatus(m.statusId)} label-white middle">${m.statusName}</span>`,
            `<td>
				<div class="btn-group"> 
                    <button class="btn btn-xs btn-primary btn--action" onclick="clickShow(this)">
						<i class="ace-icon fa fa-search bigger-120"></i>
					</button>  
				</div> 
			</td>`
        ];
    }    
    function settingWaitActionTable($this, col, data, option){
        return $($this).DataTable(Object.assign({
            columns : col, 
            data:data,
            dom: '<"top"lf><"tbox customscroll"t><"bottom"ip><"clear">',
            destroy:true,
            initComplete:tableLoad
        },option));
    }
    function tableLoad(settings, json){
         $(".top select").attr('data-width','50px').selectpicker();   
    }
    function setImageInspect(can, link){
        var canvas = document.getElementById(can),
        context = canvas.getContext('2d'); 
        base_image = new Image();
        base_image.src = link;
        base_image.onload = function(){ context.drawImage(base_image, 0, 0); } 
    }
    function actionRow( row, data, dataIndex ) { 
        $( row ).attr('id-ref', parseInt( caseInfo[dataIndex]?.changeDetailId ) ); 
    }
    function clickShow(e){ 
        let _row = $(e).closest("tr");
        let _4mNumber = _row.find("td").eq(0).text();

        $("#modal--action").attr("for-change", _row.attr("id-ref"));
        $("#modal--action").find(".title--action").html(`<strong>Approval</strong> : 4M Change number - ${_4mNumber}`);
        $("#modal--action").modal("show");
    }; 
    function searchReset(){
        $("[seTwo]").each(function( index ) {
            $( this ).val(null).trigger("change");
        })
        $("[seBot]").each(function( index ) {
            $(this).selectpicker('val', 'all');
        });
        $('input[name=date-range-picker]').val('');
    }
    async function searchFourm(){
        let condi = []
        $("[sel-for]").each(function( index ) {
            let value = $( this ).val();
            let key = $( this ).attr("sel-for");
            if( value != null && value != "all"){
                condi.push( `d.${key} = '${value}'` );
            } 
        });
        let con = condi.join(" and ");
        let _c = await queryCase(con);
        let ignoreSorting = _actionHeader.map( (m, i) => ( ["Action", "Status"].includes(m.title) ? i : -1) ).filter( f => f != -1 );
        let configTb = { 
            lengthMenu: [ [10,50, 100,-1], [10,50, 100,'All']],
            order: [[3, 'desc']],
            columnDefs: [ {'targets': ignoreSorting, 'orderable': false, }], 
            createdRow : actionRow 
        }
        waitActionTable = settingWaitActionTable("#tb-wait--action", _actionHeader, _c, configTb);
        $(".btn--filter").click();
    }
    function getClassForStatus(s){
        switch(s){
            case "1": return 'label-warning'; break;
            case "2": return 'label-info'; break;
            case "3": return 'label-success'; break;
            case "4": return 'label-danger'; break;
            default: return 'label-purple'; break;
        }
    }
 
    async function gettingDataMaster(u, t){ 
        let res = await $.get(u, {q:"All", t:t})
                    .fail( e => { Toast.fire({ icon: 'error', title: 'error getting data!' }); console.log(e) });  
        return res;          
    }
 
    async function setSelectPickers(_data, _elm){
        for( let _s of _data){
            let _d = _s?.id;
            let _t = _s?.text;
            $(_elm).append(`<option value="${_d}">${_t}</option>`);
        }
        $(_elm).selectpicker('refresh');
    }
         
    async function gettingApproveInfo(changeDetailId){
        let _a = await $.get("<?=base_url()?>changes/getting_approve", {"changeDetailId":changeDetailId});
        return _a;
    }
    async function gettingDetailInfo(changeDetailId){
        let _c = await $.get("<?=base_url()?>changes/getting_change_detail", {"changeDetailId":changeDetailId});
        return _c;
    }
    async function gettingDocumentInfo(changeDetailId){
        let _c = await $.get("<?=base_url()?>changes/getting_document", {"changeDetailId":changeDetailId});
        return _c;
    }
    async function gettingInspectionInfo(changeDetailId){
        let _c = await $.get("<?=base_url()?>changes/getting_inspection", {"changeDetailId":changeDetailId});
        return _c;
    }
    async function gettingQuality(changeDetailId){
        let _c = await $.get("<?=base_url()?>changes/getting_qualityinspection", {"changeDetailId":changeDetailId});
        return _c;
    }    
 
</script>