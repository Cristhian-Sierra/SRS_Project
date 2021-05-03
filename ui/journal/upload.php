<?php
$processed = false;
if (isset($_POST['insert'])) {
    
    $archivo = $_FILES["archivo"]["name"];
    $archivo_copiad =  $_FILES["archivo"]["tmp_name"];
    $archivo_guardado = "copia_".$archivo;
    //echo $archivo . " esta es la ruta temporal: " .$archivo_copiad;
    if(copy($archivo_copiad,$archivo_guardado)){
        echo "se copeo correctamente el archivo temporal a nuestra carpeta de trabajo";
    }else{
        echo"hubo un error <br/>";
    }
    if(file_exists($archivo_guardado)){
        $fp = fopen($archivo_guardado,'r');// abrir un archivo
        $rows = 0;
        $firstline = true;
while (($datos = fgetcsv($fp, 1000,";",'"')) !== FALSE)
{
    if (!$firstline) {
        //echo "Se insertaron correctamente los datos";
        $newJournal = new Journal($datos[0],$datos[2],$datos[4],$datos[5],$datos[6],$datos[7],$datos[8],$datos[10],$datos[11],$datos[12],$datos[18],"","");
        $resultado=$newJournal->insert_csv($datos[0],$datos[2],$datos[4],$datos[5],$datos[6],$datos[7],$datos[8],$datos[10],$datos[11],$datos[12],$datos[18]);
    }
    $firstline = false;
}
     

        
    }else{
        echo "No existe el archivo Copiado <br/>";
    }
    $user_ip = getenv('REMOTE_ADDR');
    $agent = $_SERVER["HTTP_USER_AGENT"];
    $browser = "-";
    if (preg_match('/MSIE (\d+\.\d+);/', $agent)) {
        $browser = "Internet Explorer";
    } else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent)) {
        $browser = "Chrome";
    } else if (preg_match('/Edge\/\d+/', $agent)) {
        $browser = "Edge";
    } else if (preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent)) {
        $browser = "Firefox";
    } else if (preg_match('/OPR[\/\s](\d+\.\d+)/', $agent)) {
        $browser = "Opera";
    } else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent)) {
        $browser = "Safari";
    }
    if ($_SESSION['entity'] == 'Administrator') {
        //$logAdministrator = new LogAdministrator("", "Create Journal", "Title: " . $title . "; Issn: " . $issn . "; Sjr: " . $sjr . "; Best_quartile: " . $best_quartile . "; Hindex: " . $hindex . "; Total_docs: " . $total_docs . "; Total_references: " . $total_references . "; Total_cites: " . $total_cites . "; Citable_docs: " . $citable_docs . "; Coverage: " . $coverage . "; Categories: " . $categories . "; Country: " . $nameCountry, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
        //$logAdministrator->insert();
    }
    $processed = true;
}


?>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Journal</h4>
                </div>
                <div class="card-body">
                    <?php if ($processed) { ?>
                        <div class="alert alert-success">Data Entered
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/journal/upload.php") ?>" enctype="multipart/form-data" class="bootstrap-form needs-validation">
                        <div>
                            <!-- FORMULARIO PARA SOICITAR LA CARGA DEL EXCEL -->
                            Selecciona el archivo a importar:
                            <input type="file" name="archivo" required />
                            <!--                                <input type='submit' name='enviar'  value="Importar"  />-->
                            <!-- CARGA LA MISMA PAGINA MANDANDO LA VARIABLE upload -->
                        </div>
                        <button type="submit" class="btn btn-info" name="insert">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>