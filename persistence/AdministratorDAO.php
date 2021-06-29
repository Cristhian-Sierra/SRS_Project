<?php
class AdministratorDAO{
	private $idAdministrator;
	private $name;
	private $lastName;
	private $email;
	private $password;
	private $picture;
	private $phone;
	private $mobile;
	private $state;

	function AdministratorDAO($pIdAdministrator = "", $pName = "", $pLastName = "", $pEmail = "", $pPassword = "", $pPicture = "", $pPhone = "", $pMobile = "", $pState = ""){
		$this -> idAdministrator = $pIdAdministrator;
		$this -> name = $pName;
		$this -> lastName = $pLastName;
		$this -> email = $pEmail;
		$this -> password = $pPassword;
		$this -> picture = $pPicture;
		$this -> phone = $pPhone;
		$this -> mobile = $pMobile;
		$this -> state = $pState;
	}

	function logIn($email, $password){
		return "select idAdministrator, name, lastName, email, password, picture, phone, mobile, state
				from administrator
				where email = '" . $email . "' and password = '" . md5($password) . "'";
	}

	function insert(){
		return "insert into administrator(name, lastName, email, password, picture, phone, mobile, state)
				values('" . $this -> name . "', '" . $this -> lastName . "', '" . $this -> email . "', md5('" . $this -> password . "'), '" . $this -> picture . "', '" . $this -> phone . "', '" . $this -> mobile . "', '" . $this -> state . "')";
	}

	function update(){
		return "update administrator set 
				name = '" . $this -> name . "',
				lastName = '" . $this -> lastName . "',
				email = '" . $this -> email . "',
				phone = '" . $this -> phone . "',
				mobile = '" . $this -> mobile . "',
				state = '" . $this -> state . "'	
				where idAdministrator = '" . $this -> idAdministrator . "'";
	}

	function updatePassword($password){
		return "update administrator set 
				password = '" . md5($password) . "'
				where idAdministrator = '" . $this -> idAdministrator . "'";
	}

	function existEmail($email){
		return "select idAdministrator, name, lastName, email, password, picture, phone, mobile, state
				from administrator
				where email = '" . $email . "'";
	}

	function recoverPassword($email, $password){
		return "update administrator set 
				password = '" . md5($password) . "'
				where email = '" . $email . "'";
	}

	function updateImage($attribute, $value){
		return "update administrator set "
				. $attribute . " = '" . $value . "'
				where idAdministrator = '" . $this -> idAdministrator . "'";
	}

	function select() {
		return "select idAdministrator, name, lastName, email, password, picture, phone, mobile, state
				from administrator
				where idAdministrator = '" . $this -> idAdministrator . "'";
	}

	function selectAll() {
		return "select idAdministrator, name, lastName, email, password, picture, phone, mobile, state
				from administrator";
	}

	function selectAllOrder($orden, $dir){
		return "select idAdministrator, name, lastName, email, password, picture, phone, mobile, state
				from administrator
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idAdministrator, name, lastName, email, password, picture, phone, mobile, state
				from administrator
				where name like '%" . $search . "%' or lastName like '%" . $search . "%' or email like '%" . $search . "%' or phone like '%" . $search . "%' or mobile like '%" . $search . "%' or state like '%" . $search . "%'";
	}
}
?>
