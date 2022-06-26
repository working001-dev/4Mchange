<script src="<?= base_url() ?>assets/js/tree.min.js"></script>


<script type="text/javascript" local-section="true">
    $(document).ready(function(){ 
        var sampleData = initiateDemoData();//see below


        $('#tree1').ace_tree({
            dataSource: sampleData['dataSource1'],
            multiSelect: true,
            cacheItems: true,
            'open-icon' : 'ace-icon tree-minus',
            'close-icon' : 'ace-icon tree-plus',
            'itemSelect' : true,
            'folderSelect': false,
            'selected-icon' : 'ace-icon fa fa-check',
            'unselected-icon' : 'ace-icon fa fa-times',
            loadingHTML : '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>'
        });

 


        /**
        //Use something like this to reload data	
        $('#tree1').find("li:not([data-template])").remove();
        $('#tree1').tree('render');
        */


        /**
        //please refer to docs for more info
        $('#tree1')
        .on('loaded.fu.tree', function(e) {
        })
        .on('updated.fu.tree', function(e, result) {
        })
        .on('selected.fu.tree', function(e) {
        })
        .on('deselected.fu.tree', function(e) {
        })
        .on('opened.fu.tree', function(e) {
        })
        .on('closed.fu.tree', function(e) {
        });
        */


        function initiateDemoData(){
            var tree_data = {
                'for-sale' : {text: 'For Sale', type: 'folder'}	,
                'vehicles' : {text: 'Vehicles', type: 'folder'}	,
                'rentals' : {text: 'Rentals', type: 'folder'}	,
                'real-estate' : {text: 'Real Estate', type: 'folder'}	,
                'pets' : {text: 'Pets', type: 'folder'}	,
                'tickets' : {text: 'Tickets', type: 'item'}	,
                'services' : {text: 'Services', type: 'item'}	,
                'personals' : {text: 'Personals', type: 'item'}
            }
            tree_data['for-sale']['additionalParameters'] = {
                'children' : {
                    'appliances' : {text: 'Appliances', type: 'item'},
                    'arts-crafts' : {text: 'Arts & Crafts', type: 'item'},
                    'clothing' : {text: 'Clothing', type: 'item'},
                    'computers' : {text: 'Computers', type: 'item'},
                    'jewelry' : {text: 'Jewelry', type: 'item'},
                    'office-business' : {text: 'Office & Business', type: 'item'},
                    'sports-fitness' : {text: 'Sports & Fitness', type: 'item'}
                }
            }
            tree_data['vehicles']['additionalParameters'] = {
                'children' : {
                    'cars' : {text: 'Cars', type: 'folder'},
                    'motorcycles' : {text: 'Motorcycles', type: 'item'},
                    'boats' : {text: 'Boats', type: 'item'}
                }
            }
            tree_data['vehicles']['additionalParameters']['children']['cars']['additionalParameters'] = {
                'children' : {
                    'classics' : {text: 'Classics', type: 'item'},
                    'convertibles' : {text: 'Convertibles', type: 'item'},
                    'coupes' : {text: 'Coupes', type: 'item'},
                    'hatchbacks' : {text: 'Hatchbacks', type: 'item'},
                    'hybrids' : {text: 'Hybrids', type: 'item'},
                    'suvs' : {text: 'SUVs', type: 'item'},
                    'sedans' : {text: 'Sedans', type: 'item'},
                    'trucks' : {text: 'Trucks', type: 'item'}
                }
            }

            tree_data['rentals']['additionalParameters'] = {
                'children' : {
                    'apartments-rentals' : {text: 'Apartments', type: 'item'},
                    'office-space-rentals' : {text: 'Office Space', type: 'item'},
                    'vacation-rentals' : {text: 'Vacation Rentals', type: 'item'}
                }
            }
            tree_data['real-estate']['additionalParameters'] = {
                'children' : {
                    'apartments' : {text: 'Apartments', type: 'item'},
                    'villas' : {text: 'Villas', type: 'item'},
                    'plots' : {text: 'Plots', type: 'item'}
                }
            }
            tree_data['pets']['additionalParameters'] = {
                'children' : {
                    'cats' : {text: 'Cats', type: 'item'},
                    'dogs' : {text: 'Dogs', type: 'item'},
                    'horses' : {text: 'Horses', type: 'item'},
                    'reptiles' : {text: 'Reptiles', type: 'item'}
                }
            }

            var dataSource1 = function(options, callback){
                var $data = null
                if(!("text" in options) && !("type" in options)){
                    $data = tree_data;//the root tree
                    callback({ data: $data });
                    return;
                }
                else if("type" in options && options.type == "folder") {
                    if("additionalParameters" in options && "children" in options.additionalParameters)
                        $data = options.additionalParameters.children || {};
                    else $data = {}//no data
                }

                if($data != null)//this setTimeout is only for mimicking some random delay
                    setTimeout(function(){callback({ data: $data });} , parseInt(Math.random() * 500) + 200);
 
            }
  


            return {'dataSource1': dataSource1 }
        }

 

    });		
</script>