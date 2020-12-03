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
$idCountry = $_GET ['idCountry'];
$country = new Country($idCountry);
$country -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Country</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Name</th>
			<td><?php echo $country -> getName() ?></td>
		</tr>
		<tr>
			<th>Region</th>
			<td><?php echo $country -> getRegion() ?></td>
		</tr>
		<tr>
			<th>Documents</th>
			<td><?php echo $country -> getDocuments() ?></td>
		</tr>
		<tr>
			<th>Citable_docs</th>
			<td><?php echo $country -> getCitable_docs() ?></td>
		</tr>
		<tr>
			<th>Citations</th>
			<td><?php echo $country -> getCitations() ?></td>
		</tr>
		<tr>
			<th>Self_citations</th>
			<td><?php echo $country -> getSelf_citations() ?></td>
		</tr>
		<tr>
			<th>Citations_per_doc</th>
			<td><?php echo $country -> getCitations_per_doc() ?></td>
		</tr>
		<tr>
			<th>Hindex</th>
			<td><?php echo $country -> getHindex() ?></td>
		</tr>
	</table>
</div>
