<?php
session_start();
require_once('database.php');

$user = isset($_SESSION['login']) ? get_user_details($_SESSION['login']) : NULL;
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']) || $user['role'] !== "admin")
{
    header ('location: index.php');
    exit;
}
$user = NULL;
if (empty($_GET["user"]) || !($user = get_user_details_byid($_GET["user"]))) {
    header ('location: manage_users.php');
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

<section>
    <div class='information'>
        <h1>Edit User</h1>
    </div>
    <br/>
    <form method="POST" action="manage_user_edit.php?user=<?php echo $user["id"]; ?>">
        <span>Email : <input type="text" name="name" value="<?php echo $user["name"]; ?>"/></span>
        <br />
        <span>Password : <input type="password" name="passwd"/></span>
        <br />
        <span>First name : <input type="text" name="first_name" value="<?php echo $user["first_name"]; ?>"/></span>
        <br />
        <span>Last name : <input type="text" name="last_name" value="<?php echo $user["last_name"]; ?>"/></span>
        <br />
        <span>Role :
            <select name="role">
                <option value="user"<?php if ($user["role"] !== "admin") echo "selected=\"selected\""; ?>>user</option>
                <option value="admin"<?php if ($user["role"] === "admin") echo "selected=\"selected\""; ?>>admin</option>
            </select>
        </span>
        <br />
        <span>Address : <input type="text" name="address" value="<?php echo $user["address"]; ?>"/></span>
        <br />
        <span>Phone : <input type="text" name="phone" value="<?php echo $user["phone"]; ?>"/></span>
        <br />
        <input type="submit" name="submit" value="OK"/>
    </form>
</section>

<!-- ***FOOTER*** -->
<?php include ("footer.php"); ?>

</body>
</html>
