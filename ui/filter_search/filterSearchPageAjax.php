<?php 
$con=mysqli_connect('localhost','root','','srs');
$country=$_POST['country_filter'];
$area=$_POST['area_filter'];
$category=$_POST['category_filter'];
$quartile=$_POST['quartile_filter'];
$hindex=$_POST['hindex_filter'];
$references=$_POST['ref_filter'];
$sjr=$_POST['sjr_filter'];
  

        $sqlF="SELECT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.citable_docs,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co,category as ca, area as a WHERE co.idCountry=j.country_IdCountry  AND a.idArea=ca.area_idArea  AND a.idArea='$area' AND co.idCountry='$country' AND ca.idCategory='$category' AND j.hindex>='$hindex' AND j.total_references>='$references' AND j.sjr>='$sjr' AND j.best_quartile='$quartile' order by j.idJournal";




        //AND j.hindex>='$hindex' AND j.total_references>='$references' AND j.sjr>='$sjr'

        $sqlAll="SELECT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.citable_docs,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co WHERE co.idCountry=j.country_IdCountry";
        	
//
//  AND j.best_quartile='$quartile' j.country_idCountry=co.idCountry AND ca.area_idArea=a.idArea AND jc.category_idCategory=ca.idCategory AND jc.journal_idJournal=j.idJournal AND        
?>


	<!--class="table table-hover table-striped table-responsive-md"-->
		<div id="container">
			<table class="table table-dark "  id="JournalTableS">
				<thead  class="thead-dark">
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
					$resultF=mysqli_query($con,$sqlF);
					$resultAll=mysqli_query($con,$sqlAll);


					if($area=="" && $country=="" && $category=="" ){
						while ($ver=mysqli_fetch_row($resultAll)) {
							echo "<tr>";	
							echo "<td>".$ver[0]."</td>";
							echo "<td>".$ver[1]."</td>";
							echo "<td>".$ver[2]."</td>";
							echo "<td>".$ver[3]."</td>";
							echo "<td>".$ver[4]."</td>";
							echo "<td>".$ver[5]."</td>";
							echo "<td>".$ver[6]."</td>";
							echo "<td>".$ver[7]."</td>";
							echo "<td>".$ver[8]."</td>";
							echo "<td>".$ver[9]."</td>";
							echo "<td>".$ver[10]."</td>";
							echo "<td>".$ver[11]."</td>";
							echo  "</tr>";
						}

					}
					else{
						while ($ver=mysqli_fetch_row($resultF)) {
							echo "<tr>";	
							echo "<td>".$ver[0]."</td>";
							echo "<td>".$ver[1]."</td>";
							echo "<td>".$ver[2]."</td>";
							echo "<td>".$ver[3]."</td>";
							echo "<td>".$ver[4]."</td>";
							echo "<td>".$ver[5]."</td>";
							echo "<td>".$ver[6]."</td>";
							echo "<td>".$ver[7]."</td>";
							echo "<td>".$ver[8]."</td>";
							echo "<td>".$ver[9]."</td>";
							echo "<td>".$ver[10]."</td>";
							echo "<td>".$ver[11]."</td>";
							echo "</tr>";	

						}	
					}

					?>
				</tbody>
			</table>

			<!--DATABLE JQUERY-->
			<script type="text/javascript">
				$(document).ready( function () {
					$('#JournalTableS').DataTable({
					//dom:'<"top"lfip> rt <"bottom"pi><"clear">',
                    lengthMenu: [ [100, 500,-1],[100,500,"All"] ]
					});

				} );
			</script>
		</div>



<?php
/*$quartile=$_POST['quartile_filter'];
$hindex=$_POST['hindex_filter'];
$references=$_POST['references_filter'];
$sjr=$_POST['sjr_filter'];


 $hindexRangeArr="";
 $orderSQL="";
 $hindexRangeSQL="";

        $hindexRangeArr = explode('-', $hindex);
       // $hindexRangeSQL = "j.hindex BETWEEN '".$hindexRangeArr[0]."' AND '".$hindexRangeArr[1]."'";
        $orderSQL = "ORDER BY j.hindex DESC";
*/  

?>