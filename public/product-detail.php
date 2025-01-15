<?php

require_once '../lib/config.php';
require_once '../lib/database.php';
require_once '../lib/product.php';

$db = new Database();
$pdo = $db->getConnection();
$product = new Product($pdo);

$uuid = $_GET['uuid'];

header('Content-Type: text/html');

if (!$uuid) {
  http_response_code(400);
  echo "No uuid set";
  exit;
}

$item = $product->get($uuid);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $item['product_name'] ?> details</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <nav class="nav-wrapper py-2 px-4 flex items-center justify-center">
    <div class="nav--buttons-wrapper flex py-1 px-2 items-center justify-center gap-2 text-sm lg:gap-4 lg:text-base overflow-hidden">
      <a class="py-2 px-3 rounded bg-red-400 focus:shadow-md hover:shadow-md transition-all" href="index.html">Home</a>
      <a class="py-2 px-3 rounded bg-red-400 focus:shadow-md hover:shadow-md transition-all" href="products.html">Producten</a>
      <a class="py-2 px-3 rounded bg-red-400 focus:shadow-md hover:shadow-md transition-all" href="contact.html">Contact</a>
      <a class="py-2 px-3 rounded bg-red-400 focus:shadow-md hover:shadow-md transition-all" href="about.html">Over ons</a>
      <a class="py-2 px-3 rounded bg-red-400 focus:shadow-md hover:shadow-md transition-all" href="faq.html">FAQ</a>
    </div>
  </nav>
  <div class="product-detail--parent__wrapper">
    <div class="product-detail--wrapper">
      <div class="product-detail--image__wrapper">
        <img src="/cdn/<?php echo $item['image_name'] ?>" alt="" class="product-detail--image">
      </div>
      <div class="product-detail--meta__wrapper">
        <div class="product-detail--meta">
          <h3 class="<?php if ($item['product_deleted']) echo 'strikethrough' ?> "><?php echo $item['product_name']; ?></h3>
          <span class="product-detail--meta__price"><?php echo $item['product_price'] ?></span>
          <span class="product-detail--meta__tag"><?php echo $item['tag_name'] ?></span>
          <span class="product-detail--meta__stock"><?php echo $item['product_stock'] ?></span>
        </div>
      </div>
      <div class="product-detail--cta__wrapper">
        <div class="product-detail--cta">
          <input type="number" name="quantity" class="product-detail--cta__quantity">
          <button class="product--item-button">Add to cart</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>