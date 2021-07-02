   <head>

</head>
<?php 
    require_once ('business/Area.php');
   
    require_once ('business/Category.php');
    require_once ('business/Country.php');
    require_once ('business/Filter_search.php');
    require_once ('business/Journal.php');
    

    $areaFilter= new Area();//Instance from business in the Area class
    $areasF=$areaFilter->selectAll();//Method that get all the dates from db table Area

    $categoryFilter= new Category();//Instance from business in the Category class
    $categoriesF=$categoryFilter->selectAll();//Method that get all the dates from db table Category

    $countryFilter= new Country();//Instance from business in the Country class
    $countrysF=$countryFilter->selectAll();//Method that get all the dates from db table Country

    //date_default_timezone_set('UTC');
    date_default_timezone_set("America/Bogota");
    $date = date("Y-m-d");
    $time = date("H:i a");


    $area="";
    if(isset($_POST["areas"])){
        $area=$_POST["areas"];

    }

    $category="";
    if(isset($_POST["categories"])){
        $category=$_POST["categories"];
    }

    $country="";
    if(isset($_POST["countries"])){
        $country=$_POST["countries"];

    }

    $hindex="";
    if(isset($_POST["hindex"])){
        $hindex=$_POST["hindex"];

    } 

    $references="";
    if(isset($_POST["references"])){
        $references=$_POST["references"];

    }

    $sjr=""; 
    if(isset($_POST["sjr"])){
        $sjr=$_POST["sjr"];

    }

    $quartile="";
    if(isset($_POST["quartile"])){
        $quartile=$_POST["quartile"];

    } 

    /*if(isset($_POST["Action"])){

    }*/
?>
<script type="text/javascript">
    
    $('#Action').on('click', function(){
    <?php 
       $valorA =$area;
       $valorCa =$category;
       $valorCo=$country;
       $valorQ =$quartile;
       $valorH =$hindex;
       $valorR =$references;
       $valorS =$sjr;

        $filterSClass = new Filter_search("",$date,$time,$hindex,$references,$country,$category,$area,$quartile,$sjr);
        $filterSClass->insert();
    ?>
  
  });
</script>
<div align="center">
    <?php include("ui/header.php"); ?>
</div>
<br> <br>
<script type="text/javascript">
    $(document).ready(function() {
        $("form").keypress(function(e) {
            if (e.which == 13) {
                return false;
            }
        });
    });
