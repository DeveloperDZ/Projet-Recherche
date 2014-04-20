<?php 
  include 'csvFile.php';
  include 'xlsFile.php';
  include 'xlsxFile.php';
  include 'htmlFile.php';
  require_once('PHPExcel/Classes/PHPExcel.php');
  include 'excel_reader2.php';
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Projet Recherche</title>
  
  <link href="css/bootstrap-3.1.1-dist/css/bootstrap.css" rel="stylesheet">
  <script src="js/app.js"></script>
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.html">PERSONAL BI</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.html">Accueil</a></li>
        
        <li class="active"><a href="upload.html">Déposer un fichier</a></li>
        
      </ul>
      <form class="navbar-form navbar-left" role="search" method="get" action="http://www.google.com/custom">
        <div class="form-group">
          <input type="text" name="q" class="form-control" placeholder="Rechercher un fichier...">
        </div>
        <button type="submit" class="btn btn-default">Valider</button>
      </form>
    
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

  <?php
  $extensions_valides = array( 'csv', 'xls', 'xlsx', 'html', 'ods' );
  $extension_upload = strtolower(  substr(  strrchr($_FILES['fichier']['name'], '.')  ,1)  );
  
  if ( !in_array($extension_upload,$extensions_valides) ) {
    echo '<div class="alert alert-danger">Extension incorrect ou pas de fichier!  <a href="upload.html">Revenir au formulaire<a></div>'; 
  }
  else{
    $file = $_FILES["fichier"]["tmp_name"];
    $size = $_FILES["fichier"]["size"];
    $fileName = $_FILES["fichier"]["name"];
    $path = "data/".$fileName;

    switch ($extension_upload) {
      case 'csv':
        $upCSV = new csvFile($fileName, $size);
        $upCSV::uploadFile($file, $path);
        break;
      
      case 'xls':
        $upXSL = new xlsFile($fileName, $size);
        $upXSL::convertXlsToCsv($file, $fileName);
        break;

      case 'xlsx':
        $upXSLX = new xlsxFile($fileName, $size);
        $upXSLX::convertXlsxToCsv($file, $fileName);
        break;
        
      case 'html':
          $upHTML = new htmlFile($fileName, $size);
          $upHTML::convertHtmlToCsv($file, $fileName);


          break;
      default:
        # code...
        break;
    }
  }



  ?>



    <footer>
      
    <!-- Placez ici le contenu du pied de page -->
</footer>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</html>
