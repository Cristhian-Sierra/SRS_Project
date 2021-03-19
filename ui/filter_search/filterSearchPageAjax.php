<?php 
$con=mysqli_connect('localhost','root','','srs');
$country=$_POST['country_filter'];
$area=$_POST['area_filter'];
$category=$_POST['category_filter'];
/*$references=$_POST['references_filter'];
$sjr=$_POST['sjr_filter'];
$hindex=$_POST['hindex_filter'];
$quartile=$_POST['quartile_filter'];*/


	$sql="SELECT  j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,co.name AS country  FROM journal AS j,country AS co,area AS a,category AS ca  WHERE j.country_idCountry=co.idCountry AND ca.area_idArea=a.idArea AND co.idCountry='$country' AND a.idArea='$area' AND ca.idCategory='$category'";

	$result=mysqli_query($con,$sql);

	$cadena="";
    if($country=="0" or $area=="0"){
    	$cadena=$cadena.'<option>Nothing all</option> ';
    }
    else{
    	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option>'.utf8_encode($ver[1]).'</option>';
	}

}
	echo  $cadena;
	

?>



<!--

<?php
/*
$journal = new Journal();
$journals = $journal->searchF($_REQUEST["fil"]);
*/
?>
<div class="card">
	<div class="card-header bg-secondary text-white">Search journals</div>
	<div class="card-body">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Title</th>
					<th scope="col">H index</th>
					<th scope="col">Total references</th>
					<th scope="col">Country </th>
					<th scope="col">Category</th>
					<th scope="col">Area</th>
					<th scope="col">Best quiartile </th>
					<th scope="col">SJR</th>
				</tr>
			</thead>
			<tbody>

		<?php/*
		foreach ($journals as $j) {
			  echo "<tr>";
			  		echo "<td>" . $counter . "</td>";
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
			echo "</tr>";
			$counter++;
		}
		*/?>
	</tbody>
</table>
</div>
-->


