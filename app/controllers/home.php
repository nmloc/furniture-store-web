<?php

class Home extends Controller
{
	private $model;

    public function __construct()
	{
        // $this->model = $this->model('homeModel');
    }

	public function render()
	{
		$this->view("master_layout", [
			'page' => 'home',
		]);
	}
}