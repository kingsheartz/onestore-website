<?php
require "../Main/header.php";
require "../Common/pdo.php";
if (isset($_GET['item'])) {
  $nm = strtolower($_GET['item']);
  $res = $pdo->query("select category.category_name,item.item_id,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id,sub_category.sub_category_name from item
	        	inner join item_description on item_description.item_id=item.item_id
                inner join product_details on product_details.item_description_id=item_description.item_description_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
        		where item.item_name like \"%$nm%\" and sub_category.sub_category_id=item.sub_category_id");
  $row2 = $res->fetch(PDO::FETCH_ASSOC);
  $name = $row2['item_name'];
  $cat_id = $row2['category_id'];
  $subcat_id = $row2['sub_category_id'];
} else if (isset($_GET['category_id']) && isset($_GET['subcategory_id'])) {
  $cat = $_GET['category_id'];
  $sub = $_GET['subcategory_id'];
  $sql = "select category.category_name,item.item_id,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id,sub_category.sub_category_name from item
	        	inner join item_description on item_description.item_id=item.item_id
                inner join product_details on product_details.item_description_id=item_description.item_description_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
                where category.category_id=$cat and sub_category.sub_category_id=$sub GROUP BY item.item_id order by item.sub_category_id";
  $res = $pdo->query($sql);
  $row2 = $res->fetch(PDO::FETCH_ASSOC);
  $name = $row2['sub_category_name'];
  $cat_id = $row2['category_id'];
  $subcat_id = $row2['sub_category_id'];
} else if (isset($_GET['category_id'])) {
  $cat = $_GET['category_id'];
  $res = $pdo->query("select category.category_name,store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=$cat GROUP BY item.item_id order by item.sub_category_id");
  $row2 = $res->fetch(PDO::FETCH_ASSOC);
  $name = $row2['category_name'];
  $cat_id = $row2['category_id'];
}
?>
<link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
<link href='css/product.css' rel='stylesheet'>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
</style>
<script>
  ///////////////////////////////RESIZE UPTO 635 FLOW CTRLS TO GRID PAGE #SMALL DEVICE PURPOSE/////////////
  if ($(window).width() < 635) {
    <?php
    if (isset($_GET['item'])) {
      ?>
      location.href = '../Product/products_limited.php?item=<?= $_GET['item'] ?>';
      <?php
    } else if (isset($_GET['category_id']) && isset($_GET['subcategory_id'])) {
      ?>
        location.href = '../Product/products_limited.php?category_id=<?= $_GET['category_id'] ?> & subcategory_id=<?= $_GET['subcategory_id'] ?>';
      <?php
    } else if (isset($_GET['category_id'])) {
      ?>
          location.href = '../Product/products_limited.php?category_id=<?= $_GET['category_id'] ?>';
      <?php
    }
    ?>
  }
  ///////////////////////////////RESIZE UPTO 635 FLOW CTRLS TO GRID PAGE #SMALL DEVICE PURPOSE/////////////
  $(window).resize(function () {
    if ($(window).width() < 635) {
      <?php
      if (isset($_GET['item'])) {
        ?>
        location.href = '../Product/products_limited.php?item=<?= $_GET['item'] ?>';
        <?php
      } else if (isset($_GET['category_id']) && isset($_GET['subcategory_id'])) {
        ?>
          location.href = '../Product/products_limited.php?category_id=<?= $_GET['category_id'] ?> & subcategory_id=<?= $_GET['subcategory_id'] ?>';
        <?php
      } else if (isset($_GET['category_id'])) {
        ?>
            location.href = '../Product/products_limited.php?category_id=<?= $_GET['category_id'] ?>';
        <?php
      }
      ?>
    }
  });
  ///////////////////////////////RESIZE UPTO 635 FLOW CTRLS TO GRID PAGE #SMALL DEVICE PURPOSE/////////////
