function setting_search($this, url, pla = "please choose item", tags = false){
    return $($this).select2({
      destroy:true,
      ajax: {
        url: url,
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return { q: params.term,  page: params.page };
        },
        processResults: function (data, params) { 
          params.page = params.page || 1; 
          return {
            results: data,
            pagination: {
              more: (params.page * 30) < data.length
            }
          };
        },
        cache: true
      },
      placeholder: pla,
      minimumInputLength: 2,
      tags: tags,
      width: 'resolve'
      // templateResult: formatRepo,
      // templateSelection: formatRepoSelection
      // insertTag: function (data, tag) {
      //   // Insert the tag at the end of the results
      //   data.push(tag);
      // }
    });
}
function upload() {
  var imgcanvas = document.getElementById("can");
  var fileinput = document.getElementById("finput");
  var image = new SimpleImage (fileinput);
  image.drawTo(imgcanvas);
}