<?php
 require "head.php";
 ?> 
     
<body>
     <div class="wrapper">
  <?php
 include "head1.php";
 ?> 
        
      <div class="table1">
        <h4>Categories</h4>
<div id="jsGrid"></div>
</div>
<script>
    
  
    $("#jsGrid").jsGrid({
               height: "auto",
            width: "100%",

            sorting: true,
            paging: false,
            autoload: true,
           
            controller: {
                loadData: function (filter) {
                    console.log(filter);
                    return $.ajax({
                        type: "GET",
                        url: "getcategories.php",
                        data: filter,
                        dataType: "json"
                    });
                }
            },
           
            fields: [
             { name: "category_id", type: "hidden", css:'hide' },
             { name: "category_name",title:"Categories", type: "text", width: 150 },
            
            ]
        });
</script>
<?php
require "foot.php";
?> 
</div>
 </body>
 