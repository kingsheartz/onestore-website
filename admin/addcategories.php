<?php
require "head.php";
?>
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid-theme.min.css" />
<!-- jsGrid JS -->
<script src="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.js"></script>
<body>
  <div class="wrapper">
    <?php
    include "head1.php";
    ?>
    <script type="text/javascript">
      $('li').removeClass('active');
      $('#addcategoriesphp').addClass('active');
    </script>
    <div class="table1">
      <h4 style="margin-top: 30px;margin-bottom:50px;border-bottom:  1px solid#E3E3E3;padding:10px;"><i
          class="fas fa-list" style="font-size: 24px;padding-right: 12px" aria-hidden="true"></i>Add Categories</h4>
      <div id="jsGrid"></div>
    </div>
    <br>
    <div class="table1">
      <h4 style="margin-top: 30px;margin-bottom:50px;border-bottom:  1px solid#E3E3E3;padding:10px;"><i
          class="fa fa-list-alt" style="font-size: 24px;padding-right: 12px" aria-hidden="true"></i>Add Subcategories
      </h4>
      <div id="jsGrid1"></div>
    </div>
    <script>
      $("#jsGrid").jsGrid({
        height: "auto",
        width: "100%",
        filtering: true,
        inserting: true,
        editing: true,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 10,
        pageButtonCount: 5,
        deleteConfirm: "Do you really want to delete?",
        controller: {
          loadData: function (filter) {
            filter.type = "filter";//EDITED LINE
            return $.ajax({
              type: "GET",
              url: "getaddcategories.php",
              data: filter,
              dataType: "json"
            });
          },
          //EDITED BY KINGSHEARTZ
          insertItem: function (item) {
            item.type = "insert";//EDITED LINE
            console.log(item)//NOT ESSENTIAL : ARELUM POVO VARO CHEYYINDO NNU NOKKAN
            return $.ajax({
              type: "POST",
              url: "getaddcategories.php",
              data: item,
              dataType: "json",
              timeout: 30000,   //waiting time 30 sec
              success: function (data) {
                location.href = "addcategories.php";
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
          updateItem: function (item) {
            item.type = "update";//EDITED LINE
            console.log(item)
            return $.ajax({
              type: "POST",
              url: "getaddcategories.php",
              data: item,
              dataType: "json",
              timeout: 30000,   //waiting time 30 sec
              success: function (data) {
                location.href = "addcategories.php";
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
              url: "getaddcategories.php",
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
          name: "category_id",
          title: "Category Id",
          type: "text",
          width: 150,
          editing: false
        },
        {
          name: "category_name",
          title: "Categories",
          type: "text",
          width: 150,
          validate: "required"
        },
        {
          type: "control"
        }
        ]
      });
      $("#jsGrid1").jsGrid({
        height: "auto",
        width: "100%",
        filtering: true,
        inserting: true,
        editing: true,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 10,
        pageButtonCount: 5,
        deleteConfirm: "Do you really want to delete?",
        controller: {
          loadData: function (filter) {
            filter.type = "filter";//EDITED LINE
            return $.ajax({
              type: "GET",
              url: "getaddsubcategories.php",
              data: filter,
              dataType: "json"
            });
          },
          //EDITED BY KINGSHEARTZ
          insertItem: function (item) {
            item.type = "insert";//EDITED LINE
            console.log(item)//NOT ESSENTIAL : ARELUM POVO VARO CHEYYINDO NNU NOKKAN
            return $.ajax({
              type: "POST",
              url: "getaddsubcategories.php",
              data: item,
              dataType: "json",
              timeout: 30000,   //waiting time 30 sec
              success: function (data) {
                location.href = "addcategories.php";
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
          updateItem: function (item) {
            item.type = "update";//EDITED LINE
            console.log(item)
            return $.ajax({
              type: "POST",
              url: "getaddsubcategories.php",
              data: item,
              dataType: "json",
              timeout: 30000,   //waiting time 30 sec
              success: function (data) {
                location.href = "addcategories.php";
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
              url: "getaddsubcategories.php",
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
          name: "sub_category_id",
          type: "hidden",
          css: 'hide'
        },
        {
          name: "sub_category_name",
          title: "SubCategories",
          type: "text",
          width: 150,
          validate: "required"
        },
        {
          name: "category_id",
          title: "Category Id",
          type: "text",
          width: 150,
          validate: "required"
        },
        {
          name: "category_name",
          title: "Categories",
          type: "text",
          width: 150,
          editing: false
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
</body>