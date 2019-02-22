<?php

$mysqli_database = NULL;

function get_db() {
    global $mysqli_database;
    if ($mysqli_database === NULL)
        $mysqli_database = mysqli_connect("localhost", "root", "abcdef", "rush00");
    return ($mysqli_database);
}

// =======================================================================
// ============================= CATEGORIES ==============================
// =======================================================================

function get_categories() {
    $req = 'SELECT * FROM categories';
    $res = mysqli_query(get_db(), $req);
    $array = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $array[$row["id"]] = $row;
        unset($array[$row["id"]]["id"]);
    }
    mysqli_free_result($res);
    return ($array);
}

function add_category($name, $img) {
    $req = 'INSERT INTO categories (`name`, `img`) VALUES (?, ?)';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "ss", $name, $img);
    $ret = TRUE;
    if (mysqli_stmt_execute($stmt) === FALSE)
        $ret = FALSE;
    mysqli_stmt_close($stmt);
    return ($ret);
}

function edit_category($category_id, $name, $img) {
    $req = 'UPDATE categories SET `name` = ?, `img` = ? WHERE `id` = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "sss", $name, $img, $category_id);
    $ret = TRUE;
    if (mysqli_stmt_execute($stmt) === FALSE)
        $ret = FALSE;
    mysqli_stmt_close($stmt);
    return ($ret);
}

function delete_category($category_id) {
    $req = 'DELETE FROM categories WHERE id = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $req2 = 'DELETE FROM item_categories WHERE category_id = ?';
    $stmt2 = mysqli_prepare(get_db(), $req2);
    mysqli_stmt_bind_param($stmt2, "i", $category_id);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
}

// =======================================================================
// ================================ ITEMS ================================
// =======================================================================

function get_all_items() {
    $req = 'SELECT `id`, `name`, `price`, `img` FROM items INNER JOIN item_categories ON items.id = item_categories.item_id';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $price, $img);
    $array = array();
    while (mysqli_stmt_fetch($stmt)) {
        $array[$id] = array('name'=>$name, 'price'=>$price, 'img'=>$img);
    }
    mysqli_stmt_close($stmt);
    return ($array);
}

function get_items($category_id) {
    $req = 'SELECT `id`, `name`, `price`, `img` FROM items INNER JOIN item_categories ON items.id = item_categories.item_id WHERE category_id = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $price, $img);
    $array = array();
    while (mysqli_stmt_fetch($stmt)) {
        $array[$id] = array('name'=>$name, 'price'=>$price, 'img'=>$img);
    }
    mysqli_stmt_close($stmt);
    return ($array);
}

function get_item_details($item_id) {
    $req = 'SELECT `id`, `name`, `price`, `img`, `category_id` FROM items INNER JOIN item_categories ON items.id = item_categories.item_id WHERE item_id = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "i", $item_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $price, $img, $category_id);
    $array = NULL;
    while (mysqli_stmt_fetch($stmt)) {
        if ($array === NULL) {
            $array = array();
            $array["categories"] = array();
            $array["id"] = $id;
            $array["name"] = $name;
            $array["price"] = $price;
            $array["img"] = $img;
        }
        array_push($array["categories"], $category_id);
    }
    mysqli_stmt_close($stmt);
    return ($array);
}

function add_item($name, $price, $img, $categories) {
    $req = 'INSERT INTO items (`name`, `price`, `img`) VALUES (?, ?, ?)';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "sds", $name, $price, $img);
    if (mysqli_stmt_execute($stmt) === FALSE)
        return (FALSE);
    mysqli_stmt_close($stmt);
    $item_id = mysqli_insert_id(get_db());
    foreach ($categories as $category) {
        $req2 = 'INSERT INTO item_categories (`item_id`, `category_id`) VALUES (?, ?)';
        $stmt2 = mysqli_prepare(get_db(), $req2);
        mysqli_stmt_bind_param($stmt2, "ii", $item_id, $category);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
    }
    return ($item_id);
}

