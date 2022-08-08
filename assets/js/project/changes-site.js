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