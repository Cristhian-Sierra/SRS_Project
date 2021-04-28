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
$idJournal = $_GET ['idJournal'];
$journal = new Journal($idJournal);
$journal -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Journal</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Title</th>
			<td><?php echo $journal -> getTitle() ?></td>
		</tr>
		<tr>
			<th>Issn</th>
			<td><?php echo $journal -> getIssn() ?></td>
		</tr>
		<tr>
			<th>Sjr</th>
			<td><?php echo $journal -> getSjr() ?></td>
		</tr>
		<tr>
			<th>Best_quartile</th>
			<td><?php echo $journal -> getBest_quartile() ?></td>
		</tr>
		<tr>
			<th>Hindex</th>
			<td><?php echo $journal -> getHindex() ?></td>
		</tr>
		<tr>
			<th>Total_docs</th>
			<td><?php echo $journal -> getTotal_docs() ?></td>
		</tr>
		<tr>
			<th>Total_references</th>
			<td><?php echo $journal -> getTotal_references() ?></td>
		</tr>
		<tr>
			<th>Total_cites</th>
			<td><?php echo $journal -> getTotal_cites() ?></td>
		</tr>
		<tr>
			<th>Citable_docs</th>
			<td><?php echo $journal -> getCitable_docs() ?></td>
		</tr>
		<tr>
			<th>Coverage</th>
			<td><?php echo $journal -> getCoverage() ?></td>
		</tr>
		<tr>
			<th>Categories</th>
			<td><?php echo $journal -> getCategories() ?></td>
		</tr>
		<tr>
			<th>Country</th>
			<td><?php echo $journal -> getCountry() -> getName() ?></td>
		</tr>
	</table>
</div>
