<?php

$config = require __DIR__ .'/DBConfig.php';

$username = $config["db"]["user"];
$password = $config["db"]["pass"];
$host = $config["db"]["host"];
$tableName = $config["db"]["name"];

try {

  $db = new PDO("mysql:host=${host};dbname=${tableName}", $username, $password);
  $db->query("SET CHARACTER SET utf8mb4_general_ci");

} catch (PDOException $e) {

  print "Hata!: " . $e->getMessage() . "<br/>";

}catch (Exception $e) {

  print "Bağlantı Hatası!: " . $e->getMessage() . "<br/>";

}
