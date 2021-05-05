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
			<th nowrap>Region</th>
			<th nowrap>Documents</th>
			<th nowrap>Citable_docs</th>
			<th nowrap>Citations</th>
			<th nowrap>Self_citations</th>
			<th nowrap>Citations_per_doc</th>
			<th nowrap>Hindex</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$country = new Country();
		$countrys = $country -> search($_GET['search']);
		$counter = 1;
		foreach ($countrys as $currentCountry) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCountry -> getName()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCountry -> getRegion()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCountry -> getDocuments()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCountry -> getCitable_docs()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCountry -> getCitations()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCountry -> getSelf_citations()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCountry -> getCitations_per_doc()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCountry -> getHindex()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/country/updateCountry.php") . "&idCountry=" . $currentCountry -> getIdCountry() . "' style='color: #DF691A;'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Country'  style='color: #DF691A;'></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/journal/selectAllJournalByCountry.php") . "&idCountry=" . $currentCountry -> getIdCountry() . "' style='color: #DF691A;'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Journal'  style='color: #DF691A;'></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journal/insertJournal.php") . "&idCountry=" . $currentCountry -> getIdCountry() . "' style='color: #DF691A;'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Journal'  style='color: #DF691A;'></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
