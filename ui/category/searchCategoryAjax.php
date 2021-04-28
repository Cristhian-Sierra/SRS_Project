<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Name</th>
			<th>Area</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$category = new Category();
		$categorys = $category -> search($_GET['search']);
		$counter = 1;
		foreach ($categorys as $currentCategory) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCategory -> getName()) . "</td>";
			echo "<td>" . $currentCategory -> getArea() -> getName() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/category/updateCategory.php") . "&idCategory=" . $currentCategory -> getIdCategory() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Category' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/selectAllJournalcategoryByCategory.php") . "&idCategory=" . $currentCategory -> getIdCategory() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Journalcategory' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/insertJournalcategory.php") . "&idCategory=" . $currentCategory -> getIdCategory() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Journalcategory' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
