<?php empty( $app ) ? header('location:../index.php') : '' ; if(isset($_SESSION['level'])){?>
<?php
include "class.php";
$username 	= $_SESSION['username'];
$pengajuan 	= new pengajuanBeasiswa ;
$bea		= new beasiswa ;
$db = new database ;
$db->konek();
$sqlcek1=mysql_query("select * from pengajuan_beasiswa where nomor_bp = '$username' ");
$sqlcek2=mysql_query("select * from penerima_beasiswa where nomor_bp = '$username' ");

if($_GET['aksi']=='tambah_pengajuan'){
$id_beasiswa = $_GET['id'];
	if (mysql_num_rows($sqlcek1)==0){
		if (mysql_num_rows($sqlcek2)==0){
		echo"	<form method='POST' action='index.php?app=pengajuanbeasiswa&aksi=tambah_data' accept-charset='UTF-8'>
		<table>
		<tr>	
			<td valign='top'><label>Nama Mahasiswa</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' placeholder='Nama Mahasiswa' type='text' name='nama_mahasiswa' required></td>
		</tr>
		<tr>	
			<td valign='top'><label>Nama jurusan</label></td>
			<td valign='top'>:</td>
			<td><select name='nama_jurusan' required>
				<option value='sistem informasi'>Sistem Informasi</option>
				<option value='sistem komputer'>Sistem Komputer</option>
				</select>
			</td>
		</tr>
		<tr>	
			<td valign='top'><label>Nama Fakultas</label></td>
			<td valign='top'>:</td>
			<td><select name='nama_fakultas' required>
				<option value='teknologi informasi'>Teknologi Informasi</option>
				</select>
			</td>
		</tr>
		<tr>	
			<td valign='top'><label>Id beasiswa</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' placeholder='Id Beasiswa' type='text' name='id_beasiswa' value='".$bea->bacaData(id_beasiswa,$id_beasiswa)."' readonly></td>
		</tr>
		<tr>	
			<td valign='top'><label>Jenis kelamin</label></td>
			<td valign='top'>:</td>
			<td><select name='jenis_kelamin' required>
				<option value='laki-laki'>Laki-Laki</option>
				<option value='wanita'>Wanita</option>
				</select>
			</td>
		</tr>
		<tr>	
			<td valign='top'><label>Agama</label></td>
			<td valign='top'>:</td>
			<td><select name='agama' required>
				<option value='islam'>Islam</option>
				<option value='katolik'>Katolik</option>
				<option value='protestan'>Protestan</option>
				<option value='hindu'>Hindu</option>
				<option value='budha'>Budha</option>
				<option value='konghucu'>Konghucu</option>
				</select>
			</td>
		</tr>
		<tr>	
			<td valign='top'><label>IPK</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' placeholder='IPK' type='text' name='ipk' required></td>
		</tr>
		<tr>	
			<td valign='top'><label>Keterangan<br><small>Prestasi dan Pengalaman organisasi</small></label></td>
			<td valign='top'>:</td>
			<td><textarea rows='5' cols='60' placeholder='Keterangan' name='keterangan'></textarea></td>
		</tr>
		<tr>
			<td colspan='3' align='right'><input type='submit' name='tambah' value='tambah' class='btn btn-mini'></td>
			<td><a href='index.php?app=pengajuanbeasiswa&aksi=' class='btn btn-mini'><i class='icon-thumbs-up'></i> Batal</a></td>
		</tr> 
		</table>
		</form>";
		}
		else{
		echo "Anda telah menerima beasiswa";
		}
	} 
	else {
	echo "<a href='index.php?app=databeasiswa&aksi=' class='btn btn-mini'><i class='icon-share-alt'></i> Kembali </a>";
	echo "<br><br>  Anda telah memasukan pengajuan, cuma 1 pengajuan yang dapat di ajukan  ";
	}
}
else if($_GET['aksi']=='tambah_data'){
	$nomor_bp			= $_SESSION['username'];
	$nama_mahasiswa		= mysql_real_escape_string($_POST['nama_mahasiswa']);
	$nama_jurusan		= mysql_real_escape_string($_POST['nama_jurusan']);
	$nama_fakultas		= mysql_real_escape_string($_POST['nama_fakultas']);
	$id_beasiswa		= mysql_real_escape_string($_POST['id_beasiswa']); 
	$jenis_kelamin 		= mysql_real_escape_string($_POST['jenis_kelamin']); 
	$agama				= mysql_real_escape_string($_POST['agama']); 
	$ipk 				= mysql_real_escape_string($_POST['ipk']); 
	$keterangan 		= mysql_real_escape_string($_POST['keterangan']);
	$pengajuan->tambahPengajuan($nomor_bp,$nama_mahasiswa,$nama_jurusan,$nama_fakultas,$id_beasiswa,$jenis_kelamin,$agama,$ipk,$keterangan);
}
else if($_GET['aksi']==''){

	if (mysql_num_rows($sqlcek1)==0){
		echo 	"Data tidak ditemukan anda belum pernah memasukan pengajuan atau anda telah menerima beasiswa ";
	}
	else {
		$daftar=$pengajuan->tampilDataUser($username);
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
			<th colspan = '2' align='center'>Action</th>
			</tr>";
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
			<td ><a href='index.php?app=pengajuanbeasiswa&aksi=edit' class='btn btn-mini'><i class='icon-pencil'></i> Edit </a>
			<td ><a href='index.php?app=pengajuanbeasiswa&aksi=hapus_data' class='btn btn-mini'><i class='icon-trash'></i> Delete</a></td>" ;
			}
		echo	"</tr></table>";
		}
}
else if($_GET['aksi']=='edit'){
	$nomor_bp = $_SESSION['username'];
	$tabel = 'pengajuan_mahasiswa';
	echo" <form method='POST' action='index.php?app=pengajuanbeasiswa&aksi=edit_data' accept-charset='UTF-8'>
		<table>
		<tr>	
			<td valign='top'><label>Nama Mahasiswa</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' type='text' name='nama_mahasiswa' value='".$pengajuan->bacaDataPengajuan(nama_mahasiswa,$nomor_bp,$tabel)."'></td>
		</tr>
		<tr>	
			<td valign='top'><label>Nama jurusan</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' type='text' name='nama_jurusan' value='".$pengajuan->bacaDataPengajuan(nama_jurusan,$nomor_bp,$tabel)."'></td>
		</tr>
		<tr>	
			<td valign='top'><label>Nama Fakultas</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' type='text' name='nama_fakultas' value='".$pengajuan->bacaDataPengajuan(nama_fakultas,$nomor_bp,$tabel)."'></td>
		</tr>
		<tr>	
			<td valign='top'><label>Id beasiswa</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' type='text' name='id_beasiswa' value='".$pengajuan->bacaDataPengajuan(id_beasiswa,$nomor_bp,$tabel)."' readonly></td>
		</tr>
		<tr>	
			<td valign='top'><label>Jenis kelamin</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' type='text' name='jenis_kelamin' value='".$pengajuan->bacaDataPengajuan(jenis_kelamin,$nomor_bp,$tabel)."'></td>
		</tr>
		<tr>	
			<td valign='top'><label>Agama</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' type='text' name='agama' value='".$pengajuan->bacaDataPengajuan(agama,$nomor_bp,$tabel)."'></td>
		</tr>
		<tr>	
			<td valign='top'><label>IPK</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' type='text' name='ipk' value='".$pengajuan->bacaDataPengajuan(ipk,$nomor_bp,$tabel)."'></td>
		</tr>
		<tr>	
			<td valign='top'><label>Keterangan</label></td>
			<td valign='top'>:</td>
			<td><textarea rows='5' cols='60' name='keterangan'>".$pengajuan->bacaDataPengajuan(keterangan,$nomor_bp,$tabel)."</textarea></td>
		</tr>
		<tr>
			<td colspan='3' align='right'><input class='btn btn-mini' type='submit' name='ubah' value='ubah'></td>
			<td><a href='index.php?app=pengajuanbeasiswa&aksi=' class='btn btn-mini'><i class='icon-thumbs-up'></i> Batal</a></td>
		</tr>";
	echo	"</table>
			</form>";
}
else if($_GET['aksi']=='edit_data'){
	$nomor_bp			= $_SESSION['username'];
	$nama_mahasiswa		= mysql_real_escape_string($_POST['nama_mahasiswa']);
	$nama_jurusan		= mysql_real_escape_string($_POST['nama_jurusan']);
	$nama_fakultas		= mysql_real_escape_string($_POST['nama_fakultas']);
	$id_beasiswa		= mysql_real_escape_string($_POST['id_beasiswa']); 
	$jenis_kelamin 		= mysql_real_escape_string($_POST['jenis_kelamin']); 
	$agama				= mysql_real_escape_string($_POST['agama']); 
	$ipk 				= mysql_real_escape_string($_POST['ipk']); 
	$keterangan 		= mysql_real_escape_string($_POST['keterangan']);
	$keterangan 		= mysql_real_escape_string($_POST['keterangan']);
	$pengajuan->updateData($nomor_bp,$nama_mahasiswa,$nama_jurusan,$nama_fakultas,$id_beasiswa,$jenis_kelamin,$agama,$ipk,$keterangan);
}
else if($_GET['aksi']=='hapus_data'){
	$nomor_bp			= $_SESSION['username'];
	$pengajuan->deleteData($nomor_bp);
}
}
else{
	echo '<div class="alert alert-error"> Maaf Anda Harus Login terlebih dahulu untuk mengakses halaman ini </div>';
} 
?>