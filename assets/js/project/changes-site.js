function setting_search($this, url, option={}, p={}){
    let _op = Object.assign({
        destroy:true,
        ajax: Object.assign({
            url: url,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return Object.assign( { q: params.term,  page: params.page}, p);
            },
            processResults: function (data, params) { 
                // debugger;
                params.page = params.page || 1;
                // console.log(data); 
                return {
                    results: data,
                    pagination: { more: (params.page * 30) < data.length  }
                }
            },
            cache: true
        },option?.ajax || {} ),
        placeholder: "Please choose item",
        minimumInputLength: 2,
        tags: false,
        width: 'resolve'
        // templateResult: formatRepo,
        // templateSelection: formatRepoSelection
        // insertTag: function (data, tag) {
        //   // Insert the tag at the end of the results
        //   data.push(tag);
        // }
    }, option )
    return $($this).select2(_op);
}
function upload() {
  var imgcanvas = document.getElementById("can");
  var fileinput = document.getElementById("finput");
  var image = new SimpleImage (fileinput);
  image.drawTo(imgcanvas);
}
function removeFileExtension(f){
    // var _a = (f.split("."));
    // _a.pop(1);
    // return _a.toStting();
    return f.replace(/\.[^/.]+$/, "");
}
function getFileExtension(f){
    return f.split('.').pop();
}
function getIconForStatus(s){
    switch(s){
        case "Request": return 'fa-plus-circle'; break;
        case "Approved": return 'fa-check-circle'; break;
        case "Inspected": return 'fa-check-circle'; break;
        case "Closed": return 'fa-dot-circle-o'; break;
        case "Inspected OK!": return 'fa-check-circle'; break;
        case "Confirm Following": return 'fa-check-circle'; break;
        case "Inspected NG!": return 'fa-times-circle'; break;
        case "Cancel Inspect!": return 'fa-times-circle'; break;
        case "Cancel Following!": return 'fa-times-circle'; break;
        case "Reject 4M change": return 'fa-times-circle'; break;
        case "Reject Process": return 'fa-times-circle'; break;
        case "OK Continue": return 'fa-chevron-circle-right'; break;
        case "NO Production": return 'fa-ban'; break;
       
        default: return 'fa-clock-o'; break;
    }
}
function getActionStep(a){
    //console.log(a);
    if(a.includes("Pending")){
        return "no--action";
    }else if(a.includes("OK") || a.includes("Confirm")){
        return "ok--action";
    }else if(a == "Inspected NG!" || a == "NO Production" || a.includes("Reject") || a.includes("Cancel")  ){
        return "ng--action";
    }else if(a.includes("Follow")  ){
        return "fw--action";        
    }else return "";
}