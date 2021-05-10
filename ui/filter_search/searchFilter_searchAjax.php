<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Search_date</th>
			<th nowrap>Search_time</th>
			<th nowrap>Hindex_filter</th>
			<th nowrap>References_filter</th>
			<th nowrap>Country_filter</th>
			<th nowrap>Category_filter</th>
			<th nowrap>Area_filter</th>
			<th nowrap>Quartile_filter</th>
			<th nowrap>Sjr_filter</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$filter_search = new Filter_search();
		$filter_searchs = $filter_search -> search($_GET['search']);
		$counter = 1;
		foreach ($filter_searchs as $currentFilter_search) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentFilter_search -> getSearch_date()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentFilter_search -> getSearch_time()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentFilter_search -> getHindex_filter()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentFilter_search -> getReferences_filter()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentFilter_search -> getCountry_filter()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentFilter_search -> getCategory_filter()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentFilter_search -> getArea_filter()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentFilter_search -> getQuartile_filter()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentFilter_search -> getSjr_filter()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/filter_search/updateFilter_search.php") . "&idFilter_search=" . $currentFilter_search -> getIdFilter_search() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Filter_search'style='color: #DF691A;' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
