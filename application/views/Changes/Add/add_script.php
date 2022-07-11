<script src="https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js"> </script>
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
    });	

</script>
<script type="text/javascript" local-section="reeval"> 
   
</script>