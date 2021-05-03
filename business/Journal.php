<?php
require_once ("persistence/JournalDAO.php");
require_once ("persistence/Connection.php");

class Journal {
	private $idJournal;
	private $title;
	private $issn;
	private $sjr;
	private $best_quartile;
	private $hindex;
	private $total_docs;
	private $total_references;
	private $total_cites;
	private $citable_docs;
	private $coverage;
	private $categories;
	private $country;
	private $journalDAO;
	private $connection;

	function getIdJournal() {
		return $this -> idJournal;
	}

	function setIdJournal($pIdJournal) {
		$this -> idJournal = $pIdJournal;
	}

	function getTitle() {
		return $this -> title;
	}

	function setTitle($pTitle) {
		$this -> title = $pTitle;
	}

	function getIssn() {
		return $this -> issn;
	}

	function setIssn($pIssn) {
		$this -> issn = $pIssn;
	}

	function getSjr() {
		return $this -> sjr;
	}

	function setSjr($pSjr) {
		$this -> sjr = $pSjr;
	}

	function getBest_quartile() {
		return $this -> best_quartile;
	}

	function setBest_quartile($pBest_quartile) {
		$this -> best_quartile = $pBest_quartile;
	}

	function getHindex() {
		return $this -> hindex;
	}

	function setHindex($pHindex) {
		$this -> hindex = $pHindex;
	}

	function getTotal_docs() {
		return $this -> total_docs;
	}

	function setTotal_docs($pTotal_docs) {
		$this -> total_docs = $pTotal_docs;
	}

	function getTotal_references() {
		return $this -> total_references;
	}

	function setTotal_references($pTotal_references) {
		$this -> total_references = $pTotal_references;
	}

	function getTotal_cites() {
		return $this -> total_cites;
	}

	function setTotal_cites($pTotal_cites) {
		$this -> total_cites = $pTotal_cites;
	}

	function getCitable_docs() {
		return $this -> citable_docs;
	}

	function setCitable_docs($pCitable_docs) {
		$this -> citable_docs = $pCitable_docs;
	}

	function getCoverage() {
		return $this -> coverage;
	}

	function setCoverage($pCoverage) {
		$this -> coverage = $pCoverage;
	}

	function getCategories() {
		return $this -> categories;
	}

	function setCategories($pCategories) {
		$this -> categories = $pCategories;
	}

	function getCountry() {
		return $this -> country;
	}

	function setCountry($pCountry) {
		$this -> country = $pCountry;
	}

