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
            <?php $menu=new Menu();
		          $menu->printMenu(); ?>
        <div id="page-wrapper">          

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Mappa
                            <small>Trova le stazioni vicine</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-map-marker"></i> Mappa
                            </li>
                        </ol>
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
    <script src="<?=$config['js']?>/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$config['js']?>/bootstrap.min.js"></script>
    
    <!--Custom js-->
    <script type="text/javascript" src="<?=$config['js']?>Map/map.js"></script>

</body>

</html>