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
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$area = new Area();
		$areas = $area -> search($_GET['search']);
		$counter = 1;
		foreach ($areas as $currentArea) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentArea -> getName()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/area/updateArea.php") . "&idArea=" . $currentArea -> getIdArea() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Area' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/area/selectAllArea.php") . "&idArea=" . $currentArea -> getIdArea() . "&action=delete' onclick='return confirm(\"Confirm to delete Area: " . $currentArea -> getName() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Area' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/category/selectAllCategoryByArea.php") . "&idArea=" . $currentArea -> getIdArea() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Category' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/category/insertCategory.php") . "&idArea=" . $currentArea -> getIdArea() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Category' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
