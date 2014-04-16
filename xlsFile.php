<?php

class xlsFile{

	public $nomFichier;
	public $tailleFichier;

	function __construct($nom, $taille) {
        $nomFichier = $nom;
        $tailleFichier = $taille;
    }

    public function convertXlsToCsv($file, $fileName){
		$reader = PHPExcel_IOFactory::createReader('Excel5');
        $reader->setReadDataOnly(true);
         
        $excel = $reader->load($file);
        $writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');

        $fileName = basename($fileName, '.xls');

        $writer->save('data/'.$fileName.'.csv');
        
        echo '<div class="alert alert-success">Fichier uploader!  <a href="upload.html">Revenir au formulaire<a></div>';

	}


}

?>