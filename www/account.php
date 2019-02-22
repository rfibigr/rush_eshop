<?php
session_start();
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']))
{
	header ('location: index.php');
	exit;
}
require_once('database.php');
$user=get_user_details($_SESSION['login']);
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
	<div class='account_user'>
		<div class='block'>
			<div class='information_user'>
			<?php
			if($user['role'] === "admin")
			{
				echo "<a href='account_admin.php'> ADMIN </a>\n";
			}
				echo "<p> First Name : $user[first_name] </p>\n";
				echo "<p> Last Name : $user[last_name] </p>\n";
				echo "<p> Adress : $user[address] </p>\n";
				echo "<p> Phone number : $user[phone] </p>\n";
				echo "<p> Email : $user[name] </p>\n";
			?>
			</div>
			<div class='information_user'>
				<p> My order </p>
	            <a href="order_histo.php"><button>My previous order</button></a>
			</div>
		</div>
		<div class='block_account'>
			<div class=modify_account_user>
				<p> modify_account information </p>
				<form method="post" action="account_modify_information.php">
					First name: <input type="text" name="first_name" value='<?php echo $user['first_name']; ?>'/>
					<br />
					Last name: <input type="text" name="last_name" value='<?php echo $user['last_name']; ?>'/>
					<br />
					Adress: <input type="text" name="address" value='<?php echo $user['address']; ?>'/>
					<br />
					Phone number: <input type="text" name="phone_number" value='<?php echo $user['phone']; ?>'/>
					<br />
					<input type="submit" name="submit" value="OK"/>
				</form>
			</div>
			<div class=modify_password_user>
				<p> modify_account password </p>
				<?php
					if (isset($_GET['error']) && $_GET['error'] === "input")
						echo "<p> There are one or more required fields missing </p>\n";
					if (isset($_GET['error']) && $_GET['error'] === "old_password")
						echo "<p> Your old_password is invalid </p>\n";
					if (isset($_GET['error']) && $_GET['error'] === "password_confirmation")
						echo "<p> Your new passwords doesn't match</p>\n";
					if (isset($_GET['error']) && $_GET['success'] === "new_password")
						echo "<p> Your password has been successfully changed</p>\n";

				 ?>
				<form method="post" action="account_modify_password.php">
					Old password: <input type="password" name="old_password" />
					<br />
					New password: <input type="password" name="new_password" />
					<br />
					New password confirmation: <input type="password" name="password_confirmation" />
					<br />
					<input type="submit" name="submit" value="OK" />
				</form>
			</div>
			<div class=delete_account_user>
				<p> Delete account </p>
				<form method="post" action="account_delete.php">
					Password: <input type="password" name="passwd" />
					<br />
					<input type="submit" name="submit" value="OK" />
				</form>
			</div>
		</div>
	</div>

		<!-- ***FOOTER*** -->
	<?php include ("footer.php"); ?>

</body>
</html>
