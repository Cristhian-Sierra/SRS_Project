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
    
   

    /*$AreaC="";
    if(isset($_POST["AreaC"])){ //Conditinal to determinate the category list
        $AreaC=$_POST["AreaC"];
        $areaCat= new Areacategory($AreaC);
        $cadena = $areaCat ->select();
        echo $cadena;
       
    }*/

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
    if(isset($_POST["Action"])){    //This conditional is of the button that makes insert in the db
        //$hindex=$_POST["hindex"];
        
        switch($_POST["hindex"])//Switch case from hindex select
        {
            case 1:
                $hindex = 0;
                break;
            case 2:
                $hindex = 201 ;
                break;
            case 3:
                $hindex =401 ;
                break;
            case 4:
                $hindex =601;
                break;
            case 5:
                $hindex =801;
                break;
            default:
               
                break;
        }

        $sjr="";
        switch($_POST["sjr"]) //Switch case from sjr select
        {
            case 1:
                $sjr = 1;
                break;
            case 2:
                $sjr = 21;
                break;
            case 3:
                $sjr =41 ;
                break;
            case 4:
                $sjr =61;
                break;
            case 5:
                $sjr =81;
                break;
            default:
               
                break;
        }

        $references="";
        switch($_POST["references"]) //Switch case from references select
        {
            case 1:
                $references = 0;
                break;
            case 2:
                $references = 2001;
                break;
            case 3:
                $references =10001 ;
                break;
            case 4:
                $references =100001;
                break;
            case 5:
                $references =500001 ;
                break;
            default:
               
                break;
        }

        $quartile="";
        switch($_POST["quartile"]) //Switch case from quartile select
        {
            case 1:
                $quartile = "Q1";
                break;
            case 2:
                $quartile = "Q2";
                break;
            case 3:
                $quartile ="Q3";
                break;
            default:
                
                break;
        }

        $filterSClass = new Filter_search("",$date,$time,$hindex,$references,$country,$category,$area,$quartile,$sjr);
        $filterSClass->insert();
     
        
    }

//This is for pagination 
    
    $quantity = 900;
    if(isset($_GET["quantity"])){
    	$quantity = $_GET["quantity"];
    }
    $page = 1;
    if(isset($_GET["page"])){
    	$page = $_GET["page"];
    }
    $journalsP = $journalFilter -> searchPage($quantity, $page);
    $journalsR = $journalFilter -> searchQuantity();
    $totalPages = intval($journalsR/$quantity);
    if($journalsR%$quantity != 0){
    	$totalPages++;
    }
    $lastPage = ($totalPages == $page); 
?>

<div align="center">
	<?php include("ui/header.php"); ?>
</div>

<div class="container" >
	<form action="index.php?pid=<?php echo base64_encode("ui/filter_search/filterSearchPage.php") ?>" method="POST">


        <label>Area: 
            <select name="areas" id="areas" required>
                <option  value="0">Area</option >
                <?php 
                $i=1;
                foreach($areasF as $aF ){?>
                    <option value= "<?php echo $aF->getIdArea() ?>"> <?php echo $aF->getName() ?> </option >;
                    <?php
                    $i++;}
                    ?>
                </select>
        </label>

         <!--<select name="categories" id="categories" required>
            <option  value="">Category</option >;
            <?php 
            /*$i=1;
            foreach($categoriesF as $cF ){
                echo "<option>" . utf8_encode($cF->getName())."</option >";
                $i++;}*/
                ?>
        </select>-->

        <label>Category: 
            <select name="categories" id="categories" required>
                <option  value="">Category</option >
            </select>
        </label>

        <label>Country:
            <select name="countries" id="countries"  required>
                <option  value="0">Country</option >
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
    		<select  name="quartile" id="quartile" required>
                <option value="0">Quartile</option>
                <option value="1">Q1</option>
                <option value="2">Q2</option>
                <option value="3">Q3</option>
              
            </select>
        </label>


        <!--SLIDER DE HINDEX-->

        <div class="container">     
            <label for="amount">H index:</label>
            <input type="text" id="amount" name="range" style="border: 0; color: #4DCD7C    ; font-weight: bold;" readonly/>

            <div id="slider-range" style="width:300px;"></div>
        </div>   
        <!--JQUERY que permite mostrar datos del slider-->    
        <script>
            $(function() {
                $("#slider-range").slider({
                    range: true,
                    min: 1,
                    max: 1150,
                    values: [0, 500],
                    slide: function(event, ui) {
                        $("#amount").val(ui.values[ 0 ] + "-" + ui.values[ 1 ] + "");
                    }
                });

                $( "#amount" ).val($("#slider-range").slider("values", 0) + "-" + $("#slider-range").slider( "values", 1) + "");
            });
        </script>

        <!--SLIDER DE SJR-->

        <div class="container">     
            <label for="amountS">SJR:</label>
            <input type="text" id="amountS" name="range" style="border: 0; color: #4DCD7C    ; font-weight: bold;"  readonly />

            <div id="slider-rangeS" style="width:300px;"></div>
        </div>   
        <!--JQUERY que permite mostrar datos del slider-->    
        <script>
            $(function() {
                $("#slider-rangeS").slider({
                    range: true,
                    min: 1,
                    max: 88,
                    values: [0, 44],
                    slide: function(event, ui) {
                        $("#amountS").val(ui.values[ 0 ] + "-" + ui.values[ 1 ] + "");
                    }
                });

                $( "#amountS" ).val($("#slider-rangeS").slider("values", 0) + "-" + $("#slider-rangeS").slider( "values", 1) + "");
            });
        </script>

        <!--SLIDER DE REFERENES-->

        <div class="container">     
            <label for="amountR">References:</label>
            <input type="text" id="amountR" name="range" style="border: 0; color: #4DCD7C    ; font-weight: bold;" readonly/>

            <div id="slider-rangeR" style="width:300px;"></div>
        </div>   
        <!--JQUERY que permite mostrar datos del slider-->    
        <script>
            $(function() {
                $("#slider-rangeR").slider({
                    range: true,
                    min: 0,
                    max: 989223,
                    values: [0, 400000],
                    slide: function(event, ui) {
                        $("#amountR").val(ui.values[ 0 ] + "-" + ui.values[ 1 ] + "");
                    }
                });

                $( "#amountR" ).val($("#slider-rangeR").slider("values", 0) + "-" + $("#slider-rangeR").slider( "values", 1) + "");
            });
        </script>


        <!--<select name="hindex" id="hindex" required>
            <option value="0">H index </option>
            <option value="1">0-200</option>
            <option value="2">201-400</option>
            <option value="3">401-600</option>
            <option value="4">601-800</option>
            <option value="5">801 or more</option>
        </select>-->


      <!--  <label>SJR: 
    		<select name="sjr" id="sjr" required>
    			<option value="0">SJR</option>
    			<option value="1">1-20</option>
    			<option value="2">21-40</option>
    			<option value="3">41-60</option>
    			<option value="4">61-80</option>
    			<option value="5">80 or more</option>
    		</select>
        </label>
    -->
    <!--

        <label>References: 
    		<select  name="references" id="references" required>
    			<option value="0">References</option>
    			<option value="1">0-1000</option>
    			<option value="2">1001-10000</option>
    			<option value="3">10001-100000</option>
    			<option value="4">100001-500000</option>
    			<option value="5">500001 or more</option>
    		</select>
        </label>
    -->

		<br> <br>
		<div class="form-group">
			<input type="submit" class="btn btn-dark" value="Search with filters" name="Action">	
		</div>        
	</form>    
  </div>


