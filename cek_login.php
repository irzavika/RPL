<?php
session_start();

$db = new mysqli ( "localhost" , "root" , "root" , "rpl" );
echo $db->connect_errno?'Koneksi gagal : '.$db->connect_error:'';

if(isset($_POST['username']) && ($_POST['password'])){
	 $username = $db->real_escape_string($_POST['username']);
	 $password = $db->real_escape_string(md5($_POST['password']));
	 $sql = "select * from user where username = '$username' AND password = '$password'";
	 $result = $db->query($sql) or die('Terjadi Kesalahan : '.$db->error);
 
	if ($result->num_rows == 1){
		  $row = $result->fetch_assoc();
		  $_SESSION['username'] = $row['username'];
		  $_SESSION['nama'] = $row['nama'];
		  $_SESSION['level'] = $row['level'];
		  header("location:index.php");
		  $_SESSION['pesan'] = '<p><div class="alert alert-success">Selamat datang <b>'.$_SESSION['nama'].'</b></div></p>';
  
	}else{
		$_SESSION['error']="Username atau Password salah";
		header("location:index.php?app=login");
	}
}else{
	$_SESSION['error']="Username atau password tidak boleh kosong"; 
	header("location:index.php?app=login");
}
?>
