<?php
session_start();


class Home extends Controller{
	
	//funzione che richiama la homepage
	public function index(){
		global $config;
		//controllo se utente esiste altrimenti, redirect al login
		if (isset($_SESSION['user'])){
			header("Location: ".$config['path_base']."userManager/");	
		}else{
			$this->view('home/index');

		}	
	}
	
	//funzione che effettua il login e inizializza l'utente
	public function login(){
		global $config;
		$db=new Db();
		$result = $db->qLogin($_POST['email'],$_POST['pwd']);
		if ($result != false){
			$user = unserialize(serialize($this->model('User',$result)));	
			$_SESSION['user']=array();
			$_SESSION['user']['idUser']=$user->idUser;
			$_SESSION['user']['nome']=$user->nome;
			$_SESSION['user']['cognome']=$user->cognome;
			$_SESSION['user']['email']=$user->email;
			$_SESSION['user']['password']=$user->password;
			$_SESSION['user']['ruolo']=$user->ruolo;
			$_SESSION['user']['indirizzo']=$user->indirizzo;
			$_SESSION['user']['citta']=$user->citta;
			$_SESSION['user']['data_nascita']=$user->data_nascita;
			$_SESSION['user']['cellulare']=$user->cellulare;
			$_SESSION['user']['telefono']=$user->telefono;
			$_SESSION['user']['pIva']=$user->pIva;
			$_SESSION['user']['cf']=$user->cf;
			$_SESSION['user']['eurKw']=$user->eurKw;
			
			//in base al ruolo faccio il redirect
			switch($_SESSION['user']['ruolo']){
				case "user":
					header("Location: ".$config['path_base']."userManager/");
					break;
				case "gestore":
					if ($_SESSION['approvato']==1){
						header("Location: ".$config['path_base']."Manager/");
					}else{
						unset($_SESSION['user']);
						$this->view('home/notApproved');
					}
					break;
				case "admin":
					header("Location: ".$config['path_base']."Manager/");
					break;
			}
			
		}else{
			$this->view('home/errorLogin');
		}
	}
	
	//funzione registrazione utente
	public function register(){
		$db=new Db();
		if($result=$db->qRegister($_POST['nome'],$_POST['cognome'],$_POST['email'],$_POST['pwd'],$_POST['fisso'],$_POST['cel'],$_POST['datana'],$_POST['citta'],$_POST['indirizzo'],$_POST['pIva'],$_POST['cf'])){
			mail($_POST['email'], "Conferma registrazione", "
			Messaggio inviato da: SpotLink\n" .
			"Username: ".$_POST['email']."". 
			"pwd: ".$_POST['pwd']);
			$this->view('home/confirm');	
		}
		else{
			$this->view('home/errorRegistration');
		}
	}
	
	public function regGestore(){
		$this->view('home/regGestore');
	}
	
	//funzione registrazione gestore
	public function registerGestore(){
		$db=new Db();
		if($result=$db->qRegisterGestore($_POST['ditta'],$_POST['email'],$_POST['pwd'],$_POST['fisso'],$_POST['cel'],$_POST['citta'],$_POST['indirizzo'],$_POST['pIva'])){
			$this->view('home/confirmGestore');	
		}
		else{
			$this->view('home/errorRegistration');
		}
	}
	
} 
?>