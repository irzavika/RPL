<?php empty( $app ) ? header('location:../index.php') : '' ; if(isset($_SESSION['level'])){ ?>
<?php 
include "class.php";

$profile 	= new users;
$bea = new beasiswa;
$username	= $_SESSION['username'];
$db 		= new database ;
$db->konek();

echo	"<script>
		function checkForm(form){
			if (form.password.value != form.password2.value){
				alert ('Password tidak sama , pastikan password yang dimasukan sama');
				return false;
			}else {
				return true;
			}
		}
		</script>";
echo 	"<form method=POST action='index.php?app=profile&aksi=update_data' onsubmit='checkForm(this)'>
		<table>
			<tr>
				<td><input class='span3' type='hidden' name='username' value='".$profile->bacaData(username,$username)."'></td>
			</tr>
			<tr>
				<td valign='top'><label>Password Baru</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='password' name='password' required></td>
			</tr>
			<tr>
				<td valign='top'><label>Password <small>Verifikasi</small></label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='password' name='password2' required></td>
			</tr>
			<tr>	
				<td valign='top'><label>Nama</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='nama' value='".$profile->bacaData(nama,$username)."'></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input type=submit value='simpan' class='btn btn-mini'></td>
			</tr>
		</table>
		</form>
	";

if($_GET['aksi']=='update_data'){
	$username 	= mysql_real_escape_string($_POST['username']);
	$password 	= mysql_real_escape_string(md5($_POST['password']));
	$password2	= mysql_real_escape_string(md5($_POST['password2']));
	$nama	 	= mysql_real_escape_string($_POST['nama']);
		if ($password != $password2){
		return false;
		}
		else {
		$profile->updateData($username,$password,$nama,$pesan = null);
		}
	}
if($_SESSION['level'] == 'user'){
	$nomor_bp 	= $_SESSION['username'];
	$penerima 	= new penerimaBeasiswa ;
	$sqlcek=mysql_query("select * from penerima_beasiswa where nomor_bp = '$username' ");
	if (mysql_num_rows($sqlcek)==0){
		echo "<div class='alert alert-error' align='center'>Anda belum memiliki beasiswa yang diterima </div>";
	}
	else{
		$daftar=$penerima->tampilData($nomor_bp,$id_beasiswa=null,$order=null);
		foreach($daftar as $data){
		$id_beasiswa = $data['id_beasiswa'];
		$daftar2	 = $bea->tampilData($id_beasiswa);
			foreach($daftar2 as $data2){
			echo "<div class='alert alert-success' align='center'><strong>Selamat anda telah dimasukan dalam kuota list untuk ";
			echo $data2['nama_beasiswa'];
			echo "</strong></div><br>";
			}
		}
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
						<th align='center'>Tanggal Berakhir</th>
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
					<td align='center'> ".$data['tanggal_terima']."</td> 
					<td align='center'> ".$data['tanggal_berakhir']."</td>
				</tr>";
			}
		echo	"</table>";
		}
	}
}
else{
	echo '<div class="alert alert-error"> Maaf Anda Harus Login terlebih dahulu untuk mengakses halaman ini </div>';
}

?>
