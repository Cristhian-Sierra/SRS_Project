<?php
require_once ("persistence/Filter_searchDAO.php");
require_once ("persistence/Connection.php");

class Filter_search {
	private $idFilter_search;
	private $journal_title;
	private $search_date;
	private $search_time;
	private $hindex_filter;
	private $references_filter;
	private $country_filter;
	private $category_filter;
	private $area_filter;
	private $quartile_filter;
	private $sjr_filter;
	private $filter_searchDAO;
	private $connection;

	function getIdFilter_search() {
		return $this -> idFilter_search;
	}

	function setIdFilter_search($pIdFilter_search) {
		$this -> idFilter_search = $pIdFilter_search;
	}

	function getSearch_date() {
		return $this -> search_date;
	}

	function setSearch_date($pSearch_date) {
		$this -> search_date = $pSearch_date;
	}


	function getJournal_title() {
		return $this -> journal_title;
	}

	function setJournal_title($pJournal_title) {
		$this -> journal_title = $pJournal_title;
	}
	function getSearch_time() {
		return $this -> search_time;
	}

	function setSearch_time($pSearch_time) {
		$this -> search_time = $pSearch_time;
	}

	function getHindex_filter() {
		return $this -> hindex_filter;
	}

	function setHindex_filter($pHindex_filter) {
		$this -> hindex_filter = $pHindex_filter;
	}

	function getReferences_filter() {
		return $this -> references_filter;
	}

	function setReferences_filter($pReferences_filter) {
		$this -> references_filter = $pReferences_filter;
	}

	function getCountry_filter() {
		return $this -> country_filter;
	}

	function setCountry_filter($pCountry_filter) {
		$this -> country_filter = $pCountry_filter;
	}

	function getCategory_filter() {
		return $this -> category_filter;
	}

	function setCategory_filter($pCategory_filter) {
		$this -> category_filter = $pCategory_filter;
	}

	function getArea_filter() {
		return $this -> area_filter;
	}

	function setArea_filter($pArea_filter) {
		$this -> area_filter = $pArea_filter;
	}

	function getQuartile_filter() {
		return $this -> quartile_filter;
	}

	function setQuartile_filter($pQuartile_filter) {
		$this -> quartile_filter = $pQuartile_filter;
	}

	function getSjr_filter() {
		return $this -> sjr_filter;
	}

	function setSjr_filter($pSjr_filter) {
		$this -> sjr_filter = $pSjr_filter;
	}

	function Filter_search($pIdFilter_search = "", $pSearch_date = "", $pSearch_time = "", $pHindex_filter = "", $pReferences_filter = "", $pCountry_filter = "", $pCategory_filter = "", $pArea_filter = "", $pQuartile_filter = "", $pSjr_filter = ""){
		$this -> idFilter_search = $pIdFilter_search;
		$this -> search_date = $pSearch_date;
		$this -> search_time = $pSearch_time;
		$this -> hindex_filter = $pHindex_filter;
		$this -> references_filter = $pReferences_filter;
		$this -> country_filter = $pCountry_filter;
		$this -> category_filter = $pCategory_filter;
		$this -> area_filter = $pArea_filter;
		$this -> quartile_filter = $pQuartile_filter;
		$this -> sjr_filter = $pSjr_filter;
		$this -> filter_searchDAO = new Filter_searchDAO($this -> idFilter_search, $this -> search_date, $this -> search_time, $this -> hindex_filter, $this -> references_filter, $this -> country_filter, $this -> category_filter, $this -> area_filter, $this -> quartile_filter, $this -> sjr_filter);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> filter_searchDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> filter_searchDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> filter_searchDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idFilter_search = $result[0];
		$this -> search_date = $result[1];
		$this -> search_time = $result[2];
		$this -> hindex_filter = $result[3];
		$this -> references_filter = $result[4];
		$this -> country_filter = $result[5];
		$this -> category_filter = $result[6];
		$this -> area_filter = $result[7];
		$this -> quartile_filter = $result[8];
		$this -> sjr_filter = $result[9];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> filter_searchDAO -> selectAll());
		$filter_searchs = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($filter_searchs, new Filter_search($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]));
		}
		$this -> connection -> close();
		return $filter_searchs;
	}

	function selectAllNames(){
		$this -> connection -> open();
		$this -> connection -> run($this -> filter_searchDAO -> selectAllNames());
		$filter_searchs = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($filter_searchs, new Filter_search($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]));
		}
		$this -> connection -> close();
		return $filter_searchs;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> filter_searchDAO -> selectAllOrder($order, $dir));
		$filter_searchs = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($filter_searchs, new Filter_search($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]));
		}
		$this -> connection -> close();
		return $filter_searchs;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> filter_searchDAO -> search($search));
		$filter_searchs = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($filter_searchs, new Filter_search($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]));
		}
		$this -> connection -> close();
		return $filter_searchs;
	}



	/*function searchF($sjr,$hindex,$references,$countries,$categories,$areas,$quartile){
		$this -> connection -> open();
		$this -> connection -> run($this -> filter_searchDAO -> searchF($sjr,$hindex,$references,$countries,$categories,$areas,$quartile));
		$filter_searchs = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($filter_searchs, new Filter_search($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7]));
		}
		$this -> connection -> close();
		return $filter_searchs;

	}*/

		/*function selectF(){
		$this -> connection -> open();
		$this -> connection -> run($this -> filter_searchDAO  -> selectF());
		$filters= array();
		while ($result = $this -> connection -> fetchRow()){
			$journal = new Journal();

			/*$journal->getIdJournal();
			$journal_id=$result[0];

			$journal->getTitle();
			$journal_title=$result[1];
			
			$journal->getIssn();
			$journal_issn=$result[2];

			$journal->getHindex();
			$journal_hindex=$result[3];

			$journal->getTotal_references();
			$journal_total_refs=$result[4];

			$country = new Country();
			$country -> getName();
			$country=$result[5];

			$journal->getCategories() ;
			$journal_category=$result[6];

			$area = new Area();
			$area->getName();
			$area=$result[7];

			$journal->getBest_quartile();
			$journal_quartile=$result[8];

			$journal->getSjr();
			$journal_sjr=$result[9];
			
			array_push($filters, new  Filter_search($result[0],$result[1],$result[2],$journal_hindex,$journal_total_refs,$country,$journal_category,$area,$journal_quartile,$journal_sjr));
		
		}


		$this -> connection -> close();
		return $filters;
	}*/

	
	
}
?>
