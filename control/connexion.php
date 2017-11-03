<?php
/**
 * Created by PhpStorm.
 * User: e.bouh
 * Date: 30/10/2017
 * Time: 15:40
 */

$servername = "10.100.1.2";
$db = "amgrh";
$username = "ebouh";
$password = "ebo";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db;charset=utf8", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}