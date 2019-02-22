<?php
$conn = mysqli_connect("192.168.99.100", "root", "abcdef");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$req = "CREATE DATABASE IF NOT EXISTS rush00";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);

$conn = mysqli_connect("192.168.99.100", "root", "abcdef", "rush00");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$req = "CREATE TABLE `categories` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "CREATE TABLE `items` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "CREATE TABLE `item_categories` (
`item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "CREATE TABLE `orders` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "CREATE TABLE `order_items` (
`order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "CREATE TABLE `users` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`item_id`,`category_id`);";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`,`item_id`);";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "INSERT INTO `categories` (`id`, `name`, `img`) VALUES
(1, 'Planet', 'http://www.blueplanetheart.it/wp-content/uploads/2017/02/planet-9.jpg'),
(2, 'Nebula', 'http://referentiel.nouvelobs.com/file/rw966/7098790.jpg'),
(3, 'Spaceship', 'https://amp.businessinsider.com/images/5b71db5564dce81e008b4f72-1920-960.jpg'),
(4, 'New', 'http://discovermagazine.com/~/media/Images/Issues/2015/april/blackhole2.jpg');";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "INSERT INTO `items` (`id`, `name`, `price`, `img`) VALUES
(1, 'Explorer V47X', 1850, 'http://s1.lprs1.fr/images/2018/09/14/7887975_6ad98352-b7f3-11e8-ab85-3d34887d1cb2-1_1000x625.jpg'),
(2, 'SuperSpaceShip', 3000, 'https://i.ytimg.com/vi/y8-R1H9e1j0/maxresdefault.jpg'),
(3, 'Death Star', 9999.99, 'https://cdn-media.rtl.fr/cache/Jy-PbLy706HiAsJZQK0OYQ/880v587-0/online/image/2016/1214/7786282730_l-etoile-noire-super-arme-destructrice-de-l-empire-galactique.PNG'),
(4, 'Starship Enterprise', 5500, 'https://cbsnews3.cbsistatic.com/hub/i/r/2016/07/23/33e67635-8d38-4b5a-8c08-c844c74f022c/resize/620x465/7f61b79d73e97f6f41863bfba070a916/enterprise-star-trek-generations-ncc-1701a.jpg'),
(5, 'Appolo Lunar rover', 720, 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ed/Apollo15LunarRover.jpg/1200px-Apollo15LunarRover.jpg'),
(6, 'Mars', 10, 'https://www.stelvision.com/astro/wp-content/uploads/2018/06/True-colour_image_of_Mars_seen_by_OSIRIS-1.jpg'),
(7, 'Earth', 300, 'https://3c1703fe8d.site.internapcdn.net/newman/gfx/news/hires/2014/1-earth.jpg'),
(8, 'Venus', 30, 'https://fr.cdn.v5.futura-sciences.com/buildsv6/images/wide1920/b/1/4/b14c8f7a8f_119688_venus-uv1-akatskuki-damiabouic.jpg'),
(9, 'Uranus', 40, 'https://cnes.fr/sites/default/files/styles/large/public/drupal/201606/image/is_uranus_hubble_2007.jpg?itok=__HvZBwN'),
(10, 'B18W', 600, 'https://3c1703fe8d.site.internapcdn.net/newman/gfx/news/hires/2017/observatorie.png'),
(11, 'Super Purple', 1000, 'https://3c1703fe8d.site.internapcdn.net/newman/gfx/news/2018/crabnebulaac.jpg'),
(12, 'K8982', 10, 'https://thumbs-prod.si-cdn.com/JkuOo9X62ty_tWzmOUI-os3xVag=/1072x720/filters:no_upscale()/https://public-media.smithsonianmag.com/filer/c5/0c/c50c8491-8c05-464d-b943-58b3320444bb/orion.jpg'),
(13, 'Curiosity', 365, 'https://static.lexpress.fr/medias_11171/w_1678,h_939,c_crop,x_0,y_59/w_2000,h_1125,c_fill,g_north/v1475674892/curiosity-mars-nasa_5719957.jpg'),
(14, 'Jupiter', 10, 'https://cnes.fr/sites/default/files/drupal/201604/image/is-jupiter-planete.jpg'),
(15, 'Mystic mountain', 3900, 'https://cdn.spacetelescope.org/archives/images/thumb700x/heic1007a.jpg'),
(16, 'Saturne', 420, 'https://medias.pourlascience.fr/api/v1/images/view/5a82b0e08fe56f22417b8499/wide_1300/image.jpg'),
(17, 'W746TY', 10, 'http://apod.cidehom.com/pix/2011/111120.jpg'),
(18, 'Nebuleuse de la Lyre', 10, 'http://www.astromaria.no/wp-content/uploads/2014/10/the-helix-nebula.jpg');";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "INSERT INTO `item_categories` (`item_id`, `category_id`) VALUES
(1, 3),
(1, 4),
(2, 3),
(2, 4),
(3, 3),
(4, 3),
(5, 3),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 2),
(10, 4),
(11, 2),
(12, 2),
(13, 3),
(14, 1),
(15, 2),
(16, 1),
(17, 2),
(18, 2);";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

$req = "INSERT INTO `users` (`id`, `name`, `password`, `first_name`, `last_name`, `role`, `address`, `phone`) VALUES
(1, 'admin', '8C6976E5B5410415BDE908BD4DEE15DFB167A9C873FC4BB8A81F6F2AB448A918', 'admin', 'admin', 'admin', 'somewhere', '0000000000');";
if (mysqli_query($conn, $req)) {
    echo "Request successfull\n";
} else {
    echo "Request error : " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
