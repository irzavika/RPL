<?php empty( $app ) ? header('location:../index.php') : '' ; if(isset($_SESSION['level'])){?>
<?php
include "class.php";
$pengguna = new users;
echo	"<script>
		function checkForm(form){
		if (form.pass1.value != form.pass2.value){
			alert ('Password tidak sama , pastikan password yang dimasukan sama');
			return false;
		}else {
			return true;
		}
		}
		</script>";

if($_GET['aksi']==''){
	echo "<form ACTION='index.php?app=tambahuser&aksi=tambah_data' METHOD='POST' NAME='tambahuser' onsubmit='checkForm(this)' >
		<table>
			<tr>	
				<td valign='top'><label>Username</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' placeholder='Username' type='text' name='user_name' required></td>
			</tr>
			<tr>	
				<td valign='top'><label>Password</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' placeholder='Password' type='password' name='pass1' required></td>
			</tr>
			<tr>	
				<td valign='top'><label>Password <small> verifikasi </small> </label></td>
				<td valign='top'>:</td>
				<td><input class='span3' placeholder='Password' type='password' name='pass2' required></td>
			</tr>
			<tr>	
				<td valign='top'><label>Nama User </label></td>
				<td valign='top'>:</td>
				<td><input class='span3' placeholder='Nama user' type='text' name='nama' required></td>
			</tr>
			<tr>
				<td colspan='3' align='right'><button class='btn-info btn' type='submit'>Tambah</button></td>
			</tr>
		</table>
	</form>";
	$daftar=$pengguna->tampilData();
	echo 	"<table class='table table-bordered table-condensed table-hover'>
				<tr class='nowrap'>
				<th align='center'>username BP</th>
				<th align='center'>Nama user</th>
				<th align='center'>Level</th>
				<th align='center'>Pesan</th>
				<th colspan = '2' align='center'>Action</th>
				</tr>";
	foreach($daftar as $data){
	echo	"<tr>
			<td align='center'> ".$data['username']."</td>
			<td align='center'> ".$data['nama']."</td> 
			<td align='center'> ".$data['level']."</td>
			<td align='center'> ".$data['pesan']."</td>
			<td><a href='index.php?app=tambahuser&aksi=edit&username=$data[username]&nama=$data[nama]' class='btn btn-mini'><i class='icon-edit'></i>Edit Pesan</a></td>
			<td><a href='index.php?app=tambahuser&aksi=hapus_data&username=$data[username]' class='btn btn-mini' onClick='return confirm('Yakin ingin delete data beasiswa')'><i class='icon-trash'></i>Delete</a></td>";
	echo	"</tr>" ;
	}
	echo	"</table>";
}
else if($_GET['aksi']=='tambah_data'){
	$user_name = mysql_real_escape_string($_POST['user_name']);
	$pass1     = mysql_real_escape_string(md5($_POST['pass1']));
	$pass2     = mysql_real_escape_string(md5($_POST['pass2']));
	$nama	   = mysql_real_escape_string($_POST['nama']);
	
	if ($pass1 != $pass2){
	return false;
	}
	else {
	$pengguna->tambahData($user_name,$pass1,$nama);
	}
}
else if ($_GET['aksi']=='hapus_data'){
	$user_name	= $_GET['username'];
	$pengguna->hapusData($user_name);
}
else if ($_GET['aksi']=='edit'){
	$daftar		=$pengguna->tampilData();
	$username	=$_GET['username'];
	$nama	=$_GET['nama'];
	echo "<h6>Pesan untuk  "; echo $nama ; echo " dengan nomor BP "; echo $username; echo "<h6>";
	echo "	<form method='POST' action='index.php?app=tambahuser&aksi=edit_data&username=$_GET[username]' accept-charset='UTF-8'>
			<table>
			<tr>
				<td valign='top'><label>Pesan</label></td>
				<td valign='top'>:</td>
				<td><textarea rows='5' cols='60' name='pesan'>".$pengguna->bacaData(pesan,$username)."</textarea></td>
			</tr>
			<tr>
				<td colspan='3' align='right'><input type='submit' name='simpan' value='simpan' class='btn btn-mini'</td>
				<td><a href='index.php?app=tambahuser&aksi=' class='btn btn-mini'><i class='icon-share-alt'></i> Batal</a></td>
			</tr>
			</table>
			</form>";
}
else if ($_GET['aksi']=='edit_data'){
	$pesan		= mysql_real_escape_string($_POST['pesan']);
	$username	= $_GET['username'];
	$pengguna->updateData($username,$password = null,$nama = null,$pesan);
}
}
else{
	echo '<div class="alert alert-error"> Maaf Anda Harus Login terlebih dahulu untuk mengakses halaman ini </div>';
}
?>