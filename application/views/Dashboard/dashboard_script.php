<script src="<?=base_url()?>assets/libs/chartjs/dist/chart.min.js"></script> 
<script src="<?=base_url()?>assets/libs/counterup/jquery.waypoints.min.js"></script>
<script src="<?=base_url()?>assets/libs/counterup/jquery.counterup.min.js"></script>   
 
<script type="text/javascript" local-section="true">
    const MONTHS = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
    ];    
    var chartYearly = undefined;
    var chartMonthly = undefined;
    var chartTypes = undefined;
    $(document).ready(function(){
        //Toast.fire({ icon: 'success', title: 'login success na na!' }) 
        settingNumStatus();
        settingChart();
    });		

    async function settingChart(){

        chartYearly = await setChartYearly() ;
 
        chartMonthly = await setChartMonthly();

        chartTypes = await setChartTopTypes();  

  
    }  
    async function settingNumStatus(){
        let _S = await gettingStatusData();
        $("#num-total>span").attr("data-value", _S[0]?.total);
        $("#num-inprocess>span").attr("data-value", _S[0]?.inprocess);
        $("#num-approve>span").attr("data-value", _S[0]?.approve);
        $("#num-reject>span").attr("data-value", _S[0]?.reject); 

        setTimeout( () => { $("[data-counter='counterup']").counterUp({ delay: 10, time: 1000, }) }, 1500); 
        // counters_number(document.querySelectorAll('.txt-number>span'), 20);
    }
    async function setChartYearly(){
        let _Y = await gettingYearlyData();
        let _L = _Y?.map( m => MONTHS[parseInt(m.mn)-1] );
        let _METHOD = MONTHS?.map( (m,i)=>{
            let f = _Y?.filter( f => f.mn == (i+1) );
            return ( f[0] ) ? f[0]?.method : 0;
        });
        let _MATERIAL = MONTHS?.map( (m,i)=>{
            let f = _Y?.filter( f => f.mn == (i+1) );
            return ( f[0] ) ? f[0]?.material : 0;
        });
        let _MACHINE = MONTHS?.map( (m,i)=>{
            let f = _Y?.filter( f => f.mn == (i+1) );
            return ( f[0] ) ? f[0]?.machine : 0;
        });
        let _MAN = MONTHS?.map( (m,i)=>{
            let f = _Y?.filter( f => f.mn == (i+1) );
            return ( f[0] ) ? f[0]?.man : 0;
        });                        
        const data = {
            labels: MONTHS, //"4M Change case of month",
            datasets: [
                {
                    label: 'Method',
                    data: _METHOD,
                    backgroundColor: '#0E185F',
                },{
                    label: 'Meterial',
                    data: _MATERIAL,
                    backgroundColor: '#2FA4FF',
                },{
                    label: 'Machine',
                    data: _MACHINE,
                    backgroundColor: '#00FFDD',
                },{
                    label: 'Man',
                    data: _MAN,
                    backgroundColor: '#E8FFC2',
                }
            ]
        }; 
        const config = {
            type: 'bar',
            data: data,
            options: {
                indexAxis: 'y', 
                elements: { bar: { borderWidth: 2, } },
                plugins: {
                    legend: { position: 'bottom', },
                    title: {
                        display: true,
                        align: "left",
                        text: '4M Change case of year'
                    },
                },
                responsive: true,
                maintainAspectRatio: false, 
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true
                },
                scales: {
                    x: {
                        grid: {
                        display: false
                        }
                    },
                    y: {
                        grid: {
                        display: false
                        }
                    }
                }
            },
        }; 
        var ctx = document.getElementById('chart-yearly').getContext('2d');              
        const chart = new Chart(ctx,config);
        return chart;
    }
    async function setChartMonthly(){ 
        let today = new Date();
        let lastDayOfMonth = new Date(today.getFullYear(), today.getMonth()+1, 0).getDate();
        let DAYS = [];
        for( let _i = 0; _i < lastDayOfMonth; _i++) DAYS.push( (_i+1).toString().padStart(2, '0') );

        let _D = await gettingMonthlyData(); 
        let _METHOD = DAYS?.map( (m,i)=>{
            let f = _D?.filter( f => f.days == (i+1) );
            return ( f[0] ) ? f[0]?.method : 0;
        });
        let _MATERIAL = DAYS?.map( (m,i)=>{
            let f = _D?.filter( f => f.days == (i+1) );
            return ( f[0] ) ? f[0]?.material : 0;
        });
        let _MACHINE = DAYS?.map( (m,i)=>{
            let f = _D?.filter( f => f.days == (i+1) );
            return ( f[0] ) ? f[0]?.machine : 0;
        });
        let _MAN = DAYS?.map( (m,i)=>{
            let f = _D?.filter( f => f.days == (i+1) );
            return ( f[0] ) ? f[0]?.man : 0;
        });
        const data = {
            labels: DAYS,
            datasets: [{
                label: 'Method',
                data: _METHOD,
                backgroundColor: '#0E185F',
            },{
                label: 'Meterial',
                data: _MATERIAL,
                backgroundColor: '#2FA4FF',
            },{
                label: 'Machine',
                data: _MACHINE,
                backgroundColor: '#00FFDD',
            },{
                label: 'Man',
                data: _MAN,
                backgroundColor: '#E8FFC2',
            }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: { 
                    x: {
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true ,
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: { position: 'bottom', },
                    title: {
                        display: true,
                        align: "left",
                        text: '4M Change case of year'
                    },
                },
                elements: { bar: { borderWidth: 2, } },
                plugins: {
                    legend: { position: 'bottom', },
                    title: {
                        display: true,
                        align: "left",
                        text: '4M Change case of month'
                    },
                },
                responsive: true,
                maintainAspectRatio: false, 
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true
                },                
            },

        };
        var ctx = document.getElementById('chart-monthly').getContext('2d');              
        const chart = new Chart(ctx,config);
        return chart;        
    }
    async function setChartTopTypes(){ 
        let _T = await gettingCaseTypeData();
        const data = {
        labels: ['Mathod', 'Material', 'Mechine', 'Man'],
            datasets: [
                {
                    label: 'type',
                    data: [_T[0]?.method, _T[0]?.material, _T[0]?.machine,_T[0]?.man],
                    backgroundColor: ['#0E185F','#2FA4FF','#00FFDD','#E8FFC2'],
                }
            ]
        }; 
        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                aspectRatio: 2,
                plugins: {
                    legend: {
                        position: 'right',
                        display: true,
                        align: "center"
                    },
                    title: {
                        display: true,
                        text: 'Total 4M Chane Type'
                    },
                    labels:{
                        render:(args) => {
                            return args.label
                        }
                    } 
                }
            },
        };
        var ctx = document.getElementById('chart-caseType').getContext('2d');              
        const chart = new Chart(ctx,config);
        return chart;
    } 
  
    async function gettingYearlyData(){
        let _Y = await $.post("<?=base_url()?>Dashboard/gettingYearChart");
        return _Y
    }
    async function gettingMonthlyData(){
        let _M = await $.post("<?=base_url()?>Dashboard/gettingMonthChart");
        return _M
    }
    async function gettingCaseTypeData(){
        let _T = await $.post("<?=base_url()?>Dashboard/gettingCaseTypeChart");
        return _T
    }
    async function gettingStatusData(){
        let _S = await $.post("<?=base_url()?>Dashboard/gettingStatusSummary");
        return _S
    }
    function counters_number(elm, speed){
        elm.forEach( counter => {
            const animate = () => {
                const value = +counter.getAttribute('counter-num');
                const data = +counter.innerText || 0;
                //console.log(value, data)   
                const time = value / speed;
                if(data < value) {
                    counter.innerText = Math.ceil(data + time);
                    setTimeout(animate, 1);
                }else{
                    counter.innerText = value;
                } 
            }  
            animate();
        });        
    }
</script>