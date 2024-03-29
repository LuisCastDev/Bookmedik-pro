<?php
class PacientData {
	public static $tablename = "pacient";
	public function __construct(){
		$this->title = "";
		$this->email = "";
		$this->image = "";
		$this->password = "";
		$this->is_public = "0";
		$this->created_at = "NOW()";
	}


	
	public function add(){

		
		$sql = "insert into ".self::$tablename." (no,image,name,lastname,gender,day_of_birth,address, cp, pob, phone,email,password,sick,medicaments,alergy,created_at) ";
		$noClean=preg_replace("/[^a-zA-Z0-9]/", '', $this->no);
		echo $sql .= "value (\"$noClean\",\"$this->image\",\"$this->name\",\"$this->lastname\",\"$this->gender\",\"$this->day_of_birth\",\"$this->address\",\"$this->cp\",\"$this->pob\",\"$this->phone\",\"$this->email\",\"$this->password\",\"$this->sick\",\"$this->medicaments\",\"$this->alergy\",$this->created_at)";
		Executor::doit($sql);
	}

	// public static function delById($id){
	// 	$sql = "delete from ".self::$tablename." where id=$id";
	// 	Executor::doit($sql);
	// }

	public static function delById($id){
		try {
			$sql = "DELETE FROM " . self::$tablename . " WHERE id = :id";
			$params = array(":id" => $id);
	
			Executor::doit($sql, $params);
			// Suponiendo que Executor::doit() es un método que ejecuta consultas SQL con parámetros y maneja excepciones
		} catch (Exception $e) {
			// Manejo de la excepción
			echo "Error al eliminar el registro: " . $e->getMessage();
		}
	}
	



	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto PacientData previamente utilizamos el contexto
	public function update_active(){
		$sql = "update ".self::$tablename." set last_active_at=NOW() where id=$this->id";
		Executor::doit($sql);
	}


	public static function getRepeated($no){
		$noClean=preg_replace("/[^a-zA-Z0-9]/", '', $no);
		$sql = "select * from ".self::$tablename." where no=$noClean";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PacientData());
	}


	public function update(){
		$noClean=preg_replace("/[^a-zA-Z0-9]/", '', $this->no);
		$sql = "update ".self::$tablename." set no=\"$noClean\",image=\"$this->image\",name=\"$this->name\",lastname=\"$this->lastname\",address=\"$this->address\",phone=\"$this->phone\",email=\"$this->email\",password=\"$this->password\",gender=\"$this->gender\",day_of_birth=\"$this->day_of_birth\",sick=\"$this->sick\",medicaments=\"$this->medicaments\",alergy=\"$this->alergy\",cp=\"$this->cp\",pob=\"$this->pob\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PacientData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}

	public static function getAllActive(){
		$sql = "select * from client where last_active_at>=date_sub(NOW(),interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}

	public static function getAllUnActive(){
		$sql = "select * from client where last_active_at<=date_sub(NOW(),interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}


	public function getUnreads(){ return MessageData::getUnreadsByClientId($this->id); }


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%' or email like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}


}

?>