</script>
<form action="index.php?pid=<?php echo base64_encode("ui/filter_search/filterSearchPage.php") ?>" method="POST">
    <div class="container-fluid" align="center"   >
        <div class="row" style="position:relative; left: -45px;">
            <div class="col col-lg-12 col-xl-12">
                <label>Area: 
                    <select name="areas" id="areas" class="form-control input-sm" >
                        <option  value="0">All areas</option >
                        <?php 
                        $i=1;
                        foreach($areasF as $aF ){
                            if ($aF->getIdArea()==$valorA){?>
                                <option value= "<?php echo $aF->getIdArea() ?>" selected> <?php echo utf8_decode($aF->getName()) ?> </option >;
                
                            <?php
                            }
                            else{              
                            ?>
                            <option value= "<?php echo $aF->getIdArea() ?>"> <?php echo utf8_decode($aF->getName()) ?> </option >;
                            <?php
                            $i++;}
                        }?>
                        </select>
                    </label>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#areas').select2({
                                 theme:'bootstrap4'

                            });
                        });
                    </script>

                    <label>Category: 
                        <select name="categories" id="categories" class="form-control input-sm">
                            <option  value="0">All Categories</option >
                        </select>
                        
                    </label>

                    <!--SCRIPTS PARA CAMBIAR EL SELECT DE CATEGORIES BASADOS EN EL AREA-->
                    <script type="text/javascript">
                        $(document).ready(function(){
                            //chargeList();
                            $('#areas').change(function(){
                                chargeList();
                            });
                        });  
                    </script>
                    <script type="text/javascript">
                        function chargeList(){
                            $.ajax({
                                type:"POST",
                                url:"index.php?pid=<?php echo base64_encode("ui/filter_search/datesC.php") ?>",
                                data:"area_category="+$('#areas').val(),
                                success:function(r){
                                    $('#categories').html(r);
                                    //$('#categories').attr("disabled", false);
                                }
                            });
                        }
                    </script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#categories').select2({
                                theme:'bootstrap4'
                            });
                        });
                    </script>

                    <label for="countries">Country:
                        <select name="countries" id="countries" class="form-control input-sm" >
                            <option  value="0">All countries </option >
                            <?php 
                            $i=1;
                            foreach($countrysF as $cF ){
                                if ($cF->getIdCountry()==$valorCo){?>
                                    <option value= "<?php echo $cF->getIdCountry() ?>" selected> <?php echo utf8_decode($cF->getName()) ?> </option >;

                                    <?php
                                }
                                else{              
                                    ?>
                                    <option value= "<?php echo $cF->getIdCountry() ?>"> <?php echo utf8_decode($cF->getName()) ?> </option >;
                                    <?php
                                    $i++;}
                                }?>
                            </select>
                        </label>
                        
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#countries').select2({
                                    
                            
                                    theme:'bootstrap4'

                                });
                            });
                        </script>

                        <label>Quartile
                            <select  name="quartile" id="quartile" class="form-control input-sm"  >
                                <option value="0">All quartiles</option>
                                <?php
                                $journal=new Journal();
                                $journalsF=$journal->selectQuartile();

                                $i=1;
                                foreach($journalsF as $jF ){
                                    if ($jF->getBest_quartile()==$valorQ){?>
                                        <option value= "<?php echo $jF->getBest_quartile() ?>" selected> <?php echo utf8_decode($jF->getBest_quartile()) ?> </option >;

                                        <?php
                                    }
                                    else{              
                                        ?>
                                        <option value= "<?php echo $jF->getBest_quartile() ?>"> <?php echo utf8_decode($jF->getBest_quartile()) ?> </option >;
                                        <?php
                                        $i++;}
                                    }?>

                            </select>
                        </label>

                        <script type="text/javascript">
                        $(document).ready(function() {
                            $('#quartile').select2({

                           
                                theme:'bootstrap4'

                            });
                        });
                    </script>
                    </div>
                </div>
            </div>

            <div class="container" >

                <label id="referencesH" >H index >=
                  <input type="number" name="hindex" id="hindex" min="0" max="1226" value="<?php echo($valorH)?>" oninput="this.form.hindex_range.value=this.value" /> 
                  <br>
                  <input type="range" name="hindex_range" id="hindex_range" min="0" max="1226" value="<?php echo($valorH)?>" oninput="this.form.hindex.value=this.value"   />
                  
              </label>

              <label id="referencesL" >References >=
                  <input type="number" name="references" id="references" min="0" max="1033089" value="<?php echo($valorR)?>" oninput="this.form.refs_range.value=this.value"   /> 
                  <br>
                  <input type="range" name="refs_range" id="refs_range" min="0" max="1033089" value="<?php echo($valorR)?>" oninput="this.form.references.value=this.value"  />
                  
              </label>

              <label id="referencesS" >SJR >=
                  <input type="number" name="sjr" id="sjr" min="0" max="62.937" value="<?php echo($valorS)?>" step="0.01"  oninput="this.form.sjr_range.value=this.value"   /> 
                  <br>
                  <input type="range" name="sjr_range" id="sjr_range" min="0" max="62.937" value="<?php echo($valorS)?>" step="0.01" oninput="this.form.sjr.value=this.value"     />
                  
              </label>
          </div>
          <br>
          <div class="container" style="position:  ">      
            <button  name="Action" id="Action" type="submit" class="btn btn-info">Search <i class="fas fa-search"></i></button>
            
    </div>