</script>
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
  function getCookieset(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  var url = window.location.href;
  if (sessionStorage.getItem("prev_url") == url) {
    var scrollTop = 'pdtsscrollTop';
  }
  else {
    var scrollTop = 'scroll_begin';
  }
  $(window).unload(function () { document.cookie = 'pdtsscrollTop=' + $(window).scrollTop(); });
  sessionStorage.setItem("prev_url", url);
  //showing onlt mrp at loading
  $(document).ready(function (f) {
    $("#per").hide();
    $("#per2").hide();
    $("#per3").hide();
    sortandfilter('loading', 'initial');
  });
  //showing onlt mrp at loading
  function check_store_select() {
    var tbl = document.getElementById("store");
    var chks = tbl.getElementsByTagName("INPUT");
    var id = 0;
    var flag = 0;
    for (var i = 0; i < chks.length; i++) {
      if (chks[i].checked == true) {
        id = chks[i].value;
        flag = 1;
      }
    }
    if (flag == 0) {
      swal({
        title: "Sorry!!!",
        text: "Select a store",
        icon: "warning",
        closeOnClickOutside: false,
        dangerMode: true,
      })
        .then((willSubmit1) => {
          if (willSubmit1) {
            return;
          }
          else {
            return;
          }
        });
    }
    else {
      var item_description_id = document.getElementById('idid_keeper').value;
      $.ajax({
        url: "../Common/functions.php", //passing page info
        data: { "cart": 1, "item_description_id": item_description_id, "store_id": id },  //form data
        type: "post",   //post data
        dataType: "json",   //datatype=json format
        timeout: 30000,   //waiting time 30 sec
        success: function (data) {    //if registration is success
          if (data.status == 'success') {
            swal({
              title: "Added!!!",
              text: "Check your cart",
              icon: "success",
              closeOnClickOutside: false,
              dangerMode: true,
            })
              .then((willSubmit1) => {
                if (willSubmit1) {
                  document.getElementById("sm-cartcnt").innerHTML = "";
                  document.getElementById("lg-cartcnt").innerHTML = "";
                  document.getElementById("sm-cartcnt").innerHTML = data.cartcnt;
                  document.getElementById("lg-cartcnt").innerHTML = data.cartcnt;
                  return;
                }
                else {
                  return;
                }
              });/*
                      var qnty=document.getElementById("Q"+id+"").innerHTML;
                      if(qnty!=0){
                        document.getElementById("Q"+id+"").innerHTML="";
                        document.getElementById("Q"+id+"").innerHTML=qnty-1;
                      }*/
            var qnty = document.getElementById("dis_qnty").innerHTML;
            if (qnty != 0) {
              document.getElementById("dis_qnty").innerHTML = "";
              document.getElementById("dis_qnty").innerHTML = qnty - 1;
            }
          }
          else if (data.status == 'error') {
            swal({
              title: "Required!!!",
              text: "You need to create an Account",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
            })
              .then((willSubmit) => {
                if (willSubmit) {
                  location.href = "../Account/registered.php";
                  return;
                }
                else {
                  return;
                }
              });
          }
          else if (data.status == 'error1') {
            swal({
              title: "Not Available!!!",
              text: "Choose another Store",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
            })
              .then((willSubmit) => {
                if (willSubmit) {
                  location.href = "../Product/single.php?id=" + item_description_id + "";
                  return;
                }
                else {
                  return;
                }
              });
          }
        },
        error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
          if (textstatus === "timeout") {
            swal({
              title: "Oops!!!",
              text: "server time out",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
              timer: 6000,
            });
            return;
          }
          else { return; }
        }
      }); //closing ajax
      //location.href="../Cart/cart.php?store="+id+"&item=<?//=$row['item_id'] ?>";
    }
  }
  function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("store");
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
      // Start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /* Loop through all table rows (except the
      first, which contains table headers): */
      for (i = 1; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        /* Check if the two rows should switch place,
        based on the direction, asc or desc: */
        if (dir == "asc") {
          if (Number(x.innerHTML) > Number(y.innerHTML)) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (Number(x.innerHTML) < Number(y.innerHTML)) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        // Each time a switch is done, increase this count by 1:
        switchcount++;
      } else {
        /* If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again. */
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ITEM START HERE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
<?php
if (isset($_GET['item'])) {
  ?>
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var filter = [];
    var page_id = 1;
    // Pagination code
    $(document).on("click", ".pagination li a", function (e) {
      e.preventDefault();
      var pageId = $(this).attr("id");
      if ($('#mobile-filter').css("display") == "none") {
        var maxprice = document.getElementById('max-price').value;
        var minprice = document.getElementById('min-price').value;
        var sort = document.getElementById('sortall').value;
        document.getElementById('mobsortall').value = sort;
        document.getElementById('mob-max-price').value = maxprice;
        document.getElementById('mob-min-price').value = minprice;
      }
      else if ($('#mobile-filter').css("display") == "block") {
        var maxprice = document.getElementById('mob-max-price').value;
        var minprice = document.getElementById('mob-min-price').value;
        var sort = document.getElementById('mobsortall').value;
        document.getElementById('sortall').value = sort;
        document.getElementById('max-price').value = maxprice;
        document.getElementById('min-price').value = minprice;
      }
      $(".table-data").empty();
      $("#dynamic-paging").empty();
      $('.background_loader').css('display', 'flex');
      $('.std_text2').css('display', 'flex');
      $.ajax({
        url: "../Common/functions.php", //passing page info
        data: { "filter_item_b": 1, "key": filter, "min-price": minprice, "max-price": maxprice, "page_no": pageId, "sort": sort, "item": '<?= $_GET['item'] ?>' },  //form data
        type: "post",   //post data
        dataType: "json",   //datatype=json format
        timeout: 30000,   //waiting time 30 sec
        success: function (data) {    //if registration is success
          if (data.status == 'success') {
            $("#table-data").html(data.content).show();
            $("#dynamic-paging").html(data.output).show();
            $('.background_loader').hide();
            $('.std_text2').hide();
            return;
          }
        },
        error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
          $('.background_loader').hide();
          $('.std_text2').hide();
          if (textstatus === "timeout") {
            swal({
              title: "Oops!!!",
              text: "server time out",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
              timer: 6000,
            });
            location.reload();
            return;
          }
          else { return; }
        }
      }); //closing ajax
    });
    function sortandfilter(val, type) {
      if ($('#mobile-filter').css("display") == "none") {
        var maxprice = document.getElementById('max-price').value;
        var minprice = document.getElementById('min-price').value;
        var sort = document.getElementById('sortall').value;
        document.getElementById('mobsortall').value = sort;
        document.getElementById('mob-max-price').value = maxprice;
        document.getElementById('mob-min-price').value = minprice;
      }
      else if ($('#mobile-filter').css("display") == "block") {
        var maxprice = document.getElementById('mob-max-price').value;
        var minprice = document.getElementById('mob-min-price').value;
        var sort = document.getElementById('mobsortall').value;
        document.getElementById('sortall').value = sort;
        document.getElementById('max-price').value = maxprice;
        document.getElementById('min-price').value = minprice;
      }
      var filter_tag_cnt = 0;
      var type = type;//TYPE category || brand ||rating
      if (type == 'brand' || type == 'category') {
        var cont = $('.val-' + val).html();//INNER HTML
      }
      if (type == 'star') {
        var cont = $('#' + val).val();
      }
      //alert(type+" is "+cont)
      if ($('#' + val).prop('checked') == false) {
        $('#mob' + val).prop('disabled', false); //enabling radio
        $('#mob' + val).prop('checked', true);    //check radio
        $('#mob' + val).prop('disabled', true);   //disabling radio
        $('#' + val).prop('disabled', false); //enabling radio
        $('#' + val).prop('checked', true);    //check radio
        $('#' + val).prop('disabled', true);   //disabling radio
        $('.filter-container').show();//FILTER DIV UNHIDE
        var newtag = $('#filter-tag').clone().appendTo('.filter-container-child'); //COPY THE DEFAULT TAG DESIGN #FILTER 1 & CREATE NEW
        newtag.addClass('filter-tag-' + type + "-" + val); //ADDING CLASS WITH NAME AS " filter-tag-name-+'type_name'+get(cat || brand)+(sub_category_id || brand_id) "
        if (type == 'brand' || type == 'category') {
          var tag_content = "<label onclick=\"removesortandfilter(\'" + val + "\',\'" + type + "\')\" id=\"filter-tag-name\" class=\"filter-tag-name" + type + "-" + val + " \" style=\"padding-left:0px !important;\" >" + cont + "</label><label onclick=\"removesortandfilter(\'" + val + "\',\'" + type + "\')\" style=\"padding-left:10px !important;\" id=\"filter-tag-close\" class=\"filter-tag-close  filter-tag-close" + type + "-" + val + "\"><span class=\"close\" >&times;</span></label>"; //CONTENT INSIDE THE DIV
          $('.filter-tag-' + type + "-" + val).html(tag_content).show(); //APPENDING INNERHTML TO TAG & DISPLAY
        }
        if (type == 'star') {
          var tag_content = "<label onclick=\"removesortandfilter(\'" + val + "\',\'" + type + "\')\" id=\"filter-tag-name\" class=\"filter-tag-name" + type + "-" + val + " \" style=\"padding-left:0px !important;\" >" + cont + "</label><label onclick=\"removesortandfilter(\'" + val + "\',\'" + type + "\')\" style=\"padding-left:2px !important;\" id=\"filter-tag-close\" class=\"filter-tag-close  filter-tag-close" + type + "-" + val + "\"><span style='padding-right:4px;color:#333' class='fa fa-star'></span><span class=\"close\" >&times;</span></label>"; //CONTENT INSIDE THE DIV
          $('.filter-tag-' + type + "-" + val).html(tag_content).show(); //APPENDING INNERHTML TO TAG & DISPLAY
        }
        filter.push({ type: type + "-" + val + "-" + cont });
        console.log(filter)
        $(".table-data").empty();
        $("#dynamic-paging").empty();
        $('.background_loader').css('display', 'flex');
        $('.std_text2').css('display', 'flex');
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "filter_item_b": 1, "key": filter, "min-price": minprice, "max-price": maxprice, "sort": sort, "item": '<?= $_GET['item'] ?>' },  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            if (data.status == 'success') {
              $("#table-data").html(data.content).show();
              $("#dynamic-paging").html(data.output).show();
              $('.background_loader').hide();
              $('.std_text2').hide();
              return;
            }
          },
          error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            $('.background_loader').hide();
            $('.std_text2').hide();
            if (textstatus === "timeout") {
              swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
      else {
        $(".table-data").empty();
        $("#dynamic-paging").empty();
        $('.background_loader').css('display', 'flex');
        $('.std_text2').css('display', 'flex');
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "filter_item_b": 1, "key": filter, "min-price": minprice, "max-price": maxprice, "sort": sort, "item": '<?= $_GET['item'] ?>' },  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            if (data.status == 'success') {
              $("#table-data").html(data.content).show();
              $("#dynamic-paging").html(data.output).show();
              $('.background_loader').hide();
              $('.std_text2').hide();
              return;
            }
          },
          error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            $('.background_loader').hide();
            $('.std_text2').hide();
            if (textstatus === "timeout") {
              swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
    }
    function removesortandfilter(val, type) {
      if ($('#mobile-filter').css("display") == "none") {
        var maxprice = document.getElementById('max-price').value;
        var minprice = document.getElementById('min-price').value;
        var sort = document.getElementById('sortall').value;
        document.getElementById('mobsortall').value = sort;
        document.getElementById('mob-max-price').value = maxprice;
        document.getElementById('mob-min-price').value = minprice;
      }
      else if ($('#mobile-filter').css("display") == "block") {
        var maxprice = document.getElementById('mob-max-price').value;
        var minprice = document.getElementById('mob-min-price').value;
        var sort = document.getElementById('mobsortall').value;
        document.getElementById('sortall').value = sort;
        document.getElementById('max-price').value = maxprice;
        document.getElementById('min-price').value = minprice;
      }
      var filter_tag_cnt = 0;
      var type = type;//TYPE category || brand ||rating
      if (type == 'brand' || type == 'category') {
        var cont = $('.val-' + val).html();//INNER HTML
      }
      if (type == 'star') {
        var cont = $('#' + val).val();
      }
      $(".filter-tag-" + type + "-" + val).remove();
      if ($('#' + val).prop('checked') == true) {
        $('#mob' + val).prop('disabled', false); //enabling radio
        $('#mob' + val).prop('checked', false);    //check radio
        $('#mob' + val).prop('disabled', true);   //disabling radio
        $('#' + val).prop('disabled', false); //enabling radio
        $('#' + val).prop('checked', false);    //check radio
        $('#' + val).prop('disabled', true);   //disabling radio
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //REMOVING THE TAGS WITH VALUE OF THE KEY
        console.log('Before removing object from an array -> ' + JSON.stringify(filter));
        var removeIndex = filter.map(function (item) { return item.type; }).indexOf(type + "-" + val + "-" + cont)
        console.log(removeIndex)
        filter.splice(removeIndex, 1);
        console.log('After removing object from an array -> ' + JSON.stringify(filter));
        //REMOVING THE TAGS WITH VALUE OF THE KEY
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        console.log(filter)
        $(".table-data").empty();
        $("#dynamic-paging").empty();
        $('.background_loader').css('display', 'flex');
        $('.std_text2').css('display', 'flex');
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "filter_item_b": 1, "key": filter, "min-price": minprice, "max-price": maxprice, "sort": sort, "item": '<?= $_GET['item'] ?>' },  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            if (data.status == 'success') {
              $("#table-data").html(data.content).show();
              $("#dynamic-paging").html(data.output).show();
              $('.background_loader').hide();
              $('.std_text2').hide();
              return;
            }
          },
          error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            $('.background_loader').hide();
            $('.std_text2').hide();
            if (textstatus === "timeout") {
              swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
<?php
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ITEM ENDS HERE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if (isset($_GET['category_id']) && isset($_GET['subcategory_id'])) {
  ?>
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var filter = [];
    var page_id = 1;
    // Pagination code
    $(document).on("click", ".pagination li a", function (e) {
      e.preventDefault();
      var pageId = $(this).attr("id");
      if ($('#mobile-filter').css("display") == "none") {
        var maxprice = document.getElementById('max-price').value;
        var minprice = document.getElementById('min-price').value;
        var sort = document.getElementById('sortall').value;
        document.getElementById('mobsortall').value = sort;
        document.getElementById('mob-max-price').value = maxprice;
        document.getElementById('mob-min-price').value = minprice;
      }
      else if ($('#mobile-filter').css("display") == "block") {
        var maxprice = document.getElementById('mob-max-price').value;
        var minprice = document.getElementById('mob-min-price').value;
        var sort = document.getElementById('mobsortall').value;
        document.getElementById('sortall').value = sort;
        document.getElementById('max-price').value = maxprice;
        document.getElementById('min-price').value = minprice;
      }
      $(".table-data").empty();
      $("#dynamic-paging").empty();
      $('.background_loader').css('display', 'flex');
      $('.std_text2').css('display', 'flex');
      $.ajax({
        url: "../Common/functions.php", //passing page info
        data: { "filter_sub_cat_b": 1, "key": filter, "min-price": minprice, "max-price": maxprice, "page_no": pageId, "sort": sort, "category":<?= $_GET['category_id'] ?>, "sub_category":<?= $_GET['subcategory_id'] ?>},  //form data
        type: "post",   //post data
        dataType: "json",   //datatype=json format
        timeout: 30000,   //waiting time 30 sec
        success: function (data) {    //if registration is success
          if (data.status == 'success') {
            $("#table-data").html(data.content).show();
            $("#dynamic-paging").html(data.output).show();
            $('.background_loader').hide();
            $('.std_text2').hide();
            return;
          }
        },
        error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
          $('.background_loader').hide();
          $('.std_text2').hide();
          if (textstatus === "timeout") {
            swal({
              title: "Oops!!!",
              text: "server time out",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
              timer: 6000,
            });
            location.reload();
            return;
          }
          else { return; }
        }
      }); //closing ajax
    });
    function sortandfilter(val, type) {
      if ($('#mobile-filter').css("display") == "none") {
        var maxprice = document.getElementById('max-price').value;
        var minprice = document.getElementById('min-price').value;
        var sort = document.getElementById('sortall').value;
        document.getElementById('mobsortall').value = sort;
        document.getElementById('mob-max-price').value = maxprice;
        document.getElementById('mob-min-price').value = minprice;
      }
      else if ($('#mobile-filter').css("display") == "block") {
        var maxprice = document.getElementById('mob-max-price').value;
        var minprice = document.getElementById('mob-min-price').value;
        var sort = document.getElementById('mobsortall').value;
        document.getElementById('sortall').value = sort;
        document.getElementById('max-price').value = maxprice;
        document.getElementById('min-price').value = minprice;
      }
      var filter_tag_cnt = 0;
      var type = type;//TYPE category || brand ||rating
      if (type == 'brand' || type == 'category') {
        var cont = $('.val-' + val).html();//INNER HTML
      }
      if (type == 'star') {
        var cont = $('#' + val).val();
      }
      //alert(type+" is "+cont)
      if ($('#' + val).prop('checked') == false) {
        $('#mob' + val).prop('disabled', false); //enabling radio
        $('#mob' + val).prop('checked', true);    //check radio
        $('#mob' + val).prop('disabled', true);   //disabling radio
        $('#' + val).prop('disabled', false); //enabling radio
        $('#' + val).prop('checked', true);    //check radio
        $('#' + val).prop('disabled', true);   //disabling radio
        $('.filter-container').show();//FILTER DIV UNHIDE
        var newtag = $('#filter-tag').clone().appendTo('.filter-container-child'); //COPY THE DEFAULT TAG DESIGN #FILTER 1 & CREATE NEW
        newtag.addClass('filter-tag-' + type + "-" + val); //ADDING CLASS WITH NAME AS " filter-tag-name-+'type_name'+get(cat || brand)+(sub_category_id || brand_id) "
        if (type == 'brand' || type == 'category') {
          var tag_content = "<label onclick=\"removesortandfilter(\'" + val + "\',\'" + type + "\')\" id=\"filter-tag-name\" class=\"filter-tag-name" + type + "-" + val + " \" style=\"padding-left:0px !important;\" >" + cont + "</label><label onclick=\"removesortandfilter(\'" + val + "\',\'" + type + "\')\" style=\"padding-left:10px !important;\" id=\"filter-tag-close\" class=\"filter-tag-close  filter-tag-close" + type + "-" + val + "\"><span class=\"close\" >&times;</span></label>"; //CONTENT INSIDE THE DIV
          $('.filter-tag-' + type + "-" + val).html(tag_content).show(); //APPENDING INNERHTML TO TAG & DISPLAY
        }
        if (type == 'star') {
          var tag_content = "<label onclick=\"removesortandfilter(\'" + val + "\',\'" + type + "\')\" id=\"filter-tag-name\" class=\"filter-tag-name" + type + "-" + val + " \" style=\"padding-left:0px !important;\" >" + cont + "</label><label onclick=\"removesortandfilter(\'" + val + "\',\'" + type + "\')\" style=\"padding-left:2px !important;\" id=\"filter-tag-close\" class=\"filter-tag-close  filter-tag-close" + type + "-" + val + "\"><span style='padding-right:4px;color:#333' class='fa fa-star'></span><span class=\"close\" >&times;</span></label>"; //CONTENT INSIDE THE DIV
          $('.filter-tag-' + type + "-" + val).html(tag_content).show(); //APPENDING INNERHTML TO TAG & DISPLAY
        }
        filter.push({ type: type + "-" + val + "-" + cont });
        console.log(filter)
        $(".table-data").empty();
        $("#dynamic-paging").empty();
        $('.background_loader').css('display', 'flex');
        $('.std_text2').css('display', 'flex');
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "filter_sub_cat_b": 1, "key": filter, "min-price": minprice, "max-price": maxprice, "sort": sort, "category":<?= $_GET['category_id'] ?>, "sub_category":<?= $_GET['subcategory_id'] ?>},  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            if (data.status == 'success') {
              $("#table-data").html(data.content).show();
              $("#dynamic-paging").html(data.output).show();
              $('.background_loader').hide();
              $('.std_text2').hide();
              return;
            }
          },
          error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            $('.background_loader').hide();
            $('.std_text2').hide();
            if (textstatus === "timeout") {
              swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
      else {
        $(".table-data").empty();
        $("#dynamic-paging").empty();
        $('.background_loader').css('display', 'flex');
        $('.std_text2').css('display', 'flex');
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "filter_sub_cat_b": 1, "key": filter, "min-price": minprice, "max-price": maxprice, "sort": sort, "category":<?= $_GET['category_id'] ?>, "sub_category":<?= $_GET['subcategory_id'] ?>},  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            if (data.status == 'success') {
              $("#table-data").html(data.content).show();
              $("#dynamic-paging").html(data.output).show();
              $('.background_loader').hide();
              $('.std_text2').hide();
              return;
            }
          },
          error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            $('.background_loader').hide();
            $('.std_text2').hide();
            if (textstatus === "timeout") {
              swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
    }
    function removesortandfilter(val, type) {
      if ($('#mobile-filter').css("display") == "none") {
        var maxprice = document.getElementById('max-price').value;
        var minprice = document.getElementById('min-price').value;
        var sort = document.getElementById('sortall').value;
        document.getElementById('mobsortall').value = sort;
        document.getElementById('mob-max-price').value = maxprice;
        document.getElementById('mob-min-price').value = minprice;
      }
      else if ($('#mobile-filter').css("display") == "block") {
        var maxprice = document.getElementById('mob-max-price').value;
        var minprice = document.getElementById('mob-min-price').value;
        var sort = document.getElementById('mobsortall').value;
        document.getElementById('sortall').value = sort;
        document.getElementById('max-price').value = maxprice;
        document.getElementById('min-price').value = minprice;
      }
      var filter_tag_cnt = 0;
      var type = type;//TYPE category || brand ||rating
      if (type == 'brand' || type == 'category') {
        var cont = $('.val-' + val).html();//INNER HTML
      }
      if (type == 'star') {
        var cont = $('#' + val).val();
      }
      $(".filter-tag-" + type + "-" + val).remove();
      if ($('#' + val).prop('checked') == true) {
        $('#mob' + val).prop('disabled', false); //enabling radio
        $('#mob' + val).prop('checked', false);    //check radio
        $('#mob' + val).prop('disabled', true);   //disabling radio
        $('#' + val).prop('disabled', false); //enabling radio
        $('#' + val).prop('checked', false);    //check radio
        $('#' + val).prop('disabled', true);   //disabling radio
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //REMOVING THE TAGS WITH VALUE OF THE KEY
        console.log('Before removing object from an array -> ' + JSON.stringify(filter));
        var removeIndex = filter.map(function (item) { return item.type; }).indexOf(type + "-" + val + "-" + cont)
        console.log(removeIndex)
        filter.splice(removeIndex, 1);
        console.log('After removing object from an array -> ' + JSON.stringify(filter));
        //REMOVING THE TAGS WITH VALUE OF THE KEY
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        console.log(filter)
        $(".table-data").empty();
        $("#dynamic-paging").empty();
        $('.background_loader').css('display', 'flex');
        $('.std_text2').css('display', 'flex');
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "filter_sub_cat_b": 1, "key": filter, "min-price": minprice, "max-price": maxprice, "sort": sort, "category":<?= $_GET['category_id'] ?>, "sub_category":<?= $_GET['subcategory_id'] ?>},  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            if (data.status == 'success') {
              $("#table-data").html(data.content).show();
              $("#dynamic-paging").html(data.output).show();
              $('.background_loader').hide();
              $('.std_text2').hide();
              return;
            }
          },
          error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            $('.background_loader').hide();
            $('.std_text2').hide();
            if (textstatus === "timeout") {
              swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
<?php
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if (isset($_GET['category_id'])) {
  ?>
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var filter = [];
    var page_id = 1;
    // Pagination code
    $(document).on("click", ".pagination li a", function (e) {
      e.preventDefault();
      var pageId = $(this).attr("id");
      if ($('#mobile-filter').css("display") == "none") {
        var maxprice = document.getElementById('max-price').value;
        var minprice = document.getElementById('min-price').value;
        var sort = document.getElementById('sortall').value;
        document.getElementById('mobsortall').value = sort;
        document.getElementById('mob-max-price').value = maxprice;
        document.getElementById('mob-min-price').value = minprice;
      }
      else if ($('#mobile-filter').css("display") == "block") {
        var maxprice = document.getElementById('mob-max-price').value;
        var minprice = document.getElementById('mob-min-price').value;
        var sort = document.getElementById('mobsortall').value;
        document.getElementById('sortall').value = sort;
        document.getElementById('max-price').value = maxprice;
        document.getElementById('min-price').value = minprice;
      }
      $(".table-data").empty();
      $("#dynamic-paging").empty();
      $('.background_loader').css('display', 'flex');
      $('.std_text2').css('display', 'flex');
      $.ajax({
        url: "../Common/functions.php", //passing page info
        data: { "filter_cat_b": 1, "key": filter, "min-price": minprice, "max-price": maxprice, "page_no": pageId, "sort": sort, "category":<?= $_GET['category_id'] ?>},  //form data
        type: "post",   //post data
        dataType: "json",   //datatype=json format
        timeout: 30000,   //waiting time 30 sec
        success: function (data) {    //if registration is success
          if (data.status == 'success') {
            $("#table-data").html(data.content).show();
            $("#dynamic-paging").html(data.output).show();
            $('.background_loader').hide();
            $('.std_text2').hide();
            return;
          }
        },
        error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
          $('.background_loader').hide();
          $('.std_text2').hide();
          if (textstatus === "timeout") {
            swal({
              title: "Oops!!!",
              text: "server time out",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
              timer: 6000,
            });
            location.reload();
            return;
          }
          else { return; }
        }
      }); //closing ajax
    });
    function sortandfilter(val, type) {
      if ($('#mobile-filter').css("display") == "none") {
        var maxprice = document.getElementById('max-price').value;
        var minprice = document.getElementById('min-price').value;
        var sort = document.getElementById('sortall').value;
        document.getElementById('mobsortall').value = sort;
        document.getElementById('mob-max-price').value = maxprice;
        document.getElementById('mob-min-price').value = minprice;
      }
      else if ($('#mobile-filter').css("display") == "block") {
        var maxprice = document.getElementById('mob-max-price').value;
        var minprice = document.getElementById('mob-min-price').value;
        var sort = document.getElementById('mobsortall').value;
        document.getElementById('sortall').value = sort;
        document.getElementById('max-price').value = maxprice;
        document.getElementById('min-price').value = minprice;
      }
      var filter_tag_cnt = 0;
      var type = type;//TYPE category || brand ||rating
      if (type == 'brand' || type == 'category') {
        var cont = $('.val-' + val).html();//INNER HTML
      }
      if (type == 'star') {
        var cont = $('#' + val).val();
      }
      //alert(type+" is "+cont)
      if ($('#' + val).prop('checked') == false) {
        $('#mob' + val).prop('disabled', false); //enabling radio
        $('#mob' + val).prop('checked', true);    //check radio
        $('#mob' + val).prop('disabled', true);   //disabling radio
        $('#' + val).prop('disabled', false); //enabling radio
        $('#' + val).prop('checked', true);    //check radio
        $('#' + val).prop('disabled', true);   //disabling radio
        $('.filter-container').show();//FILTER DIV UNHIDE
        var newtag = $('#filter-tag').clone().appendTo('.filter-container-child'); //COPY THE DEFAULT TAG DESIGN #FILTER 1 & CREATE NEW
        newtag.addClass('filter-tag-' + type + "-" + val); //ADDING CLASS WITH NAME AS " filter-tag-name-+'type_name'+get(cat || brand)+(sub_category_id || brand_id) "
        if (type == 'brand' || type == 'category') {
          var tag_content = "<label onclick=\"removesortandfilter(\'" + val + "\',\'" + type + "\')\" id=\"filter-tag-name\" class=\"filter-tag-name" + type + "-" + val + " \" style=\"padding-left:0px !important;\" >" + cont + "</label><label onclick=\"removesortandfilter(\'" + val + "\',\'" + type + "\')\" style=\"padding-left:10px !important;\" id=\"filter-tag-close\" class=\"filter-tag-close  filter-tag-close" + type + "-" + val + "\"><span class=\"close\" >&times;</span></label>"; //CONTENT INSIDE THE DIV
          $('.filter-tag-' + type + "-" + val).html(tag_content).show(); //APPENDING INNERHTML TO TAG & DISPLAY
        }
        if (type == 'star') {
          var tag_content = "<label onclick=\"removesortandfilter(\'" + val + "\',\'" + type + "\')\" id=\"filter-tag-name\" class=\"filter-tag-name" + type + "-" + val + " \" style=\"padding-left:0px !important;\" >" + cont + "</label><label onclick=\"removesortandfilter(\'" + val + "\',\'" + type + "\')\" style=\"padding-left:2px !important;\" id=\"filter-tag-close\" class=\"filter-tag-close  filter-tag-close" + type + "-" + val + "\"><span style='padding-right:4px;color:#333' class='fa fa-star'></span><span class=\"close\" >&times;</span></label>"; //CONTENT INSIDE THE DIV
          $('.filter-tag-' + type + "-" + val).html(tag_content).show(); //APPENDING INNERHTML TO TAG & DISPLAY
        }
        filter.push({ type: type + "-" + val + "-" + cont });
        console.log(filter)
        $(".table-data").empty();
        $("#dynamic-paging").empty();
        $('.background_loader').css('display', 'flex');
        $('.std_text2').css('display', 'flex');
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "filter_cat_b": 1, "key": filter, "min-price": minprice, "max-price": maxprice, "sort": sort, "category":<?= $_GET['category_id'] ?>},  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            if (data.status == 'success') {
              $("#table-data").html(data.content).show();
              $("#dynamic-paging").html(data.output).show();
              $('.background_loader').hide();
              $('.std_text2').hide();
              return;
            }
          },
          error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            $('.background_loader').hide();
            $('.std_text2').hide();
            if (textstatus === "timeout") {
              swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
      else {
        $(".table-data").empty();
        $("#dynamic-paging").empty();
        $('.background_loader').css('display', 'flex');
        $('.std_text2').css('display', 'flex');
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "filter_cat_b": 1, "key": filter, "min-price": minprice, "max-price": maxprice, "sort": sort, "category":<?= $_GET['category_id'] ?>},  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            if (data.status == 'success') {
              $("#table-data").html(data.content).show();
              $("#dynamic-paging").html(data.output).show();
              $('.background_loader').hide();
              $('.std_text2').hide();
              return;
            }
          },
          error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            $('.background_loader').hide();
            $('.std_text2').hide();
            if (textstatus === "timeout") {
              swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
    }
    function removesortandfilter(val, type) {
      if ($('#mobile-filter').css("display") == "none") {
        var maxprice = document.getElementById('max-price').value;
        var minprice = document.getElementById('min-price').value;
        var sort = document.getElementById('sortall').value;
        document.getElementById('mobsortall').value = sort;
        document.getElementById('mob-max-price').value = maxprice;
        document.getElementById('mob-min-price').value = minprice;
      }
      else if ($('#mobile-filter').css("display") == "block") {
        var maxprice = document.getElementById('mob-max-price').value;
        var minprice = document.getElementById('mob-min-price').value;
        var sort = document.getElementById('mobsortall').value;
        document.getElementById('sortall').value = sort;
        document.getElementById('max-price').value = maxprice;
        document.getElementById('min-price').value = minprice;
      }
      var filter_tag_cnt = 0;
      var type = type;//TYPE category || brand ||rating
      if (type == 'brand' || type == 'category') {
        var cont = $('.val-' + val).html();//INNER HTML
      }
      if (type == 'star') {
        var cont = $('#' + val).val();
      }
      $(".filter-tag-" + type + "-" + val).remove();
      if ($('#' + val).prop('checked') == true) {
        $('#mob' + val).prop('disabled', false); //enabling radio
        $('#mob' + val).prop('checked', false);    //check radio
        $('#mob' + val).prop('disabled', true);   //disabling radio
        $('#' + val).prop('disabled', false); //enabling radio
        $('#' + val).prop('checked', false);    //check radio
        $('#' + val).prop('disabled', true);   //disabling radio
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //REMOVING THE TAGS WITH VALUE OF THE KEY
        console.log('Before removing object from an array -> ' + JSON.stringify(filter));
        var removeIndex = filter.map(function (item) { return item.type; }).indexOf(type + "-" + val + "-" + cont)
        console.log(removeIndex)
        filter.splice(removeIndex, 1);
        console.log('After removing object from an array -> ' + JSON.stringify(filter));
        //REMOVING THE TAGS WITH VALUE OF THE KEY
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        console.log(filter)
        $(".table-data").empty();
        $("#dynamic-paging").empty();
        $('.background_loader').css('display', 'flex');
        $('.std_text2').css('display', 'flex');
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "filter_cat_b": 1, "key": filter, "min-price": minprice, "max-price": maxprice, "sort": sort, "category":<?= $_GET['category_id'] ?>},  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            if (data.status == 'success') {
              $("#table-data").html(data.content).show();
              $("#dynamic-paging").html(data.output).show();
              $('.background_loader').hide();
              $('.std_text2').hide();
              return;
            }
          },
          error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            $('.background_loader').hide();
            $('.std_text2').hide();
            if (textstatus === "timeout") {
              swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
<?php
}
?>
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>
<!--------------------------------------------------------------------------------------------------------------->
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<?php
$result_cnt = $res->rowCount();
if ($result_cnt == 0) {
  ?>
<!-- breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container" style="width:100%;">
      <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
        <li><a href="../Main/onestore.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
        <li class="active">Products</li>
      </ol>
    </div>
  </div>
  <!-- //breadcrumbs -->
  <div class="container" style="padding-top:100px;padding-bottom:100px;margin: 0;width: 100%;">
    <?php
} else {
  ?>
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
      <div class="container" style="width:100%">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
          <li><a href="../Main/onestore.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a>
          </li>
          <li class="active">Search results <span class='fa fa-search'></span></li>
        </ol>
      </div>
    </div>
    <!-- //breadcrumbs -->
    <div class="container" style="padding: 0;margin: 0;width: 100%;">
      <?php
}
?>
    <div class="row no_padding">
      <div class="col-xs-12 col-md-12 col-sm-12">
        <?php
        $result_cnt = $res->rowCount();
        if ($result_cnt == 0) {
          ?>
          <div class="product-content-right">
            <center><img style="justify-content: center;" class="sidebar-title"
                src="../../images/logo/error-no-search.png">
              <h2 class="sidebar-title" style="text-align: center;color:#2d70ff;display: inline-flex;font-weight: 600;">No
                result found</h2>
            </center>
          </div>
          <center style="margin-bottom:0px;margin-top: 50px;">
            <h4>Can't find requested product ?<a href="../Main/onestore.php"> Try again!</a></h4>
          </center>
          <?php
        } else {
          ?>
          <div class="wrapper hide_nav_small" style="margin: 0;width: 100% !important;">
            <div class="d-md-flex align-items-md-center" style="width: 100%;">
              <?php
              if (isset($_GET['item'])) {
                ?>
                <div class="h3" style="font-family: 'Poppins', sans-serif">Search results <span class='fa fa-search'></span>
                </div>
                <?php
              } else {
                ?>
                <div class="h3" style="font-family: 'Poppins', sans-serif"><?= $name ?></div>
                <?php
              }
              ?>
              <div class="ml-auto d-flex align-items-center views">
                <?php
                if (isset($_GET['item'])) {
                  ?>
                  <span class="btn-pdt_pg gridview"
                    onclick="location.href='../Product/products_limited.php?item=<?= $_GET['item'] ?>'"> &nbsp; <span
                      class="fas fa-th px-md-2 px-1"></span><span class="px-md-2 px-1">Grid view</span></span>
                  <?php
                } else if (isset($_GET['category_id']) && isset($_GET['subcategory_id'])) {
                  ?>
                    <span class="btn-pdt_pg gridview"
                      onclick="location.href='../Product/products_limited.php?category_id=<?= $_GET['category_id'] ?> & subcategory_id=<?= $_GET['subcategory_id'] ?>'">
                      &nbsp; <span class="fas fa-th px-md-2 px-1"></span><span class="px-md-2 px-1">Grid view</span></span>
                  <?php
                } else if (isset($_GET['category_id'])) {
                  ?>
                      <span class="btn-pdt_pg gridview"
                        onclick="location.href='../Product/products_limited.php?category_id=<?= $_GET['category_id'] ?>'">
                        &nbsp;
                        <span class="fas fa-th px-md-2 px-1"></span><span class="px-md-2 px-1">Grid view</span></span>
                  <?php
                }
                ?>
                <span class="btn-pdt_pg listview"> &nbsp; <span class="fas fa-list-ul text-success"></span><span
                    class="px-md-2 px-1">List view</span> </span>
                <span class="green-label px-md-2 px-1"><?= $result_cnt ?></span> <span class="text-muted">Products</span>
              </div>
            </div>
          </div>
          <hr class="make_divb">
          <div class="col-md-12 col-sm-12 col-xs-12" style="background-color: #f1f3f6;padding:0;">
            <!--FILTER-->
            <div class="col-md-3 sidebar_divider no_margin"
              style="padding:0;padding-bottom: 0px;margin-top:10px;border-radius: 5px;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63));">
              <div class="container"
                style="margin:0;padding:0;padding-top: 15px;padding-bottom: 15px;width: 100%;height: auto;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #01222b)) !important;">
                <div class="text-muted filter-label" style="padding-left: 15px;color:#ddd !important;font-size:20px;">
                  <b>Filters</b>
                </div>
                <div class="row filter-container" style="margin:0;padding:0;display:none">
                  <div class="col-12 filter-container-child" style="margin:0;padding:0;">
                    <!--FILTER TICKES-->
                    <div id="filter-tag"
                      class="form-inline filter-tag d-flex align-items-center my-2 checkbox bg-light border mx-lg-2 filter-ticket"
                      style="display:none !important;float: left;margin:0px;max-width:max-content;padding-top: 3px;padding-bottom:3px;">
                    </div>
                  </div>
                </div>
              </div>
              <div style="clear: both;"></div>
              <hr style="margin-top: 0px;margin-bottom: -10px;">
              <div class="filters" style="margin-right:0px;"> <button
                  style="display: block;border-color:#002b41;outline:#0c99cc;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;margin-bottom:0px;height:40px;border-radius:5px"
                  class="btn-pdt_pg btn-success" type="button" data-toggle="collapse" data-target="#mobile-filter"
                  aria-expanded="false" aria-controls="mobile-filter"><span class="px-1 fas fa-list"></span><span
                    class="px-1 fas fa-filter fa-lg"></span></button>
              </div>
              <div style="clear: both;"></div>
              <div id="mobile-filter" class="collapse">
                <div class="d-lg-flex align-items-lg-center pt-2 small-sort-select"
                  style="padding-bottom: 5px;margin-top: -15px;">
                  <!--LABEL TICKES-->
                  <!--<div class="form-inline d-flex align-items-center my-2 checkbox bg-light border mx-lg-2"> <label class="tick">Farm <input type="checkbox" checked="checked"> <span class="check"></span> </label> <span class="text-success px-2 count"> 328</span> </div>-->
                  <div class="checkbox bg-light border "
                    style="display: flex;align-items: center;justify-content: center;padding-left: 10px !important;width:100% !important;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;border-radius: 5px;">
                    <select id="mobsortall" class="frm-field required sect"
                      style="font-family: 'Poppins', sans-serif;height: 22px;font-size: 13px;display: flex;padding:0;border: none;width:100%;background-color: transparent;background-color: transparent;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;outline:none;color:white"
                      onchange="sortandfilter('getsort','sort')">
                      <option value="default"><i class="fa fa-arrow-right" aria-hidden="true"></i>Default sorting</option>
                      <option value="high"><i class="fa fa-arrow-right" aria-hidden="true"></i>Price high to low</option>
                      <option value="low"><i class="fa fa-arrow-right" aria-hidden="true"></i>Price low to high</option>
                      <option value="view"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by popularity</option>
                    </select>
                  </div>
                </div>
                <?php
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if (isset($_GET['category_id']) && !isset($_GET['subcategory_id'])) {
                  ?>
                  <div class="py-3 side-nav-filters-head">
                    <h5 data-toggle="collapse" data-target="#cat-filter-mob" aria-expanded="false"
                      aria-controls="cat-filter-mob" class="font-weight-bold side-nav-filters"
                      style="width: 100%;color:white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #01222b)) !important;"
                      onclick="if($('.cat-right').css('display')=='none'){$('.cat-right').show();$('.cat-down').hide();}else{$('.cat-right').hide();$('.cat-down').show();}">
                      Categories<i class="fa fa-angle-down cat-right" style="float: right;padding-right:5px"></i><i
                        class="fa fa-angle-up cat-down"
                        style="float: right;display: none;padding-right:5px;border-bottom:none;"></i></h5>
                    <ul id="cat-filter-mob" class="list-group collapse" style="margin-bottom: 0px; ">
                      <?php
                      $getcat = "select sub_category_name,sub_category_id from sub_category where category_id=" . $_GET['category_id'];
                      $getcat_stmt = $pdo->query($getcat);
                      while ($getcat_row = $getcat_stmt->fetch(PDO::FETCH_ASSOC)) {
                        $getsubcatqnty = "SELECT count(item_description.item_description_id) as qntycnt  from item
        		inner join item_description on item_description.item_id=item.item_id
				    inner join product_details  on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on item.sub_category_id= sub_category.sub_category_id
            where category.category_id=(" . $_GET['category_id'] . ") AND sub_category.sub_category_id IN (" . $getcat_row['sub_category_id'] . ")
 				GROUP BY item.item_id AND item.sub_category_id IN (" . $getcat_row['sub_category_id'] . ")";
                        $getsubcatqnty_stmt = $pdo->query($getsubcatqnty);
                        $getsubcatqnty_row = $getsubcatqnty_stmt->fetch(PDO::FETCH_ASSOC);
                        if ($getsubcatqnty_row == false) {
                          $getsubcatqnty_row['qntycnt'] = 0;
                        }
                        ?>
                        <li onclick="sortandfilter('getcat-<?= $getcat_row['sub_category_id'] ?>','category')"
                          class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category cat-font  getcat-<?= $getcat_row['sub_category_id'] ?>"
                          style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;color:#ddd ">
                          <label class="options"
                            style="display:flex;justify-content:center;align-items:center;margin-top:3px;"><span
                              class="val-getcat-<?= $getcat_row['sub_category_id'] ?>"><?= $getcat_row['sub_category_name'] ?></span><input
                              value="<?= $getcat_row['sub_category_name'] ?>"
                              id="mobgetcat-<?= $getcat_row['sub_category_id'] ?>" type="radio" disabled
                              name="mob-radio-getcat-<?= $getcat_row['sub_category_id'] ?>"> <span class="checkmark"></span>
                          </label><span class="badge badge-primary badge-pill"><?= $getsubcatqnty_row['qntycnt'] ?></span>
                        </li>
                        <?php
                      }
                      ?>
                    </ul>
                  </div>
                  <?php
                }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if (isset($_GET['category_id']) || isset($_GET['subcategory_id']) || isset($_GET['item'])) {
                  if (isset($_GET['item'])) {
                    $brandsql = "select brand.brand_name,brand.brand_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN brand ON item_description.brand=brand.brand_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where item.item_name like '%" . $_GET['item'] . "%' GROUP BY brand.brand_name";
                  } else if (isset($_GET['category_id']) || isset($_GET['subcategory_id'])) {
                    if (isset($_GET['subcategory_id'])) {
                      $keeper = 'item.sub_category_id';
                      $brandval = $_GET['subcategory_id'];
                    } else if (isset($_GET['category_id'])) {
                      $keeper = 'item.category_id';
                      $brandval = $_GET['category_id'];
                    }
                    $brandsql = "select brand.brand_name,brand.brand_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN brand ON item_description.brand=brand.brand_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where " . $keeper . " IN (" . $brandval . ") GROUP BY brand.brand_name";
                  }
                  $brandstmt = $pdo->query($brandsql);
                  $brandcnt = $brandstmt->rowCount();
                  if ($brandcnt > 0) {
                    ?>
                    <div class="py-3 side-nav-filters-head">
                      <h5 data-toggle="collapse" data-target="#brand-filter-mob" aria-expanded="false"
                        aria-controls="brand-filter-mob" class="font-weight-bold side-nav-filters"
                        style="width: 100%;color:white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #01222b)) !important;"
                        onclick="if($('.brand-right').css('display')=='none'){$('.brand-right').show();$('.brand-down').hide();}else{$('.brand-right').hide();$('.brand-down').show();}">
                        Brands<i class="fa fa-angle-down brand-right" style="float: right;padding-right:5px"></i><i
                          class="fa fa-angle-up brand-down" style="float: right;display: none;padding-right:5px"></i></h5>
                      <form class="brand collapse" id="brand-filter-mob" style="">
                        <?php
                        while ($getbrand_row = $brandstmt->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                          <li onclick="sortandfilter('getbrand-<?= $getbrand_row['brand_id'] ?>','brand')"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category brand-font  getbrand-<?= $getbrand_row['brand_id'] ?>"
                            style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;color:#ddd ">
                            <label class="options"
                              style="display:flex;justify-content:center;align-items:center;margin-top:3px;"><span
                                class="val-getbrand-<?= $getbrand_row['brand_id'] ?>"><?= $getbrand_row['brand_name'] ?></span><input
                                value="<?= $getbrand_row['brand_id'] ?>" id="mobgetbrand-<?= $getbrand_row['brand_id'] ?>"
                                type="radio" disabled name="mob-radio-getbrand-<?= $getbrand_row['brand_id'] ?>"> <span
                                class="checkmark"></span> </label>
                          </li>
                          <?php
                        }
                        ?>
                      </form>
                    </div>
                    <?php
                  }
                }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                ?>
                <div class="py-3 side-nav-filters-head">
                  <h5 data-toggle="collapse" data-target="#rating-filter-mob" aria-expanded="false"
                    aria-controls="rating-filter-mob" class="font-weight-bold side-nav-filters"
                    style="width: 100%;color:white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #01222b)) !important;"
                    onclick="if($('.rating-right').css('display')=='none'){$('.rating-right').show();$('.rating-down').hide();}else{$('.rating-right').hide();$('.rating-down').show();}">
                    Rating <i class="fa fa-angle-down rating-right" style="float: right;padding-right:5px"></i><i
                      class="fa fa-angle-up rating-down" style="float: right;display: none;padding-right:5px"></i></h5>
                  <form class="rating collapse" id="rating-filter-mob" style="">
                    <div class="form-inline star-font align-items-center py-2"
                      onclick="sortandfilter('getstar-5','star')">
                      <label class="tick">
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star"></span>
                        <input type="checkbox" id="mobgetstar-5" disabled value="5">
                        <span class="check"></span>
                      </label>
                    </div>
                    <div class="form-inline star-font align-items-center py-2"
                      onclick="sortandfilter('getstar-4','star')">
                      <label class="tick">
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star px-1 text-muted"></span>
                        <input type="checkbox" id="mobgetstar-4" disabled value="4">
                        <span class="check"></span>
                      </label>
                    </div>
                    <div class="form-inline star-font align-items-center py-2"
                      onclick="sortandfilter('getstar-3','star')">
                      <label class="tick">
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star px-1 text-muted"></span>
                        <span class="fas fa-star px-1 text-muted"></span>
                        <input type="checkbox" id="mobgetstar-3" disabled value="3">
                        <span class="check"></span>
                      </label>
                    </div>
                    <div class="form-inline star-font align-items-center py-2"
                      onclick="sortandfilter('getstar-2','star')">
                      <label class="tick">
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star px-1 text-muted"></span>
                        <span class="fas fa-star px-1 text-muted"></span>
                        <span class="fas fa-star px-1 text-muted"></span>
                        <input type="checkbox" id="mobgetstar-2" disabled value="2">
                        <span class="check"></span>
                      </label>
                    </div>
                    <div class="form-inline star-font align-items-center py-2"
                      onclick="sortandfilter('getstar-1','star')">
                      <label class="tick">
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star px-1 text-muted"></span>
                        <span class="fas fa-star px-1 text-muted"></span>
                        <span class="fas fa-star px-1 text-muted"></span>
                        <span class="fas fa-star px-1 text-muted"></span>
                        <input type="checkbox" id="mobgetstar-1" disabled value="1">
                        <span class="check"></span>
                      </label>
                    </div>
                  </form>
                </div>
                <?php
                $pricesql = $pdo->query("select product_details.price FROM product_details
join item_description on item_description.item_description_id=product_details.item_description_id
join item on item_description.item_id=item.item_id
where category_id=$cat_id");
                $pricecnt = 0;
                while ($pricerow = $pricesql->fetch(PDO::FETCH_ASSOC)) {
                  $pricearray[$pricecnt] = $pricerow['price'];
                  $pricecnt++;
                }
                $maxprice = max($pricearray);
                $minprice = min($pricearray);
                $maxpricelen = strlen($maxprice);
                $minpricelen = strlen($minprice);
                ?>
                <div class="py-3 side-nav-filters-head">
                  <h5 data-toggle="collapse" data-target="#mob-pricing-filter" aria-expanded="false"
                    aria-controls="mob-pricing-filter" class="font-weight-bold side-nav-filters"
                    style="width: 100%;color:white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #01222b)) !important;"
                    onclick="if($('.pricing-right').css('display')=='none'){$('.pricing-right').show();$('.pricing-down').hide();}else{$('.pricing-right').hide();$('.pricing-down').show();}">
                    Price <i class="fa fa-angle-down pricing-right" style="float: right;padding-right:5px"></i><i
                      class="fa fa-angle-up pricing-down" style="float: right;display: none;padding-right:5px"></i></h5>
                  <form class=" pricing collapse range-field my-5" id="mob-pricing-filter" style="margin:5px !important">
                    <div class="div-wrapper">
                      <label>
                        <h2 style="margin:0px;"><span class="badge blue lighten-2 mb-4">Minimum</span></h2>
                        <select style="width: 100%;height:40px" class="min-price" id="mob-min-price"
                          onchange="sortandfilter('getprice','price')">
                          <option><?= $minprice ?></option>
                          <?php
                          $divident = 10;
                          for ($j = 1; $j < $minpricelen; $j++) {
                            $divident .= 0;
                          }
                          ?>
                          <?php
                          $divident = (int) $divident;
                          $cnt = $maxprice / $divident;
                          for ($i = 1; $i < $cnt; $i++) {
                            if ($divident * $i > $minprice and $divident * $i < $maxprice) {
                              $pricelist = $divident * $i;
                            }
                            ?>
                            <option><?= $pricelist ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </label>
                      <label>
                        <h2 style="margin:0px;"><span class="badge blue lighten-2 mb-4">Maximum</span></h2>
                        <select style="width: 100%;height:40px" class="max-price" id="mob-max-price"
                          onchange="sortandfilter('getprice','price')">
                          <option><?= $maxprice ?></option>
                          <?php
                          $divident = 10;
                          for ($j = 1; $j < $minpricelen; $j++) {
                            $divident .= 0;
                          }
                          ?>
                          <?php
                          $divident = (int) $divident;
                          $cnt = $maxprice / $divident;
                          for ($i = 1; $i < $cnt; $i++) {
                            if ($divident * $i > $minprice and $divident * $i < $maxprice) {
                              $pricelist = $divident * $i;
                            }
                            ?>
                            <option><?= $pricelist ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </label>
                    </div>
                  </form>
                </div>
              </div>
              <div class="content py-md-0 py-3" style="width: 100%;padding: 0px !important;">
                <section id="sidebar" style="width: 100%;">
                  <!--DEFAULT FILTERS-->
                  <div class=" align-items-lg-center pt-2" style="padding-bottom: 0px;margin-top:15px !important">
                    <div class="form-inline d-flex align-items-center my-2 checkbox bg-light border mx-lg-2"
                      style="display: flex;align-items: center;justify-content: center;padding-left: 10px !important;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;">
                      <select id="sortall" class="frm-field required sect"
                        style="font-family: 'Poppins', sans-serif;height: 22px;font-size: 13px;display: flex;padding:0;border: none;width:100%;background-color: transparent;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;outline:none;color:white"
                        onchange="sortandfilter('getsort','sort')">
                        <option value="default"><i class="fa fa-arrow-right" aria-hidden="true"></i>Default sorting
                        </option>
                        <option value="high"><i class="fa fa-arrow-right" aria-hidden="true"></i>Price high to low
                        </option>
                        <option value="low"><i class="fa fa-arrow-right" aria-hidden="true"></i>Price low to high</option>
                        <option value="view"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by popularity
                        </option>
                      </select>
                    </div>
                  </div>
                  <!--DEFAULT FILTERS-->
                  <hr style="margin-top: 15px;margin-bottom: 1px;">
                  <?php
                  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                  if (isset($_GET['category_id']) && !isset($_GET['subcategory_id'])) {
                    ?>
                    <div class="py-3 side-nav-filters-head">
                      <h5 data-toggle="collapse" data-target="#cat-filter" aria-expanded="false" aria-controls="cat-filter"
                        class="font-weight-bold side-nav-filters"
                        style="width: 100%;color:white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #01222b)) !important;"
                        onclick="if($('.cat-right').css('display')=='none'){$('.cat-right').show();$('.cat-down').hide();}else{$('.cat-right').hide();$('.cat-down').show();}">
                        Categories<i class="fa fa-angle-down cat-right" style="float: right;padding-right:5px"></i><i
                          class="fa fa-angle-up cat-down" style="float: right;display: none;padding-right:5px"></i></h5>
                      <ul id="cat-filter" class="list-group collapse" style="margin-bottom: 0px;">
                        <?php
                        $getcat = "select sub_category_name,sub_category_id from sub_category where category_id=" . $_GET['category_id'];
                        $getcat_stmt = $pdo->query($getcat);
                        while ($getcat_row = $getcat_stmt->fetch(PDO::FETCH_ASSOC)) {
                          $getsubcatqnty = "SELECT count(item_description.item_description_id) as qntycnt  from item
        		inner join item_description on item_description.item_id=item.item_id
				    inner join product_details  on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on item.sub_category_id= sub_category.sub_category_id
            where category.category_id=(" . $_GET['category_id'] . ") AND sub_category.sub_category_id IN (" . $getcat_row['sub_category_id'] . ")
 				GROUP BY item.item_id AND item.sub_category_id IN (" . $getcat_row['sub_category_id'] . ")";
                          $getsubcatqnty_stmt = $pdo->query($getsubcatqnty);
                          $getsubcatqnty_row = $getsubcatqnty_stmt->fetch(PDO::FETCH_ASSOC);
                          if ($getsubcatqnty_row == false) {
                            $getsubcatqnty_row['qntycnt'] = 0;
                          }
                          ?>
                          <li onclick="sortandfilter('getcat-<?= $getcat_row['sub_category_id'] ?>','category')"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category cat-font  getcat-<?= $getcat_row['sub_category_id'] ?>"
                            style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;color:#ddd ">
                            <label style="display:flex;justify-content:center;align-items:center;margin-top:3px;"
                              class="options"><span
                                class="val-getcat-<?= $getcat_row['sub_category_id'] ?>"><?= $getcat_row['sub_category_name'] ?></span><input
                                value="<?= $getcat_row['sub_category_name'] ?>"
                                id="getcat-<?= $getcat_row['sub_category_id'] ?>" type="radio" disabled
                                name="radio-getcat-<?= $getcat_row['sub_category_id'] ?>"> <span class="checkmark"></span>
                            </label><span class="badge badge-primary badge-pill"><?= $getsubcatqnty_row['qntycnt'] ?></span>
                          </li>
                          <?php
                        }
                        ?>
                      </ul>
                    </div>
                    <?php
                  }
                  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                  if (isset($_GET['category_id']) || isset($_GET['subcategory_id']) || isset($_GET['item'])) {
                    if (isset($_GET['item'])) {
                      $brandsql = "select brand.brand_name,brand.brand_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN brand ON item_description.brand=brand.brand_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where item.item_name like '%" . $_GET['item'] . "%' GROUP BY brand.brand_name";
                    } else if (isset($_GET['category_id']) || isset($_GET['subcategory_id'])) {
                      if (isset($_GET['subcategory_id'])) {
                        $keeper = 'item.sub_category_id';
                        $brandval = $_GET['subcategory_id'];
                      } else if (isset($_GET['category_id'])) {
                        $keeper = 'item.category_id';
                        $brandval = $_GET['category_id'];
                      }
                      $brandsql = "select brand.brand_name,brand.brand_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN brand ON item_description.brand=brand.brand_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where " . $keeper . " IN (" . $brandval . ") GROUP BY brand.brand_name";
                    }
                    $brandstmt = $pdo->query($brandsql);
                    $brandcnt = $brandstmt->rowCount();
                    if ($brandcnt > 0) {
                      ?>
                      <div class="py-3 side-nav-filters-head">
                        <h5 data-toggle="collapse" data-target="#brand-filter" aria-expanded="false"
                          aria-controls="brand-filter" class="font-weight-bold side-nav-filters"
                          style="width: 100%;color:white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #01222b)) !important;"
                          onclick="if($('.brand-right').css('display')=='none'){$('.brand-right').show();$('.brand-down').hide();}else{$('.brand-right').hide();$('.brand-down').show();}">
                          Brands <i class="fa fa-angle-down brand-right" style="float: right;padding-right:5px"></i><i
                            class="fa fa-angle-up brand-down" style="float: right;display: none;padding-right:5px"></i></h5>
                        <ul id="brand-filter" class="list-group collapse" style="margin-bottom: 0px;">
                          <?php
                          while ($getbrand_row = $brandstmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <li onclick="sortandfilter('getbrand-<?= $getbrand_row['brand_id'] ?>','brand')"
                              class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category brand-font  getbrand-<?= $getbrand_row['brand_id'] ?>"
                              style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;color:#ddd ">
                              <label class="options"
                                style="display:flex;justify-content:center;align-items:center;margin-top:3px;"><span
                                  class="val-getbrand-<?= $getbrand_row['brand_id'] ?>"><?= $getbrand_row['brand_name'] ?></span><input
                                  value="<?= $getbrand_row['brand_id'] ?>" id="getbrand-<?= $getbrand_row['brand_id'] ?>"
                                  type="radio" disabled name="radio-getbrand-<?= $getbrand_row['brand_id'] ?>"> <span
                                  class="checkmark"></span> </label>
                            </li>
                            <?php
                          }
                          ?>
                        </ul>
                      </div>
                      <?php
                    }
                  }
                  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                  ?>
                  <div class="py-3 side-nav-filters-head">
                    <h5 data-toggle="collapse" data-target="#rating-filter" aria-expanded="false"
                      aria-controls="rating-filter" class="font-weight-bold side-nav-filters"
                      style="width: 100%;color:white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #01222b)) !important;"
                      onclick="if($('.rating-right').css('display')=='none'){$('.rating-right').show();$('.rating-down').hide();}else{$('.rating-right').hide();$('.rating-down').show();}">
                      Rating <i class="fa fa-angle-down rating-right" style="float: right;padding-right:5px"></i><i
                        class="fa fa-angle-up rating-down" style="float: right;display: none;padding-right:5px"></i></h5>
                    <form class="rating collapse" id="rating-filter" style="">
                      <div class="form-inline star-font align-items-center py-2"
                        onclick="sortandfilter('getstar-5','star')">
                        <label class="tick">
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star"></span>
                          <input type="checkbox" id="getstar-5" disabled value="5">
                          <span class="check"></span>
                        </label>
                      </div>
                      <div class="form-inline star-font align-items-center py-2"
                        onclick="sortandfilter('getstar-4','star')">
                        <label class="tick">
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star px-1 text-muted"></span>
                          <input type="checkbox" id="getstar-4" disabled value="4">
                          <span class="check"></span>
                        </label>
                      </div>
                      <div class="form-inline star-font align-items-center py-2"
                        onclick="sortandfilter('getstar-3','star')">
                        <label class="tick">
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star px-1 text-muted"></span>
                          <span class="fas fa-star px-1 text-muted"></span>
                          <input type="checkbox" id="getstar-3" disabled value="3">
                          <span class="check"></span>
                        </label>
                      </div>
                      <div class="form-inline star-font align-items-center py-2"
                        onclick="sortandfilter('getstar-2','star')">
                        <label class="tick">
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star px-1 text-muted"></span>
                          <span class="fas fa-star px-1 text-muted"></span>
                          <span class="fas fa-star px-1 text-muted"></span>
                          <input type="checkbox" id="getstar-2" disabled value="2">
                          <span class="check"></span>
                        </label>
                      </div>
                      <div class="form-inline star-font align-items-center py-2"
                        onclick="sortandfilter('getstar-1','star')">
                        <label class="tick">
                          <span class="fas fa-star"></span>
                          <span class="fas fa-star px-1 text-muted"></span>
                          <span class="fas fa-star px-1 text-muted"></span>
                          <span class="fas fa-star px-1 text-muted"></span>
                          <span class="fas fa-star px-1 text-muted"></span>
                          <input type="checkbox" id="getstar-1" disabled value="1">
                          <span class="check"></span>
                        </label>
                      </div>
                    </form>
                  </div>
                  <div class="py-3 side-nav-filters-head">
                    <h5 data-toggle="collapse" data-target="#pricing-filter" aria-expanded="false"
                      aria-controls="pricing-filter" class="font-weight-bold side-nav-filters"
                      style="width: 100%;color:white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #01222b)) !important;"
                      onclick="if($('.pricing-right').css('display')=='none'){$('.pricing-right').show();$('.pricing-down').hide();}else{$('.pricing-right').hide();$('.pricing-down').show();}">
                      Price <i class="fa fa-angle-down pricing-right" style="float: right;padding-right:5px"></i><i
                        class="fa fa-angle-up pricing-down" style="float: right;display: none;padding-right:5px"></i></h5>
                    <form class=" pricing collapse range-field my-5" id="pricing-filter" style="margin:5px !important">
                      <div class="div-wrapper">
                        <label>
                          <h2 style="margin:0px;"><span class="badge blue lighten-2 mb-4">Minimum</span></h2>
                          <select style="width: 100%;height:35px" class="min-price" id="min-price"
                            onchange="sortandfilter('getprice','price')">
                            <option><?= $minprice ?></option>
                            <?php
                            $divident = 10;
                            for ($j = 1; $j < $minpricelen; $j++) {
                              $divident .= 0;
                            }
                            ?>
                            <?php
                            $divident = (int) $divident;
                            $cnt = $maxprice / $divident;
                            for ($i = 1; $i < $cnt; $i++) {
                              if ($divident * $i > $minprice and $divident * $i < $maxprice) {
                                $pricelist = $divident * $i;
                              }
                              ?>
                              <option><?= $pricelist ?></option>
                              <?php
                            }
                            ?>
                          </select>
                        </label>
                        <label>
                          <h2 style="margin:0px;"><span class="badge blue lighten-2 mb-4">Maximum</span></h2>
                          <select style="width: 100%;height:35px" class="max-price" id="max-price"
                            onchange="sortandfilter('getprice','price')">
                            <option><?= $maxprice ?></option>
                            <?php
                            $divident = 10;
                            for ($j = 1; $j < $minpricelen; $j++) {
                              $divident .= 0;
                            }
                            ?>
                            <?php
                            $divident = (int) $divident;
                            $cnt = $maxprice / $divident;
                            for ($i = 1; $i < $cnt; $i++) {
                              if ($divident * $i > $minprice and $divident * $i < $maxprice) {
                                $pricelist = $divident * $i;
                              }
                              ?>
                              <option><?= $pricelist ?></option>
                              <?php
                            }
                            ?>
                          </select>
                        </label>
                      </div>
                    </form>
                  </div>
                </section> <!-- Products Section -->
              </div>
            </div>
            <!----------------------------------------------------------------------------------------------------------------------------------------------->
          <!----------------------------------------------------------------------------------------------------------------------------------------------->
          <!----------------------------------------------------------------------------------------------------------------------------------------------->
          <!----------------------------------------------------------------------------------------------------------------------------------------------->
          <!----------------------------------------------------------------------------------------------------------------------------------------------->
          <div class="col-md-9 col-sm-12 col-xs-12" style="padding:0px;margin:0px">
            <div style="margin-bottom: 0px;padding:0px"></div>
            <section>
              <div class="container py-3" style="padding:0px;">
                <div class="row" style="margin:0;padding-top:0px !important">
                  <?php
                  require "../Common/pdo.php";
                  if (isset($_GET['item'])) {
                    $nm = $_GET['item'];
                    $res = $pdo->query("select store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
	        	inner join item_description on item_description.item_id=item.item_id
                inner join product_details on product_details.item_description_id=item_description.item_description_id
                inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
        		where item.item_name like \"%$nm%\" and sub_category.sub_category_id=item.sub_category_id");
                  } else if (isset($_GET['category_id']) && isset($_GET['subcategory_id'])) {
                    $cat = $_GET['category_id'];
                    $sub = $_GET['subcategory_id'];
                    $res = $pdo->query("select store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
	        	inner join item_description on item_description.item_id=item.item_id
                inner join product_details on product_details.item_description_id=item_description.item_description_id
                inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
                where category.category_id=$cat and sub_category.sub_category_id=$sub GROUP BY item.item_id order by item.sub_category_id");
                  } else if (isset($_GET['category_id'])) {
                    $cat = $_GET['category_id'];
                    $res = $pdo->query("select store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id,category.category_name,sub_category.sub_category_name,store.store_name from item
        		inner join item_description on item_description.item_id=item.item_id
                inner join product_details on product_details.item_description_id=item_description.item_description_id
                inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
                where category.category_id=$cat GROUP BY item.item_id order by item.sub_category_id");
                  }
                  ?>
                  <div class="col-lg-12 col-md-12 col-sm-12 col xs-12 dynamic-content" id="dynamic-content"
                    style="width: 100%;padding:0">
                    <div id="table-data">
                      <!--------------------------------------REMOVE CONTENTS------------------------------------------------------------------------------------------>
                        <!--------------------------------------REMOVE CONTENTS------------------------------------------------------------------------------------------>
                        <!--------------------------------------REMOVE CONTENTS------------------------------------------------------------------------------------------>
                        <!--------------------------------------REMOVE CONTENTS------------------------------------------------------------------------------------------>
                        <!--------------------------------------REMOVE CONTENTS------------------------------------------------------------------------------------------>
                        <!---ALL CONTENTS ARE LOADED HERE--->
                      <?php
                      while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                        if (strlen($row['item_name']) >= 35) {
                          $item = $row['item_name'];
                          $item_name = substr($item, 0, 35) . "...";
                        } else {
                          $item_name = $row['item_name'];
                        }
                        if (strlen($row['description']) >= 65) {
                          $description = substr($row['description'], 65);
                          $description2 = $description . "...";
                        } else {
                          $description = $row['description'];
                          $description2 = $row['description'] . "... ";
                        }
                        ?>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 offset-md-0 offset-sm-1"
                        style="height: 280px;margin:0px;padding:8px;padding-bottom:0px;padding-top:0px;">
                        <?php
                        $query = "select store.store_name, category.category_name,sub_category.sub_category_name,size,color,weight,flavour,processor,display,battery,internal_storage,brand,material FROM product_details
      JOIN item_description ON product_details.item_description_id=item_description.item_description_id
      JOIN item ON item.item_id=item_description.item_id
      JOIN category ON category.category_id=item.category_id
      JOIN sub_category ON sub_category.sub_category_id=item.sub_category_id
      JOIN store on store.store_id=product_details.store_id
      where item_description.item_description_id=:idid";
                        $statement = $pdo->prepare($query);
                        $statement->execute(array(
                          ':idid' => $row['item_description_id']
                        ));
                        $row_feature = $statement->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="order-single"
                          style="margin:0;padding:0;background-color:#fff;width:100%;height:100%;border-bottom: 1px solid #666;">
                          <div class="col-sm-3 col-xs-3" style="background-color:#fff"
                            onclick="location.href='../Product/single.php?id=<?= $row['item_description_id'] ?>'">
                            <table>
                              <tr style="padding-bottom:30px;"></tr>
                              <tr>
                                <td>
                                  <div style="height: 150px;width: 100%">
                                    <img
                                      style="height:auto;max-width: 100%;width:auto;max-height: 250px;display: block;margin: auto;padding-top:30px "
                                      class="img-responsive"
                                      src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-sm-9 col-xs-9" style="padding:0px;">
                            <table>
                              <tr>
                                <td>
                                  <div
                                    style="width: 100%;text-align: center;color: #000;font-weight:bold;font-size:20px;padding-top:30px">
                                    <?= $row['item_name'] ?>
                                  </div>
                                </td>
                              </tr>
                            </table>
                            <div class="col-sm-12 col-xs-12" style="padding:0px;">
                              <div class="col-sm-7 col-xs-7" style="min-height:200px;padding:0;">
                                <table width="100%" style="padding:0px;margin:0px;">
                                  <tr style="padding-top:10px;">
                                    <td colspan="2">
                                      <div
                                        style="width: 100%;text-align: left;color: #333;font-weight:normal;font-size:14px;padding-top:30px;padding-bottom:10px">
                                      </div>
                                    </td>
                                  </tr>
                                  <?php
                                  if ($row_feature['size'] != 0) {
                                    $query1 = "SELECT * FROM size where size_id=" . $row_feature['size'];
                                    $st1 = $pdo->query($query1);
                                    $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Size</li>
                                    </th>
                                    <td class="cust_details">
                                      <?= $row1['size_name'] ?>
                                    </td>
                                  </tr>
                                  <?php
                                  }
                                  if ($row_feature['color'] != 0) {
                                    $query1 = "SELECT * FROM color where color_id=" . $row_feature['color'];
                                    $st1 = $pdo->query($query1);
                                    $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Color</li>
                                    </th>
                                    <td class="cust_details">
                                      <div
                                        style="height:16px;width:16px;border:.5px solid #999;background-color:<?= $row1['color_name'] ?>">
                                      </div>
                                    </td>
                                  </tr>
                                  <?php
                                  }
                                  if ($row_feature['weight'] != 0) {
                                    ?>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Weight</li>
                                    </th>
                                    <td class="cust_details">
                                      <?= $row_feature['weight'] ?>
                                    </td>
                                  </tr>
                                  <?php
                                  }
                                  if ($row_feature['flavour'] != 0) {
                                    $query1 = "SELECT * FROM flavour where flavour_id=" . $row_feature['flavour'];
                                    $st1 = $pdo->query($query1);
                                    $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Flavour</li>
                                    </th>
                                    <td class="cust_details">
                                      <?= $row1['flavour_name'] ?>
                                    </td>
                                  </tr>
                                  <?php
                                  }
                                  if ($row_feature['processor'] != 0) {
                                    $query1 = "SELECT * FROM processor where processor_id=" . $row_feature['processor'];
                                    $st1 = $pdo->query($query1);
                                    $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Processor</li>
                                    </th>
                                    <td class="cust_details">
                                      <?= $row1['processor_name'] ?>
                                    </td>
                                  </tr>
                                  <?php
                                  }
                                  if ($row_feature['display'] != 0) {
                                    $query1 = "SELECT * FROM display where display_id=" . $row_feature['display'];
                                    $st1 = $pdo->query($query1);
                                    $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Display</li>
                                    </th>
                                    <td class="cust_details">
                                      <?= $row1['display_name'] ?>
                                    </td>
                                  </tr>
                                  <?php
                                  }
                                  if ($row_feature['battery'] != 0) {
                                    $query1 = "SELECT * FROM battery where battery_id=" . $row_feature['battery'];
                                    $st1 = $pdo->query($query1);
                                    $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Battery</li>
                                    </th>
                                    <td class="cust_details">
                                      <?= $row1['battery_name'] ?>
                                    </td>
                                  </tr>
                                  <?php
                                  }
                                  if ($row_feature['internal_storage'] != 0) {
                                    $query1 = "SELECT * FROM internal_storage where internal_storage_id=" . $row_feature['internal_storage'];
                                    $st1 = $pdo->query($query1);
                                    $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Internal Storage</li>
                                    </th>
                                    <td class="cust_details">
                                      <?= $row1['internal_storage_name'] ?>
                                    </td>
                                  </tr>
                                  <?php
                                  }
                                  if ($row_feature['brand'] != 0) {
                                    $query1 = "SELECT * FROM brand where brand_id=" . $row_feature['brand'];
                                    $st1 = $pdo->query($query1);
                                    $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Brand</li>
                                    </th>
                                    <td class="cust_details">
                                      <?= $row1['brand_name'] ?>
                                    </td>
                                  </tr>
                                  <?php
                                  }
                                  if ($row_feature['material'] != 0) {
                                    $query1 = "SELECT * FROM material where material_id=" . $row_feature['material'];
                                    $st1 = $pdo->query($query1);
                                    $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Material</li>
                                    </th>
                                    <td class="cust_details">
                                      <?= $row1['material_name'] ?>
                                    </td>
                                  </tr>
                                  <?php
                                  }
                                  ?>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Category
                                    </th>
                                    <td class="cust_details">
                                      <?= $row_feature['category_name'] ?>
                                      </li>
                                    </td>
                                  </tr>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Sub Category
                                    </th>
                                    <td class="cust_details">
                                      <?= $row_feature['sub_category_name'] ?>
                                      </li>
                                    </td>
                                  </tr>
                                  <tr class=" dw">
                                    <th class="cust_header2">
                                      <li>Seller
                                    </th>
                                    <td class="cust_details">
                                      <?= $row_feature['store_name'] ?>
                                      </li>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                              <div class="col-sm-5 col-xs-5">
                                <table width="100%" style="padding:0px;margin:0px;">
                                  <?php
                                  $save = round(($row['mrp'] - $row['price']) / $row['mrp'] * 100);
                                  ?>
                                  <tr>
                                    <td align="right">
                                      <img
                                        style="height:auto;max-width: 100%;width:auto;max-height: 50px;display: block;padding-top:30px; "
                                        class="img-responsive" src="../../images/logo/logofill-sm.png">
                                    </td>
                                  </tr>
                                  <tr class="div-wrapper dw" style="padding-top:30px;">
                                    <td class="cust_details" style="font-size:24px;font-weight:bold" align="right"><i
                                        class='fa fa-rupee-sign'></i>
                                      <?= $row['price'] ?>
                                    </td>
                                  </tr>
                                  <td class="cust_details" style="font-size:14px;font-weight:normal" align="right">
                                    <del><i class='fa fa-rupee-sign'></i>
                                      <?= $row['mrp'] ?>
                                    </del> <span style="color: #119904;font-weight:bold">
                                      <?= $save ?>% off
                                    </span>
                                  </td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--------------------------------------REMOVE CONTENTS------------------------------------------------------------------------------------------>
                          <!--------------------------------------REMOVE CONTENTS------------------------------------------------------------------------------------------>
                          <!--------------------------------------REMOVE CONTENTS------------------------------------------------------------------------------------------>
                          <!--------------------------------------REMOVE CONTENTS------------------------------------------------------------------------------------------>
                          <!--------------------------------------REMOVE CONTENTS------------------------------------------------------------------------------------------>
                          <?php
                      }
                      ?>
                      </div>
                    </div>
                  </div>
              </section>
              <div id="dynamic-paging"></div>
            </div>
            <!----------------------------------------------------------------------------------------------------------------------------------------------->
          <!----------------------------------------------------------------------------------------------------------------------------------------------->
          <!----------------------------------------------------------------------------------------------------------------------------------------------->
          <!----------------------------------------------------------------------------------------------------------------------------------------------->
          <!----------------------------------------------------------------------------------------------------------------------------------------------->
        </div>
        <!--to be removed-->
          <?php
        }
        ?>
        <!--to be removed-->
      </div>
    </div>
  </div>
  <?php
  require "../Product/products_footer.php";
  ?>
  <script>
      //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      //STORE LISTING
      function storefinder(item_description_id) {
        $("#per").hide();
        var idid = item_description_id;
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "storefinder": 1, "item_description_id": idid },  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 60000,   //waiting time 60 sec
          success: function (data) {    //if registration is success
            if (data.status == "success") {
              if (data.avail != 0) {
                $('.store_rows').remove();
                $('#store').append(data.data);
                $("avail_store").show();
              }
              else {
                $("multi_store_response").show();
              }
              //$("#multi_store_listing").show();
              return;
            }
          },
          error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            if (textstatus === "timeout") {
              swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function wishlist_storefinder(item_description_id) {
      $("#per2").hide();
      var idid = item_description_id;
      $.ajax({
        url: "../Common/functions.php", //passing page info
        data: { "wishlist_storefinder": 1, "item_description_id": idid },  //form data
        type: "post",   //post data
        dataType: "json",   //datatype=json format
        timeout: 60000,   //waiting time 60 sec
        success: function (data) {    //if registration is success
          if (data.status == "success") {
            if (data.avail != 0) {
              $('.wishlist_store_rows').remove();
              $('#wishlist_store').append(data.data);
              $("avail_store_wishlist").show();
            }
            else {
              $("wishlist_multi_store_response").show();
            }
            //$("#multi_store_listing").show();
            return;
          }
        },
        error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
          if (textstatus === "timeout") {
            swal({
              title: "Oops!!!",
              text: "server time out",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
              timer: 6000,
            });
            return;
          }
          else { return; }
        }
      }); //closing ajax
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //PRICE AND CART SETTINGS
    function pricing(store, item_description_id) {
      var idid = item_description_id;
      var store_id = store;
      $('.sel_store').css('display', 'unset');
      $('.element_cart').hide();
      $('#check' + store_id).css('display', 'none');
      $('#btn' + store_id).css('display', 'unset');
      //if none is checked
      if ($('.sel_store:checkbox:checked').length == 0) {
        $("#ini").show();
        $("#per").hide();
      }
      //if none is checked
      else {
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "pricefinder": 1, "item_description_id": idid, "store_id": store_id },  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            $("#ini").hide();
            document.getElementById('save').innerHTML = "";
            document.getElementById('save').innerHTML += data.save;
            document.getElementById('off').innerHTML = "";
            document.getElementById('off').innerHTML += data.off;
            document.getElementById('dis_avail').innerHTML = "";
            document.getElementById('dis_avail').innerHTML = "" + data.availability;
            document.getElementById('dis_sts').innerHTML = "";
            document.getElementById('dis_sts').innerHTML = "" + data.sts;
            document.getElementById('dis_qnty').innerHTML = "";
            document.getElementById('dis_qnty').innerHTML = "" + data.quantity;
            document.getElementById('dis_add').innerHTML = "";
            document.getElementById('dis_add').innerHTML = "" + data.address;
            document.getElementById('idid_keeper').value = "";
            document.getElementById('idid_keeper').value = "" + data.idid;
            $('#item_detailed_features').append(data.features);
            $("#oldpriceofitem").show();
            $("#per").show();
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
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
    }
    //PRICE AND CART SETTINGS
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //PRICE AND CART SETTINGS WISHLIST
    function wishlist_pricing(store, item_description_id) {
      var idid = item_description_id;
      var store_id = store;
      $('.sel_store2').css('display', 'unset');
      $('.element_cart2').hide();
      $('#wishlist_check' + store_id).css('display', 'none');
      $('#wishlist_btn' + store_id).css('display', 'unset');
      //if none is checked
      if ($('.sel_store2:checkbox:checked').length == 0) {
        $("#ini").show();
        $("#per2").hide();
      }
      //if none is checked
      else {
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "wishlist_pricefinder": 1, "item_description_id": idid, "store_id": store_id },  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            $("#ini").hide();
            document.getElementById('save2').innerHTML = "";
            document.getElementById('save2').innerHTML += data.save;
            document.getElementById('off2').innerHTML = "";
            document.getElementById('off2').innerHTML += data.off;
            document.getElementById('dis_avail2').innerHTML = "";
            document.getElementById('dis_avail2').innerHTML = "" + data.availability;
            document.getElementById('dis_sts2').innerHTML = "";
            document.getElementById('dis_sts2').innerHTML = "" + data.sts;
            document.getElementById('dis_qnty2').innerHTML = "";
            document.getElementById('dis_qnty2').innerHTML = "" + data.quantity;
            document.getElementById('dis_add2').innerHTML = "";
            document.getElementById('dis_add2').innerHTML = "" + data.address;
            document.getElementById('wishlist_idid_keeper').value = "";
            document.getElementById('wishlist_idid_keeper').value = "" + data.idid;
            $('#wishlist_item_detailed_features').append(data.features);
            $("#oldpriceofitem").show();
            $("#per2").show();
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
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
    }
    //PRICE AND CART SETTINGS  WISHLIST
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //WISHLIST ENTRY ITEMS
    function wishlist_check_store_select() {
      var tbl = document.getElementById("wishlist_store");
      var chks = tbl.getElementsByTagName("INPUT");
      var id = 0;
      var flag = 0;
      for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked == true) {
          id = chks[i].value;
          flag = 1;
        }
      }
      if (flag == 0) {
        swal({
          title: "Sorry!!!",
          text: "Select a store",
          icon: "warning",
          closeOnClickOutside: false,
          dangerMode: true,
        })
          .then((willSubmit1) => {
            if (willSubmit1) {
              return;
            }
            else {
              return;
            }
          });
      }
      else {
        var item_description_id = document.getElementById('wishlist_idid_keeper').value;
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "addtowishlist": 1, "item_description_id": item_description_id, "store_id": id },  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            if (data.status == 'success') {
              return;
            }
            else {
              return;
            }
          },
          error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            if (textstatus === "timeout") {
              swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
      }
    }
    //WISHLIST ENTRY ITEMS
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function wishlist_check_list_select(wishlist_id) {
      $.ajax({
        url: "../Common/functions.php", //passing page info
        data: { "fetchedwishlistid": 1, "wishlist_id": wishlist_id },  //form data
        type: "post",   //post data
        dataType: "json",   //datatype=json format
        timeout: 30000,   //waiting time 30 sec
        success: function (data) {    //if registration is success
          if (data.status == 'success') {
            swal({
              title: "Added!!!",
              text: "Check your wishlist",
              icon: "success",
              closeOnClickOutside: false,
              dangerMode: true,
            })
              .then((willSubmit1) => {
                if (willSubmit1) {
                  return;
                }
                else {
                  return;
                }
              });
          }
          else if (data.status == 'error') {
            swal({
              title: "Required!!!",
              text: "You need to create an Account",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
            })
              .then((willSubmit) => {
                if (willSubmit) {
                  location.href = "../Account/registered.php";
                  return;
                }
                else {
                  return;
                }
              });
          }
        },
        error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
          if (textstatus === "timeout") {
            swal({
              title: "Oops!!!",
              text: "server time out",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
              timer: 6000,
            });
            return;
          }
          else { return; }
        }
      }); //closing ajax
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  </script>
  </body>
  <html>