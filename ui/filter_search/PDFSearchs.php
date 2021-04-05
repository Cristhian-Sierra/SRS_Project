<?php
require "pdf/class.ezpdf.php";



$filterS = new  Filter_search();

$filS=$filterS->selectAll();

$pdf =new Cezpdf('a4');
$pdf->selectFont('pdf/fonts/Times-Roman.afm');
$pdf->ezText("<b>Searchs</b>\n", 30, array("justification" => "center") );
$opciones = array('width' => '500');
$cols = array('nro' => 'Nro',
    'search_date' => 'Search date' ,
    'search_time' => 'Search time' ,
    'hindex_filter' => 'H index filter',
    'references_filter' => 'References filter',
    'country_filter' => 'Country filter',
    'category_filter' => 'Category filter',
    'area_filter' => 'Area filter',
    'quartile_filter' => 'Quartile filter',
    'sjr_filter' => 'SJR filter'
    
);
$i=0;

foreach($filS as $fs){

    $datos[$i]=array(
     'nro' => $i ,   
    'search_date' => $fs->getSearch_date() ,
    'search_time' => $fs->getSearch_time()  ,
    'hindex_filter' => $fs->getHindex_filter(),
    'references_filter' => $fs->getReferences_filter(),
    'country_filter' => $fs->getCountry_filter(),
    'category_filter' => $fs->getCategory_filter(),
    'area_filter' => $fs->getArea_filter(),
    'quartile_filter' => $fs->getQuartile_filter(),
    'sjr_filter' => $fs->getSjr_filter()
    );
    $i=$i+1;
}


$pdf->ezTable($datos,$cols,"",$opciones);
$pdf->ezText("\n\n",10);
/*$pdf->ezText("Total a pagar:".$total,20);
$pdf->ezText("Cliente: ".$cliente->getNombre()." ".$cliente->getApellido(),15);
$pdf->ezText("\n",10);*/
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n",10);

ob_end_clean();
$pdf->ezStream();

?>