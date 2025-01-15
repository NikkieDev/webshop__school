<?php

require_once '../private/config.php';
require_once '../private/database.php';
require_once '../private/product-handler.php';

$db = new Database();
$pdo = $db->getConnection();
$product_handler = new ProductHandler($pdo);

$products = $product_handler->getList(5, 'Tech');
echo json_encode($products);