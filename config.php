<?php
define('BASE_URL', ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http") . "://".$_SERVER['HTTP_HOST']."/");
define('BASE_URL_ADMIN', BASE_URL . 'admin/');