<script src="<?= base_url() ?>assets/libs/SimpleImage.js"> </script>
<script src="<?= base_url() ?>assets/js/project/changes-site.js"></script>

<script type="text/javascript" local-section="true">
    var request = {}
    $(document).ready(function(){
        //Toast.fire({ icon: 'success', title: 'login success na na!' })
        request["selectLine"] = setting_search("select[name=req-line]", "<?= base_url() ?>changes/getting_select_line", "please select line");
        setting_search("select[name=req-partnumber]", "<?= base_url() ?>changes/getting_select_partnumber", "please select part number");
        setting_search("select[name=req-partname]", "<?= base_url() ?>changes/getting_select_partname", "please select part name");
        setting_search("select[name=req-process]", "<?= base_url() ?>changes/getting_select_process", "please select process");
        setting_search("select[name=req-cuase]", "<?= base_url() ?>changes/getting_select_cuase", "กรุณาเลือกสาเหตุการเปลี่ยนแปลง");  
        $("#modal-sheet-add").on("show.bs.modal", function(){
            console.log("modal open");
            document.querySelector("[autoset=datetime]").textContent = moment(new Date).format("YYYY-MM-DD"); 
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

        })
    });	

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
        $("tbody", $this).prepend($("template[for-site=add-button--intable").html());
        toolTipSetting("[data--tooltip=tooltip-table]", {tooltipClass: "btn--in--table" });
    }
    function removeRow($this){
        $($this).closest("tr").remove();
    }
    function tooltipFormat(){

    }
</script>
<script type="text/javascript" local-section="reeval"> 
   
</script>