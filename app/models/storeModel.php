<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class StoreModel extends Database
{
	public function getStores(){
		$sql = "SELECT *  FROM stores";
		return mysqli_query($this->connection, $sql);
	}
}
?>