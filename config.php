<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 5/3/15
 * Time: 12:58 PM
 * To change this template use File | Settings | File Templates.
 */
//include db class file
include 'class/class.db.php';

//MYSQL connection
$db = new db("mysql:host=127.0.0.1;port=3306;dbname=ems", "root", "root");
//$db = new PDO("mysql:host=127.0.0.1;port=3306;dbname=ems", "root", "root");