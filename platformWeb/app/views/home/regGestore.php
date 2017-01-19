<?php global $config?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spotlink manager</title>
    
    <link rel="stylesheet" href="<?=$config['css']?>reset.css">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='<?=$config['fontaw']?>font-awesome.min.css'>
    <link rel="stylesheet" href="<?=$config['css']?>regGestore.css">
  </head>

  <body>

    
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  <img class="img-responsive" src="<?=$config['img']?>logo_spotlink.png" />
</div>
<div class="pen-title">
  <img class="img-responsive" src="<?=$config['img']?>logo_emotion3.png" />
</div>  
<!-- Form Module-->
<div class="module form-module">
  
 
  <div class="form">
    <h2>Crea un account</h2>
    <form action="registerGestore" method="post">
      <input name="ditta" type="text" required placeholder="Nominativo"/>
      <input name="email" type="email" required placeholder="E-mail"/>
      <input name="pwd" type="password" required placeholder="Password"/>
      <input name="fisso" type="text" placeholder="Tel. fisso"/>
      <input name="cel" type="text" placeholder="Cellulare"/>     
      <input name="citta"  type="text" placeholder="Città"/>
      <input name="indirizzo"  type="text" placeholder="Indirizzo"/>
      <input class="text-uppercase" name="pIva" type="text" placeholder="P. IVA"/>
      <button type="submit" id="register">Registrati</button>
    </form>
  </div>
 
  
</div>
<div id="testDb"></div>
    <script src='<?=$config['js']?>jquery.js'></script>
    
    
  </body>
</html>
