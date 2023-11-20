<?php

class Sql extends PDO{
	private $con;

	public function __construct(){

		$this->con= new PDO("sqlsrv:server=localhost\SQLEXPRESS;Database=dbphp7;ConnectionPooling=0");
	}

	private function setParams($statment,$parameters = array() ){

		foreach ($parameters as $key => $value){
			$this->setParam($statment,$key, $value);

		}


	}

	private function setParam($statment, $key, $value){
		$statment->bindParam($key, $value);
		

	}
	public function query($rawQuery, $params = array()){
		
		$stnt = $this->con->prepare($rawQuery);
		$this->setParams($stnt, $params);
		
		$stnt->execute();

		return $stnt;
	}
	public function select($rawQuery, $params = array()){

		$stnt = $this->query($rawQuery, $params);

		return $stnt->fetchALL(PDO::FETCH_ASSOC);
	}
	public function selectStoredProcedure($rawQuery, $params = array()){

		$stnt = $this->query($rawQuery, $params);
		$stnt->nextRowset();

		return $stnt->fetchALL(PDO::FETCH_ASSOC);
	}
	
}


?>