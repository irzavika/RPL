<?php empty( $app ) ? header('location:../index.php') : '' ; if(isset($_SESSION['level'])){?>
<?php
include "class.php";
$view = new mainView ;
$main = new mainController ;

if($_GET['aksi']==''){
$view->viewDataBeasiswa();
}
else if($_GET['aksi']=='tambah'){
$view->viewTambahDataBeasiswa();
}
else if($_GET['aksi']=='tambah_data'){

$namabeasiswa		= mysql_real_escape_string($_POST['namabeasiswa']);
$asalbeasiswa		= mysql_real_escape_string($_POST['asalbeasiswa']);
$besarbeasiswa		= mysql_real_escape_string($_POST['besarbeasiswa']);
$kuota 				= mysql_real_escape_string($_POST['kuota']);
$syaratipk 			= mysql_real_escape_string($_POST['syaratipk']); 
$syaratpenerima		= mysql_real_escape_string($_POST['syaratpenerima']); 
$tanggalterima 		= mysql_real_escape_string($_POST['tanggalterima']); 
$tanggalberakhir 	= mysql_real_escape_string($_POST['tanggalberakhir']);  
$keterangan 		= mysql_real_escape_string($_POST['keterangan']);
$main->tambahDataBeasiswa($namabeasiswa,$asalbeasiswa,$besarbeasiswa,$kuota,$syaratipk,$syaratpenerima,$tanggalterima,$tanggalberakhir,$keterangan);

}
else if($_GET['aksi']=='edit'){ 
$nomor_beasiswa	= $_GET['id'];
$view->viewEditBeasiswa($nomor_beasiswa);
}
else if($_GET['aksi']=='update_data'){

$nomor_beasiswa		= mysql_real_escape_string($_POST['nomor_beasiswa']);
$nomor_bp			= mysql_real_escape_string($_POST['nomor_bp']);
$namabeasiswa		= mysql_real_escape_string($_POST['namabeasiswa']);
$asalbeasiswa		= mysql_real_escape_string($_POST['asalbeasiswa']);
$besarbeasiswa		= mysql_real_escape_string($_POST['besarbeasiswa']);
$tanggalterima 		= mysql_real_escape_string($_POST['tanggalterima']); 
$tanggalberakhir 	= mysql_real_escape_string($_POST['tanggalberakhir']); 
$kuota 				= mysql_real_escape_string($_POST['kuota']); 
$syaratipk			= mysql_real_escape_string( $_POST['syaratipk']); 
$syaratpenerima		= mysql_real_escape_string( $_POST['syaratpenerima']); 
$keterangan 		= mysql_real_escape_string( $_POST['keterangan']);
$main->updateDataBeasiswa($nomor_beasiswa,$namabeasiswa,$asalbeasiswa,$besarbeasiswa,$tanggalterima,$tanggalberakhir,$kuota,$syaratipk,$syaratpenerima,$keterangan);

}
else if($_GET['aksi']=='hapus_data'){
$where=$_GET['id'];
$main->deleteData($table = 'beasiswa',$where);
}
}
else{
	echo '<div class="alert alert-error"> Maaf Anda Harus Login terlebih dahulu untuk mengakses halaman ini </div>';
}
?> 