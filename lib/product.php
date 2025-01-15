<?php
require_once "logger.php";

class Product
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
    // $this->logger = new Logger("Product");
  }

  public function get(string $uuid)
  {
    $sql_query = "SELECT
                    product.name AS `product_name`
                    product.price AS `product_price`
                    product.release_year AS `product_release_year`,
                    tag.name AS `tag_name`,
                    product_image.name AS `image_name`
                  FROM
                    product
                  INNER JOIN
                    product_with_tag.tag_id ON product.id = product_with_tag.product_id
                  INNER JOIN
                    product_image ON product_image.product_id = product.id
                  INNER JOIN
                    tag ON product_with_tag.tag_id = tag.id
                  WHERE
                    product.uuid = :uuid";

    $stmt = $this->pdo->prepare($sql_query);
    $stmt->bindParam(":uuid", $uuid, PDO::PARAM::STR);
    
    try {
      $stmt->execute();
      return $stmt->fetch();
    } catch (Exception $e) {
      echo "An error has occured.";
      exit;
    }
  }

  public function getList(int $amount, string $tag, ?int $start = null): ?array
  {
    $sql_query = "SELECT 
                    product.id AS `product_id`, 
                    product.name AS `product_name`, 
                    product.price AS `product_price`, 
                    product.release_year AS `product_release_year`,
                    product.uuid AS `product_uuid`,
                    tag.name AS `tag_name`,
                    product_image.name AS `image_name`
                  FROM 
                    product
                  INNER JOIN 
                    product_with_tag ON product.id = product_with_tag.product_id
                  INNER JOIN 
                    tag ON product_with_tag.tag_id = tag.id
                  INNER JOIN 
                    product_image ON product_image.product_id = product.id
                  WHERE 
                    tag.name = :tagname;";

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


    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      echo "An error has occured!";
      return null;
      // $this->logger->info($e);
    }

  }

}