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
$idCategory = $_GET ['idCategory'];
$category = new Category($idCategory);
$category -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Category</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Name</th>
			<td><?php echo $category -> getName() ?></td>
		</tr>
		<tr>
			<th>Area</th>
			<td><?php echo $category -> getArea() -> getName() ?></td>
		</tr>
	</table>
</div>
