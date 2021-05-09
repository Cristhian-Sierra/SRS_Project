<?php
require_once ("persistence/JournalcategoryDAO.php");
require_once ("persistence/Connection.php");

class Journalcategory {
	private $idJournalcategory;
	private $category;
	private $journal;
	private $journalcategoryDAO;
	private $connection;

	function getIdJournalcategory() {
		return $this -> idJournalcategory;
	}

	function setIdJournalcategory($pIdJournalcategory) {
		$this -> idJournalcategory = $pIdJournalcategory;
	}

	function getCategory() {
		return $this -> category;
	}

	function setCategory($pCategory) {
		$this -> category = $pCategory;
	}

	function getJournal() {
		return $this -> journal;
	}

	function setJournal($pJournal) {
		$this -> journal = $pJournal;
	}

	function Journalcategory($pIdJournalcategory = "", $pCategory = "", $pJournal = ""){
		$this -> idJournalcategory = $pIdJournalcategory;
		$this -> category = $pCategory;
		$this -> journal = $pJournal;
		$this -> journalcategoryDAO = new JournalcategoryDAO($this -> idJournalcategory, $this -> category, $this -> journal);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idJournalcategory = $result[0];
		$category = new Category($result[1]);
		$category -> select();
		$this -> category = $category;
		$journal = new Journal($result[2]);
		$journal -> select();
		$this -> journal = $journal;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> selectAll());
		$journalcategorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$category = new Category($result[1]);
			$category -> select();
			$journal = new Journal($result[2]);
			$journal -> select();
			array_push($journalcategorys, new Journalcategory($result[0], $category, $journal));
		}
		$this -> connection -> close();
		return $journalcategorys;
	}

	function selectAllByCategory(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> selectAllByCategory());
		$journalcategorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$category = new Category($result[1]);
			$category -> select();
			$journal = new Journal($result[2]);
			$journal -> select();
			array_push($journalcategorys, new Journalcategory($result[0], $category, $journal));
		}
		$this -> connection -> close();
		return $journalcategorys;
	}

	function insertIdsJC($pCategory){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> insertIdsJC($pCategory));
		$this -> connection -> close();
	}

	function selectAllByJournal(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> selectAllByJournal());
		$journalcategorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$category = new Category($result[1]);
			$category -> select();
			$journal = new Journal($result[2]);
			$journal -> select();
			array_push($journalcategorys, new Journalcategory($result[0], $category, $journal));
		}
		$this -> connection -> close();
		return $journalcategorys;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> selectAllOrder($order, $dir));
		$journalcategorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$category = new Category($result[1]);
			$category -> select();
			$journal = new Journal($result[2]);
			$journal -> select();
			array_push($journalcategorys, new Journalcategory($result[0], $category, $journal));
		}
		$this -> connection -> close();
		return $journalcategorys;
	}

	function selectAllByCategoryOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> selectAllByCategoryOrder($order, $dir));
		$journalcategorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$category = new Category($result[1]);
			$category -> select();
			$journal = new Journal($result[2]);
			$journal -> select();
			array_push($journalcategorys, new Journalcategory($result[0], $category, $journal));
		}
		$this -> connection -> close();
		return $journalcategorys;
	}

	function selectAllByJournalOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> selectAllByJournalOrder($order, $dir));
		$journalcategorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$category = new Category($result[1]);
			$category -> select();
			$journal = new Journal($result[2]);
			$journal -> select();
			array_push($journalcategorys, new Journalcategory($result[0], $category, $journal));
		}
		$this -> connection -> close();
		return $journalcategorys;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> search($search));
		$journalcategorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$category = new Category($result[1]);
			$category -> select();
			$journal = new Journal($result[2]);
			$journal -> select();
			array_push($journalcategorys, new Journalcategory($result[0], $category, $journal));
		}
		$this -> connection -> close();
		return $journalcategorys;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}

	function deleteAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalcategoryDAO -> deleteAll());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}


}
?>
