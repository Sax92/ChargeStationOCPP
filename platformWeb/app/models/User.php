<?php
class User{
	public $idUser;
	public $nome;
	public $cognome;
	public $nominativo;
	public $email;
	public $password;
	public $ruolo;
	public $indirizzo;
	public $citta;
	public $data_nascita;
	public $cellulare;
	public $telefono;
	public $pIva;
	public $eurKw;
	public $cf;
	public $approvato;
	
	public function User($res=null){
		if ($res!=null){
			$this->idUser = $res['idUser'];
			$this->email = $res['email'];
			$this->password = $res['password'];
			$this->ruolo = $res['ruolo'];
			$this->approvato="-";
			if ($this->ruolo=="user"){
				$this->indirizzo = $res['indirizzo'];
				$this->citta = $res['citta'];
				$this->data_nascita = $res['data_nascita'];
				$this->cellulare = $res['cellulare'];
				$this->telefono = $res['telefono'];
				$this->pIva = $res['pIva'];
				$this->eurKw = "-";
				$this->cf = $res['CF'];
				$this->nominativo="-";
				$this->nome = $res['nome'];
				$this->cognome = $res['cognome'];
			}else if($this->ruolo=="gestore"){
				$this->indirizzo = $res['indirizzo'];
				$this->citta = $res['citta'];
				$this->data_nascita = "-";
				$this->cellulare = $res['cellulare'];
				$this->telefono = $res['telefono'];
				$this->pIva = $res['pIva'];
				$this->eurKw = "-";
				$this->cf = "-";
				$this->nominativo=$res['nominativo'];	
				$this->nome = "-";
				$this->cognome = "-";
				$this->approvato = $res['approvato'];
			}
		}else{
			$this->idUser = "";
			$this->nome = "";
			$this->cognome = "";
			$this->email = "";
			$this->password = "";
			$this->ruolo = "";
			$this->indirizzo = "";
			$this->citta = "";
			$this->data_nascita = "";
			$this->cellulare = "";
			$this->telefono = "";
			$this->pIva = "";
			$this->eurKw = "";
			$this->cf = "";
			$this->nominativo = "";
			$this->approvato = "";
		}
		
	}   
	
} 
?>