</form>  
<br></br>
<div class="container" >
    <table class="table dt-responsive  table-dark " id="JournalTableS" >
        <thead >
            <tr>
                <th scope="col" >Rank</th>
                <th scope="col"> Title</th>
                <th scope="col"> Issn</th>
                <th scope="col">sjr</th>
                <th scope="col">Best_quartile</th>
                <th scope="col">H index</th>
                <th scope="col">Total documents</th>
                <th scope="col">Total references</th>
                <th scope="col">Total cites</th>
                <th scope="col">Cites per doc</th>
                <th scope="col">Coverage</th>
                <th scope="col" >All categories</th>
                <th scope="col">Country</th>
            </tr>
        </thead>
        <tbody>
           
            <?php

                //Select without filters
            if($area=="0" && $country=="0"  && $quartile=="0" ){
                $conn= new Connection();
                $con=$conn->openSRS();
                $journal=new JournalDAO();
                $sqlAll= $journal->selectWF($hindex,$references,$sjr);
                $resultAll=mysqli_query($con,$sqlAll);
                while ($ver=mysqli_fetch_row($resultAll)) {
                    echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11],$ver[12]);
                }


            }

            if($area=="0" && $category=="0" && $quartile=="0" ){
                $journal= new Journal();
                $selectCo= $journal->selectCo($country,$hindex,$references,$sjr);
                foreach($selectCo as $sCo) {
                    echo tableJ($sCo->getIdJournal(),$sCo->getTitle(),$sCo->getIssn(),$sCo->getSjr(),$sCo->getBest_quartile(),$sCo->getHindex(),$sCo->getTotal_docs(),$sCo->getTotal_references(),$sCo->getTotal_cites(),$sCo->getCitable_docs(),$sCo->getCoverage(),$sCo-> getCategories(),$sCo-> getCountry()->getName());
                }

            }

            if($country=="0"   &&  $quartile=="0" && $category=="0"){
                $journal= new Journal();
                $selectAr= $journal->selectAr($area,$hindex,$references,$sjr);
                foreach($selectAr as $sA) {
                    echo tableJ($sA->getIdJournal(),$sA->getTitle(),$sA->getIssn(),$sA->getSjr(),$sA->getBest_quartile(),$sA->getHindex(),$sA->getTotal_docs(),$sA->getTotal_references(),$sA->getTotal_cites(),$sA->getCitable_docs(),$sA->getCoverage(),$sA-> getCategories(),$sA->getCountry()->getName());
                }
            }

            if($country=="0"  && $quartile=="0"  ){
                $journal= new Journal();
                $selectArCa= $journal->selectArCa($area,$category,$hindex,$references,$sjr);
                foreach($selectArCa as $sACa) {
                    echo tableJ($sACa->getIdJournal(),$sACa->getTitle(),$sACa->getIssn(),$sACa->getSjr(),$sACa->getBest_quartile(),$sACa->getHindex(),$sACa->getTotal_docs(),$sACa->getTotal_references(),$sACa->getTotal_cites(),$sACa->getCitable_docs(),$sACa->getCoverage(),$sACa-> getCategories(),$sACa-> getCountry()->getName());
                }
                        //echo $sqlCA;
            }   

            if($area=="0" && $country=="0" && $category=="0" ){
                $journal= new Journal();
                $selectQ= $journal->selectQ($quartile,$hindex,$references,$sjr); 
                foreach($selectQ as $sQ) {
                    echo tableJ($sQ->getIdJournal(),$sQ->getTitle(),$sQ->getIssn(),$sQ->getSjr(),$sQ->getBest_quartile(),$sQ->getHindex(),$sQ->getTotal_docs(),$sQ->getTotal_references(),$sQ->getTotal_cites(),$sQ->getCitable_docs(),$sQ->getCoverage(),$sQ-> getCategories(),$sQ-> getCountry()->getName());
                }
            }

            if($quartile=="0" ){
                $journal= new Journal();
                $selectACC= $journal->selectACC($area,$category,$country,$hindex,$references,$sjr); 
                foreach($selectACC as $sACC) {
                    echo tableJ($sACC->getIdJournal(),$sACC->getTitle(),$sACC->getIssn(),$sACC->getSjr(),$sACC->getBest_quartile(),$sACC->getHindex(),$sACC->getTotal_docs(),$sACC->getTotal_references(),$sACC->getTotal_cites(),$sACC->getCitable_docs(),$sACC->getCoverage(),$sACC-> getCategories(),$sACC-> getCountry()->getName());
                }
            }

            if($quartile=="0" && $category=="0"){
                $journal= new Journal();
                $selectACo= $journal->selectACo($area,$country,$hindex,$references,$sjr); 
                foreach($selectACo as $sACo) {
                    echo tableJ($sACo->getIdJournal(),$sACo->getTitle(),$sACo->getIssn(),$sACo->getSjr(),$sACo->getBest_quartile(),$sACo->getHindex(),$sACo->getTotal_docs(),$sACo->getTotal_references(),$sACo->getTotal_cites(),$sACo->getCitable_docs(),$sACo->getCoverage(),$sACo-> getCategories(),$sACo-> getCountry()->getName());
                }
            }


            if($category=="0" ){
                $journal= new Journal();
                $selectACoQ= $journal->selectACoQ($area,$country,$quartile,$hindex,$references,$sjr); 
                foreach($selectACoQ as $sACoQ) {
                    echo tableJ($sACoQ->getIdJournal(),$sACoQ->getTitle(),$sACoQ->getIssn(),$sACoQ->getSjr(),$sACoQ->getBest_quartile(),$sACoQ->getHindex(),$sACoQ->getTotal_docs(),$sACoQ->getTotal_references(),$sACoQ->getTotal_cites(),$sACoQ->getCitable_docs(),$sACoQ->getCoverage(),$sACoQ-> getCategories(),$sACoQ-> getCountry()->getName());
                }
            }

            if($country=="0" ){
                $journal= new Journal();
                $selectACaQ= $journal->selectACaQ($area,$category,$quartile,$hindex,$references,$sjr); 
                foreach($selectACaQ as $sACaQ) {
                    echo tableJ($sACaQ->getIdJournal(),$sACaQ->getTitle(),$sACaQ->getIssn(),$sACaQ->getSjr(),$sACaQ->getBest_quartile(),$sACaQ->getHindex(),$sACaQ->getTotal_docs(),$sACaQ->getTotal_references(),$sACaQ->getTotal_cites(),$sACaQ->getCitable_docs(),$sACaQ->getCoverage(),$sACaQ-> getCategories(),$sACaQ-> getCountry()->getName());
                }
            }

            if($country=="0" && $category=="0"){
                $journal= new Journal();
                $selectAQ= $journal->selectAQ($area,$quartile,$hindex,$references,$sjr); 
                foreach($selectAQ as $sAQ) {
                    echo tableJ($sAQ->getIdJournal(),$sAQ->getTitle(),$sAQ->getIssn(),$sAQ->getSjr(),$sAQ->getBest_quartile(),$sAQ->getHindex(),$sAQ->getTotal_docs(),$sAQ->getTotal_references(),$sAQ->getTotal_cites(),$sAQ->getCitable_docs(),$sAQ->getCoverage(),$sAQ-> getCategories(),$sAQ-> getCountry()->getName());
                }
            }

            if($category=="0" && $area=="0"){
                $journal= new Journal();
                $selectCoQ= $journal->selectCoQ($country,$quartile,$hindex,$references,$sjr);
                foreach($selectCoQ as $sCoQ) {
                    echo tableJ($sCoQ->getIdJournal(),$sCoQ->getTitle(),$sCoQ->getIssn(),$sCoQ->getSjr(),$sCoQ->getBest_quartile(),$sCoQ->getHindex(),$sCoQ->getTotal_docs(),$sCoQ->getTotal_references(),$sCoQ->getTotal_cites(),$sCoQ->getCitable_docs(),$sCoQ->getCoverage(),$sCoQ-> getCategories(),$sCoQ-> getCountry()->getName());
                }

            }   

            else{
                $journal= new Journal();
                $selectF= $journal->selectAllF($area,$category,$country,$quartile,$hindex,$references,$sjr);
                foreach($selectF as $sF) {
                    echo tableJ($sF->getIdJournal(),$sF->getTitle(),$sF->getIssn(),$sF->getSjr(),$sF->getBest_quartile(),$sF->getHindex(),$sF->getTotal_docs(),$sF->getTotal_references(),$sF->getTotal_cites(),$sF->getCitable_docs(),$sF->getCoverage(),$sF-> getCategories(),$sF-> getCountry()->getName());
                }
            }?>
  
        </tbody>
    </table>
