<?php
require "head.php";
?>

<body>
  <div class="wrapper">
    <?php
    include "head1.php";
    ?>
    <script type="text/javascript">
      $('li').removeClass('active');
      $('#requestphp').addClass('active');
    </script>

    <body>
      <?php
      require "pdo.php";
      ?>
      <div class="table1">
        <h4 style="margin-top: 30px;margin-bottom:50px;border-bottom:  1px solid#E3E3E3;padding:10px;"><i
            class="fas fa-file-contract" style="font-size: 24px;padding-right: 12px" aria-hidden="true"></i>Permssion
          for Stores</h4>
        <div id="jsGrid1"></div>
      </div><br><br>
      <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.css" />
      <link type="text/css" rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid-theme.min.css" />
      <!-- jsGrid JS -->
      <script src="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.js"></script>
      <script>
        $("#jsGrid1").jsGrid({
          height: "auto",
          width: "100%",
          filtering: true,
          editing: true,
          sorting: true,
          paging: true,
          autoload: true,
          pageSize: 5,
          pageButtonCount: 5,
          deleteConfirm: "Do you really want to delete?",
          controller: {
            loadData: function (filter) {
              filter.type = "filter";//EDITED LINE
              return $.ajax({
                type: "GET",
                url: "getrequest1.php",
                data: filter,
                dataType: "json"
              });
            },
            //EDITED BY KINGSHEARTZ
            updateItem: function (item) {
              item.type = "update";//EDITED LINE
              console.log(item)
              return $.ajax({
                type: "POST",
                url: "getrequest1.php",
                data: item,
                dataType: "json",
                timeout: 30000,   //waiting time 30 sec
                success: function (data) {
                  location.href = " request.php";
                },
                error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
                  if (textstatus === "timeout") {
                    swal({
                      title: "Oops!!!",
                      text: "server time out",
                      icon: "error",
                      closeOnClickOutside: false,
                      dangerMode: true,
                      timer: 100,
                    });
                    return;
                  }
                }
              });
            },
            deleteItem: function (item) {
              item.type = "delete";//EDITED LINE
              console.log(item)
              return $.ajax({
                type: "POST",
                url: "getrequest1.php",
                data: item,
                dataType: "json",
                timeout: 30000,   //waiting time 30 sec
                success: function (data) {
                  return;
                },
                error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
                  if (textstatus === "timeout") {
                    swal({
                      title: "Oops!!!",
                      text: "server time out",
                      icon: "error",
                      closeOnClickOutside: false,
                      dangerMode: true,
                      timer: 100,
                    });
                    return;
                  }
                }
              });
              //EDITED BY KINGSHEARTZ
            },
          },
          fields: [{
            name: "product_details_id",
            title: "Id",
            type: "text",
            width: 50,
            editing: false,
            validate: "required"
          },
          {
            name: "item_description_id",
            title: "description_id",
            type: "text",
            width: 100,
            editing: false,
            validate: "required"
          },
          {
            name: "item_name",
            title: "Product",
            type: "text",
            width: 150,
            editing: false,
            validate: "required"
          },
          {
            name: "store_name",
            title: "Store",
            type: "text",
            editing: false,
            width: 100,
            validate: "required"
          },
          {
            name: "permission",
            title: "Permission",
            type: "select",
            items: [{ Name: "", Id: "" }, { Name: "Allow", Id: "1" }, { Name: "Denied", Id: "0" }],
            valueField: "Id",
            textField: "Name"
          },
          {
            type: "control"
          }
          ]
        });
      </script>
      <?php
      require "foot.php";
      ?>
  </div>
</body>