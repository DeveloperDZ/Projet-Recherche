<?php

class odsFile{

    public $nomFichier;
    public $tailleFichier;

    function __construct($nom, $taille) {
        $nomFichier = $nom;
        $tailleFichier = $taille;
    }

    public function convertOdsToXlsx($file, $fileName){
        $objPHPExcel = new PHPExcel();
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
        $objSheet = $objPHPExcel->getActiveSheet();

        $pathODS = easy_ods_read::extract_content_xml($file,"./temp");
        $easy_ods_read = new easy_ods_read(0,$pathODS);

        $debut = key($easy_ods_read->rows_data);
        $fin = key( array_slice( $easy_ods_read->rows_data, -1, 1, TRUE ) );

        for($i=$debut;$i<=$fin;$i++){
            $debutC = key($easy_ods_read->rows_data[$i]);
            $finC = key( array_slice( $easy_ods_read->rows_data[$i], -1, 1, TRUE ) );

            $comptD = ord($debutC);
            $comptF = ord($finC);
            for($j=$comptD;$j<=$comptF;$j++){
                $tmp = chr($j);
                $var = $tmp.$i;
                $var = (string)$var;
                $objSheet->getCell($var)->setValue($easy_ods_read->rows_data[$i][$tmp]);
            }


            //echo("Colonne : $debutC -- $finC    <br>");
        }

        $objWriter->save('test.xlsx');

        $easy_ods_read->delete_temporary_directory("./temp");

        $this->convertXlsxToCsv('test.xlsx', $fileName);
        unlink('test.xlsx');
    }

    public function convertXlsxToCsv($file, $fileName){

        $reader = PHPExcel_IOFactory::createReader('Excel2007');
        $reader->setReadDataOnly(true);

        $excel = $reader->load($file);
        $writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');

        $fileName = basename($fileName, '.ods');

        $writer->save('data/'.$fileName.'.csv');

        echo '<div class="alert alert-success">Fichier uploader!  <a href="upload.html">Revenir au formulaire<a></div>';

    }


}

?>