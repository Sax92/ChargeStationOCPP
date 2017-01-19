<?php 
session_start();
global $config;
if (!isset($_SESSION['user'])){
	header("Location: ".$config['path_base']."home/");
}

class Map extends Controller{
	
	
	public function index(){
		$this->view('map/map');
	}

}

?> 