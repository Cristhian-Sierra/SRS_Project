

<?php
require "pdf/class.ezpdf.php";
$user_ip = getenv('REMOTE_ADDR');
$agent = $_SERVER["HTTP_USER_AGENT"];
$browser = "-";
if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
    $browser = "Internet Explorer";
} else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
    $browser = "Chrome";
} else if (preg_match('/Edge\/\d+/', $agent) ) {
    $browser = "Edge";
} else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
    $browser = "Firefox";
} else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
    $browser = "Opera";
} else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
    $browser = "Safari";
}
$administrator=new Administrator();
$logAdministrator = new LogAdministrator("", "View PDF reports", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $administrator -> getIdAdministrator());
$logAdministrator -> insert();

$filterS = new  Filter_search();

$filS=$filterS->selectAll();

$pdf =new Cezpdf('a4');
$pdf->selectFont('pdf/fonts/Times-Roman.afm');
$pdf->ezText("<b>Search Reports </b>\n", 30, array("justification" => "center") );
$opciones = array('width' => '550');
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
$i=1;

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
$pdf->ezText("<b>Current date:</b> ".date("d/m/Y"),10);
$pdf->ezText("<b>Current time:</b> ".date("H:i:s")."\n\n",10);

ob_end_clean();
$pdf->ezStream();

?>