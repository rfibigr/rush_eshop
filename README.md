# RUSH - E-SHOP

We had 48 to build an e-commerce website in php and html.
I did this project with a friend [Arthur Cauchy](https://github.com/ArthurCauchy)

You can find more informations about this challenge in this [document](https://github.com/rfibigr/rush_eshop/blob/master/PDF/Rush00-Sujet.pdf).

We only had 48h to this project and we focus our work to developp the back funcitonnality. Please excuse the poor appearence of the front.

## Requirements

Linux
Install [Docker](https://docs.docker.com/install/) and [Docker Compose](https://docs.docker.com/compose/install/).

Windows, MacOS
Docker Toolbox (Recommend)
Install [Docker Toolbox](https://docs.docker.com/toolbox/overview/).

## Installation

```bash
git clone https://github.com/rfibigr/rush_eshop.git
cd rush_eshop
docker-compose build
docker-compose run
```

Access the website

http://localhost:8000

If your docker is configure with a different IP,you will need to change the localhost in the file install.php and database.php the ip.

`Install.php`
```php
line 2  :$conn = mysqli_connect("localhost", "root", "abcdef");
[...]
line 16 :$conn = mysqli_connect("localhost", "root", "abcdef", "rush00");
 ```

 `Database.php`
```php
line 8  :$mysqli_database = mysqli_connect("localhost", "root", "abcdef", "rush00");

 ```
## Account

An admin account is already set-up
login : admin / admin

## Functionality

+ Data management: We used mysql as database.
+ A basket : you can modify quantity, and delete products. You need to be logged to valid a basket but it's possible to fill it before being identified.
+ An admin page where you can add categories and products and manage users account.
+ An user page: where you can modify informations and view precedent order,
