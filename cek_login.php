<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'config/conn.php';

header("Content-Type:application/json");
 
// menangkap data yang dikirim dari form
$username = $_GET['username'];
$password = $_GET['password'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($conn,"select * from m_user where username='$username' and password='$password'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

$emparray = array();
    while($row =mysqli_fetch_assoc($data))
    {
        $emparray = $row;
    }
 
if($cek > 0){
	$_SESSION['id'] = $emparray["id"];
	$_SESSION['nama'] = $emparray["nama"];
	$_SESSION['role'] = $emparray["role"];
	$_SESSION['status'] = "login";
	// header("location:admin/index.php");
	echo json_encode($emparray, JSON_PRETTY_PRINT);
}else{
	echo "Failed";
}
?>