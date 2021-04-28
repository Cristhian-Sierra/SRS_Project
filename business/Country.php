<?php
require_once ("persistence/CountryDAO.php");
require_once ("persistence/Connection.php");

class Country {
	private $idCountry;
	private $name;
	private $region;
	private $documents;
	private $citable_docs;
	private $citations;
	private $self_citations;
	private $citations_per_doc;
	private $hindex;
	private $countryDAO;
	private $connection;

	function getIdCountry() {
		return $this -> idCountry;
	}

	function setIdCountry($pIdCountry) {
		$this -> idCountry = $pIdCountry;
	}

	function getName() {
		return $this -> name;
	}

	function setName($pName) {
		$this -> name = $pName;
	}

	function getRegion() {
		return $this -> region;
	}

	function setRegion($pRegion) {
		$this -> region = $pRegion;
	}

	function getDocuments() {
		return $this -> documents;
	}

	function setDocuments($pDocuments) {
		$this -> documents = $pDocuments;
	}

	function getCitable_docs() {
		return $this -> citable_docs;
	}

	function setCitable_docs($pCitable_docs) {
		$this -> citable_docs = $pCitable_docs;
	}

	function getCitations() {
		return $this -> citations;
	}

	function setCitations($pCitations) {
		$this -> citations = $pCitations;
	}

	function getSelf_citations() {
		return $this -> self_citations;
	}

	function setSelf_citations($pSelf_citations) {
		$this -> self_citations = $pSelf_citations;
	}

	function getCitations_per_doc() {
		return $this -> citations_per_doc;
	}

	function setCitations_per_doc($pCitations_per_doc) {
		$this -> citations_per_doc = $pCitations_per_doc;
	}

	function getHindex() {
		return $this -> hindex;
	}

	function setHindex($pHindex) {
		$this -> hindex = $pHindex;
	}

	function Country($pIdCountry = "", $pName = "", $pRegion = "", $pDocuments = "", $pCitable_docs = "", $pCitations = "", $pSelf_citations = "", $pCitations_per_doc = "", $pHindex = ""){
		$this -> idCountry = $pIdCountry;
		$this -> name = $pName;
		$this -> region = $pRegion;
		$this -> documents = $pDocuments;
		$this -> citable_docs = $pCitable_docs;
		$this -> citations = $pCitations;
		$this -> self_citations = $pSelf_citations;
		$this -> citations_per_doc = $pCitations_per_doc;
		$this -> hindex = $pHindex;
		$this -> countryDAO = new CountryDAO($this -> idCountry, $this -> name, $this -> region, $this -> documents, $this -> citable_docs, $this -> citations, $this -> self_citations, $this -> citations_per_doc, $this -> hindex);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> countryDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> countryDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> countryDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCountry = $result[0];
		$this -> name = $result[1];
		$this -> region = $result[2];
		$this -> documents = $result[3];
		$this -> citable_docs = $result[4];
		$this -> citations = $result[5];
		$this -> self_citations = $result[6];
		$this -> citations_per_doc = $result[7];
		$this -> hindex = $result[8];
	}

	function selectN(){
		$this -> connection -> open();
		$this -> connection -> run($this -> countryDAO -> selectN());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> name = $result[0];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> countryDAO -> selectAll());
		$countrys = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($countrys, new Country($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8]));
		}
		$this -> connection -> close();
		return $countrys;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> countryDAO -> selectAllOrder($order, $dir));
		$countrys = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($countrys, new Country($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8]));
		}
		$this -> connection -> close();
		return $countrys;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> countryDAO -> search($search));
		$countrys = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($countrys, new Country($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8]));
		}
		$this -> connection -> close();
		return $countrys;
	}
}
?>
