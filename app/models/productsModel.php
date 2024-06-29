<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class ProductsModel extends Database
{
	public function getTotalProductsCount(){
		$sql = "SELECT COUNT(*) AS totalItems FROM products";
		$result = mysqli_query($this->connection, $sql);

		if (!$result) {
            die('Error: ' . mysqli_error($this->connection));
        }

        $row = mysqli_fetch_assoc($result);
        return $row['totalItems'];
	}

	public function getProductsJSON(){
        $sql = "SELECT * FROM products";
        $result = mysqli_query($this->connection, $sql);

        $products = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return json_encode($products);
    }

	public function search($searchString){
		$sql = "SELECT * FROM products WHERE name LIKE '$searchString%' LIMIT 5";
		return mysqli_query($this->connection, $sql);
	}

	public function load(){
		$sql = "SELECT * FROM products ORDER BY id ASC LIMIT 4";
		return mysqli_query($this->connection, $sql);
	}

	public function lazyLoad($lastId){
		$sql = "SELECT * FROM products WHERE id > '" .$lastId . "' ORDER BY id ASC LIMIT 4";
		return mysqli_query($this->connection, $sql);
	}
}
?>