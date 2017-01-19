<?php global $config?>
<!DOCTYPE html>
<html lang="it">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SpotLink manager</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=$config['css']?>bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=$config['css']?>sb-admin.css" rel="stylesheet">
    <link href="<?=$config['css']?>style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link href="<?=$config['fontaw']?>font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    
    <div id="wrapper">

        <!--stampo il menu in base al ruolo -->
        <?php 
            $menu=new Menu();
            $menu->printMenu(); 
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Panoramica</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <!--Pannelli info rapide-->
                <div id="quickInfo" class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-battery-three-quarters fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div id="numberRecharge" class="huge">26</div>
                                        <div>Rifornimenti</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#lastRecharge">
                                <div class="panel-footer">
                                    <span class="pull-left">Vedi dettagli</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-lightbulb-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div id="kwTot" class="huge">12</div>
                                        <div>Kw totali</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#lastRecharge">
                                <div class="panel-footer">
                                    <span class="pull-left">Vedi dettagli</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-credit-card-alt fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="medium">Coupon</div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                            <a href="#coupon">
                                <div class="panel-footer">
                                    <span class="pull-left">Vedi dettagli</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-street-view fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Mappa</div>
                                        <div>Scopri le stazioni vicine</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?=$config['path_base']?>map/">
                                <div class="panel-footer">
                                    <span class="pull-left">Vai alla mappa</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                <!--Ricarica in corso-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-spinner"></i> Rifornimento in corso</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <img class="img-responsive" src="<?=$config['img']?>car.png"/>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-xs-6 rTitle">
                                            KW istantanei
                                        </div>
                                        <div class="col-xs-6 rBody">
                                            15
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 rTitle">
                                            KW Totali
                                        </div>
                                        <div class="col-xs-6 rBody">
                                            50
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 rTitle">
                                            Importo €
                                        </div>
                                        <div class="col-xs-6 rBody">
                                            4.50
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                <!--Ultime ricariche-->
                <div class="row">
                    <div class="col-lg-12">  
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-battery-three-quarters fa-fw"></i> Ultimi rifornimenti</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="lastRecharge" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Data e Ora inizio</th>
                                                <th>Data e Ora fine</th>
                                                <th>KW ricaricati</th>
                                                <th>Importo €</th>
                                                <th>Colonnina</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="allRecharge">Vedi tutti i rifornimenti <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>       
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                <!--Coupon attivi-->
                <div class="row">
                    <div class="col-lg-12">  
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-credit-card-alt fa-fw"></i> Coupon</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="coupon" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Codice</th>
                                                <th>Tipo</th>
                                                <th>Descrizione</th>
                                                <th>Valore €</th>
                                                <th>Scadenza</th>
                                            </tr>
                                        </thead>
                                        <tbody>  
                                        </tbody>
                                    </table>
                                </div>
                            </div>       
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?=$config['js']?>jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$config['js']?>bootstrap.min.js"></script>
    
    <!--Custom js-->
    <script type="text/javascript" src="<?=$config['js']?>UserManager/userManager.js"></script>

</body>

</html>