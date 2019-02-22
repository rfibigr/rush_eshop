<?php
session_start();
require_once('database.php');

$user = isset($_SESSION['login']) ? get_user_details($_SESSION['login']) : NULL;
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']) || $user['role'] !== "admin")
{
	header ('location: index.php');
	exit;
}
$orders_list = get_orders();
?>

<!doctype html>
<html>
<head>
	<title>Rush00</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="rush00.css">
	<link rel="icon" type="image/png" sizes="96x96" href="./img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="32x32" href="./img/favicon-32x32.png">
	<style type="text/css">

	</style>
</head>
<body>

		<!-- ***HEADER*** -->
	<?php include ("header.php"); ?>

	<section>
		<div class='information'>
			<h1>Manage Orders</h1>
            <a href="account_admin.php"><button>Back</button></a>
            <br />
		</div>
        <br/>
			<?php

            //echo "<table class=\"db_table\">";
            foreach($orders_list as $key => $order)
            {
                echo "<h2>Order #" . $key . "</h2>\n";
                echo "<h3>by user #" . $order["user_id"] . "</h3> at " . $order["date"] . "\n";
                echo "<table class=\"db_table\">";
                echo "<tr>\n";
                echo "<th>Item Id</th>\n";
                echo "<th>Name</th>\n";
                echo "<th>Unit Price</th>\n";
                echo "<th>Quantity</th>\n";
                echo "</tr>\n";
                foreach($order["items"] as $item_id => $item_data) {
                    echo "<tr> \n";
                    echo "<td>" . $item_id . "</td>\n";
                    echo "<td>" . $item_data["item"]["name"] . "</td>\n";
                    echo "<td>" . $item_data["item"]["price"] . "</td>\n";
                    echo "<td>" . $item_data["quantity"] . "</td>\n";
                    echo "</tr>\n";
                }
                echo "</table>";
                echo "<a href=\"manage_order_delete.php?order=" . $key . "\"><button>DELETE</button></a>\n";
                echo "<hr />\n";
            }

            ?>
	</section>

		<!-- ***FOOTER*** -->
	<?php include ("footer.php"); ?>

</body>
</html>