function edit_item($item_id, $name, $price, $img, $categories) {
    $req = 'UPDATE items SET `name` = ?, `price` = ?, `img` = ? WHERE id = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "sdss", $name, $price, $img, $item_id);
    if (mysqli_stmt_execute($stmt) === FALSE)
        return (FALSE);
    mysqli_stmt_close($stmt);
    $req2 = 'DELETE FROM item_categories WHERE item_id = ?';
    $stmt2 = mysqli_prepare(get_db(), $req2);
    mysqli_stmt_bind_param($stmt2, "i", $item_id);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
    foreach ($categories as $category) {
        $req3 = 'INSERT INTO item_categories (`item_id`, `category_id`) VALUES (?, ?)';
        $stmt3 = mysqli_prepare(get_db(), $req3);
        mysqli_stmt_bind_param($stmt3, "ii", $item_id, $category);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_close($stmt3);
    }
    return ($item_id);
}

function delete_item($item_id) {
    $req = 'DELETE FROM items WHERE id = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "i", $item_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $req2 = 'DELETE FROM item_categories WHERE item_id = ?';
    $stmt2 = mysqli_prepare(get_db(), $req2);
    mysqli_stmt_bind_param($stmt2, "i", $item_id);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
}

// =======================================================================
// ================================ USERS ================================
// =======================================================================

function get_users() {
    $req = 'SELECT * FROM users';
    $res = mysqli_query(get_db(), $req);
    $array = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $array[$row["id"]] = $row;
        unset($array[$row["id"]]["id"]);
    }
    mysqli_free_result($res);
    return ($array);
}

function add_user($login, $passwd, $first_name, $last_name, $role, $address, $phone) {
    $req = 'INSERT INTO users (`name`, `password`, `first_name`, `last_name`, `role`, `address`, `phone`) VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "sssssss", $login, $passwd, $first_name, $last_name, $role, $address, $phone);
    $ret = TRUE;
    if (mysqli_stmt_execute($stmt) === FALSE)
        $ret = FALSE;
    mysqli_stmt_close($stmt);
    return ($ret);
}

function check_user_exists($login) {
    $req = 'SELECT * FROM users WHERE `name` = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "s", $login);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $ret = FALSE;
    if (mysqli_stmt_num_rows($stmt) >= 1)
        $ret = TRUE;
    mysqli_stmt_close($stmt);
    return ($ret);
}

function check_user_credentials($login, $passwd) {
    $req = 'SELECT * FROM users WHERE `name` = ? AND `password` = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "ss", $login, $passwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $ret = FALSE;
    if (mysqli_stmt_num_rows($stmt) >= 1)
        $ret = TRUE;
    mysqli_stmt_close($stmt);
    return ($ret);
}

function update_user_password($user_id, $new_passwd) {
    $req = 'UPDATE users SET `password` = ? WHERE `id` = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "ss", $new_passwd, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $ret = FALSE;
    if (mysqli_stmt_num_rows($stmt) >= 1)
        $ret = TRUE;
    mysqli_stmt_close($stmt);
    return ($ret);
}

function update_user_data($user_id, $login, $first_name, $last_name, $role, $address, $phone) {
    $req = 'UPDATE users SET `name` = ?, `first_name` = ?, `last_name` = ?, `role` = ?, `address` = ?, `phone` = ? WHERE `id` = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "sssssss", $login, $first_name, $last_name, $role, $address, $phone, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $ret = FALSE;
    if (mysqli_stmt_num_rows($stmt) >= 1)
        $ret = TRUE;
    mysqli_stmt_close($stmt);
    return ($ret);
}

function get_user_details($login) {
    $req = 'SELECT `id`, `name`, `first_name`, `last_name`, `role`, `address`, `phone` FROM users WHERE `name` = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "s", $login);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $first_name, $last_name, $role, $address, $phone);
    if (mysqli_stmt_fetch($stmt) === NULL)
        return (NULL);
    $array = array();
    $array["id"] = $id;
    $array["name"] = $name;
    $array["first_name"] = $first_name;
    $array["last_name"] = $last_name;
    $array["role"] = $role;
    $array["address"] = $address;
    $array["phone"] = $phone;
    mysqli_stmt_close($stmt);
    return ($array);
}

