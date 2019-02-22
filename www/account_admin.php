<?php
session_start();
require_once('database.php');

$category_list = get_categories();
$user = isset($_SESSION['login']) ? get_user_details($_SESSION['login']) : NULL;
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']) || $user['role'] !== "admin")
{
    header ('location: index.php');
    exit;
}
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


		<!-- ***nav*** -->
	<div class='account'>
		<div class='information'>

			<h1> Admin </h1>
		</div>
		<div>
            <a href="manage_categories.php"><button>Manage categories</button></a>
            <a href="manage_items.php"><button>Manage items</button></a>
            <a href="manage_orders.php"><button>Manage orders</button></a>
            <a href="manage_users.php"><button>Manage users</button></a>
        </div>

		<!-- ***FOOTER*** -->
	<?php include ("footer.php"); ?>

</body>
</html>
