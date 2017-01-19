<?php global $config?>
<!DOCTYPE html>
<html lang="it">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link  href="<?=$config['css']?>bootstrap.min.css" rel="stylesheet">
	<link  href="<?=$config['css']?>login.css" rel="stylesheet">
	<link href="<?=$config['fontaw']?>font-awesome.min.css" rel="stylesheet" type="text/css">
	 
</head>
<body>
<div class="container">
  <div class="row">

  		<div class="col-lg-3"></div>
  		<div class="col-lg-6">
			<div class="panel panel-danger ops">
				<div class="panel-heading"><h1>OPS!!! <i class="fa fa-exclamation-triangle"></i></h1></div>
					<div class="panel-body">
						
							<h2>Errore di registrazione.</h2><hr>
							
							<div class="row">
								<div class="col-md-3 freccia">
									<a href="index"><i class="fa fa-angle-double-left"></i></a>
								</div>
								<div class="col-md-8 "><h2 id="scritta">Premere la freccia per tornare alla pagina di accesso.</h2></div>
							</div>
					</div>	
				
			</div>
		</div>
  		<div class="col-lg-3"></div>

  </div>
</div>
  <!-- jQuery -->
    <script src="<?=$config['js']?>jquery.js"></script>
 <!-- Bootstrap Core JavaScript -->
    <script src="<?=$config['js']?>bootstrap.min.js"></script>
</body>

</html> 


