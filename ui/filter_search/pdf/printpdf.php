<?php
require_once 'business/Filter_search.php';
$bo= new Filter_search();
$searchs= $bo->selectAll();
//$searchs = unsearialize($_POST["searchs"]);
class printpdf extends fpdf
{


    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('logo.png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(60,10,'Busquedas de usuario',1,0,'C');
        // Salto de línea
        $this->Ln(20);
    }
    
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
    
}
//if(isset($_POST["filter_searchs"])){}
    // Creación del objeto de la clase heredada
    

    $pdf = new printpdf();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    while ($row = $searchs -> fetch_assoc()){
        $pdf->Cell(90,10,$row['search_date']);
    }
   
    $pdf->Output();



   // unserialize($_POST["searchs"]);
?>