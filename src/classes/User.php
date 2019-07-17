<?php
namespace App;

class User{

	private $con;
	public $id = NULL;
	public $name = NULL;
	public $email = NULL;
	public $password = NULL;
	public $role = NULL;
	public $created_at = NULL;
	public $updated_at = NULL;

	public function __construct($con, $data)
	{
		$this->con = $con;
		$this->id = $data['id'];
		$this->name = $data['name'];
		$this->email = $data['email'];
		$this->password = md5($data['password']);
		$this->role = $data['role'];
		$this->created_at = $data['created_at'];
		$this->updated_at = $data['updated_at'];
	}

	public function login()
	{
		$data = [];
		$sql = "SELECT * FROM users where email='$this->email' and password='$this->password'"; 
		$result = $this->con->prepare($sql); 
		$result->execute();
		$user = $result->fetch();
		if( $result->rowCount() > 0 ){
			$data = [
				'user' => $user,
				'message' => 'El usuario Existe',
				'error' => 'no'
			];	
		}else{
			$data = [
				'message' => 'El Usuario no Existe',
				'error' => 'yes'
			];
		}
		return $data;
	}

	public function getAllUsers()
	{
		$data = [];
		$sql = "SELECT * FROM users"; 
		$result = $this->con->prepare($sql); 
		$result->execute();
		$users = $result->fetchAll();
		if( $result->rowCount() > 0 ){
			$data = [
				'users' => $users,
				'message' => 'Listando Usuarios',
				'error' => 'no'
			];	
		}else{
			$data = [
				'message' => 'No Existen Usarios',
				'error' => 'yes'
			];
		}
		return $data;
	}

	public function getUser()
	{
		$data = [];
		$sql = "SELECT * FROM users where id = $this->id"; 
		$result = $this->con->prepare($sql); 
		$result->execute();
		$user = $result->fetch();
		if( $result->rowCount() > 0 ){
			$data = [
				'user' => $user,
				'message' => 'El usuario Existe',
				'error' => 'no'
			];	
		}else{
			$data = [
				'message' => 'El Usuario no Existe',
				'error' => 'yes'
			];
		}
		return $data;
	}

	public function add_user(){
		$data = [];
		$sql = "INSERT INTO users(name, email, password, role) values ('$this->name','$this->email', '$this->password', '$this->role')";
		$object = $this->con->prepare($sql);
		if($object->execute()){
			$data = [
				'message' => 'Registro Insertado con Exito',
				'error' => 'no'
			];
		}else{
			$data = [
				'message' => 'Error al insertar el registro',
				'error' => 'yes'
			];
		}

		return $data;
	}

	public function edit_user(){
		$data = [];
		$sql = "UPDATE users SET name = '$this->name', email = '$this->email', updated_at = CURRENT_TIMESTAMP where id = $this->id";
		$object = $this->con->prepare($sql);
		if($object->execute()){
			$data = [
				'message' => 'Registro Actualizado con Exito',
				'error' => 'no'
			];
		}else{
			$data = [
				'message' => 'Error al Actualizar el registro',
				'error' => 'yes'
			];
		}

		return $data;
	}

	public function delete_user(){
		$data = [];
		$sql = "DELETE FROM users where id = $this->id";
		$object = $this->con->prepare($sql);
		if($object->execute()){
			$data = [
				'message' => 'Registro Eliminado con Exito',
				'error' => 'no'
			];
		}else{
			$data = [
				'message' => 'Error al Eliminar el registro',
				'error' => 'yes'
			];
		}

		return $data;
	}

	public function change_password(){
		$data = [];
		$sql = "UPDATE users SET password = '$this->password', updated_at = CURRENT_TIMESTAMP where id = $this->id";
		$object = $this->con->prepare($sql);
		if($object->execute()){
			$data = [
				'message' => 'Contraseña Actualizada con Exito',
				'error' => 'no'
			];
		}else{
			$data = [
				'message' => 'Error al Actualizar el registro',
				'error' => 'yes'
			];
		}

		return $data;
	}
}