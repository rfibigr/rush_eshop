<?php
session_start();
require_once('database.php');

$user = isset($_SESSION['login']) ? get_user_details($_SESSION['login']) : NULL;
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']) || $user['role'] !== "admin")
{
	header ('location: index.php');
	exit;
}
$users = get_users();
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
			<h1>Manage Users</h1>
            <a href="account_admin.php"><button>Back</button></a>
            <br />
            <a href="manage_user_addpage.php"><button>CREATE A USER</button></a>
		</div>
        <br/>
		<table class="db_table">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Role</th>
                <th>Address</th>
                <th>Phone</th>
                <th></th>
                <th></th>
            </tr>
			<?php
            foreach($users as $user_id => $user)
            {
                echo "<tr>\n";
                echo "<td>$user_id</td>\n";
                echo "<td>" . $user["name"] . "</td>\n";
                echo "<td>" . $user["first_name"] . "</td>\n";
                echo "<td>" . $user["last_name"] . "</td>\n";
                echo "<td>" . $user["role"] . "</td>\n";
                echo "<td>" . $user["address"] . "</td>\n";
                echo "<td>" . $user["phone"] . "</td>\n";
                echo "<td><a href=\"manage_user_delete.php?user=" . $user_id . "\"><button>DELETE</button></a></td>\n";
                echo "<td><a href=\"manage_user_editpage.php?user=" . $user_id . "\"><button>EDIT</button></a></td>\n";
                echo "</tr>\n";
            }
            ?>
		 </table>
	</section>

		<!-- ***FOOTER*** -->
	<?php include ("footer.php"); ?>

</body>
</html>
