<?php

class Database
{
	public $connection = 'home';
	protected $serverName = 'localhost';
	protected $username = 'root';
	protected $password = '';
	protected $dbname = 'OnlineStore';

	public function __construct()
	{
		$this->connection = mysqli_connect($this->serverName, $this->username, $this->password);

		if (!$this->connection) {
			die("Connection failed: " . mysqli_connect_error());
		}

		mysqli_select_db($this->connection, $this->dbname);
		mysqli_query($this->connection, "SET NAMES 'utf8'");
	}

	public function getVietnameseUnitsConnection()
    {
        $vietnameseUnitsConnection = mysqli_connect($this->serverName, $this->username, $this->password);

        if (!$vietnameseUnitsConnection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        mysqli_select_db($vietnameseUnitsConnection, 'vietnamese_administrative_units');
        mysqli_query($vietnameseUnitsConnection, "SET NAMES 'utf8'");

        return $vietnameseUnitsConnection;
    }
}

?>