<?php

class csvFile{

  public $nomFichier;
  public $tailleFichier;

  function __construct($nom, $taille) {
        $nomFichier = $nom;
        $tailleFichier = $taille;
    }

  public function uploadFile($file, $path){
    if(move_uploaded_file($file, $path)){
      echo '<div class="alert alert-success">Fichier uploader!  <a href="upload.html">Revenir au formulaire<a></div>';
    }else{
      echo '<div class="alert alert-danger">Fichier non uploader!  <a href="upload.html">Revenir au formulaire<a></div>';
    }
  }

}

?>