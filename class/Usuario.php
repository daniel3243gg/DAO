<?php
class Usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function  __construct($login = '', $senha = ""){
		$this->setLogin($login);
		$this->setSenha($senha);
	}

	public function getIdusuario(){

		return $this->idusuario;
	}
	public function setIdusuario(int $id){
		$this->idusuario = $id;
	}
	public function getLogin(){

		return $this->deslogin;
	}
	public function setLogin($value){
		$this->deslogin = $value;
	}
	public function getSenha(){

		return $this->dessenha;
	}
	public function setSenha($value){
		$this->dessenha = $value;
	}
	public function getDtcadastro(){

		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}
	public function loadById($id){
		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario= :ID", array(
			":ID"=>$id

		));
				
		if(count($result)>0){
			$this->setData($result[0]);
		} 
		

	}

	public static function getList(){
		$sql = new Sql();

		return $sql->select('SELECT *FROM tb_usuarios ORDER BY deslogin	;');
	}

	public static function Search($login){

		$sql = new Sql();
		return $sql->select("SELECT *FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));

	}
	public function setUser(string $login,string $senha):bool {
		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin= :LOGIN and dessenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=> $senha

		));
		

		if(count($result) > 0){
			$row = $result[0];
		
			$this->setData($row);
			return true; 
		}else{
			echo 'usuarios errado.';
			return false; 
		}	

	}
	public function getColum(string $coluna){

		switch($coluna){
			case "deslogin":
				return $this->getLogin(); 
			break;
			case "dessenha":
				return $this->getSenha();
			break;
			case "dtcadastro":
				return $this->getDtcadastro();
			break;
			case "idusuarios":
				return $this->getIdusuarios();
			break;
			default:
				echo "COLUNA INCORRETA!";
		}

	}
	private function setData($data){
		
		#esta pegando pelo indice de cada um e colocando na sua respectivo atributo.
		$this->setIdusuario($data['idusuario']);
		$this->setLogin($data['deslogin']);
		$this->setSenha($data['dessenha']);
		$this->setDtcadastro($data['dtcadastro']);


	}

	public function insert (){

		$sql = new Sql();
		
		$results = $sql->selectStoredProcedure("EXEC sp_usuarios_insert :LOGIN, :PASSWORD",array(
			":LOGIN"=>$this->getLogin(),
			":PASSWORD"=>$this->getSenha()
		));
		
		
		if(count($results)>0){

			$this->setData($results[0]);
		}else{
			echo 'nao contem valores o array';
		} 


	}

	public function update($login,$password){

		$this->setLogin($login);
		$this->setSenha($password);

		$sql= new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID",array(
			'LOGIN'=>$this->getLogin(),
			'PASSWORD'=>$this->getSenha(),
			'ID'=>$this->getIdusuario()


		));

	}
	public function Delete(){
		$sql = new Sql();
		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID ", array(	"ID"=>$this->getIdusuario()));
		$dataHoraAtual = new DateTime();
		$this->setData(array(
			"idusuario"=> 0,
			"dessenha"=> '' ,
			"deslogin"=>'',
			"dtcadastro"=>$dataHoraAtual->format(" Y-m-d H:i:s") 
		));



	}
	public function __toString(){

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"login"=>$this->getLogin(),
			"senha"=>$this->getSenha(),
			"DT"=>$this->getDtcadastro()

		));
	}
}


?>