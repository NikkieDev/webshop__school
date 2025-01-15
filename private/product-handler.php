<?php

class ProductHandler
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function getList(int $amount, string $tag, ?int $start = null)
  {
    $sql_query = "SELECT product.id AS `product_id`, 
                         product.name AS `product_name`, 
                         product.price AS `product_price`, 
                         product.release_year AS `product_release_year`, 
                         tag.name AS `tag_name` 
                  FROM product
                  INNER JOIN product_with_tag ON product.id = product_with_tag.product_id
                  INNER JOIN tag ON product_with_tag.tag_id = tag.id 
                  WHERE tag.name = :tagname ";

    if ($start !== null) {
      $sql_query .= "AND product.id > :cursor_start ";
    }

    $sql_query .= "LIMIT :amount";

    $stmt = $this->pdo->prepare($sql_query);

    $stmt->bindParam(':tagname', $tag, PDO::PARAM_STR);
    $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);

    if ($start !== null) {
      $stmt->bindParam(':cursor_start', $start, PDO::PARAM_INT);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}