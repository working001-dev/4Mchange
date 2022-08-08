<script src="<?= base_url() ?>assets/libs/SimpleImage.js"> </script>
<script src="<?= base_url() ?>assets/js/project/changes-site.js"></script>

<script type="text/javascript" local-section="true">
    var request = {}
    var cuaseType = "1";
    var documentNo = "";
    var dataInspection = [];
    var inpcIndex = 0;
    $(document).ready(function(){
        //Toast.fire({ icon: 'success', title: 'login success na na!' })

        setting_search("select[name=req-line]", "<?= base_url() ?>changes/getting_select_line", {placeholder :"please select line"});
        setting_search("select[name=req-partnumber]", "<?= base_url() ?>changes/getting_select_partnumber", {placeholder :"please select part number"});
        setting_search("select[name=req-partname]", "<?= base_url() ?>changes/getting_select_partname", {placeholder :"please select part name"});
        setting_search("select[name=req-process]", "<?= base_url() ?>changes/getting_select_process", {placeholder :"please select process"});
        setting_search("select[name=req-cuase]","<?= base_url() ?>changes/getting_select_cuase", {  placeholder :"กรุณาเลือกสาเหตุการเปลี่ยนแปลง"}, {t:cuaseType});
        
        pageLoad();


        $("#modal-sheet-add").on("show.bs.modal", function(){
            //console.log("modal open");
            documentNo = `4M${moment().format("YYYYMMDD")}####`;
            document.querySelector("[autoset=datetime]").textContent = moment(new Date).format("YYYY-MM-DD HH:mm:ss"); 
            document.querySelector("[autoset=changenumber]").textContent = documentNo; 
        });	
        $("button.btn-attach").on("click", function(){
            $(this).closest("label.attach-component").find("input[attach-request]").click();
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
        $("input[name=changeType]").on("change", function(){
            $(".block-waite--select").hide(400);
        });
        $("input[name=causeType]").on("change", function(){
            cuaseType = $(this).val();
            setting_search("select[name=req-cuase]","<?= base_url() ?>changes/getting_select_cuase", {  placeholder :"กรุณาเลือกสาเหตุการเปลี่ยนแปลง" , tags:true}, {t:cuaseType});
            if($("select[name=req-cuase]")[0].hasAttribute("disabled")){
                $("select[name=req-cuase]").prop("disabled", false).trigger("change");                
            } 
        });

    });	

    async function pageLoad(){
        setting_documentForapprove();
    }

    async function setting_documentForapprove(){
        let docForApprove = await $.get("<?=base_url()?>/changes/getting_master_for_approve");
        docForApprove.forEach( _d => {
            $(".doc--forapprove").append(`
            <div class="req-input flex flex-column">
            	<span class="req-title flex">${_d.gname}</span>
            	<label for="file-forapprove" class="attach-component">
            		<input type="file" onchange="attaced(this)" name="file-forapprove" subject-doc="${_d.gid}" name-doc="${_d.gtext}" style="display: none;" attach-request />
            		<span class="sp-filename">กรุณาแนบไฟล์</span>
            		<button class="btn-attach" onclick='$(this).closest("label.attach-component").find("input[attach-request]").click()'><i class="fa fa-paperclip" aria-hidden="true"></i></button>
            	</label>
            </div>            
            `)
        });
 
        $("input[attach-request]").on("change", function(){

        });
    }

    function toolTipSetting($this, option){ 
        $($this).tooltip(Object.assign({
		show: null,
		position: { my: "left top", at: "left bottom" },
		open: function( event, ui ) {
			ui.tooltip.animate({ top: ui.tooltip.position().top + 5 }, "fast" );
		}
		}, option));
    }

    function addReview($this, e){
        $("tbody", $this).append($("template[for-site=add-button--intable").html());
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
    function attaced(e){
        let __f = $(e)[0]?.files[0]?.name;
        if(__f){
            $("+span", e).text(__f);  
            $("+span", e).css({background: "#4f5c78",color: "white"});              
        }else{
            $("+span", e).text("กรุณาแนบไฟล์");  
            $("+span", e).css({background: "#fff",color: "black"}); 
        } 
    }
    function tooltipFormat(){

    }

    async function add4MChange(){
        $("#modal-sheet-add").addClass("wait-loadding");
        $("#modal-sheet-add").scrollTop(0);
        let changeType = $("input[name=changeType]:checked").val();
        let causeType  = $("input[name=causeType]:checked").val();
        let reqCause = $("select[name=req-cuase]").val();
        let reqLineId = $("select[name=req-line]").val() || null;
        let requestDetail = $("textarea[name=req-description]").val();
        let changeCuaseId = await findChangeCuase(causeType, reqCause);
        let productionId = await findProductionFromLine(reqLineId);
        let changeinfo = {
            "changeTypeId" :causeType,
            "changeCuaseId" : changeCuaseId,
            "description" : requestDetail,
            "fourm_number" : documentNo,
            "createBy": MemberInfo[0]?.userLoginId,
            "changeDetailGroupId": MemberInfo[0]?.roleGroupId,
            "lineId" : reqLineId,
            "productionId" : productionId
        }
 
        let newChange = JSON.parse( await $.post("<?=base_url()?>/changes/settingNewChange", {ins :changeinfo}) );
        let changeId = newChange?.changeDetailId;
        documentNo = newChange?.fourm_number;
        $(".progress-bar").css("width", "10%");
        $(".progress-status").text('create 4m change request')
        if(changeId){ 
            await( ()=>{
                return new Promise( (_r,_j)=>{
                    $(".progress-bar").css("width", "40%");
                    setTimeout( ()=>{ _r( $(".progress-status").text(`create 4m change number ${documentNo} document`) );}, 2000)
                })
            })(); 
            await uploadDocument(changeId); 
            await( ()=>{
                $(".progress-bar").css("width", "70%"); 
                return new Promise( (_r,_j)=>{
                    setTimeout( ()=>{ _r( $(".progress-status").text(`create 4m change number ${documentNo} inspection`) );}, 2000)
                })
            })(); 
            await settingInspection(changeId);
            await( ()=>{
                $(".progress-bar").css("width", "100%");
                return new Promise( (_r,_j)=>{
                    setTimeout( ()=>{ _r(  $(".progress-status").text(`create 4m change number ${documentNo} done.`) );}, 2000)
                })
            })();
            
           
            await Toast.fire({ icon: 'success', title: 'User created!',timer: 2000 });
            location.reload(); 
        }else Toast.fire({ icon: 'error', title: 'Create request fail!',timer: 2000  });
    }


    function uploadDocument(changeId){
        return new Promise( (r, j) => {
            var filesAttach = [];
            let form_data = new FormData();
            $("input[type=file][attach-request]").each( (i,e)=>{
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
        let inpRes = await $.post("<?=base_url()?>/changes/settingNewChangeInspection", {ins :inp});
        
        return inpRes;
    }
    async function findChangeCuase(cuaseType, cuaseText){
        let _c = await $.get("<?=base_url()?>/changes/findChangeCuase", {ctype :cuaseType, ctext:cuaseText});
        return JSON.parse(_c) || 0;
    }
    async function findProductionFromLine(lineId){
        let _c = await $.get("<?=base_url()?>/changes/findProductionLine", {line:lineId});
        return JSON.parse(_c) || null;
    }
</script>
<script type="text/javascript" local-section="reeval"> 
   
</script>