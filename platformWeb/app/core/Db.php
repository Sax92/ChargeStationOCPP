<?php 

class Db{
	
	//connessione DB
	public function connect(){
		// collegamento al database con PDO
		$col = 'mysql:host=localhost;dbname=emotion_db';
			
		// blocco try per il lancio dell'istruzione
		try {
		// connessione tramite creazione di un oggetto PDO
		$db = new PDO($col , 'root', '');
		return $db;
		}
		// blocco catch per la gestione delle eccezioni
		catch(PDOException $e) {
		// notifica in caso di errorre
		echo 'Attenzione: '.$e->getMessage();
		}
	}
	
	//LOGIN
	public function qLogin($email,$password){
		$db = $this->connect();
		try{
			// preparazione della query 
			$sql = $db->prepare('SELECT * FROM User WHERE email = :email and password = :password');
			//binding dei parametri
			$sql->bindParam(':email',$email);
			$sql->bindParam(':password',md5($password));
			// esecuzione della query 
			$sql->execute();
			// creazione di un array dei risultati
			if ($row = $sql->rowCount()>0){
				$res = $sql->fetch();
				return $res;
			}
			else{
				return false;
			}	
		}catch(PDOException $ex){
			$ex->getMessage();
		}
		
	}
	
	//REGISTRAZIONE UTENTI
	public function qRegister($nome,$cognome,$email,$password,$fisso,$cel,$data_nascita,$citta,$indirizzo,$pIva,$cf){
		$db = $this->connect();
		// preparazione della query 
		$sql = $db->prepare("INSERT INTO User (nome, cognome, email, password, ruolo, indirizzo, citta, data_nascita, cellulare, telefono, pIva, CF)".
							"VALUES (:nome,:cognome,:email,:password,:ruolo,:indirizzo,:citta,:data_nascita,:cel,:fisso,:pIva,:CF)");
		try{
			// esecuzione della query
			$pwdhashed=md5($password); //hashing password
			$ruolo="user";	
			$sql->bindParam(':nome',$nome);
			$sql->bindParam(':cognome',$cognome);	
			$sql->bindParam(':email',$email);
			$sql->bindParam(':password',$pwdhashed);
			$sql->bindParam(':ruolo',$ruolo);
			$sql->bindParam(':indirizzo',$indirizzo);
			$sql->bindParam(':citta',$citta);
			$sql->bindParam(':data_nascita',$data_nascita);
			$sql->bindParam(':cel',$cel);
			$sql->bindParam(':fisso',$fisso);
			$sql->bindParam(':pIva',$pIva);
			$sql->bindParam(':CF',$cf);	
			if($sql->execute()){
				return true;
			}
			
		}catch(PDOException $ex){
			$ex->getMessage();
			return false;
		}						
	}
	
	//REGISTRAZIONE GESTORE
	public function qRegisterGestore($ditta,$email,$password,$fisso,$cel,$citta,$indirizzo,$pIva){
		$db = $this->connect();
		// preparazione della query 
		$sql = $db->prepare("INSERT INTO User (ditta, email, password, ruolo, indirizzo, citta, cellulare, telefono, pIva, eurKw, approvato) ".
							"VALUES (:ditta, :email, :password, :ruolo, :indirizzo, :citta, :cellulare, :fisso, :pIva, :eurKw, :approvato)");
		try{
			// esecuzione della query
			$pwdhashed=md5($password); //hashing password
			$ruolo="gestore";
			$approvato=0;
			$eurKw=0;		
			$sql->bindParam(':ditta', $ditta);
			$sql->bindParam(':email', $email);
			$sql->bindParam(':password', $pwdhashed);
			$sql->bindParam(':ruolo', $ruolo);
			$sql->bindParam(':indirizzo', $indirizzo);
			$sql->bindParam(':citta', $citta);
			$sql->bindParam(':cellulare', $cel);
			$sql->bindParam(':fisso', $fisso);
			$sql->bindParam(':pIva', $pIva);
			$sql->bindParam(':eurKw', $eurKw);
			$sql->bindParam(':approvato', $approvato);
			//print_r($sql);
			if($sql->execute()){
				return true;
			}
			
		}catch(PDOException $ex){
			$ex->getMessage();
			return false;
		}						
	}
	
	/*****GESTIONE UTENTE BASE*******/
	
	//ULTIME RICARICHE
	public function qGetRecharge($idUser){
		$db=$this->connect();
		try{
			$sql=$db->prepare("SELECT DATE_FORMAT(dataStart,'%d/%m/%Y %H:%i') AS dataStart, DATE_FORMAT(dataStop,'%d/%m/%Y %H:%i') AS dataStop, kwTot, importoTot, fkTower FROM ".
							"History_Charge JOIN Tower ".
							"ON History_Charge.fkTower=Tower.idTower ". 
							"WHERE History_Charge.fkUser = :idUser ". 
							"ORDER BY dataStart DESC");
			$sql->bindParam(':idUser',$idUser);
			if($sql->execute()){
				if ($row = $sql->rowCount()>0){
					while($res = $sql->fetch()){
						$result[]=$res;
					}
					return $result;
				}
			}else{
				return false;
			}	
		}catch(PDOException $ex){
			$ex->getMessage();
			return false;
		}
	}
	
	//STATO COUPON
	public function qGetCouponState($idUser){
		$db=$this->connect();
		
		try{
			$sql=$db->prepare("SELECT DATE_FORMAT(scadenza,'%d/%m/%Y') AS scadenza, codice, tipo, descrizione, valore FROM ".
							"Coupon JOIN ".
							"(User_Coupon JOIN User ".
							"ON User_Coupon.fkUser=User.idUser) ".
							"ON Coupon.idCoupon=User_Coupon.fkCoupon ". 
							"WHERE User.idUser = :idUser ");
			$sql->bindParam(':idUser',$idUser);
			if($sql->execute()){
				if ($row = $sql->rowCount()>0){
					while($res = $sql->fetch()){
						$result[]=$res;
					}
					return $result;
				}
			}else{
				return false;
			}	
		}catch(PDOException $ex){
			$ex->getMessage();
			return false;
		}	
	}
	
	//NUMERO RICARICHE EFFETTUATE
	public function qGetRechargeNumber($idUser){
		$db=$this->connect();
		try{
			$sql=$db->prepare("SELECT COUNT(*) AS num ".
								"FROM History_Charge ".
								"WHERE fkUser = :idUser");
			$sql->bindParam(':idUser',$idUser);
			if($sql->execute()){
				if ($row = $sql->rowCount()>0){
					$res = $sql->fetch();
					$result[]=$res;
					return $result;
				}
			}else{
				return false;
			}	
		}catch(PDOException $ex){
			$ex->getMessage();
			return false;
		}	
	}
	
	//TOTALE KW RICARICATI
	public function qGetTotKW($idUser){
		$db=$this->connect();
		try{
			$sql=$db->prepare("SELECT SUM(kwTot) AS tot ".
								"FROM History_Charge ".
								"WHERE fkUser = :idUser");
			$sql->bindParam(':idUser',$idUser);
			if($sql->execute()){
				if ($row = $sql->rowCount()>0){
					$res = $sql->fetch();
					$result[]=$res;
					return $result;
				}
			}else{
				return false;
			}	
		}catch(PDOException $ex){
			$ex->getMessage();
			return false;
		}	
	}

}

?>