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
    <link rel="stylesheet" href="<?=$config['css']?>login.css">
    <script src="<?=$config['js']?>js-webshim/minified/polyfiller.js"></script> 
    <script> 
        // load and implement all unsupported features 
        webshims.polyfill();
        // or only load a specific feature
        //webshims.polyfill('forms es5');
    </script>
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
  <img class="img-responsive" src="<?=$config['img']?>logo_emotion.png" />
</div>  
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
   <!-- <div class="tooltip">REGISTRATI</div>-->
  </div>
  <div class="form">
    <h2>Accedi al tuo account</h2>
    <form action="login" method="post">
      <input name="email" type="email" required placeholder="E-mail"/>
      <input name="pwd" type="password" required placeholder="Password"/>
      <button type="submit">Login</button>
    </form>
  </div>
  <div class="form">
    <h2>Crea un account</h2>
    <form action="register" method="post">
      <input name="nome" type="text" required placeholder="Nome"/>
      <input name="cognome" type="text" required placeholder="Cognome"/>
      <input name="email" type="email" required placeholder="E-mail"/>
      <input name="pwd" type="password" required placeholder="Password"/>
      <input name="fisso" type="text" placeholder="Tel. fisso"/>
      <input name="cel" type="text" placeholder="Cellulare"/>
      <input name="datana"  type="date" placeholder="Data di nascita"/>
      <input name="citta"  type="text" placeholder="Città"/>
      <input name="indirizzo"  type="text" placeholder="Indirizzo"/>
      <input class="text-uppercase" name="pIva" type="text" placeholder="P. IVA"/>
      <input class="text-uppercase" name="cf" type="text" placeholder="Codice fiscale">
      <button type="submit" id="register">Registrati</button>
    </form>
  </div>
  <div id="reg" class="cta2">Registrati</div>
  <div id="forget" class="cta"><a href="#">Password dimenticata?</a></div>
  
</div>
<div id="testDb"></div>
    <script src='<?=$config['js']?>jquery.js'></script>
    <script src="<?=$config['js']?>login.js"></script> 
    
  </body>
</html>
