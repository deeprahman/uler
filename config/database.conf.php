<?php
declare(strict_types = 1);
/**
 * Database Information
 * mysql database host: db739039241.db.1and1.com
 */


$dbserver = "mysql";
//$dbhost = "localhost";
$dbhost = "db739039241.db.1and1.com";

$dbname = "db739039241";

$user_name = "dbo739039241";
$user_pass = "12345678";

//constants for database
define("THIS_DBINFO", "{$dbserver}:host={$dbhost};dbname={$dbname}");

define("THIS_USER_NAME", "{$user_name}");

define("THIS_USER_PASS", "{$user_pass}");
//Unsetting the vraiable
$dbserver = NULL;
$dbhost = NULL;
$dbname = NULL;
$user_name = NULL;
$user_pass = NULL;

