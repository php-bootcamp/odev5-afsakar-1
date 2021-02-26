<?php
require __DIR__ .'/SQLActions.php';
$get = new Actions;

date_default_timezone_set('Europe/Istanbul');

function darkMode($value){
  if (date("H") > 18) {
    $mode = array(
      "background" => "bg-dark",
      "color" => "text-secondary",
      "border" => "secondary"
    );
  } else {
    $mode = [
      "background" => "bg-white",
      "color" => "",
      "border" => ""
    ];
  }
  return $mode[$value];
}

if(isset($_GET["table"])){
  $tableName = $_GET["table"];
  $explodeURL = explode("/", $_SERVER["REQUEST_URI"]);
  $id = explode("?", end($explodeURL));
  $id = $id[0];

  $keys = array_keys($explodeURL);

  $getMethodID = end($keys) - 1;
  $getMethodName = array_values($explodeURL);
  $getMethod = $getMethodName[$getMethodID];

  if($getMethod == "delete"){
    $get->delete($db, $tableName, $id, "index");
  }
}

if(isset($_POST["import"])){

  $item = $_FILES["jsonFile"]["name"];
  copy($_FILES['jsonFile']['tmp_name'], '../datas/'.$item);
  $data = file_get_contents('../datas/'.$item);
  $jsonData = json_decode($data);


  foreach ($jsonData as $key => $value) {
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

    $id = $value->uniqid;
    $items = $db->prepare("SELECT * FROM products WHERE id=:id");
    $items->execute(["id" => $id]);
    $result = $items->fetch(PDO::FETCH_OBJ);
    $success = "";

    if($result){
      $category = json_encode($value->category);
      $updateItem = $db->prepare("SELECT * FROM products WHERE id=:id");
      $updateItem->execute(["id" => $id]);
      $kral = $updateItem->fetch(PDO::FETCH_OBJ);
      $update = $db->prepare("UPDATE products SET name='$value->name', price='$value->price', description='$value->description', content='$value->content', category='$category'  WHERE id='$kral->id'");
      $update->execute();
    }

    $sql = $db->prepare('INSERT INTO products SET id=?, name=?, price=?, description=?, content=?, category=?');
    $add = $sql->execute([
      $value->uniqid,
      $value->name,
      $value->price,
      $value->description,
      $value->content,
      $category
    ]);

    if($add || $update){
      $_SESSION["alert"] = "success";
      $_SESSION["text"] = "Kayıt başarıyla eklendi!";
      header("Location: ../index");
    }else{
      $_SESSION["alert"] = "error";
      $_SESSION["text"] = "Kayıt eklenirken hata oluştu!";
      header("Location: ../index");
    }
  }

  unlink('../datas/'.$item);
}

if(isset($_POST["add"])){

  $name = $_POST["name"];
  $price = $_POST["price"];
  $description = $_POST["description"];
  $content = $_POST["content"];
  $category_id = $_POST["category"];
  $category = $db->prepare("SELECT * FROM categories WHERE id=:id");
  $category->execute(["id" => $category_id]);
  $item = $category->fetch(PDO::FETCH_OBJ);

  $json["uniqid"] = $item->id;
  $json["name"] = $item->name;

  $sql = $db->prepare('INSERT INTO products SET id=?, name=?, price=?, description=?, content=?, category=?');
  $add = $sql->execute([
    uniqid(),
    $name,
    $price,
    $description,
    $content,
    json_encode($json)
  ]);

  if($add){
    $_SESSION["alert"] = "success";
    $_SESSION["text"] = "Kayıt başarıyla eklendi!";
    header("Location: ../index");
  }else{
    $_SESSION["alert"] = "error";
    $_SESSION["text"] = "Kayıt eklenirken hata oluştu!";
    header("Location: ../index");
  }
}

if(isset($_POST["update"])){

    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $name = $_POST["name"];
  $price = $_POST["price"];
  $description = $_POST["description"];
  $content = $_POST["content"];
  $category_id = $_POST["category"];
  $id = $_POST["id"];
  $category = $db->prepare("SELECT * FROM categories WHERE id=:id");
  $category->execute(["id" => $category_id]);
  $item = $category->fetch(PDO::FETCH_OBJ);

  $json["uniqid"] = $item->id;
  $json["name"] = $item->name;

  $sql = $db->prepare("UPDATE products SET name=?, price=?, description=?, content=?, category=? WHERE id=?");
  $update = $sql->execute([
    $name,
    $price,
    $description,
    $content,
    json_encode($json),
    $_POST["id"]
  ]);

  if($update){
    $_SESSION["alert"] = "success";
    $_SESSION["text"] = "Kayıt başarıyla güncellendi!";
    header("Location: ../index");
  }else{
    $_SESSION["alert"] = "error";
    $_SESSION["text"] = "Kayıt güncellenirken hata oluştu!";
    header("Location: ../index");
  }

}

if(isset($_POST["addCategory"])){

  $name = $_POST["name"];

  $sql = $db->prepare('INSERT INTO categories SET id=?, name=?');
  $add = $sql->execute([
    uniqid(),
    $name
  ]);

  if($add){
    $_SESSION["alert"] = "success";
    $_SESSION["text"] = "Kategori başarıyla eklendi!";
    header("Location: ../index");
  }else{
    $_SESSION["alert"] = "error";
    $_SESSION["text"] = "Kategori eklenirken hata oluştu!";
    header("Location: ../index");
  }
}

if(isset($_POST["updateCategory"])){

  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $name = $_POST["name"];
  $id = $_POST["id"];

  $sql = $db->prepare("UPDATE categories SET name=? WHERE id=?");
  $update = $sql->execute([
    $name,
    $_POST["id"]
  ]);

  if($update){
    $_SESSION["alert"] = "success";
    $_SESSION["text"] = "Kategori başarıyla güncellendi!";
    header("Location: ../index");
  }else{
    $_SESSION["alert"] = "error";
    $_SESSION["text"] = "Kategori güncellenirken hata oluştu!";
    header("Location: ../index");
  }

}

?>
