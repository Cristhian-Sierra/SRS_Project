<?php
$processedC = false;


if(isset($_POST['relations'])){

    $archivo = fopen("./csv/scimagojr_category.csv", "r");
//Lo recorremos
    while (($datos = fgetcsv($archivo, 2000,";",'"')) !== FALSE)
    {

        $newJourCa = new Journalcategory();
        $resultado=$newJourCa->insertIdsJC($datos[0]);

    }
//Cerramos el archivo
    fclose($archivo);
    
$processedC = true;

}
?>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Ids to JournalCategory</h4>
                </div>
                <div class="card-body">
                    <form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/journalcategory/relationsJC.php") ?>" enctype="multipart/form-data" class="bootstrap-form needs-validation">
                        <button type="submit" class="btn btn-info" name="relations">Create relations</button>

                        <?php if ($processedC) { ?>
                            <div class="alert alert-success">Relations to JC entered
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <script type="text/javascript">
                            Push.create("Relations to JC success",{
                                body:"The creations of The Journal-to-Category relationships were successful",
                                icon:"img/logo.png",
                                timeout:10000
                                
                                /*onClick: function(){
                                    window.location="https://pushjs.org/docs/quick-start";
                                   
                                }*/
                            });
                        </script>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>