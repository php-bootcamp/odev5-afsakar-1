<?php
require __DIR__."/system/functions.php";

if(isset($_POST["exportJson"])){
  $products = $db->prepare("SELECT * FROM products");
  $items = $products->execute();
  $items = $products->fetchAll(PDO::FETCH_ASSOC);

  $jsonData = json_encode($items, JSON_PRETTY_PRINT);

  header("Content-Type: application/json");
  header("Content-Disposition: attachment; filename=products.json");
  echo json_encode($items, JSON_PRETTY_PRINT);
}

?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  .center {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
  </style>

  <title>Ürün Listesi | Kodluyoruz - Bootchamp</title>
</head>
<body class="bg-dark <?= darkMode("color") ?>">

  <div class="container">
    <div class="row">
      <!-- Odev-1 -->
      <div class="col-md-8">
        <div class="card <?= darkMode("border") ?>" style="margin: 2rem 0 1rem 0;">
          <div class="card-header bg-light <?= darkMode("color") ?>">
            <div class="container row">
              <div class="col-md-7">
                Ürünler
              </div>
              <div class="col-md-5">
                <form method="post">
                  <div class="btn-group d-flex justify-content-end">
                    <a href="product-add" class="btn btn-secondary btn-sm">Ürün Ekle</a>
                    <a href="import-data" class="btn btn-secondary btn-sm">İçeri Aktar</a>
                    <button type="submit" name="exportJson" class="btn btn-secondary btn-sm">Dışa Aktar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card-body">
            <p>

              <?php require __DIR__."/includes/alert.php"; ?>
              <?php $products = $get->getAll($db, "products"); ?>
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead class="bg-light">
                    <th class="text-center">#</th>
                    <th width="100">Ürün Adı</th>
                    <th class="d-none d-md-block">Açıklama</th>
                    <th width="100">Fiyat</th>
                    <th class="text-center">İşlemler</th>
                  </thead>
                  <tbody>
                    <?php $users = $get->getAll($db, "users"); ?>
                    <?php foreach ($products as $key => $product): ?>
                      <tr>
                        <th class="text-center"><?=$product->id?></th>
                        <td><?=$product->name?></td>
                        <td class="d-none d-md-block"><?=substr($product->description, 0, 100)."..."?></td>
                        <td><?=number_format($product->price, 2)?> TL</td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="product-update?id=<?=$product->id?>" class="btn btn-primary">Düzenle</a>
                            <a  onclick="return confirm('Emin misiniz?');" href="system/functions/delete/<?=$product->id?>?table=products" class="btn btn-danger">Sil</a>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card <?= darkMode("border") ?>" style="margin: 2rem 0 1rem 0;">
          <div class="card-header bg-light <?= darkMode("color") ?>">
            <div class="container row">
              <div class="col-md-6">
                Kategoriler
              </div>
              <div class="col-md-6">
                <div class="btn-group d-flex justify-content-end">
                  <a href="category-add" class="btn btn-secondary btn-sm">Kategori Ekle</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <?php $categories = $get->getAll($db, "categories"); ?>
            <ul class="list-group text-center">
              <?php foreach ($categories as $key => $category): ?>
                <li class="list-group-item">
                  <span class="col-md-9"><?=$category->name?></span>
                  <span class="float-right col-md-3" style="margin-left: 3rem;">
                    <a href="category-update?id=<?=$category->id?>" class="btn btn-primary btn-sm">Düzenle</a>
                    <a onclick="return confirm('Emin misiniz?');" href="system/functions/delete/<?=$category->id?>?table=categories" class="btn btn-danger btn-sm">Sil</a>
                  </span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
</body>
</html>
