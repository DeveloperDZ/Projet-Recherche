<?php

class htmlFile{

    public $nomFichier;
    public $tailleFichier;

    function __construct($nom, $taille) {
        $nomFichier = $nom;
        $tailleFichier = $taille;
    }

    public function convertHtmlToCsv($file, $fileName){
        $a = file_get_contents($file);

        preg_match('/<table(>| [^>]*>)(.*?)<\/table( |>)/is',$a,$b);
        $table = $b[2];
        preg_match_all('/<tr(>| [^>]*>)(.*?)<\/tr( |>)/is',$table,$b);
        $rows = $b[2];
        foreach ($rows as $row){
            preg_match_all('/<td(>| [^>]*>)(.*?)<\/td( |>)/is',$row,$b);
            $out[] = strip_tags(implode(';',$b[2]));
        }
        $out = implode("\n", $out);

        $fileName = basename($fileName, '.html');
        $fo = fopen('data/'.$fileName.'.csv', 'w+');
        fwrite($fo, $out);

        echo '<div class="alert alert-success">Fichier uploader!  <a href="upload.html">Revenir au formulaire<a></div>';

    }


}

?>