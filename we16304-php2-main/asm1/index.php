<?php
require_once './commons/helpers.php';
require_once './vendor/autoload.php';
require_once './commons/db.php';
require_once './commons/route.php';
require_once './commons/lib.php';
$url = isset($_GET['url']) ? $_GET['url'] : "/";

applyRoute($url);


