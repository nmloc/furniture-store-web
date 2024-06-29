<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class LoginModel extends Database
{
	public function login($username)
	{
		$sql = "SELECT * FROM users WHERE username = '{$username}'";
		return mysqli_query($this->connection, $sql);
	}
}

?>