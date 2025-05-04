<?php
require "head.php";
?>

<body>
  <div class="wrapper">
    <?php
    include "head1.php";
    ?>
    <style>
      .excelbt {
        padding: 10px;
        text-decoration: none;
        color: white;
        border-radius: 5px;
        margin: 10px;
        background: green;
      }

      .pdfbt {
        padding: 10px;
        text-decoration: none;
        color: white;
        border-radius: 5px;
        margin: 10px;
        background: red;
      }
    </style>
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid-theme.min.css" />
    <!-- jsGrid JS -->
    <script src="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.js"></script>
    <div class="table1">
      <h4 style="margin-top: 30px;margin-bottom:50px;border-bottom:  1px solid#E3E3E3;padding:10px;">
        <i class="fas fa-poll" style="font-size: 24px;padding-right: 12px" aria-hidden="true"></i>New Orders
      </h4>
      <div id="jsGrid"></div>
      <br><br>
      <a class="excelbt" href="javascript:void(0);" onclick="printPageArea('jsGrid')">Print to Excel</a>
      <a class="pdfbt" href="javascript:void(0);" onclick="printPage()">Print to PDF</a>
      <br><br>
    </div>
    <script>
      function tblpr() {
        var data = $("#jsGrid").jsGrid("option", "data");
        //var result = JSON.stringify(data);
        console.log(data[0]);
        var p = "";
        p += "<table><tr>\
<th>OrderId</th>\
<th>Product</th>\
<th>Order Date</th>\
<th>Store Name</th>\
<th>Status</th>\
<th>Total Amount</th></tr>\
";
        for (var i = 0; i < data.length; i++) {
          p += "<tr>\
  <th>"+ data[i].new_ordered_products_id + "</th>\
<th>"+ data[i].item_name + "</th>\
<th>"+ data[i].order_date + "</th>\
<th>"+ data[i].store_name + "</th>\
<th>"+ data[i].delivery_status + "</th>\
<th>"+ data[i].total_amt + "</th></tr>";
        }
        p += "</table>";
        return p;
      }
      //Excel printing
      function printPageArea(areaID) {
        p = tblpr();
        window.open('data:application/vnd.ms-excel;base64,' + base64_encode(p));
      }
      function base64_encode(data) {
        var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
          ac = 0,
          enc = "",
          tmp_arr = [];
        if (!data) {
          return data;
        }
        do { // pack three octets into four hexets
          o1 = data.charCodeAt(i++);
          o2 = data.charCodeAt(i++);
          o3 = data.charCodeAt(i++);
          bits = o1 << 16 | o2 << 8 | o3;
          h1 = bits >> 18 & 0x3f;
          h2 = bits >> 12 & 0x3f;
          h3 = bits >> 6 & 0x3f;
          h4 = bits & 0x3f;
          // use hexets to index into b64, and append result to encoded string
          tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
        } while (i < data.length);
        enc = tmp_arr.join('');
        var r = data.length % 3;
        return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
      }
      //pdf printing
      function printPage() {
        p = tblpr();
        var printWin = window.open('', '', 'left=0,top=0,width=1,height=1,toolbar=0,scrollbars=0,status  =0');
        printWin.document.write(p);
        printWin.document.close();
        printWin.focus();
        printWin.print();
        printWin.close();
      }
      $("#jsGrid").jsGrid({
        height: "auto",
        width: "100%",
        filtering: true,
        editing: false,
        sorting: true,
        paging: true,
        autoload: true,
        controller: {
          loadData: function (filter) {
            console.log(filter);
            return $.ajax({
              type: "GET",
              url: "getnewo.php",
              data: filter,
              dataType: "json"
            });
          },
        },
        fields: [
          { name: "new_ordered_products_id", css: 'hidden' },
          { name: "item_name", title: "Product", type: "text", width: 150 },
          { name: "order_date", title: "Ordered Date", type: "text", width: 100 },
          { name: "store_name", title: "Store Name", type: "text", width: 100 },
          { name: "delivery_status", title: "Status", type: "text", width: 100 },
          { name: "total_amt", title: "Total", type: "text", width: 100 },
          {
            type: "control", deleteButton: false, editButton: false
          }
        ]
      });
    </script>
  </div>
  <?php
  require "foot.php";
  ?>