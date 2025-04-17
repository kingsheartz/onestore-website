<?php
require "head.php";
?>

<body>
   <div class="wrapper">
      <?php
      include "head1.php";
      ?>
      <style>
         .products {
            display: inline-block;
            text-align: center;
            padding: 14px;
            position: relative;
            height: 300px;
            background: white;
            color: #000;
         }

         .products img {
            margin: auto;
            display: block;
            background: white;
            image-rendering: auto;
            image-rendering: crisp-edges;
            width: auto;
            max-width: 170px;
            height: auto;
            max-height: 200px;
         }

         .content {
            position: relative;
            background: white;
            height: auto;
            padding-bottom: 50px;
            border-top: none;
         }

         .divhed {
            padding: 20px;
            font-family: Roboto;
            font-size: 32px;
            text-align: center;
            border-bottom: 1px solid #dcdcdc;
            margin-bottom: 50px;
         }

         nav.numbering {
            float: right;
         }
      </style>
      <?php
      if (isset($_GET['category_id'])) {
         $ctid = $_GET['category_id'];
      } else {
         die("<div class='alert alert-danger'>You have not specified Category</div>");
      }
      require "pdo.php";
      $results_per_page = 12;
      //find the total number of results stored in the database
      $query = "SELECT * FROM item JOIN item_description ON item.item_id=item_description.item_id where item.category_id=$ctid GROUP BY item_description.item_id";
      $result = $pdo->query($query);
      $number_of_result = $result->rowCount();
      //determine the total number of pages available
      $number_of_page = ceil($number_of_result / $results_per_page);
      //determine which page number visitor is currently on
      if (!isset($_GET['pageno'])) {
         $pageno = 1;
      } else {
         $pageno = $_GET['pageno'];
      }
      //determine the sql LIMIT starting number for the results on the displaying page
      $page_first_result = ($pageno - 1) * $results_per_page;
      ?>
      <div class="content table1 col-sm-12">
         <div class="divhed">
            <?php
            $query6 = "SELECT * FROM category
where category_id=$ctid ";
            $st6 = $pdo->query($query6);
            $row6 = $st6->fetch(PDO::FETCH_ASSOC);
            ?><?= $row6['category_name'] ?>
         </div>
         <?php
         //display the link of the pages in URL
         
         $query = "SELECT * FROM item JOIN item_description ON item.item_id=item_description.item_id
 where item.category_id=$ctid GROUP BY item_description.item_id LIMIT " . $page_first_result . "," . $results_per_page;
         $st = $pdo->query($query);
         while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="products col-sm-4">
               <div style="display: flex;
  justify-content: center;height: 200px;width:100%;background: white;text-align: center;"><img class="image"
                     align="middle"
                     src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
               </div>
               <div class="middle">
                  <form id="<?= $row['item_description_id'] ?>" method="post" action="change.php"
                     name="<?= $row['item_description_id'] ?>">
                     <input type="hidden" name="pr_id" value="<?= $row['item_description_id'] ?>">
                     <input type="hidden" name="item_id" value="<?= $row['item_id'] ?>">
                     <input type="hidden" name="im_url"
                        value="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                     <input type="hidden" name="name" value="<?= $row['item_name'] ?>">
                     <input type="hidden" name="description" value="<?= $row['description'] ?>">
                     <input type="hidden" name="price" value="<?= $row['price'] ?>">
                     <button onclick="showupda(<?= $row['item_description_id'] ?>)" class="updation"><i
                           class="fa fa-pencil-square-o" style="font-size: 24px;padding-right: 12px"
                           aria-hidden="true"></i>Change</button>
                  </form>
               </div>
               <div class="deupd"><?= $row['item_name'] ?><br>
               </div>
            </div>
            <?php
         }
         ?>
      </div>
      <div class="clearfix"> </div>
      <nav class="numbering">
         <ul class="pagination">
            <li><a href="<?php
            $_GET['pageno'] = 1;
            echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET);
            ?>">First</a></li>
            <li class="<?php if ($pageno <= 1) {
               echo 'disabled';
            } ?>">
               <a href="<?php if ($pageno <= 1) {
                  echo '#';
               } else {
                  $_GET['pageno'] = $pageno - 1;
                  echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET);
               } ?>">Prev</a>
            </li>
            <?php
            $ends_count = 1;  //how many items at the ends (before and after [...])
            $middle_count = 2;  //how many items before and after current page
            $dots = false;
            for ($page = 1; $page <= $number_of_page; $page++) {
               if ($page == $pageno) {
                  ?>
                  <li class="active">
                     <a href="<?php
                     $_GET['pageno'] = $page;
                     echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET); ?>">
                        <?= $page ?></a>
                  </li>
                  <?php
                  $dots = true;
               } else {
                  if ($page <= $ends_count || ($pageno && $page >= $pageno - $middle_count && $page <= $pageno + $middle_count) || $page > $number_of_page - $ends_count) {
                     ?>
                     <li>
                        <a href="<?php
                        $_GET['pageno'] = $page;
                        echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET); ?>">
                           <?= $page ?></a>
                     </li>
                     <?php
                     $dots = true;
                  } elseif ($dots) {
                     ?>
                     <li><a>&hellip;</a></li><?php
                     $dots = false;
                  }
               }
               ?>
               <?php
            }
            ?>
            <li class="<?php if ($pageno >= $number_of_page) {
               echo 'disabled';
            } ?>">
               <a href="<?php if ($pageno >= $number_of_page) {
                  echo '#';
               } else {
                  $_GET['pageno'] = $pageno + 1;
                  echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET);
               } ?>">
                  Next</a>
            </li>
            <li><a href="<?php
            $_GET['pageno'] = $number_of_page;
            echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET);
            ?>">Last</a></li>
         </ul>
      </nav>
      <div class="clearfix">
      </div>
      <?php
      require "foot.php";
      ?>