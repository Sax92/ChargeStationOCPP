<?php 
session_start();
global $config;
if (!isset($_SESSION['user'])){
	header("Location: ".$config['path_base']."home/");
}

class UserManager extends Controller{
	
	
	public function index(){
		/*$user = $this->model('User');
		$user->name = $name;*/
		//$this->view('home/index',['name' => $user->name]);
		$this->view('userManager/main');
	}
	
	public function logout(){
		global $config;
		unset($_SESSION['user']);
		session_unset();
		header("Location: ".$config['path_base']."home/");
	}
	
	//numero ricariche
	public function getRechargeNumber(){
		$db=new Db();
		$result=$db->qGetRechargeNumber($_SESSION['user']['idUser']);
		if($result!=false){
			echo $result[0]['num'];
		}else{
			return false;
		}
	}
	
	//ultime ricariche
	public function getLastRecharge(){
		$db=new Db();
		$result=$db->qGetRecharge($_SESSION['user']['idUser']);
		if($result!=false){
			$cont=1;
			$row=0;
			foreach($result as $res){
				if ($row < 10){
					echo '<tr>'. 
					'<td>'. $cont .'</td>'.
					'<td>'. $res['dataStart'] .'</td>'.
					'<td>'. $res['dataStop'] .'</td>'.
					'<td>'. $res['kwTot'] .'</td>'.
					'<td>'. $res['importoTot'] .'</td>'.
					'<td>'. $res['fkTower'] .'</td>'.
					'</tr>';
					$cont++;
					$row++;
				}else{
					break;
				}
			}
		}else{
			return false;
		}
	}
	
	//stato Coupon
	public function getCouponState(){
		$db=new Db();
		$result=$db->qGetCouponState($_SESSION['user']['idUser']);
		if($result!=false){
			foreach($result as $res){
				$scadenza= ($res['scadenza']) ? $res['scadenza']:"-";
				$valore= ($res['valore']) ? $res['valore']:"-";
				echo '<tr>'. 
					'<td>'. $res['codice'] .'</td>'.
					'<td>'. $res['tipo'] .'</td>'.
					'<td>'. $res['descrizione'] .'</td>'.
					'<td>'. $valore .'</td>'.
					'<td>'. $scadenza .'</td>'.
					'</tr>';
			}
		}else{
			return false;
		}
	}
	
	//kw totali
	public function getTotKW(){
		$db=new Db();
		$result=$db->qGetTotKW($_SESSION['user']['idUser']);
		if($result!=false){
			if ($result[0]['tot']==null){
				$result[0]['tot']=0;
			}
			echo $result[0]['tot'];
		}else{
			return false;
		}
	}
	
	//vista tutte ricariche
	public function allRecharge(){
		$this->view('userManager/recharge');
	}
	
	public function getAllRecharge(){
		$db=new Db();
		$result=$db->qGetRecharge($_SESSION['user']['idUser']);
		if ($result != false){
			$row=1;
			foreach($result as $res){
				echo '<tr>'.
				'<td>'. $row .'</td>'.
				'<td>'. $res['dataStart'] .'</td>'.
				'<td>'. $res['dataStop'] .'</td>'.
				'<td>'. $res['kwTot'] .'</td>'.
				'<td>'. $res['importoTot'] .'</td>'.
				'<td>'. $res['fkTower'] .'</td>';
				$row++;
			}
		}else{
			return false;
		}
	}
	
	
}

?> 