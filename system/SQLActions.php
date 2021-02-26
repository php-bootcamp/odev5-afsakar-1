<?php
session_start();
ob_start();

require __DIR__ .'/PDOConnection.php';

class Actions {

  private $db;
  private $table;
  private $data;
  private $fields;
  private $keys;
  private $placeholders;
  private $sql;

  public function addValue($argse){

    $values=implode(',',array_map(function($item){
      return $item.'=?';
    },array_keys($argse)));
    return $values;

  }

  public function getAll($db, $table){

    $get = $db->query("SELECT * FROM $table", PDO::FETCH_OBJ);
    return $get;

  }

  public function add($db, $table, $data, $url){

    $keys = array_keys($data);
    $fields = implode(",", $keys);
    $placeholders = str_repeat('?,', count($keys) - 1) . '?';
    $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
    $add = $db->prepare($sql)->execute(array_values($data));

    if($add){
      $_SESSION["alert"] = "success";
      $_SESSION["text"] = "Kayıt başarıyla eklendi!";
      header("Location: ../$url");
    }else{
      $_SESSION["alert"] = "error";
      $_SESSION["text"] = "Kayıt eklenirken hata oluştu!";
      header("Location: ../$url");
    }

  }

  public function first($db, $table, $id){

    $sql = $db->prepare("SELECT * FROM $table WHERE id = $id");
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_OBJ);
    return $result;

  }

  public function delete($db, $tableName, $id, $url){

    $result = $db->prepare("DELETE FROM $tableName WHERE id = ?")->execute([$id]);

    if($result){
      $_SESSION["alert"] = "success";
      $_SESSION["text"] = "Kayıt başarıyla silindi!";
      header("Location: ../../../$url");
    }else{
      $_SESSION["alert"] = "error";
      $_SESSION["text"] = "Kayıt silinirken hata oluştu!";
      header("Location: ../../../$url");
    }

  }

  public function update($db, $tableName, $data, $id, $url){

    foreach ($data as $key => $value) {
      $keys[] = $key." = :".$key;
    }
    $newKeys = implode(", ", $keys);

    $sql = "UPDATE $tableName SET {$this->addValue($data)} WHERE id = $id";
    $updates = $db->prepare($sql)->execute(array_values($data));

    if($updates){
      $_SESSION["alert"] = "success";
      $_SESSION["text"] = "Kayıt başarıyla güncellendi!";
      header("Location: ../$url");
    }else{
      $_SESSION["alert"] = "error";
      $_SESSION["text"] = "Kayıt güncellenirken hata oluştu!";
      header("Location: ../$url");
    }

  }

}
