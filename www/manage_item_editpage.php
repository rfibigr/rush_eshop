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
$item = NULL;
if (empty($_GET["item"]) || !($item = get_item_details($_GET["item"]))) {
    header ('location: manage_items.php');
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
        <h1>Edit Item</h1>
    </div>
    <br/>
    <form method="POST" action="manage_item_edit.php?item=<?php echo $item["id"]; ?>">
        <span>Name : <input type="text" name="name" placeholder="name" value="<?php echo $item["name"]; ?>"/></span>
        <br />
        <span>Image : <input type="text" name="img" placeholder="img url" value="<?php echo $item["img"]; ?>"/></span>
        <br />
        <span>Price : <input type="number" name="price" step="0.01" min="0" value="<?php echo $item["price"]; ?>"/></span>
        <br />
        <?php
        foreach ($category_list as $key => $category) {
            echo "<input type=\"checkbox\" name=\"categories[]\" value=\"" . $key . "\"" . (in_array($key, $item["categories"]) ? "checked" : "") . "/>", $category["name"], "<br />";
        }
        ?>
        <input type="submit" name="submit" value="OK"/>
    </form>
</section>

<!-- ***FOOTER*** -->
<?php include ("footer.php"); ?>

</body>
</html>
