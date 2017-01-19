<?php 

class Controller{
	protected function model($model,$param){
		require_once '../app/models/'. $model .'.php';
		return new $model($param);
	}
	
	public function view($view, $data=[]){
		require_once '../app/views/'.$view.'.php';
	}
	
	/*public function getAccess($actions,$method){
		if (isset($_SESSION['user'])){
			if (in_array($method,$actions)){
				
			}
		}
	}*/
}

?>