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
    

   /* $journalFilter = new Journal();
    $journalsF= $journalFilter->selectAllC();
    */

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

   
    if(isset($_POST["Action"])){
        //This conditional is of the button that makes insert in the db

        $filterSClass = new Filter_search("",$date,$time,$hindex,$references,$country,$category,$area,$quartile,$sjr);
        $filterSClass->insert();

        if ($filterSClass) {
        	  echo "<script>alert('Search saved')</script>";

        }
      


       
    }
?>

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
        <div class="row">
            <div class="col col-lg-12 col-xl-12">
                <label>Area: 
                    <select name="areas" id="areas" class="form-control input-sm" >
                        <option  value="">All areas</option >
                        <?php 
                        $i=1;
                        foreach($areasF as $aF ){?>
                            <option value= "<?php echo $aF->getIdArea() ?>"> <?php echo utf8_decode($aF->getName()) ?> </option >;
                            <?php
                            $i++;}
                            ?>
                        </select>
                    </label>

                    <label>Category: 
                        <select name="categories" id="categories" class="form-control input-sm" >
                        </select>
                    </label>

                    <label>Country:
                        <select name="countries" id="countries" class="form-control input-sm"   >
                            <option  value="">All countries </option >
                            <?php 
                            $i=1;
                            foreach($countrysF as $coF ){?>
                                <option value= "<?php echo utf8_decode($coF->getIdCountry()) ?>"> <?php echo utf8_decode($coF->getName()) ?> </option >;
                                <?php
                                $i++;}
                                ?>
                            </select>
                        </label>

                        <label>Quartile
                            <select  name="quartile" id="quartile" class="form-control input-sm"  >
                                <option value="">All quartiles</option>
                                <option value="Q1">Q1</option>
                                <option value="Q2">Q2</option>
                                <option value="Q3">Q3</option>
                                <option value="Q4">Q4</option>
                                <option value="-">Without quartile</option>

                            </select>
                        </label>
                    </div>
                </div>
            </div>

            <div class="container" style="position: relative; left: 25px;" >

                <label id="referencesH" >H index >=
                  <input type="number" name="hindex" id="hindex" min="0" max="1159" value="100" oninput="this.form.hindex_range.value=this.value" /> 
                  <br>
                  <input type="range" name="hindex_range" id="hindex_range" min="0" max="1159" value="100" oninput="this.form.hindex.value=this.value"   />
                  
              </label>

              <label id="referencesL" >References >=
                  <input type="number" name="references" id="references" min="0" max="989223" value="1000" oninput="this.form.refs_range.value=this.value"   /> 
                  <br>
                  <input type="range" name="refs_range" id="refs_range" min="0" max="989223" value="1000" oninput="this.form.references.value=this.value"  />
                  
              </label>

              <label id="referencesS" >SJR >=
                  <input type="number" name="sjr" id="sjr" min="0" max="62.937" value="10.0" step="0.01"  oninput="this.form.sjr_range.value=this.value"   /> 
                  <br>
                  <input type="range" name="sjr_range" id="sjr_range" min="0" max="62.937" value="10.0" step="0.01" oninput="this.form.sjr.value=this.value"     />
                  
              </label>
          </div>
          <br>
          <div class="container" style="position: relative;left: 15px; ">      
            <button name="Action" type="submit" class="btn btn-info">Save your search <i class="far fa-save"></i></button>
        </div>
    </form>  


    <br> </br>
    <div class="container" >
     <!--Table's Structure-->
     <div id="searchResults"></div>
 </div>
 <!--SCRIPTS PARA CAMBIAR EL SELECT DE CATEGORIES BASADOS EN EL AREA-->
 <script type="text/javascript">
    $(document).ready(function(){
        // $('#areas').val(1);
        chargeList();   
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
            data:"area_category=" + $('#areas').val(),
            success:function(r){
                $('#categories').html(r);
                //$('#categories').attr("disabled", false);
            }
        });
    }
</script>

<!--SCRIPTS PARA CAMBIAR EL SELECT DE CATEGORIES BASADOS EN EL AREA 2,0
<script type="text/javascript">
    $(document).ready(function(){
       $('#areas').change(function(){
           $("#areas option:selected").each(function (){   
                area_category = $("#areas").val();
                $.post("index.php?pid=<?//php //echo base64_encode("ui/filter_search/datesC.php") ?>", { area_category: area_category }, function(data){
                    $("#categories").html(data);
                });
            });
       });
    });   
</script>
-->

<!--EL JQUERY Y AJAX PARA HACER CONSULTAS CON FILTROS-->

<script type="text/javascript">
    $(document).ready(function(){
    
        chargesList();
        $('#countries').change(function(){
            chargesList();
        });
        $('#areas').change(function(){
            areachargesList();
        });
         $('#categories').change(function(){
            chargesList();
        });
        
        $('#hindex_range').change(function(){
            chargesList();
        });

        $('#refs_range').change(function(){
            chargesList();
        });

        $('#sjr_range').change(function(){
            chargesList();
        });


        $('#hindex').change(function(){
            chargesList();
        });

        $('#references').change(function(){
            chargesList();
        });

        $('#sjr').change(function(){
            chargesList();
        });

        $('#quartile').change(function(){
            chargesList();
        });


    });
</script>

<script type="text/javascript">
    function chargesList(){
     
        $.ajax({
            type:"POST",
            url:"index.php?pid=<?php echo base64_encode("ui/filter_search/filterSearchPageAjax.php") ?>",
            data:{
                "area_filter":$('#areas').val(),
                "country_filter":$('#countries').val(),
                "category_filter":$('#categories').val(),
                "hindex_filter":$('#hindex_range').val(),
                "ref_filter":$('#refs_range').val(),
                "sjr_filter":$('#sjr_range').val(),
                "quartile_filter":$('#quartile').val()

                },
            success:function(r){
                $('#searchResults').html(r);
               /* $('#searchResult').fadeOut('slow',function(){
                $('#searchResult').html(r).fadeIn('fast');*/
            }
        });
    }
</script>

<script type="text/javascript">
    function areachargesList(){
     
        $.ajax({
            type:"POST",
            url:"index.php?pid=<?php echo base64_encode("ui/filter_search/filterSearchPageAjax.php") ?>",
            data:{
                "area_filter":$('#areas').val(),
                "country_filter":$('#countries').val(),
                "category_filter":'',
                "hindex_filter":$('#hindex_range').val(),
                "ref_filter":$('#refs_range').val(),
                "sjr_filter":$('#sjr_range').val(),
                "quartile_filter":$('#quartile').val()

                },
            success:function(r){
                $('#searchResults').html(r);
                         }
        });
    }
</script>
