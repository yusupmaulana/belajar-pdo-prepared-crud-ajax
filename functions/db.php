<?php

$server  ="localhost";
$user    ="root";
$pass    ="";
$db_name ="crud_pdo_ajax";


//0. Koneksi ke database===============================================
try
{	//metode utk koneksi
 	$conn = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);

 	//attribute untuk menambahkan error
 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 	// echo "berhasil konek ke database!";
}catch(PDOException $e)
{
	echo "error : " . $e->getMessage();
}

?>
