<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class RegisterModel extends Database
{
	public function register($name, $username, $password, $province, $district, $ward)
	{
		$sql = "INSERT INTO users (name, username, password, province, district, ward) VALUES ('$name', '$username', '$password', '$province', '$district', '$ward')";
		$result = false;
		if (mysqli_query($this->connection, $sql)) {
			$result = true;
		}
		return json_encode($result);
	}

	public function getProvinces()
    {
        $sql = "SELECT * FROM provinces ORDER BY name_en ASC";
		return mysqli_query($this->getVietnameseUnitsConnection(), $sql);
    }

	public function getDistricts($provinceCode)
    {
		$sql = "SELECT * FROM districts WHERE province_code = '{$provinceCode}' ORDER BY name_en ASC";
		return mysqli_query($this->getVietnameseUnitsConnection(), $sql);
    }

	public function getWards($districtCode)
    {
		$sql = "SELECT * FROM wards WHERE district_code = '{$districtCode}' ORDER BY name_en ASC";
		return mysqli_query($this->getVietnameseUnitsConnection(), $sql);
    }
}

?>