function get_user_details_byid($user_id) {
    $req = 'SELECT `id`, `name`, `first_name`, `last_name`, `role`, `address`, `phone` FROM users WHERE `id` = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "s", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $first_name, $last_name, $role, $address, $phone);
    if (mysqli_stmt_fetch($stmt) === NULL)
        return (NULL);
    $array = array();
    $array["id"] = $id;
    $array["name"] = $name;
    $array["first_name"] = $first_name;
    $array["last_name"] = $last_name;
    $array["role"] = $role;
    $array["address"] = $address;
    $array["phone"] = $phone;
    mysqli_stmt_close($stmt);
    return ($array);
}

function delete_user($user_id) {
    $req = 'DELETE FROM users WHERE `id` = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// =======================================================================
// =============================== ORDERS ================================
// =======================================================================

function add_order($user_id, $order) {
    $req = 'INSERT INTO orders (`user_id`) VALUES (?)';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    if (mysqli_stmt_execute($stmt) === FALSE)
        return (FALSE);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_close($stmt);
    $order_id = mysqli_insert_id(get_db());
    foreach ($order as $item) {
        $req2 = 'INSERT INTO order_items (`order_id`, `item_id`, `quantity`) VALUES (?, ?, ?)';
        $stmt2 = mysqli_prepare(get_db(), $req2);
        mysqli_stmt_bind_param($stmt2, "iii", $order_id, $item[0]["id"], $item[1]);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
    }
    return (TRUE);
}

function get_orders() {
    $req = 'SELECT order_items.order_id, orders.date, orders.user_id, order_items.item_id, order_items.quantity, items.name, items.price, items.img FROM orders LEFT JOIN order_items ON orders.id = order_items.order_id LEFT JOIN items ON order_items.item_id = items.id';
    $stmt = mysqli_prepare(get_db(), $req);
    $array = array();
    if (mysqli_stmt_execute($stmt) === FALSE)
        return (FALSE);
    mysqli_stmt_bind_result($stmt, $order_id, $date, $user_id, $item_id, $quantity, $name, $price, $img);
    while (mysqli_stmt_fetch($stmt)) {
        if (!isset($array[$order_id])) {
            $array[$order_id] = array();
            $array[$order_id]["date"] = $date;
            $array[$order_id]["user_id"] = $user_id;
            $array[$order_id]["items"] = array();
        }
        $array[$order_id]["items"][$item_id] = ["item" => ["name"=>$name, "price"=>$price, "img"=>$img], "quantity" => $quantity];
    }
    mysqli_stmt_close($stmt);
    return ($array);
}

function get_user_orders($user_id) {
    $req = 'SELECT order_items.order_id, orders.date, order_items.item_id, order_items.quantity, items.name, items.price, items.img FROM orders LEFT JOIN order_items ON orders.id = order_items.order_id LEFT JOIN items ON order_items.item_id = items.id WHERE orders.user_id = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    $array = array();
    if (mysqli_stmt_execute($stmt) === FALSE)
        return (FALSE);
    mysqli_stmt_bind_result($stmt, $order_id, $date, $item_id, $quantity, $name, $price, $img);
    while (mysqli_stmt_fetch($stmt)) {
        if (!isset($array[$order_id])) {
            $array[$order_id] = array();
            $array[$order_id]["date"] = $date;
            $array[$order_id]["items"] = array();
        }
        $array[$order_id]["items"][$item_id] = ["item" => ["name"=>$name, "price"=>$price, "img"=>$img], "quantity" => $quantity];
    }
    mysqli_stmt_close($stmt);
    return ($array);
}

function delete_order($order_id) {
    $req = 'DELETE FROM orders WHERE `id` = ?';
    $stmt = mysqli_prepare(get_db(), $req);
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $req2 = 'DELETE FROM order_items WHERE `order_id` = ?';
    $stmt2 = mysqli_prepare(get_db(), $req2);
    mysqli_stmt_bind_param($stmt2, "i", $order_id);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
}
