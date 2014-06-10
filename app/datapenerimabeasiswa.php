<?php empty( $app ) ? header('location:../index.php') : '' ; if(isset($_SESSION['level'])){?>

<?php 
include "class.php";

$penbea = new penerimaBeasiswa;
$order = $_GET['order'] ;

if($_GET['aksi']==''){
$cari 		= mysql_real_escape_string($_POST['cari']);
echo 	"	<form method=POST action='index.php?app=datapenerimabeasiswa&aksi=pencari&nilaicari=$_POST[cari]'>
			<p>
			<div class='btn-group' style='float:left;'>
				<a class='btn dropdown-toggle' data-toggle='dropdown' href='#'>
				Sort By
				<span class='caret'></span>
				</a>
				<ul class='dropdown-menu'>
				<li>
				<a href='index.php?app=datapenerimabeasiswa'>Sort BP</a
				</li>
				<li>
				<a href='index.php?app=datapenerimabeasiswa&order=nama_jurusan'>Sort Jurusan</a
				</li>
				<li>
				<a href='index.php?app=datapenerimabeasiswa&order=ipktinggi'>IPK Tertinggi</a
				</li>
				<li>
				<a href='index.php?app=datapenerimabeasiswa&order=ipkrendah'>IPK Terendah</a
				</li>
				</ul>
			</div><br><br>";
			/*<div>
				<input type='text' class='input-large search-query' name='cari' placeholder='Cari Berdasarkan nomor BP' >
				<a href='index.php?app=datapenerimabeasiswa' class='btn btn-medium'><i class='icon-search'></i></a>
			</div>*/
echo		"</p>
			</form> ";
echo $cari;			
$daftar=$penbea->tampilData($nomor_bp = null, $id_beasiswa = null, $order);

echo 	"<table <table class='table table-bordered table-condensed table-hover'>
		<tr class='nowrap'>
		<th align='center'>Nomor BP</th>
		<th align='center'>Nama Mahasiswa</th>
		<th align='center'>Jurusan</th>
		<th align='center'>Fakultas</th>
		<th align='center'>Id Beasiswa</th>
		<th align='center'>Gender</th>
		<th align='center'>Agama</th>
		<th align='center'>IPK</th>
		<th align='center'>Keterangan</th>
		<th align='center'>Tanggal Terima</th>
		<th align='center'>Tanggal Berakhir</th>";
		if($_SESSION['level']=='admin'){
			echo "<th colspan = '2' align='center'>Action</th>";
			 } else {
			echo "<th align='center'>Action</th>";
			 } 
echo	"</tr>";
foreach($daftar as $data){
echo	"<tr>
		<td align='center'> ".$data['nomor_bp']."</td>
		<td align='center'> ".$data['nama_mahasiswa']."</td> 
		<td align='center'> ".$data['nama_jurusan']."</td> 
		<td align='center'> ".$data['nama_fakultas']."</td> 
		<td align='center'> ".$data['id_beasiswa']."</td> 
		<td align='center'> ".$data['jenis_kelamin']."</td>
		<td align='center'> ".$data['agama']."</td> 
		<td align='center'> ".$data['ipk']."</td> 
		<td align='center'> ".$data['keterangan']."</td> 
		<td align='center'> ".$data['tanggal_terima']."</td> 
		<td align='center'> ".$data['tanggal_berakhir']."</td>";
		if($_SESSION['level']=='admin'){
		echo "<td ><a href='index.php?app=datapenerimabeasiswa&aksi=edit&bp=$data[nomor_bp]' class='btn btn-mini'><i class='icon-edit'></i> Edit</a>" ;
		echo "<td ><a href='index.php?app=datapenerimabeasiswa&aksi=hapus_data&bp=$data[nomor_bp]' class='btn btn-mini' onClick='return confirm('Yakin ingin delete data beasiswa')'><i class='icon-trash'></i>Delete</a></td>" ;
		}
echo	"</tr>" ;
}
echo	"</table>";
}
else if($_GET['aksi']=='lihat_penerima'){
$id_beasiswa = $_GET['id'] ;
echo 	"	<form method=POST action='index.php?app=datapenerimabeasiswa&aksi=pencari'>
			<p>
			<div class='btn-group' style='float:right;'>
				<a class='btn dropdown-toggle' data-toggle='dropdown' href='#'>
				Sort By
				<span class='caret'></span>
				</a>
				<ul class='dropdown-menu'>
				<li>
				<a href='index.php?app=datapenerimabeasiswa'>Tampilkan Semua</a
				</li>
				<li>
				<a href='index.php?app=datapenerimabeasiswa&order=nama_jurusan&aksi=lihat_penerima&id=$_GET[id]'>Sort Jurusan</a
				</li>
				<li>
				<a href='index.php?app=datapenerimabeasiswa&order=ipktinggi&aksi=lihat_penerima&id=$_GET[id]'>IPK Tertinggi</a
				</li>
				<li>
				<a href='index.php?app=datapenerimabeasiswa&order=ipkrendah&aksi=lihat_penerima&id=$_GET[id]'>IPK Terendah</a
				</li>
				</ul>
			</div>
			<div>
				<input type='text' class='input-large search-query' name='cari' placeholder='Cari Berdasarkan nomor BP' >
				<a href='' class='btn btn-medium'><i class='icon-search'></i></a>
			</div>
			</p>
			</form>";
			
$daftar=$penbea->tampilData($nomor_bp = null ,$id_beasiswa, $order);

echo 	"<table <table class='table table-bordered table-condensed table-hover'>
		<tr class='nowrap'>
		<th align='center'>Nomor BP</th>
		<th align='center'>Nama Mahasiswa</th>
		<th align='center'>Jurusan</th>
		<th align='center'>Fakultas</th>
		<th align='center'>Id Beasiswa</th>
		<th align='center'>Gender</th>
		<th align='center'>Agama</th>
		<th align='center'>IPK</th>
		<th align='center'>Keterangan</th>
		<th align='center'>Tanggal Terima</th>
		<th align='center'>Tanggal Berakhir</th>";
		if($_SESSION['level']=='admin'){
			echo "<th colspan = '2' align='center'>Action</th>";
			 } else {
			echo "<th align='center'>Action</th>";
			 } 
echo	"</tr>";
foreach($daftar as $data){
echo	"<tr>
		<td align='center'> ".$data['nomor_bp']."</td>
		<td align='center'> ".$data['nama_mahasiswa']."</td> 
		<td align='center'> ".$data['nama_jurusan']."</td> 
		<td align='center'> ".$data['nama_fakultas']."</td> 
		<td align='center'> ".$data['id_beasiswa']."</td> 
		<td align='center'> ".$data['jenis_kelamin']."</td>
		<td align='center'> ".$data['agama']."</td> 
		<td align='center'> ".$data['ipk']."</td> 
		<td align='center'> ".$data['keterangan']."</td> 
		<td align='center'> ".$data['tanggal_terima']."</td> 
		<td align='center'> ".$data['tanggal_berakhir']."</td>";
		if($_SESSION['level']=='admin'){
		echo "<td ><a href='index.php?app=datapenerimabeasiswa&aksi=edit&bp=$data[nomor_bp]&id=$_GET[id]' class='btn btn-mini'><i class='icon-edit'></i> Edit</a>" ;
		echo "<td ><a href='index.php?app=datapenerimabeasiswa&aksi=hapus_data&bp=$data[nomor_bp]' class='btn btn-mini' onClick='return confirm('Yakin ingin delete data beasiswa')'><i class='icon-trash'></i>Delete</a></td>" ;
		}
echo	"</tr>" ;
}
echo	"</table>";
}
else if($_GET['aksi']=='edit'){ 
$nomor_bp	=	mysql_real_escape_string($_GET['bp']);
echo 	"<form method=POST action='index.php?app=datapenerimabeasiswa&aksi=update_data&id=$_GET[id]'>
		<table>
			<tr>
				<td valign='top'><label>Nomor BP</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='nomor_bp' value='".$penbea->bacaData(nomor_bp,$nomor_bp)."'></td></tr>
			<tr>
			<tr>
				<td valign='top'><label>Nama Mahasiswa</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='nama_mahasiswa' value='".$penbea->bacaData(nama_mahasiswa,$nomor_bp)."'></td></tr>
			<tr>	
				<td valign='top'><label>Jurusan</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='nama_jurusan' value='".$penbea->bacaData(nama_jurusan,$nomor_bp)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>Fakultas</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='nama_fakultas' value='".$penbea->bacaData(nama_fakultas,$nomor_bp)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>Id beasiswa</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='id_beasiswa' value='".$penbea->bacaData(id_beasiswa,$nomor_bp)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>Jenis Kelamin</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='jenis_kelamin' value='".$penbea->bacaData(jenis_kelamin,$nomor_bp)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>Agama</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='agama' value='".$penbea->bacaData(agama,$nomor_bp)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>IPK</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='ipk' value='".$penbea->bacaData(ipk,$nomor_bp)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>Keterangan</label></td>
				<td valign='top'>:</td>
				<td><textarea rows='5' cols='60' name='keterangan'>".$penbea->bacaData(keterangan,$nomor_bp)."</textarea></td>
			</tr>
			<tr>	
				<td valign='top'><label>Tanggal Terima</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='date' name='tanggal_terima' value='".$penbea->bacaData(tanggal_terima,$nomor_bp)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>Tanggal Berakhir</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='date' name='tanggal_berakhir' value='".$penbea->bacaData(tanggal_berakhir,$nomor_bp)."'></td>
			</tr>
			<tr>
				<td></td
				<td></td>
				<td><input type=submit value='simpan' class='btn btn-mini'></td>
				<td><a href='index.php?app=datapenerimabeasiswa&aksi=lihat_penerima&id=$_GET[id]' class='btn btn-mini'><i class='icon-thumbs-up'></i>Batal</a></td>
			</tr>
		</table>
		</form>
";
}
else if($_GET['aksi']=='update_data'){

$nomor_bp 		= mysql_real_escape_string($_POST['nomor_bp']);
$nama_mahasiswa = mysql_real_escape_string($_POST['nama_mahasiswa']);
$nama_jurusan 	= mysql_real_escape_string($_POST['nama_jurusan']);
$nama_fakultas 	= mysql_real_escape_string($_POST['nama_fakultas']);
$id_beasiswa 	= mysql_real_escape_string($_POST['id_beasiswa']); 
$jenis_kelamin 	= mysql_real_escape_string($_POST['jenis_kelamin']); 
$agama 			= mysql_real_escape_string($_POST['agama']); 
$ipk 			= mysql_real_escape_string($_POST['ipk']); 
$keterangan 	= mysql_real_escape_string($_POST['keterangan']);
$tanggal_terima = mysql_real_escape_string($_POST['tanggal_terima']);
$tanggal_berakhir = mysql_real_escape_string($_POST['tanggal_berakhir']);
$penbea->updateData($nomor_bp,$nama_mahasiswa,$nama_jurusan,$nama_fakultas,$id_beasiswa,$jenis_kelamin,$agama,$ipk,$keterangan,$tanggal_terima,$tanggal_berakhir);

}
else if($_GET['aksi']=='hapus_data'){

$nomor_bp	= mysql_real_escape_string($_GET['bp']);
$penbea->hapusData($nomor_bp);

}
else if($_GET['aksi']=='pencari'){
$cari = $_POST['cari'];
echo $cari;
echo 'disini';
echo 	"	<form method=POST action='index.php?app=datapenerimabeasiswa&aksi=pencari'>
			<p style=''>
			<input type='text' class='input-large search-query' id='cari' placeholder='Cari Berdasarkan nomor BP' >
			<a href='index.php?app=datapenerimabeasiswa&aksi=pencari' class='btn btn-medium'><i class='icon-search'></i></a>
		";
echo	" 	<a href='index.php?app=datapenerimabeasiswa' class='btn btn-medium'><i class='icon-reply'></i>Semua Data</a>
			</p>
			</form>";
			
//$nomor_bp = $_GET['pencarian'];
$nomor_bp = '1110951005';
$daftar=$penbea->tampilData($nomor_bp, $id_beasiswa = null);
echo 	"<table <table class='table table-bordered table-condensed table-hover'>
		<tr class='nowrap'>
		<th align='center'>Nomor BP</th>
		<th align='center'>Nama Mahasiswa</th>
		<th align='center'>Nama Jurusan</th>
		<th align='center'>Nama Fakultas</th>
		<th align='center'>Id Beasiswa</th>
		<th align='center'>Jenis Kelamin</th>
		<th align='center'>Agama</th>
		<th align='center'>IPK</th>
		<th align='center'>Keterangan</th>
		<th align='center'>Tanggal Terima</th>
		<th align='center'>Tanggal Berakhir</th>";
		if($_SESSION['level']=='admin'){
			echo "<th colspan = '2' align='center'>Action</th>";
			 } else {
			echo "<th align='center'>Action</th>";
			 } 
echo	"</tr>";
foreach($daftar as $data){
echo	"<tr>
		<td align='center'> ".$data['nomor_bp']."</td>
		<td align='center'> ".$data['nama_mahasiswa']."</td> 
		<td align='center'> ".$data['nama_jurusan']."</td> 
		<td align='center'> ".$data['nama_fakultas']."</td> 
		<td align='center'> ".$data['id_beasiswa']."</td> 
		<td align='center'> ".$data['jenis_kelamin']."</td>
		<td align='center'> ".$data['agama']."</td> 
		<td align='center'> ".$data['ipk']."</td> 
		<td align='center'> ".$data['keterangan']."</td> 
		<td align='center'> ".$data['tanggal_terima']."</td> 
		<td align='center'> ".$data['tanggal_berakhir']."</td>";
		if($_SESSION['level']=='admin'){
		echo "<td ><a href='index.php?app=datapenerimabeasiswa&aksi=edit&bp=$data[nomor_bp]' class='btn btn-mini'><i class='icon-edit'></i> Edit</a>" ;
		echo "<td ><a href='index.php?app=datapenerimabeasiswa&aksi=hapus_data&bp=$data[nomor_bp]' class='btn btn-mini' onClick='return confirm('Yakin ingin delete data beasiswa')'><i class='icon-trash'></i>Delete</a></td>" ;
		}
echo	"</tr>" ;
}
echo	"</table>";
}
}
else{
	echo '<div class="alert alert-error"> Maaf Anda Harus Login terlebih dahulu untuk mengakses halaman ini </div>';
} 
?>
