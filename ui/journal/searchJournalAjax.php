<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Title</th>
			<th nowrap>Issn</th>
			<th nowrap>Sjr</th>
			<th nowrap>Best_quartile</th>
			<th nowrap>Hindex</th>
			<th nowrap>Total_docs</th>
			<th nowrap>Total_references</th>
			<th nowrap>Total_cites</th>
			<th nowrap>Citable_docs</th>
			<th nowrap>Coverage</th>
			<th nowrap>Categories</th>
			<th>Country</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$journal = new Journal();
		$journals = $journal -> search($_GET['search']);
		$counter = 1;
		foreach ($journals as $currentJournal) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentJournal -> getTitle()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentJournal -> getIssn()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentJournal -> getSjr()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentJournal -> getBest_quartile()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentJournal -> getHindex()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentJournal -> getTotal_docs()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentJournal -> getTotal_references()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentJournal -> getTotal_cites()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentJournal -> getCitable_docs()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentJournal -> getCoverage()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentJournal -> getCategories()) . "</td>";
			echo "<td>" . $currentJournal -> getCountry() -> getName() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journal/updateJournal.php") . "&idJournal=" . $currentJournal -> getIdJournal() . "' style='color: #DF691A;'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Journal' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journal/selectAllJournal.php") . "&idJournal=" . $currentJournal -> getIdJournal() . "&action=delete' onclick='return confirm(\"Confirm to delete Journal: " . $currentJournal -> getTitle() . " " . $currentJournal -> getIssn() . "\")' style='color: #DF691A;'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Journal' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/selectAllJournalcategoryByJournal.php") . "&idJournal=" . $currentJournal -> getIdJournal() . "' style='color: #DF691A;'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Journalcategory' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/insertJournalcategory.php") . "&idJournal=" . $currentJournal -> getIdJournal() . "' style='color: #DF691A;'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Journalcategory' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
