<?php
require "../Common/pdo.php";
if (isset($_REQUEST["name"])) {
	$data = array(
		':name' => "%" . $_GET['name'] . "%"
	);
	if (strlen($_GET['name']) == 0) {
		$query = 'select users.first_name,wishlist.list_name,wishlist.wishlist_id,wishlist.date FROM wishlist INNER JOIN wishlist_items ON wishlist.wishlist_id=wishlist_items.wishlist_id inner join users on wishlist.user_id=users.user_id WHERE privacy="public" group by wishlist.wishlist_id';
		$statement = $pdo->prepare($query);
		$statement->execute();
		if ($statement->rowCount() > 0) {
			while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				$sql_wish2 = 'select count(wishlist_id) as item_count FROM wishlist_items WHERE wishlist_id=:wish_id ';
				$stmt_wish2 = $pdo->prepare($sql_wish2);
				$stmt_wish2->execute(array(':wish_id' => $row['wishlist_id']));
				$row_wish2 = $stmt_wish2->fetch(PDO::FETCH_ASSOC);
?>
				<tr class="wltr" onclick="location.href='../Wishlist/wishlist_public.php?wishlist_id=<?= $row['wishlist_id'] ?>'">
					<?php
					if (strlen($row['first_name']) < 12) {
						$listownername = $row['first_name'];
					} else {
						$cutname = substr($row['first_name'], 0, 12);
						$listownername = $cutname . "...";
					}
					if (strlen($row['list_name']) < 15) {
						$listname = $row['list_name'];
					} else {
						$cutname = substr($row['list_name'], 0, 15);
						$listname = $cutname . "...";
					}
					?>
					<td>
						<h4 title="<?= $row['first_name'] ?>"><?= $listownername ?></h4>
					</td>
					<td>
						<h4 title="<?= $row['list_name'] ?>"><?= $listname ?></h4>
					</td>
					<td>
						<h4><?= $row_wish2['item_count'] ?></h4>
					</td>
					<td>
						<h4><?= $row['date'] ?></h4>
					</td>
				</tr>
			<?php
			}
		} else {
			?>
			<tr class="wltr">
				<td style="padding:10px" colspan="4">No Matches Found</td>
			</tr>
			<?php
		}
	} else {
		$query = 'select users.first_name,wishlist.list_name,wishlist.wishlist_id,wishlist.date FROM wishlist INNER JOIN wishlist_items ON wishlist.wishlist_id=wishlist_items.wishlist_id inner join users on wishlist.user_id=users.user_id WHERE privacy="public" AND (wishlist.list_name LIKE :name OR users.email LIKE :name) group by wishlist.wishlist_id';
		$statement = $pdo->prepare($query);
		$statement->execute($data);
		if ($statement->rowCount() > 0) {
			while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				$sql_wish2 = 'select count(wishlist_id) as item_count FROM wishlist_items WHERE wishlist_id=:wish_id ';
				$stmt_wish2 = $pdo->prepare($sql_wish2);
				$stmt_wish2->execute(array(':wish_id' => $row['wishlist_id']));
				$row_wish2 = $stmt_wish2->fetch(PDO::FETCH_ASSOC);
			?>
				<tr class="wltr" onclick="location.href='../Wishlist/wishlist_public.php?wishlist_id=<?= $row['wishlist_id'] ?>'">
					<?php
					if (strlen($row['first_name']) < 12) {
						$listownername = $row['first_name'];
					} else {
						$cutname = substr($row['first_name'], 0, 12);
						$listownername = $cutname . "...";
					}
					if (strlen($row['list_name']) < 15) {
						$listname = $row['list_name'];
					} else {
						$cutname = substr($row['list_name'], 0, 15);
						$listname = $cutname . "...";
					}
					?>
					<td>
						<h4 title="<?= $row['first_name'] ?>"><?= $listownername ?></h4>
					</td>
					<td>
						<h4 title="<?= $row['list_name'] ?>"><?= $listname ?></h4>
					</td>
					<td>
						<h4><?= $row_wish2['item_count'] ?></h4>
					</td>
					<td>
						<h4><?= $row['date'] ?></h4>
					</td>
				</tr>
			<?php
			}
		} else {
			?>
			<tr class="wltr">
				<td style="padding:10px" colspan="4">No Matches Found</td>
			</tr>
<?php
		}
	}
}
?>