
<script src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script> 
<script src="<?=base_url()?>assets/js/moment.min.js"></script>
<script type="text/javascript" local-section="true">
    var tbData = undefined;
    $(document).ready(function(){
        gettingtbData("'<?=date('Y-m-d 00:00:00')?>' and '<?=date('Y-m-d 23:59:59')?>'")

 
        $('.date-picker').datepicker({
		    autoclose: true,
		    todayHighlight: true,
            format: "yyyy-mm-dd" 
		});
        $("#id-date-picker-1").on("change", function(){
            let _a = $(this).val();
            let _s = moment(_a).format("YYYY-MM-DD 00:00:00");
            let _e = moment(_a).format("YYYY-MM-DD 23:59:59");
            //generate_table_report(a);
            gettingtbData(`'${_s}' and '${_e}'`); 
        });
        $("#select-pd").on("change", async function(){
            let _v = $(this).val();
            _v = _v == "NO PD" ? null : _v;
            if(_v != "All"){
                let _tb = tbData?.filter(f => f.pd == _v);
                await generate_table_report(_tb);
                console.log(_tb)
            }else{
                await generate_table_report(tbData);
            }
        });
    });
    async function gettingtbData(d){
        tbData = await getting_daily_data(d);
        SettingSelectProduction(tbData);
        await generate_table_report(tbData);
    }

    async function generate_table_report(d){
        
        
        let tbBody = await Promise.all( d?.map( async (m, i) => {
            return `
                <tr>
                    <td>${i+1}</td>
                    <td>${m?.date}</td>
                    <td>${m?.pd || "-"}</td>
                    <td>${m?.fourm_number || "-"}</td>
                    <td>${m?.lineName || "-"}</td>
                    <td>${m?.processName || "-"}</td>
                    <td>${m?.rel_production || "-"}</td>
                    <td>${m?.changeTypeCode || "-"}</td>
                    <td>${m?.description || "-"}</td>
                    <td>${m?.permanent == 1 ? `<i class="fa fa-check-circle" aria-hidden="true" style="color:green;"></i>` : ""}</td>
                    <td>${m?.temporary == 1 ? `<i class="fa fa-check-circle" aria-hidden="true" style="color:green;"></i>` : ""}</td>
                    <td>${m?.start || "-"}</td>
                    <td>${m?.duaDate || "-"}</td>
                    <td>${m?.status || "-"}</td>
                    <td></td>                                        
                </tr>
            `}) 
        );
        if(tbBody[0])
            $("#tbReport tbody").html(tbBody.toLocaleString());
        else $("#tbReport tbody").html(`<tr><td colspan="15">Data Empty.</td></tr>`);
    }

    async function getting_daily_data(mon){
        let _d = await $.get("<?=base_url()?>reports/gettingMonthlyReport", {mon:mon});
        return _d;
    }
    function SettingSelectProduction(_b){
        $('#select-pd').selectpicker('destroy');
        if(_b[0]){
            let _s = ["All", ...new Set(_b?.map( m => m.pd || "NO PD" ))].map( m => (`<option value='${m}'>${m}</option>`));
            $("#select-pd").html(_s.sort().toLocaleString()); 
            $("#select-pd").addClass('btn-primary').selectpicker('render');           
        }else{
            $("#select-pd").html(`<option value="All">All</option>`); 
            $("#select-pd").addClass('btn-primary').selectpicker('render');     
        }   

        
        
    }
    async function ExportToExcel() {
        let _a = $("#id-date-picker-1").val();
        let _p = $("#select-pd").val();
        let _s = moment(_a).format("YYYY-MM-DD 00:00:00");
        let _e = moment(_a).format("YYYY-MM-DD 23:59:59");
        let _m = `'${_s}' and '${_e}'`;
        window.open(`<?=base_url()?>reports/exportdaily_report?m=${_m}&p=${_p}`);
        //let _e = await $.get("<?=base_url()?>reports/export_report");
    }
</script>