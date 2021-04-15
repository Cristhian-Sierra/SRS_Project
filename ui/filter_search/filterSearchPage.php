   <head>

</head>
<?php 
    require_once ('business/Area.php');
    require_once ('business/Areacategory.php');
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
    

    $journalFilter = new Journal();
    $journalsF= $journalFilter->selectAll();
    

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
       
    }
?>

<div align="center">
	<?php include("ui/header.php"); ?>
</div>

<div class="container" >
	<form action="index.php?pid=<?php echo base64_encode("ui/filter_search/filterSearchPage.php") ?>" method="POST">

        <div class="container">
            <label>Area: 
                <select name="areas" id="areas" class="form-control input-sm" required>
                    <option  value="">Area</option >
                    <?php 
                    $i=1;
                    foreach($areasF as $aF ){?>
                        <option value= "<?php echo $aF->getIdArea() ?>"> <?php echo $aF->getName() ?> </option >;
                        <?php
                        $i++;}
                        ?>
                    </select>
            </label>

            <label>Category: 
                <select name="categories" id="categories" class="form-control input-sm"  required>
                    <option  value="">Category</option >
                </select>
            </label>

            <label>Country:
                <select name="countries" id="countries" class="form-control input-sm"   required>
                    <option  value="">Country</option >
                    <?php 
                    $i=1;
                    foreach($countrysF as $coF ){?>
                        <option value= "<?php echo $coF->getIdCountry() ?>"> <?php echo $coF->getName() ?> </option >;
                        <?php
                        $i++;}
                        ?>
                    </select>
            </label>
            
            <label>Quartile
        		<select  name="quartile" id="quartile" class="form-control input-sm"  required>
                    <option value="">Quartile</option>
                    <option value="Q1">Q1</option>
                    <option value="Q2">Q2</option>
                    <option value="Q3">Q3</option>
                  
                </select>
            </label>
        </div>

        <div class="container">
            
                <label id="referencesH" >H index:
                  <input type="number" name="hindex" id="hindex" min="1" max="1159" value="" oninput="this.form.hindex_range.value=this.value" required  /> 
                  <br>
                  <input type="range" name="hindex_range" id="hindex_range" min="1" max="1159" value="" oninput="this.form.hindex.value=this.value" />
                  
              </label>

              <label id="referencesL" >References:
                  <input type="number" name="references" id="references" min="0" max="989223" value="" oninput="this.form.refs_range.value=this.value" required /> 
                  <br>
                  <input type="range" name="refs_range" id="refs_range" min="0" max="989223" value="" oninput="this.form.references.value=this.value"   />
                  
              </label>

              <label id="referencesS" >SJR:
                  <input type="number" name="sjr" id="sjr" min="1" max="88" value="" oninput="this.form.sjr_range.value=this.value" required /> 
                  <br>
                  <input type="range" name="sjr_range" id="sjr_range" min="1" max="88" value="" oninput="this.form.sjr.value=this.value"   />
                  
              </label>
           
           
        </div>

        <br>
		<div class="form-group">
			<input type="submit" class="btn btn-dark" value="Save your search" name="Action">	
		</div>        
	</form>    
  </div>
  <br>


<div class="container"><!-- Pagination div-->
	
     
     <!--Table's Structure-->
     <div id="searchResults">
        <table   class="table table-dark " id="JournalTable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Rank</th>
                    <th scope="col"> Title</th>
                    <th scope="col"> Issn</th>
                    <th scope="col">sjr</th>
                    <th scope="col">Best_quartile</th>
                    <th scope="col">H index</th>
                    <th scope="col">Total documents</th>
                    <th scope="col">Total references</th>
                    <th scope="col">Total cites</th>
                    <th scope="col">Coverage</th>
                    <th scope="col" >All categories</th>
                    <th scope="col">Country</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                foreach($journalsF as $jP){
                    echo "<tr>";
                    echo "<td>" . $jP->getIdJournal() . "</td>";
                    echo "<td>" . $jP ->  getTitle() . "</td>";
                    echo "<td>" . $jP ->  getIssn() . "</td>";
                    echo "<td>" . $jP  -> getSjr() . "</td>";
                    echo "<td>" . $jP  -> getBest_quartile() . "</td>";
                    echo "<td>" . $jP  -> getHindex(). "</td>";
                    echo "<td>" . $jP  ->  getTotal_docs() . "</td>";
                    echo "<td>" . $jP  ->  getTotal_references() . "</td>";
                    echo "<td>" . $jP  ->  getTotal_cites() . "</td>";
                    echo "<td>" . $jP  ->  getCoverage() . "</td>";
                    echo "<td>" . $jP  -> getCategories(). "</td>";
                    echo "<td>" . $jP  -> getCountry(). "</td>";
                    echo "</tr>";
                    $i++;
                }
                ?>
            </tbody>

        </table>
        <!--DATABLE JQUERY
        i=info
        t=table
        f=filter input text
        p=pagination
        r=research
        l=list of dates
        -->
        <script type="text/javascript">
            $(document).ready( function () {
                $('#JournalTable').DataTable({
                    //dom:'<"top"lfip> rt <"bottom"pi><"clear">',
                    lengthMenu: [ [100, 500,-1],[100,500,"All"] ]
                });
                 
            } );
        </script>
    </div>
     
</div>



<!--SCRIPTS PARA CAMBIAR EL SELECT DE CATEGORIES BASADOS EN EL AREA-->
<script type="text/javascript">
    $(document).ready(function(){
       // $('#areas').val(1);
        chargeList();

        $('#areas').change(function(){
            chargeList();
        });
    })
</script>
<script type="text/javascript">
    function chargeList(){
        $.ajax({
            type:"POST",
            url:"index.php?pid=<?php echo base64_encode("ui/filter_search/datesC.php") ?>",
            data:"area_category=" + $('#areas').val(),
            success:function(r){
                $('#categories').html(r);
            }
        });
    }
</script>

<!--EL JQUERY Y AJAX PARA HACER CONSULTAS CON FILTROS-->

<script type="text/javascript">
    $(document).ready(function(){
    
        chargesList();
        $('#countries').change(function(){
            chargesList();
        });
        $('#areas').change(function(){
            chargesList();
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

        $('#quartile').change(function(){
            chargesList();
        });


    });
</script>

<script type="text/javascript">
    function chargesList(){
        //var hindex_range = $('#slider-rangeH').val();
       // $('#searchResult').html(loader);
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


