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
      $('#shopsphp').addClass('active');
    </script>
    <style>
      @media print {
        #jsGrid {
          width: 100%;
          overflow: auto;
        }

        .jsgrid-filter-row {
          display: none;
        }

        .jsgrid-cell,
        .jsgrid-header-cell,
        td,
        th {
          overflow: hidden;
        }
      }
    </style>
    <div class="table1">
      <h4 style="margin-top: 30px;margin-bottom:50px;border-bottom:  1px solid#E3E3E3;padding:10px;"><i
          class="fas fa-store-alt" style="font-size: 24px;padding-right: 12px" aria-hidden="true"></i>Stores</h4>
      <script type="text/JavaScript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
      <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.css" />
      <link type="text/css" rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid-theme.min.css" />
      <!-- jsGrid JS -->
      <script src="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.js"></script>
      <!--   <button style="float:right"class="prbt"onclick="$('#jsGrid').print();">Print All</button>-->
      <div id="jsGrid"></div>
    </div>
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid-theme.min.css" />
    <!-- jsGrid JS -->
    <script src="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.js"></script>
    <script>
      $("#jsGrid").jsGrid({
        height: "auto",
        width: "100%",
        filtering: true,
        inserting: false,
        editing: false,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 5,
        pageButtonCount: 5,
        deleteConfirm: "Do you really want to delete?",
        controller: {
          loadData: function (filter) {
            console.log("hdgahgdjagj")
            return $.ajax({
              type: "GET",
              url: "getneworders.php",
              data: filter,
              dataType: "json"
            });
          },
          insertItem: function (item) {
            return $.ajax({
              type: "POST",
              url: "getneworders.php",
              data: item,
              dataType: "json"
            });
          },
          updateItem: function (item) {
            return $.ajax({
              type: "PUT",
              url: "getneworders.php",
              data: item
            });
          },
          deleteItem: function (item) {
            return $.ajax({
              type: "DELETE",
              url: "getneworders.php",
              data: item
            });
          },
        },
        fields: [{
          name: "store_id",
          title: "# Id",
          type: "text",
          //width:80,
          validate: "required"
        },
        {
          name: "store_name",
          title: "Store Name",
          type: "text",
          //width:150,
          validate: "required"
        },
        {
          name: "opening_hours",
          title: "Opening Hours",
          type: "text",
          //width:150,
          validate: "required"
        },
        {
          name: "address",
          title: "Address",
          type: "text",
          // width:150,
          validate: "required"
        },
        {
          name: "status",
          title: "Open/Closed",
          type: "text",
          //width:150,
          validate: "required"
        },
        {
          name: "longitude",
          title: "Longitude",
          type: "text",
          //width:150,
          validate: "required"
        },
        {
          name: "latitude",
          title: "Latitude",
          type: "text",
          // width:150,
          validate: "required"
        },
        ]
      });
    </script>
    <?php
    require "foot.php";
    ?>
  </div>