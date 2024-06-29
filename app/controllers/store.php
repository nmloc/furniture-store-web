<?php
class Store extends Controller
{
	private $model;

    public function __construct()
	{
        $this->model = $this->model('storeModel');
    }

	public function render()
	{
		$this->view("master_layout", [
			'page' => 'store',
			'stores' => $this->fetchStores(),
		]);
	}

	public function fetchStores(){
		$stores = $this->model->getStores();

		$result = [];
		while ($row = mysqli_fetch_array($stores)) { 
			$store = [
				'id' => $row['id'],
				'name' => $row['name'],
				'latitude' => $row['latitude'],
				'longitude' => $row['longitude'],
			];
		
			$result[] = $store;
		}

		return json_encode($result);
	}
}

?>