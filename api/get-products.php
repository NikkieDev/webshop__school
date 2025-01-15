<?php

require_once '../private/config.php';
require_once '../private/database.php';
require_once '../private/product-handler.php';

$db = new Database();
$pdo = $db->getConnection();
$product_handler = new ProductHandler($pdo);

header('Content-Type: application/json');

$category = $_GET['cat'];
$products = $product_handler->getList(5, $category);

if (count($products) < 0) {
  http_response_code(404);
  echo json_encode(['error' => 'No products found']);
  exit;
}

http_response_code(200);
echo json_encode(['body' => $products]);
exit;