<div class="container"><!-- Pagination div-->
	<div class="row"> 
		<div class="col-md-9"></div>
		<div class="col-md-3">
		    <nav aria-label="Page navigation Journals">
		    	<ul class="pagination">
		            <li class="page-item <?php echo ($page==1)?"disabled": ""; ?>"><a class="page-link" href="<?php echo "index.php?pid=" . base64_encode("ui/filter_search/filterSearchPage.php") . "&page=" . ($page-1) . "&quantity=" . $quantity ?>"> &lt;&lt; </a></li>
		            <?php 
		            for($i=1; $i<=$totalPages; $i++){
		            	if($i==$page){
		            		echo "<li class='page-item active' aria-current='page'><span class='page-link'>" . $i . "<span class='sr-only'></span></span></li>";
		            	}else{
		            		echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("ui/filter_search/filterSearchPage.php") . "&page=" . $i . "&quantity=" . $quantity . "'>" . $i . "</a></li>";
		            	}        						            						    
		            }        						
		            ?>
		            <li class="page-item <?php echo ($lastPage)?"disabled": ""; ?>"><a class="page-link" href="<?php echo "index.php?pid=" . base64_encode("ui/filter_search/filterSearchPage.php") . "&page=" . ($page+1) . "&quantity=" . $quantity ?>"> &gt;&gt; </a></li>
		        </ul>
		    </nav>
            <select id="quantity" >
                <option value="900" <?php echo ($quantity==900)?"selected":"" ?>>900</option>
                <option value="1800" <?php echo ($quantity==1800)?"selected":"" ?>>1800</option>
                <option value="2700" <?php echo ($quantity==2700)?"selected":"" ?>>2700</option>
                <option value="4000" <?php echo ($quantity==4000)?"selected":"" ?>>4000</option>
            </select> 
		</div>
		    
    </div>
     
     <!--Table's Structure-->
     <div class="text-right">Searchs <?php echo (($page-1)*$quantity+1) ?> to <?php echo (($page-1)*$quantity)+count($journalsP) ?> of <?php echo $journalsR ?> registers searched</div>

     <select name="searchResult" id="searchResult" required>
        <option  value="">Journals</option >
    </select>



     <div id="searchResults">
        <table class="table table-hover table-striped table-responsive-md">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
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
                foreach($journalsP as $jP){
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
    </div>
     
</div>

<!--SCRIPT QUE PERMITE LA PAGINACIÓN-->
<script>
    $("#quantity").on("change", function() {
        url = "index.php?pid=<?php echo base64_encode("ui/filter_search/filterSearchPage.php") ?>&quantity=" + $(this).val();     
        location.replace(url);
    });
</script>




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
        });/*
          $('#slider-range').change(function(){
            chargesList();
        });*/

    })
</script>

<script type="text/javascript">
    function chargesList(){
        var hindex_range = $('#slider-range').val();
        $.ajax({
            type:"POST",
            url:"index.php?pid=<?php echo base64_encode("ui/filter_search/filterSearchPageAjax.php") ?>",
            data:{"country_filter":$('#countries').val(),
                 "area_filter":$('#areas').val(),
                 "category_filter":$('#categories').val()
                 //"hindex_filter=":+hindex_range
             },
            //data:"area_filter=" + $('#areas').val(),
            success:function(r){
                $('#searchResult').html(r);
            }
        });
    }
</script>


