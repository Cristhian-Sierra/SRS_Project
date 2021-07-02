<?php

$filtersearch= new Filter_search();
$filterSCo = $filtersearch -> selectAllCo();

$filtersearchA= new Filter_search();
$filterSA = $filtersearchA -> selectAllA();

$filtersearchCa= new Filter_search();
$filterSCa = $filtersearchCa -> selectAllCa();

$filtersearchDate= new Filter_search();
$filterSDate = $filtersearchDate -> selectAllDate();


?>

<div class="container mt-4">
  <h1>Charts</h1>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-dark text-white">Area Filters</div>
        <div class="card-body">
          <div id="fsRA" style="height: 300px;"></div>
                    <?php 
                        echo "<script>";
                        $json2="{";
                        for ($i=0; $i<count($filterSA ); $i++) {
                            $json2 .= "\"".$filterSA [$i][0] . "\" : " . $filterSA [$i][1] . ",";     
                      }
                      $json2 .= "}";
                      echo "new Chartkick.PieChart(\"fsRA\", " . $json2 . ",)";
                        echo "</script>";
                    ?>          
        </div>        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-dark text-white">Category Filters</div>
        <div class="card-body">
          <div id="fsRCa" style="height: 300px;"></div>
                    <?php 
                        echo "<script>";
                        $json3="{";
                        for ($i=0; $i<count($filterSCa ); $i++) {
                            $json3 .= "\"".$filterSCa [$i][0] . "\" : " . $filterSCa [$i][1] . ",";     
                      }
                      $json3 .= "}";
                      echo "new Chartkick.PieChart(\"fsRCa\", " . $json3 . ",)";
                        echo "</script>";
                    ?>          
        </div>        
      </div>
    </div>
  </div>

    <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-dark text-white">Country Filters</div>
        <div class="card-body">
          <div id="fsRCo" style="height: 300px;"></div>
                    <?php 
                        echo "<script>";
                        $json="{";
                        for ($i=0; $i<count($filterSCo ); $i++) {
                            $json .= "\"".$filterSCo [$i][0] . "\" : " . $filterSCo [$i][1] . ",";     
                      }
                      $json .= "}";
                      echo "new Chartkick.PieChart(\"fsRCo\", " . $json . ",)";
                        echo "</script>";
                    ?>          
        </div>        
      </div>
    </div>
  </div>
    <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-dark text-white">Searchs by date</div>
        <div class="card-body">
          <div id="fsRDate" style="height: 300px;"></div>
                    <?php 
                        echo "<script>";
                        $json4="{";
                        for ($i=0; $i<count($filterSDate ); $i++) {
                            $json4 .= "\"".$filterSDate [$i][0] . "\" : " . $filterSDate [$i][1] . ",";     
                      }
                      $json4 .= "}";
                      echo "new Chartkick.LineChart(\"fsRDate\", " . $json4 . ",)";
                        echo "</script>";
                    ?>          
        </div>        
      </div>
    </div>
  </div>   
</div>
