<?php

require_once '../lib/config.php';
require_once '../lib/database.php';
require_once '../lib/product.php';

$db = new Database();
$pdo = $db->getConnection();
$product_handler = new Product($pdo);

header('Content-Type: application/json');
$category = $_GET['cat'];

if (!$category) {
  http_response_code(400);
  echo json_encode(['error' => 'No category set']);
  exit;
}

$products = $product_handler->getList(5, $category);

if (count($products) < 0) {
  http_response_code(404);
  echo json_encode(['error' => 'No products found']);
  exit;
}

http_response_code(200);
echo json_encode(['body' => $products]);
exit;