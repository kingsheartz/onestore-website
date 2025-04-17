function check() {
  var ele = document.getElementById("search").value;
  ele = ele.toLowerCase();
  if (ele == "") {
    swal({
      title: "Oops!!!",
      text: "Search field is empty",
      icon: "error",
      closeOnClickOutside: false,
      dangerMode: true,
      timer: 6000,
    });
    return;
  } else {
    location.href = "../Product/products_limited.php?item=" + ele;
  }
}
function check2() {
  var ele = document.getElementById("search2").value;
  ele = ele.toLowerCase();
  if (ele == "") {
    swal({
      title: "Oops!!!",
      text: "Search field is empty",
      icon: "error",
      closeOnClickOutside: false,
      dangerMode: true,
      timer: 6000,
    });
    return;
  } else {
    location.href = "../Product/products_limited.php?item=" + ele;
  }
}
$(document).on("click", ".item_search_list_p", function () {
  //this is the function I am trying to get to work.
  var name = $(this).html().split(">");
  console.log(name[1]);
  var srch_item = name[1].trim();
  fill(srch_item);
});
function fill(Value) {
  //Assigning value to "search" div in "search.php" file.
  $("#search").val(Value);
  $("#search2").val(Value);
  //Hiding "display" div in "search.php" file.
  $("#display").hide();
  $("#display2").hide();
}
var item;
function getitems(src) {
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: { key: src },
    dataType: "json",
    timeout: 30000,
    success: function (data) {
      item = data;
      console.log(item);
    },
    error: function (xmlhttprequest, textstatus, message) {
      //if it exceeds timeout period
      if (textstatus === "timeout") {
        console.log("timeout");
      }
    },
  });
}
//LARGE
function searchele() {
  if (
    document.getElementById("search").value == null ||
    document.getElementById("search").value == ""
  ) {
    $("#display").hide();
  } else {
    $("#display").show();
    var cat = document.getElementById("search_param").value;
    console.log(cat);
    var src = document.getElementById("search").value;
    src = src.toLowerCase();
    getitems(src);
    if (cat == 0) {
      document.getElementById("display").innerHTML = "";
      var html = "";
      if (item) {
        for (var i = 0; i < item.length; i++) {
          console.log("item is" + item[i].item_name);
          html +=
            '<p class="item_search_list_p" style="margin: 0;padding: 7px 10px;border: 1px solid #CCCCCC;border-top: none;cursor: pointer;"><img src="../../images/' +
            item[i].category_id +
            "/" +
            item[i].sub_category_id +
            "/" +
            item[i].item_description_id +
            '.jpg" style="max-width:80px;height:30px">' +
            item[i].item_name +
            "</p>";
        }
      }
      $("#display").html(html);
    } else {
      document.getElementById("display").innerHTML = "";
      console.log(item.length);
      var html = "";
      if (item) {
        for (var i = 0; i < item.length; i++) {
          console.log(item[i]);
          if (item[i].category_id == cat) {
            console.log("item is" + item[i].item_name);
            html +=
              '<p class="item_search_list_p" style="margin: 0;padding: 7px 10px;border: 1px solid #CCCCCC;border-top: none;cursor: pointer;"><img src="../../images/' +
              item[i].category_id +
              "/" +
              item[i].sub_category_id +
              "/" +
              item[i].item_description_id +
              '.jpg" style="max-width:80px;height:30px">' +
              item[i].item_name +
              "</p>";
          }
        }
      }
      $("#display").html(html);
    }
  }
}
//SMALL
function searchele2() {
  if (
    document.getElementById("search2").value == null ||
    document.getElementById("search2").value == ""
  ) {
    $("#display2").hide();
  } else {
    $("#display2").show();
    var cat = $("input[type=radio][name=sel-category]").filter(":checked").val();
    console.log(cat);
    var src = document.getElementById("search2").value;
    src = src.toLowerCase();
    getitems(src);
    if (typeof cat === "undefined") {
      document.getElementById("display2").innerHTML = "";
      var html = "";
      for (var i = 0; i < item.length; i++) {
        console.log("item is" + item[i].item_name);
        html +=
          '<p class="item_search_list_p" style="margin: 0;padding: 7px 10px;border: 1px solid #CCCCCC;border-top: none;cursor: pointer;"><img src="../../images/' +
          item[i].category_id +
          "/" +
          item[i].sub_category_id +
          "/" +
          item[i].item_description_id +
          '.jpg" style="max-width:80px;height:30px">' +
          item[i].item_name +
          "</p>";
      }
      $("#display2").html(html);
    } else {
      document.getElementById("display2").innerHTML = "";
      console.log(item.length);
      var html = "";
      for (var i = 0; i < item.length; i++) {
        console.log(item[i]);
        if (item[i].category_id == cat) {
          console.log("item is" + item[i].item_name);
          html +=
            '<p class="item_search_list_p" style="margin: 0;padding: 7px 10px;border: 1px solid #CCCCCC;border-top: none;cursor: pointer;"><img src="../../images/' +
            item[i].category_id +
            "/" +
            item[i].sub_category_id +
            "/" +
            item[i].item_description_id +
            '.jpg" style="max-width:80px;height:30px">' +
            item[i].item_name +
            "</p>";
        }
      }
      $("#display2").html(html);
    }
  }
}