</div>

<?php
function tableJ($idJournal,$title,$issn,$sjr,$quartile,$hindex,$document,$refs,$cites,$citesdoc,$coverage,$category,$country){

    return 
    "<tr>   
    <td>".$idJournal."</td>
    <td>"."<a href='https://www.scimagojr.com/journalsearch.php?q=".$issn."' target='_blank' style='color: #DF691A;'> ".$title."</a>"."</td>
    <td>".$issn."</td>
    <td>".$sjr."</td>
    <td>".$quartile."</td>
    <td>".$hindex."</td>
    <td>".$document."</td>
    <td>".$refs."</td>
    <td>".$cites."</td>
    <td>".$citesdoc."</td>
    <td>".$coverage."</td>
    <td>".$category."</td>
    <td>".$country."</td>
    </tr>";


}
?>
<!--DATABLE JQUERY-->
<script type="text/javascript">
    $(document).ready( function () {
        $('#JournalTableS').DataTable({
            responsive: "true",
                    //dom: '<"top"Bf>irt<"bottom"lp><"clear">',
                    dom:'Bfrtlip',
                    lengthMenu: [ [10, 50,100],[10,50,100] ],
                    buttons: [
                    {

                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf">',
                        titleAttr: 'Dowload to PDF',
                        pageSize: 'LETTER',
                        pageOrientation: 'landscape',
                        image:'img/logo.png',
                        className:'btn btn-danger',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3,4,5,7,11]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel">',
                        titleAttr: 'Dowload to xlsx',
                        className:'btn btn-success'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv">',
                        titleAttr: 'Dowload to CSV',
                        className:'btn btn-clear'
                    }


                    ]
                });
    });
</script>




