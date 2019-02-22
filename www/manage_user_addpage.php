<?php
session_start();
require_once('database.php');

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

<section>
    <div class='information'>
        <h1>Add User</h1>
    </div>
    <br/>
    <form method="POST" action="manage_user_add.php">
        <span>Email : <input type="text" name="name"/></span>
        <br />
        <span>Password : <input type="password" name="passwd"/></span>
        <br />
        <span>First name : <input type="text" name="first_name"/></span>
        <br />
        <span>Last name : <input type="text" name="last_name"/></span>
        <br />
        <span>Role :
            <select name="role">
                <option value="user" selected="selected">user</option>
                <option value="admin">admin</option>
            </select>
        </span>
        <br />
        <span>Address : <input type="text" name="address"/></span>
        <br />
        <span>Phone : <input type="text" name="phone"/></span>
        <br />
        <input type="submit" name="submit" value="OK"/>
    </form>
</section>

<!-- ***FOOTER*** -->
<?php include ("footer.php"); ?>

</body>
</html>
