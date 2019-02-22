<?php
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['passwd']))
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

	<div>
		<?php
			if (isset($_GET['login']) && $_GET['login'] === "needed")
				echo "You need to be register to complete your order";
		?>

	</div>
	<?php
	if (isset($_SESSION['login']) || isset($_SESSION['passwd']))
		header ('location: index.php');
	?>
	<div class='sign_in'>

	<p style="font-size: 20px; text-decoration: underline;"> Sign up </p>
		<?php if (isset($_GET["error"])) echo '<p>', $_GET["error"], '</p>'; ?>
		<form method="post" action="verif_sign_up.php">
			Email: <input type="text" name="login" />
			<br />
			Password: <input type="password" name="passwd" />
			<br />
			Password confirmation: <input type="password" name="passwd_confirmation" />
			<br />
			First name: <input type="text" name="first_name" />
			<br />
			Last name: <input type="text" name="last_name" />
			<br />
			Adress: <input type="text" name="adress" />
			<br />
			Phone number: <input type="text" name="phone_number" />
			<br />
			<br />
			<input type="submit" name="submit" value="OK" />
		</form>

	<div class='sign_in'>
	<p style="font-size: 20px; text-decoration: underline;"> Already member? </p>
    <a href="sign_in.php"><button>Sign in</button></a>
	</div>


		<!-- ***FOOTER*** -->
	<?php include ("footer.php"); ?>

</body>
</html>
