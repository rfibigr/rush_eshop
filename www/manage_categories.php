<?php
session_start();
require_once('database.php');

$user = isset($_SESSION['login']) ? get_user_details($_SESSION['login']) : NULL;
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']) || $user['role'] !== "admin")
{
	header ('location: index.php');
	exit;
}
$category_list = get_categories();
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
			<h1>Manage Categories</h1>
            <a href="account_admin.php"><button>Back</button></a>
            <br />
            <a href="manage_category_addpage.php"><button>CREATE A CATEGORY</button></a>
		</div>
        <br/>
		<table class="db_table">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Image</th>
                <th></th>
                <th></th>
            </tr>
			<?php
            foreach($category_list as $key => $category)
            {
                echo "<tr>\n";
                echo "<td>$key</td>\n";
                echo "<td>" . $category["name"] . "</td>\n";
                echo "<td>" . $category["img"] . "</td>\n";
                echo "<td><a href=\"manage_category_delete.php?category=" . $key . "\"><button>DELETE</button></a></td>\n";
                echo "<td><a href=\"manage_category_editpage.php?category=" . $key . "\"><button>EDIT</button></a></td>\n";
                echo "</tr>\n";
            }

            ?>
		 </table>
	</section>

		<!-- ***FOOTER*** -->
	<?php include ("footer.php"); ?>

</body>
</html>
