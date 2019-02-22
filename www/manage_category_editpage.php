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
if (empty($_GET["category"]) || empty($category_list[$_GET["category"]])) {
    header ('location: manage_categories.php');
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
        <h1>Edit Category</h1>
    </div>
    <br/>
    <form method="POST" action="manage_category_edit.php?category=<?php echo $_GET["category"]; ?>">
        <span>Name : <input type="text" name="name" placeholder="name" value="<?php echo $category_list[$_GET["category"]]["name"]; ?>"/></span>
        <br />
        <span>Image : <input type="text" name="img" placeholder="img url" value="<?php echo $category_list[$_GET["category"]]["img"]; ?>"/></span>
        <br />
        <input type="submit" name="submit" value="OK"/>
    </form>
</section>

<!-- ***FOOTER*** -->
<?php include ("footer.php"); ?>

</body>
</html>
