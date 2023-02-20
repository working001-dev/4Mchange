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
 
        //Toast.fire({ icon: 'success', title: 'login success na na!' })

        $('#modal--action').on('show.bs.modal', async function (e) {
            $(this).addClass("wait-loadding");   
            let _changeRef = $(this).attr("for-change");
            caseAction = caseInfo.filter( f=>f.changeDetailId == _changeRef );
            modalLoad(this, _changeRef);
        });
        
        $('#modal--action').on('hidden.bs.modal', function (e) {
            $(".progress-bar").css("width", "0%");
            $(".btn-result").removeClass("clicked");
            $("#modal--ActionInspec .modal-ActionInspec-footer .btn-submit").prop("disabled", true);
            $("input[attach-request]").val('').change();
            $("#modal--ActionInspec #reviewList tbody").html('')
            dataInspection = [];
            inpcIndex = 0; 
            $('.input-daterange input').val(moment(new Date()).format("YYYY/MM/DD")).prop("disabled", true);
            $('#modal--QualityConfirm textarea[name=req-condition-des]').val("").prop("disabled", true);
            $('#modal--QualityConfirm label input[type=radio]').prop("checked", false);
            $('#modal--QualityConfirm .block--group').addClass("blocked");
          
        });
        $('#modal--ActionEvent').on('hidden.bs.modal', function (e) {
            $("[name=req-description]", this).val("");
        });  

        $("input[attach-request]").on("change", function(){
            let __f = $(this)[0]?.files[0]?.name;
            if(__f){
                $("+span", this).text(__f);  
                $("+span", this).css({background: "#4f5c78",color: "white"});              
            }else{
                $("+span", this).text("กรุณาแนบไฟล์");  
                $("+span", this).css({background: "#fff",color: "black"}); 
            } 
        }); 

        $("input[ckUsed]").on("change", function(){
            let isCheck = $("input[name=inp-follow]:checked")?.val() && $("input[name=inp-follow-juds]:checked")?.val();
            if( $("input[name=inp-follow-juds]:checked")?.val() == "2"){
                isCheck = isCheck && $("input[name=inp-error-action]:checked")?.val();
                let chkOTH = $("input[name=inp-error-action]:checked").toArray()?.filter( f => $(f).val() == 4)[0];
                if(chkOTH){
                    $('.container-row .block--group textarea[name=inp-error-oth]').prop("disabled", false); 
                }else{
                    $('.container-row .block--group textarea[name=inp-error-oth]').prop("disabled", true); 
                }
                $(".modal-Following-footer button.actioned").prop("disabled", !isCheck);
            }else{
                $(".modal-Following-footer button.actioned").prop("disabled", !isCheck);                
            }

        });

        $("button.btn-attach").on("click", function(){
            $(this).closest("label.attach-component").find("input[attach-request]").click();
        });
        $(".btn-result").on("click", function(){
            $(".btn-result").removeClass("clicked");
            $(this).addClass("clicked");

            $("#modal--ActionInspec .modal-ActionInspec-footer .btn-submit").prop("disabled", false)
        });
    });		
    async function pageLoad(){
        await settingTableCase()


         
       // console.log(_c);
    }
    async function modalLoad(_m, changeId){ 
        showActionEvent();
        let _appInfo = await settingStep(changeId);
        
        $('.input-daterange').datepicker({autoclose:true, format: 'yyyy/mm/dd', startDate: "dateToday",
            icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
            }
        });

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
            lengthMenu: [ [ -1], [ 'All']],
            order: [[3, 'desc']],
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
            setttinStampResult(_cahngeInfo[0]?.qualityJudgment);
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
                $("#table--inspecction tbody").append(strInp);  
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
        }else{
            $(".status--stamp").hide();
        }
    } 
    async function gettingCase(){
        caseInfo = CaseWaitAction;// await $.get("<?=base_url()?>/changes/getting_case", {roleGroupId:MemberInfo[0]?.roleGroupId, userActionId:MemberInfo[0]?.userActionId});
        let rowInfo = caseInfo.map( m => setRowTable(m));
        return rowInfo;
    }
    function setRowTable(m){
        return [
            m.fourm_number, 
            m.description,
            m.requestBy,
            m.requestDate,
            `<span class="label ${getClassForStatus(m.statusId)} label-white middle">${m.statusName}</span>`,
            `<td>
				<div class="btn-group"> 
                    <button class="btn btn-xs btn-warning btn--action" onclick="clickShow(this)">
						<i class="ace-icon fa fa-clock-o bigger-120"></i>
					</button>  
				</div> 
			</td>`
        ];
    }    
    function settingWaitActionTable($this, col, data, option){
        return $($this).DataTable(Object.assign({
            columns : col, 
            data:data,
            dom: '<"top"f><"tbox customscroll"t><"bottom"i><"clear">',
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
    function clickActionEvent(e){ 
        let isAction = $(e).attr("action");
        let _4mNumber = caseAction[0]?.fourm_number;
        if(isAction=="approve"){
            $("#modal--ActionEvent").removeClass("action--reject").addClass(`action--approve`);
            
        }else{
            $("#modal--ActionEvent").removeClass("action--approve").addClass(`action--reject`);
        }
        $("#modal--ActionEvent .modal-footer button[action]").attr("action", isAction);
        $("#modal--ActionEvent").attr("for-change", caseAction[0]?.changeDetailId);
        $("#modal--ActionEvent").find(".title--ActionEvent").html(`<strong>Approval</strong> : 4M Change number - ${_4mNumber}`);
        $("#modal--ActionEvent").modal("show");
    };   
    async function approveEvent(e){
        let isAction = $(e).attr("action");
        let _m = $("#modal--ActionEvent");
        let _comment = $("[name=req-description]", _m).val();
        let _parm = {
            changeDetailId:caseAction[0]?.changeDetailId,
            currentStatusId:caseAction[0]?.statusId,
            currentStatusName:caseAction[0]?.statusName,
            comment:_comment,
            userLogin:MemberInfo[0]?.userLoginId,
            userActionId:MemberInfo[0]?.userActionId
        }
        let _ap = await $.post("<?=base_url()?>changes/setting_actionApprove", {approve :_parm, action:isAction});
        await Swal.fire( `4M Number ${caseAction[0]?.fourm_number}`, 'Approved', 'success' );
        location.reload();
    }

    async function clickActionInspec(e){
    
        let _4mNumber = caseAction[0]?.fourm_number; 
        
        $("#modal--ActionInspec").attr("for-change", caseAction[0]?.changeDetailId);
        $("#modal--ActionInspec").find(".title--ActionInspec").html(`<strong>Quality Control Inspection</strong> : 4M Change number - ${_4mNumber}`);
        $("#modal--ActionInspec").modal("show");
    } 
    async function clickActionConfirmInspec(e){
    
        let _4mNumber = caseAction[0]?.fourm_number;
        $("#modal--QualityConfirm").find(".title--QualityConfirm").html(`<strong> การอนุมัติการเริ่มผลิต </strong> : 4M Change number - ${_4mNumber}`);
        $("#modal--QualityConfirm").modal("show");
        //console.log(dataInspection)
    }    
    async function clickFollowingEvent(e){
        let _4mNumber = caseAction[0]?.fourm_number;
        $("#modal--Following").find(".title--Following").html(`<strong> การติดตามผล การควบคุม </strong> : 4M Change number - ${_4mNumber}`);
        $("#modal--Following").modal("show");
    } 
    async function approveinspectEvent(e){
        let changeId = caseAction[0]?.changeDetailId;
        $("#modal--ActionInspec .progress-status").text('Saving the process starting..');
        $("#modal--ActionInspec").addClass("wait-loadding");
        try{
            $("#modal--ActionInspec .progress-status").text('Saving the Inspection..');
            await settingInspection(changeId);
            await ( () => new Promise( (r,j) => { $("#modal--ActionInspec .progress-bar").css("width", "20%"); setTimeout( () => { r("done.") }, 80) } ) )();
            $("#modal--ActionInspec .progress-status").text('Saving the Document..');
            await uploadDocument(changeId);
            await ( () => new Promise( (r,j) => { $("#modal--ActionInspec .progress-bar").css("width", "75%"); setTimeout( () => { r("done.") }, 80) } ) )();
            $("#modal--ActionInspec .progress-status").text('Saving the Confirmation..');
            await settingConfirmation(changeId);
            await ( () => new Promise( (r,j) => { $("#modal--ActionInspec .progress-bar").css("width", "100%"); setTimeout( () => { r("done.") }, 80) } ) )();
            $(".progress-status").text('getting done.'); 
            await Swal.fire( `4M Number ${caseAction[0]?.fourm_number}`, 'Inspected', 'success' );
            setTimeout( () => { $("#modal--ActionInspec").removeClass("wait-loadding"); }, 80);  
            location.reload();             
        }catch{ 
            $("#modal--ActionInspec .progress-bar").css("width", "0%");
            $("#modal--ActionInspec .progress-status").text('Saving the process error.');
            await Swal.fire( `Saving the process error`, 'Error process', 'error' );
            $("#modal--ActionInspec").removeClass("wait-loadding");            
        }        
        // let _4mNumber = caseAction[0]?.fourm_number;
        // $("#modal--QualityConfirm").find(".title--QualityConfirm").html(`<strong> การอนุมัติการเริ่มผลิต </strong> : 4M Change number - ${_4mNumber}`);
        // $("#modal--QualityConfirm").modal("show");
        // console.log(dataInspection)
    }  
    async function approveJudgment(e){
        let changeId = caseAction[0]?.changeDetailId;
        let statusName = $("#modal--QualityConfirm input[for-status]:checked").attr("for-status");
        let statusId = JSON.parse(await gettingStatusId(statusName, 1));
        let comment = $("textarea[name=req-condition-des]").val();
        let dateStartTime = moment(new Date).format("YYYY-MM-DD 00:00:00");
        let dateEndTime = moment($("input[name=end").val()).format("YYYY-MM-DD 23:59:59");

        let upd = { 
            qualityJudgment:statusName == "Approved" ? "OK" : statusName == "Rejected" ? "NG" : null,
            updateDateTime:moment(new Date()).format("YYYY-MM-DD HH:mm:ss"),
            updateBy:MemberInfo[0]?.userLoginId,
            statusId:statusId
        }; 
        let inpRes = await $.post("<?=base_url()?>/changes/setting_qualityComfirmation", 
        {
            qcJudgment :upd, 
            changeDetailId:changeId, 
            stName:statusName,
            comment:comment,
            followStartDateTime:dateStartTime,
            followEndDateTime:dateEndTime
        });
      
        await Swal.fire( `4M Number ${caseAction[0]?.fourm_number}`, 'Confirmed', 'success' );
        location.reload();
    }
    async function approveFollow(e){  
        let statusName = $("input[name=inp-follow-juds]:checked").attr("for-status");
        let comment = await gettingFollowingSTR(statusName);
        if(comment){
            let changeId = caseAction[0]?.changeDetailId;
           
            let statusId = JSON.parse(await gettingStatusId(statusName, 1)); 
            let dateTime = moment($("input[name=end").val()).format("YYYY-MM-DD 00:00:00");
            let upd = { 
                qualityJudgment:statusName == "Approved" ? "OK" : statusName == "Rejected" ? "NG" : null,
                updateDateTime:moment(new Date()).format("YYYY-MM-DD HH:mm:ss"),
                updateBy:MemberInfo[0]?.userLoginId,
                statusId:statusId
            }; 
            let inpRes = await $.post("<?=base_url()?>/changes/setting_followingComfirmation", 
            {
                qcJudgment :upd, 
                changeDetailId:changeId, 
                stName:statusName,
                comment:comment
            })
            .fail( async (e)=>{
                await Swal.fire( `4M Number ${caseAction[0]?.fourm_number} error ${e.status}`, 'Error process', 'error' ); 
                throw e.responseText;         
            })
        
            await Swal.fire( `4M Number ${caseAction[0]?.fourm_number}`, 'Confirmed', 'success' );
            location.reload();            
        } 
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
    function addReview($this, e){
        $("tbody", $this).append($("template[for-site=add-button--intable").html());
        $("#modal--ActionInspec .tbox")[0].scrollTo(0,$("#modal--ActionInspec .tbox")[0].scrollHeight);
        //toolTipSetting("[data--tooltip=tooltip-table]", {tooltipClass: "btn--in--table" });
    }
    function removeRow(e){
        let _r = $(e).closest("tr");
        if(_r[0].hasAttribute("row-index")){
            let rIndex = _r.attr("row-index")
            dataInspection = dataInspection.filter( f => f.id != rIndex);            
        }
       _r.remove(); 
    }
    function confirmRow(e, status){
        let _r = $(e).closest("tr");
        let _loc = _r.find("td").eq(0);
        let _cot = _r.find("td").eq(1);
        let isEmp = _r.find("td>input").toArray().filter( f => $(f).val() == "");
        if( !isEmp[0] ){
            //console.log(_loc.find("input"));
            if( !(_r[0].hasAttribute("row-index"))){
                _r.attr("row-index", inpcIndex)
                let locationInp = _loc.find("input").val();
                let resultInp = _cot.find("input").val()
                _loc.html(_loc.find("input").val());
                _cot.html(_cot.find("input").val());  
                _r.css("background-color", status == 1 ? "#c4ffcc" : "#ffc5c5");
                dataInspection.push({ id:inpcIndex++, inspectionLocation:locationInp, inspectionControl:resultInp, inspectionControlResult:status});               
            }else{
                let rIndex = _r.attr("row-index");
                _r.css("background-color", status == 1 ? "#c4ffcc" : "#ffc5c5");
                dataInspection.filter( f => f.inspectionControlResult = f.id == rIndex ? status : f.inspectionControlResult );
            } 
        }else{
             isEmp.forEach( elm => $(elm).css("border-color", "red"));
        } 
    } 
    function selectCondition(e){
        let seld = $(e).val()
        switch(seld){
            case "1":
                $('.input-daterange input').closest(".container-row").find(".block--group").addClass("blocked");
                $('.input-daterange input[name=end]').prop("disabled", true);
                $('#modal--QualityConfirm textarea[name=req-condition-des]').prop("disabled", true); 
                break;
            case "2":
                $('.input-daterange input').closest(".container-row").find(".block--group").removeClass("blocked");
                $('.input-daterange input[name=end]').prop("disabled", false);
                $('#modal--QualityConfirm textarea[name=req-condition-des]').prop("disabled", false); 
                break;
            case "3":
                $('.input-daterange input').closest(".container-row").find(".block--group").addClass("blocked");
                $('.input-daterange input[name=end]').prop("disabled", true);
                $('#modal--QualityConfirm textarea[name=req-condition-des]').prop("disabled", true); 
                break;
            default: break;
        }
    }
    function selectJudment(e){
        let seld = $(e).val()
        let pLabel = $(e).closest("label");
        
        switch(seld){
            case "1":  
                $('.container-row .block--group').addClass("blocked");
                $('.container-row .block--group  textarea[name=inp-error-oth]').prop("disabled", true); 
                break;
            case "2": 
                $('.container-row .block--group').removeClass("blocked"); 
                // $('.container-row .block--group textarea[name=inp-error-oth]').prop("disabled", false); 
                break; 
            default: break;
        }        
    }
    function uploadDocument(changeId){
        return new Promise( (r, j) => {
            let filesAttach = [];
            let form_data = new FormData();
            let documentNo = caseInfo[0]?.fourm_number;
            $("#modal--ActionInspec input[type=file][attach-request]").each( (i,e)=>{
                let groupId = $(e).attr("subject-doc");
                let docName = $(e).attr("name-doc");
                if( $(e).val() ){ 
                    let fileName = $(e)[0].files[0]?.name;
                    let _doc = {
                        changeDetailId:changeId,
                        documentGroupId : groupId,
                        documentName : `${docName}${documentNo}`,
                        fileName: removeFileExtension(fileName ), 
                        fileExtension: getFileExtension(fileName),
                        filePath: `/uploads/${documentNo}/${docName}${documentNo}.${getFileExtension(fileName)}`,
                        createBy: MemberInfo[0]?.userLoginId
                    }  
                    form_data.append(`fileGroup_${groupId}`, $(e).prop("files")[0]);
                    filesAttach.push(_doc);
                }
            });
            form_data.append("document",  JSON.stringify(filesAttach));
            form_data.append("4MNumber", documentNo);

            $.ajax({
                url: '<?=base_url()?>/changes/create', // point to server-side PHP script 
                dataType: 'JSON', // what to expect back from the PHP script 
                data: form_data,
                processData: false,
                contentType: false,
                type: "POST",
                success: function(response) { 
                    console.log(response) // display success response from the PHP script
                    r(response);
                },
                error: function (response) {
                    console.log(response) // display error response from the PHP script
                }
            });            
        }); 
    }     
    async function settingInspection(changeId){
        let inp = dataInspection.map(m=>({
            changeDetailId:changeId,
            inspectionLocation:m.inspectionLocation,
            inspectionControl:m.inspectionControl,
            inspectionControlResult:m.inspectionControlResult,
            createBy: MemberInfo[0]?.userLoginId
        }));
        let inpRes = await $.post("<?=base_url()?>/changes/settingNewQualityChangeInspection", {ins :inp});
        
        return inpRes;
    } 
    async function settingConfirmation(changeId){
        // debugger;
        let statusName = caseAction[0]?.statusName;
        let statusId = JSON.parse(await gettingStatusId(statusName, 1));
        let upd = { 
            qualityJudgment:$("#modal--ActionInspec .btn-result.clicked").attr("res"),
            updateDateTime:moment(new Date()).format("YYYY-MM-DD HH:mm:ss"),
            updateBy:MemberInfo[0]?.userLoginId 
        }; 
        let inpRes = await $.post("<?=base_url()?>/changes/setting_actionInspectApprove", {qcJudgment :upd, changeDetailId:changeId, stName:statusName});
        
        return inpRes;
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
    async function gettingStatusId(statusName, forTb){
        let inpRes =  await $.get("<?=base_url()?>/changes/gettingStatusId", {statusName :statusName, tFlg:forTb}) ;
        return inpRes;
    }
    async function gettingQuality(changeDetailId){
        let _c = await $.get("<?=base_url()?>changes/getting_qualityinspection", {"changeDetailId":changeDetailId});
        return _c;
    }   
    function gettingFollowingSTR(judmentFollow){ 
        return new Promise( async (resolve,reject)=>{
            let activity = $("input[name=inp-follow]:checked").toArray();
            let m = activity.map( f => { return $("+span.tree-item-name span.tree-label", f).text() });
            let actvStr = `การติดตามผล การควบคุม 4M Changes\r\n\t- ${m.join("\r\n\t- ")}\r\n\r\n`;
            //let judmentFollow = $("input[name=inp-follow-juds]:checked").attr("for-status");
            if(judmentFollow == "Approved"){
                actvStr += `การสิ้นสุดการควบคุม 4M Changes\r\n\t- อนุมัติการสิ้นสุดการควบคุม`;
                resolve(actvStr)
            }else if(judmentFollow == "Rejected"){
                let acError = $("input[name=inp-error-action]:checked").toArray();
                let chkOTH = acError?.filter( f => $(f).val() == 4)[0];
                let oth = $('.container-row .block--group textarea[name=inp-error-oth]');
                if(oth.val() || !chkOTH){
                    let e = acError.map( f => { return $("+span.tree-item-name span.tree-label", f).text() });
                    let o = oth.val().split("\n")
                    actvStr += `การสิ้นสุดการควบคุม 4M Changes\r\n\t- พบความผิดปกติในการควบคุม 4M\r\n\t\t- ${e.join("\r\n\t\t- ")}${o[0]? `\r\n\t\t\t- ${o.join("\r\n\t\t\t- ")}`: ""}`;
                    resolve(actvStr);
                }else{
                    await Swal.fire( `Please input data`, 'Error empty input', 'error' );
                    oth.focus();
                    resolve(null); 
                } 
            }else resolve(null);
        });
    }
    function showActionEvent(){
        if( caseAction[0]?.statusId == 2 ){
                $(".btn--approve").hide();
                $(".btn--reject").hide();
                $(".btn--confirm").hide();
                $(".btn--following").hide();
                $(".btn--inspcet").show();
            }else if( caseAction[0]?.statusId == 1 ){
                $(".btn--approve").show();
                $(".btn--reject").show();
                $(".btn--following").hide();
                $(".btn--confirm").hide();
                $(".btn--inspcet").hide();
            }else if( caseAction[0]?.statusId == 14 ){
                $(".btn--approve").hide();
                $(".btn--reject").hide();
                $(".btn--following").hide();
                $(".btn--confirm").show();
                $(".btn--inspcet").hide();
            }else if( caseAction[0]?.statusId == 12 ){
                $(".btn--approve").hide();
                $(".btn--reject").hide();
                $(".btn--following").show();
                $(".btn--confirm").hide();
                $(".btn--inspcet").hide();
            }else{
                $(".btn--approve").hide();
                $(".btn--reject").hide();
                $(".btn--inspcet").hide(); 
                $(".btn--confirm").hide(); 
                $(".btn--following").hide();          
            }
    }
</script>