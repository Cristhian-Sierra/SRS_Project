<?php
class JournalcategoryDAO{
	private $idJournalcategory;
	private $category;
	private $journal;

	function JournalcategoryDAO($pIdJournalcategory = "", $pCategory = "", $pJournal = ""){
		$this -> idJournalcategory = $pIdJournalcategory;
		$this -> category = $pCategory;
		$this -> journal = $pJournal;
	}

	function insert(){
		return "insert into journalcategory(category_idCategory, journal_idJournal)
				values('" . $this -> category . "', '" . $this -> journal . "')";
	}

	function update(){
		return "update journalcategory set 
				category_idCategory = '" . $this -> category . "',
				journal_idJournal = '" . $this -> journal . "'	
				where idJournalcategory = '" . $this -> idJournalcategory . "'";
	}

	function select() {
		return "select idJournalcategory, category_idCategory, journal_idJournal
				from journalcategory
				where idJournalcategory = '" . $this -> idJournalcategory . "'";
	}

	function selectAll() {
		return "select idJournalcategory, category_idCategory, journal_idJournal
				from journalcategory";
	}

	function selectAllByCategory() {
		return "select idJournalcategory, category_idCategory, journal_idJournal
				from journalcategory
				where category_idCategory = '" . $this -> category . "'";
	}

	function selectAllByJournal() {
		return "select idJournalcategory, category_idCategory, journal_idJournal
				from journalcategory
				where journal_idJournal = '" . $this -> journal . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idJournalcategory, category_idCategory, journal_idJournal
				from journalcategory
				order by " . $orden . " " . $dir;
	}

	function selectAllByCategoryOrder($orden, $dir) {
		return "select idJournalcategory, category_idCategory, journal_idJournal
				from journalcategory
				where category_idCategory = '" . $this -> category . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByJournalOrder($orden, $dir) {
		return "select idJournalcategory, category_idCategory, journal_idJournal
				from journalcategory
				where journal_idJournal = '" . $this -> journal . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from journalcategory
				where idJournalcategory = '" . $this -> idJournalcategory . "'";
	}
	function deleteAll(){
		return "delete from journalcategory";
	}

	function insertIdsJC($pCategory){

		return "INSERT INTO journalcategory(Journal_idJournal,Category_idCategory) 
		select j.idJournal,c.idCategory
		FROM journal as j, category as c
		WHERE  j.categories LIKE  '%".$pCategory."%'  AND c.name='".$pCategory."'";

	}
}
?>
