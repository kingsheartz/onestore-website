 
function check(){
  var ele=document.getElementById('search').value;
  location.href="products.php?item="+ele;
}



 $(document).on('click', 'p', function(){ //this is the function I am trying to get to work.  
           fill($(this).html());
        });
function fill(Value) {
   //Assigning value to "search" div in "search.php" file.
   $('#search').val(Value);
   //Hiding "display" div in "search.php" file.
   $('#display').hide();
}
var item ;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    item = JSON.parse(this.responseText);

  }
};
xmlhttp.open("GET", "ajax.php", true);
xmlhttp.send();
function searchele(){
     $('#display').show();

  var cat=document.getElementById('category').value;
  var src=document.getElementById('search').value;
  if(cat== ""){
    alert("please select a category");
  }
  else{
    console.log(item.length);
     for (var i = 0; i <item.length; i++) {
          console.log(item[i]);
      if(item[i].category==cat){
    
        var n=item[i].item_name.search(src);
    

        if(n>-1){
              console.log(item[i].item_name);

                 var html=document.createElement('p');
              var att = document.createAttribute("class");       // Create a "class" attribute
                att.value ="card";                           // Set the value of the class attribute
             html.setAttributeNode(att); 
             var att1 = document.createAttribute("style");       // Create a "class" attribute
                att1.value ="margin: 0;padding: 7px 10px;border: 1px solid #CCCCCC;border-top: none;cursor: pointer;";                           // Set the value of the class attribute
             html.setAttributeNode(att1);
                 html.innerHTML=item[i].item_name;
                 document.getElementById('display').append(html);


        }

      }
  }
  }
 
}