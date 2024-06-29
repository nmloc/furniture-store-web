<?php

class Products extends Controller
{
	private $model;
	// private $productsArr = [];

    public function __construct()
	{
        $this->model = $this->model('productsModel');
    }

	public function render()
	{
		$this->view("master_layout", [
			'page' => 'products',
			'products' => $this->model->load(),
			'totalProductsCount' => $this->model->getTotalProductsCount(),
		]);
	}


	public function getProductsJSON(){
		return $this->model->getProductsJSON();
	}

	public function search(){
		if (isset($_POST['search'])) {
			$result = $this->model->search(trim($_POST['search']));
			while ($row = mysqli_fetch_array($result)) {
				echo ('<li class="list-group-item"><img src="' . $row['imageUrl'] . '" height="35" width="35" class="img-thumbnail" /> ' . $row['name'] . ' | <span class="text-muted">' . $row['price'] . '</span></li>');
			}
		}
	}

	public function load(){

		return $this->model->load();
	}

	public function lazyLoad($lastId){
		$result = $this->model->lazyLoad($lastId);
		while ($product = mysqli_fetch_assoc($result)) {
			echo (
			'<div class="col-12 col-md-4 col-lg-3 mb-5">'.
				'<a class="product-item" href="#" id="' . $product['id'] . '" name="' . $product['id'] .'">'.
					'<img src="' .$product['imageUrl']. '" class="img-fluid product-thumbnail" width="250">'.
					'<h3 class="product-title">' .$product['name']. '</h3>'.
					'<strong class="product-price">$' .$product['price']. '</strong>'.

					'<span class="icon-cross"> <img src="./public/images/cross.svg" class="img-fluid"> </span>
				</a>
			</div>
			');
		}
	}
}

?>