<?php

if(count($_POST)>0){
	$user = PacientData::getById($_POST["user_id"]);


	$img = new Upload($_FILES["image"]);
	if($img->uploaded){
		$img->Process("storage/");
		if($img->processed){
			$user->image=$img->file_dst_name;
		}
	}


	$user->no = $_POST["no"];
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];

	$user->gender = $_POST["gender"];
	$user->day_of_birth = $_POST["day_of_birth"];
	
	$user->record = $_POST["record"];
	$user->physicalExam = $_POST["physicalExam"];
	$user->alergy = $_POST["alergy"];


	$user->address = $_POST["address"];
	$user->cp = $_POST["cp"];
	$user->pob = $_POST["pob"];
	$user->email = $_POST["email"];
	if($_POST["password"]!=""){
	$user->password = sha1(md5($_POST["password"]));
	}

	$user->phone = $_POST["phone"];
	$user->update();

Core::alert("Actualizado exitosamente!");
print "<script>window.location='index.php?view=pacients';</script>";


}


?>