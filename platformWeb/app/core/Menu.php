<?php 
include 'Config.php';

//session_start();
class Menu{
	
	public function printMenu(){
		//in base al tipo di utente stampo il menu
		switch($_SESSION['user']['ruolo']){
			case "user": 
				$this->userMenu();
				break;
			case "gestore": 
				$this->gestoreMenu();
				break;
				
			case "admin": 
				$this->adminMenu();
				break;
		}
	}
	
	
	public function userMenu(){
        global $config;
		 echo'<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="'. $config['path_base'] .'userManager/">SpotLink manager</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> '. $_SESSION['user']['nome'] .' '. $_SESSION['user']['cognome'] .'<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="'. $config['path_base'] .'profile/"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <!--<li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>-->
                        <li class="divider"></li>
                        <li>
                            <a id="logout" href="'. $config['path_base'] .'userManager/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="userManager">
                        <a href="'. $config['path_base'] .'userManager/"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li id="map">
                        <a href="'. $config['path_base'] .'map/"><i class="fa fa-fw fa-map-marker"></i>Mappa</a>
                    </li>            
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>';
	}
	
	public function adminMenu(){
		
	}
	
	public function gestoreMenu(){
		
	}
} 

?>