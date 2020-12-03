<?php
require("business/Administrator.php");
require("business/LogAdministrator.php");
require("business/Area.php");
require("business/Category.php");
require("business/Journalcategory.php");
require("business/Journal.php");
require("business/Country.php");
require("business/Filter_search.php");
require_once("persistence/Connection.php");
$idFilter_search = $_GET ['idFilter_search'];
$filter_search = new Filter_search($idFilter_search);
$filter_search -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Filter_search</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Search_date</th>
			<td><?php echo $filter_search -> getSearch_date() ?></td>
		</tr>
		<tr>
			<th>Search_time</th>
			<td><?php echo $filter_search -> getSearch_time() ?></td>
		</tr>
		<tr>
			<th>Hindex_filter</th>
			<td><?php echo $filter_search -> getHindex_filter() ?></td>
		</tr>
		<tr>
			<th>References_filter</th>
			<td><?php echo $filter_search -> getReferences_filter() ?></td>
		</tr>
		<tr>
			<th>Country_filter</th>
			<td><?php echo $filter_search -> getCountry_filter() ?></td>
		</tr>
		<tr>
			<th>Category_filter</th>
			<td><?php echo $filter_search -> getCategory_filter() ?></td>
		</tr>
		<tr>
			<th>Area_filter</th>
			<td><?php echo $filter_search -> getArea_filter() ?></td>
		</tr>
		<tr>
			<th>Quartile_filter</th>
			<td><?php echo $filter_search -> getQuartile_filter() ?></td>
		</tr>
		<tr>
			<th>Sjr_filter</th>
			<td><?php echo $filter_search -> getSjr_filter() ?></td>
		</tr>
	</table>
</div>
