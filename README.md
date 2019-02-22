# RUSH - E-SHOP

We had 48 to build an e-shop website in php and html.
For this project i worked with [Arthur Cauchy](https://github.com/ArthurCauchy)

You can find more information about this challenge in this document

We only had 48h to this project and we focus our work to developp the back. I keep it has we ended it.

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

Install the database

http://localhost:8000/install.php

Access the website

http://localhost:8000

If your docker is configure with a different IP with you will need to change the localhost in the file install.php and database.php the ip in

`Install.php`
```php
ligne 2  :$conn = mysqli_connect("localhost", "root", "abcdef");

[...]


ligne 16 :$conn = mysqli_connect("localhost", "root", "abcdef", "rush00");
 ```

 `Database.php`
```php
ligne 8  :$mysqli_database = mysqli_connect("localhost", "root", "abcdef", "rush00");

 ```
## Account

An admin account is already set-up
login : admin / admin
