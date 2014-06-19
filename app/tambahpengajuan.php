<?php empty( $app ) ? header('location:../index.php') : '' ;?>
<?php if(isset($_SESSION['level'])){?>
<form method="POST" action="" accept-charset="UTF-8">
	<table>
		<tr>	
			<td valign="top"><label>Nomor Bp</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Nomor Bp" type="text" name="nomor_bp" required></td>
		</tr>
		<tr>	
			<td valign="top"><label>Nama Mahasiswa</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Nama Mahasiswa" type="text" name="nama_mahasiswa" required></td>
		</tr>
		<tr>	
			<td valign="top"><label>Keterangan</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Keterangan" type="text" name="keterangan" required></td>
		</tr>
		<tr>
			<td colspan="3" align="right"><input type="submit" name="tambah" value="tambah"></td>
		</tr>
		<?php
		include 'class.php';
		$db = new database();
		$db->connect();
		
		?>
	</table>
</form>
<?php 
else{
	echo '<div class="alert alert-error"> Maaf Anda Harus Login terlebih dahulu untuk mengakses halaman ini </div>';
} 
?>