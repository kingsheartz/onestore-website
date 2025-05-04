<style type="text/css">
  .row {
    margin: auto;
    display: block
  }
</style>
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require "pdo.php";
// Attempt search query execution
try {
  if (isset($_REQUEST["term"])) {
    // create prepared statement
    $sql = "SELECT * FROM item JOIN item_description ON item.item_id=item_description.item_id JOIN category ON category.category_id=item.category_id  WHERE item.item_name LIKE :term OR category.category_name LIKE :term GROUP BY item.item_id";
    $stmt = $pdo->prepare($sql);
    $term = $_REQUEST["term"] . '%';
    // bind parameters to statement
    $stmt->bindParam(":term", $term);
?>
    <div class="row">
      <?php
      $i = 0;
      $rt = $stmt->rowCount();
      // execute the prepared statement
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        $cn = 0;
        while ($row = $stmt->fetch()) {
          $cn++;
          $i++;
      ?>
          <div class="products" style="width: 320px">
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
                <button onclick="showupda(<?= $row['item_description_id'] ?>)" class="updation"><i class="fa fa-pencil-square-o"
                    style="font-size: 24px;padding-right: 12px" aria-hidden="true"></i>Change</button>
              </form>
            </div>
            <div class="deupd"><?= $row['item_name'] ?><br>
            </div>
          </div>
          <?php
          if ($cn >= 3) {
            $cn = 0;
          ?>
    </div>
    <div class="clearfix"> </div>
    <div class="row">
<?php
          }
          if ($i == $rt) {
            echo "</div>";
          }
        }
      } else {
        echo "<p>No matches found</p>";
      }
    }
  } catch (PDOException $e) {
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
  }
  // Close statement
  unset($stmt);
  // Close connection
  unset($pdo);
?>