	function Journal($pIdJournal = "", $pTitle = "", $pIssn = "", $pSjr = "", $pBest_quartile = "", $pHindex = "", $pTotal_docs = "", $pTotal_references = "", $pTotal_cites = "", $pCitable_docs = "", $pCoverage = "", $pCategories = "", $pCountry = ""){
		$this -> idJournal = $pIdJournal;
		$this -> title = $pTitle;
		$this -> issn = $pIssn;
		$this -> sjr = $pSjr;
		$this -> best_quartile = $pBest_quartile;
		$this -> hindex = $pHindex;
		$this -> total_docs = $pTotal_docs;
		$this -> total_references = $pTotal_references;
		$this -> total_cites = $pTotal_cites;
		$this -> citable_docs = $pCitable_docs;
		$this -> coverage = $pCoverage;
		$this -> categories = $pCategories;
		$this -> country = $pCountry;
		$this -> journalDAO = new JournalDAO($this -> idJournal, $this -> title, $this -> issn, $this -> sjr, $this -> best_quartile, $this -> hindex, $this -> total_docs, $this -> total_references, $this -> total_cites, $this -> citable_docs, $this -> coverage, $this -> categories, $this -> country);
		$this -> connection = new Connection();
	}
 //
 // 
	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> insert());
		$this -> connection -> close();
	}

	function insert_csv($pIdJournal,$pTitle, $pIssn, $pSjr, $pBest_quartile, $pHindex, $pTotal_docs, $pTotal_references, $pTotal_cites, $pCitable_docs, $pCoverage){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> insert_csv($pIdJournal,$pTitle, $pIssn, $pSjr, $pBest_quartile, $pHindex, $pTotal_docs, $pTotal_references, $pTotal_cites, $pCitable_docs, $pCoverage));
		$this -> connection -> close();
	}

	function upgrade_csv($pIdJournal,$pTitle, $pIssn, $pSjr, $pBest_quartile, $pHindex, $pTotal_docs, $pTotal_references, $pTotal_cites, $pCitable_docs, $pCoverage){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> insert_csv($pIdJournal,$pTitle, $pIssn, $pSjr, $pBest_quartile, $pHindex, $pTotal_docs, $pTotal_references, $pTotal_cites, $pCitable_docs, $pCoverage));
		$this -> connection -> close();
	}
	function insert_idCountry($country){
		$this -> connection -> open();
		$this -> connection->run($this->journalDAO->insert_idCountry($country));
		$this -> connection -> close();
	}



	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idJournal = $result[0];
		$this -> title = $result[1];
		$this -> issn = $result[2];
		$this -> sjr = $result[3];
		$this -> best_quartile = $result[4];
		$this -> hindex = $result[5];
		$this -> total_docs = $result[6];
		$this -> total_references = $result[7];
		$this -> total_cites = $result[8];
		$this -> citable_docs = $result[9];
		$this -> coverage = $result[10];
		$this -> categories = $result[11];
		$country = new Country($result[12]);
		$country -> select();
		$this -> country = $country;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> selectAll());
		$journals = array();
		while ($result = $this -> connection -> fetchRow()){
			/*$country = new Country();
			$country -> getName();
			$country=$result[12];*/
			$country = new Country($result[12]);
			$country -> select();
	
			array_push($journals, new Journal($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9], $result[10], $result[11], $country));
		}
		$this -> connection -> close();
		return $journals;
	}

	function selectAllC(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> selectAllC());
		$journals = array();
		while ($result = $this -> connection -> fetchRow()){
			/*$country = new Country();
			$country -> getName();
			$country=$result[12];*/
			$country = new Country($result[12]);
			$country -> select();
	
			array_push($journals, new Journal($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9], $result[10], $result[11], $country));
		}
		$this -> connection -> close();
		return $journals;
	}

	function selectAllA(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> selectAllA());
		$journals = array();
		while ($result = $this -> connection -> fetchRow()){
			/*$country = new Country();
			$country -> getName();
			$country=$result[12];*/
			$country = new Country($result[12]);
			$country -> select();
	
			array_push($journals, new Journal($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9], $result[10], $result[11], $country));
		}
		$this -> connection -> close();
		return $journals;
	}


	function selectAllByCountry(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> selectAllByCountry());
		$journals = array();
		while ($result = $this -> connection -> fetchRow()){
			$country = new Country($result[12]);
			$country -> select();
			array_push($journals, new Journal($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9], $result[10], $result[11], $country));
		}
		$this -> connection -> close();
		return $journals;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> selectAllOrder($order, $dir));
		$journals = array();
		while ($result = $this -> connection -> fetchRow()){
			$country = new Country($result[12]);
			$country -> select();
			array_push($journals, new Journal($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9], $result[10], $result[11], $country));
		}
		$this -> connection -> close();
		return $journals;
	}

	function selectAllByCountryOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> selectAllByCountryOrder($order, $dir));
		$journals = array();
		while ($result = $this -> connection -> fetchRow()){
			$country = new Country($result[12]);
			$country -> select();
			array_push($journals, new Journal($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9], $result[10], $result[11], $country));
		}
		$this -> connection -> close();
		return $journals;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> search($search));
		$journals = array();
		while ($result = $this -> connection -> fetchRow()){
			$country = new Country($result[12]);
			$country -> select();
			array_push($journals, new Journal($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9], $result[10], $result[11], $country));
		}
		$this -> connection -> close();
		return $journals;
	}


	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> journalDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}

	public function searchPage($quantity, $page){
        $this -> connection -> open();        
        $this -> connection -> run($this -> journalDAO -> searchPage($quantity, $page));
        $journals= array();
        while(($result = $this -> connection -> fetchRow()) != null){
        	$country = new Country();
			$country -> getName();
			$country=$result[12];
            $j = new Journal ($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9], $result[10], $result[11], $country);
            array_push($journals, $j);
        }
        $this -> connection -> close();
        return $journals;
    }
    
    public function searchQuantity(){
        $this -> connection -> open();
        $this -> connection -> run($this -> journalDAO -> searchQuantity());
        $this -> connection -> close();
        return $this -> connection -> fetchRow()[0];
    }



}
?>
