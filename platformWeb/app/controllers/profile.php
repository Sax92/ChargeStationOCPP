<?php
session_start();
if (!isset($_SESSION['user'])){
	header("Location: ".$config['path_base']."home/");
}

class Profile extends Controller{
	public function index(){
		switch($_SESSION['user']['ruolo']){
			case "user":
				$this->view('profile/userProfile');
				break;
			case "gestore":
				$this->view('profile/gestProfile');
				break;
			case "admin":
				$this->view('profile/adminProfile');
				break;		
		}
		
	}
}