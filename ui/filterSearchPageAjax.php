<script charset="utf-8">
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			
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
		$filter_searchs = $filter_search -> searchF($_GET['sjr'],$_GET['hindex'],$_GET['references'],$_GET['countries'],$_GET['categories'],$_GET['areas'],$_GET['quartile']);
		$counter = 1;
		foreach ($filter_searchs as $currentFilter_search) {
			echo "<tr><td>" . $counter . "</td>";
			
			echo "<td>" . str_ireplace($_GET['hindex'], "<mark>" . $_GET['hindex'] . "</mark>", $currentFilter_search -> getHindex_filter()) . "</td>";
			echo "<td>" . str_ireplace($_GET['references'], "<mark>" . $_GET['references'] . "</mark>", $currentFilter_search -> getReferences_filter()) . "</td>";
			echo "<td>" . str_ireplace($_GET['countries'], "<mark>" . $_GET['countries'] . "</mark>", $currentFilter_search -> getCountry_filter()) . "</td>";
			echo "<td>" . str_ireplace($_GET['categories'], "<mark>" . $_GET['categories'] . "</mark>", $currentFilter_search -> getCategory_filter()) . "</td>";
			echo "<td>" . str_ireplace($_GET['areas'], "<mark>" . $_GET['areas'] . "</mark>", $currentFilter_search -> getArea_filter()) . "</td>";
			echo "<td>" . str_ireplace($_GET['quartile'], "<mark>" . $_GET['quartile'] . "</mark>", $currentFilter_search -> getQuartile_filter()) . "</td>";
			echo "<td>" . str_ireplace($_GET['sjr'], "<mark>" . $_GET['sjr'] . "</mark>", $currentFilter_search -> getSjr_filter()) . "</td>";
						
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
