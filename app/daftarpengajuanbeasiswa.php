<?php empty( $app ) ? header('location:../index.php') : '' ; if(isset($_SESSION['level'])){?>
<?php
include "class.php";

$pengajuan = new pengajuanBeasiswa;
$pengguna = new users;
$id_beasiswa = $_GET['id'] ;
$order = $_GET['order'] ;

if($_GET['terima']== 'terima_pengajuan'){
	$username = $_GET['nomor_bp'] ;
	echo"	<form method='POST' action='index.php?app=daftarpengajuanbeasiswa&lihat=$_GET[lihat]&aksi=terima_data_pengajuan&nomor_bp=$_GET[nomor_bp]&id=$_GET[id]' accept-charset='UTF-8'>
			<table>
			<tr>	
			<td valign='top'><label>Tanggal Terima</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' placeholder='Tanggal Terima' type='date' name='tanggalterima' required></td>
			</tr>
			<tr>	
			<td valign='top'><label>Tanggal Berakhir</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' placeholder='Tanggal Berakhir' type='date' name='tanggalberakhir' required></td>
			</tr>
			<tr>	
			<td valign='top'><label>Pesan</label></td>
			<td valign='top'>:</td>
			<td><textarea rows='5' cols='60' name='pesan'>".$pengguna->bacaData(pesan,$username)."</textarea></td>
			</tr>
			<tr>
			<td colspan='3' align='right'><input type='submit' name='simpan' value='simpan' class='btn btn-mini'</td>
			<td><a href='index.php?app=daftarpengajuanbeasiswa&lihat=$_GET[lihat]&id=$_GET[id]' class='btn btn-mini'><i class='icon-share-alt'></i> Batal</a></td>
			</tr>
			</table>
			</form>
		";
}
if($_GET['lihat']==''){
	if($_GET['hide']=='hiden'){}
	else{
	$daftar=$pengajuan->tampilData($id_beasiswa = null,$order);
	echo	"<h6> Data Pengajuan yang belum di periksa </h6> 
			<div class='btn-group' style='float:left;'>
				<a class='btn dropdown-toggle' data-toggle='dropdown' href='#'>
				Sort By
				<span class='caret'></span>
				</a>
				<ul class='dropdown-menu'>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa'>Sort BP</a
				</li>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&order=nama_jurusan'>Sort Jurusan</a
				</li>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&order=ipktinggi'>IPK Tertinggi</a
				</li>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&order=ipkrendah'>IPK Terendah</a
				</li>
				</ul>
			</div><br><br>
			";
			
	echo 	"<table class='table table-bordered table-condensed table-hover'>
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
			<td ><a href='index.php?app=daftarpengajuanbeasiswa&hide=hiden&terima=terima_pengajuan&nomor_bp=$data[nomor_bp]' class='btn btn-mini'><i class='icon-ok'></i> Terima </a>
			<td ><a href='index.php?app=daftarpengajuanbeasiswa&aksi=tolak_pengajuan&nomor_bp=$data[nomor_bp]' class='btn btn-mini'><i class='icon-remove'></i>Tolak</a></td>" ;
			}
	echo	"</tr></table>";

	echo	"<br><h6>Data pengajuan yang telah diperiksa </h6>
			<div class='btn-group' style='float:left;'>
				<a class='btn dropdown-toggle' data-toggle='dropdown' href='#'>
				Sort By
				<span class='caret'></span>
				</a>
				<ul class='dropdown-menu'>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa'>Sort BP</a
				</li>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&order=nama_jurusan2'>Sort Jurusan</a
				</li>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&order=ipktinggi2'>IPK Tertinggi</a
				</li>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&order=ipkrendah2'>IPK Terendah</a
				</li>
				</ul>
			</div><br><br>
			";

	$daftar2=$pengajuan->tampilDataBatch($id_beasiswa = null,$order);

	echo 	"<table class='table table-bordered table-condensed table-hover'>
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
			
	foreach($daftar2 as $data2){
	echo	"<tr>
			<td align='center'> ".$data2['nomor_bp']."</td>
			<td align='center'> ".$data2['nama_mahasiswa']."</td> 
			<td align='center'> ".$data2['nama_jurusan']."</td> 
			<td align='center'> ".$data2['nama_fakultas']."</td> 
			<td align='center'> ".$data2['id_beasiswa']."</td> 
			<td align='center'> ".$data2['jenis_kelamin']."</td>
			<td align='center'> ".$data2['agama']."</td> 
			<td align='center'> ".$data2['ipk']."</td> 
			<td align='center'> ".$data2['keterangan']."</td> 
			<td ><a href='index.php?app=daftarpengajuanbeasiswa&lihat=&aksi=delete_bacth&nomor_bp=$data2[nomor_bp]' class='btn btn-mini'><i class='icon-trash'></i> Hapus </a>
			<td ><a href='index.php?app=daftarpengajuanbeasiswa&lihat=&aksi=kembalikan_pengajuan&nomor_bp=$data2[nomor_bp]' class='btn btn-mini'></i>Kembalikan ke daftar periksa</a></td>" ;
			}
	echo	"</tr></table>";
	}
}
else if($_GET['lihat']=='lihat_pengajuan'){
	if($_GET['hide']=='hiden'){}
	else{
	$daftar=$pengajuan->tampilData($id_beasiswa,$order);
	echo	"<h6> Data Pengajuan yang belum di periksa </h6> ";
	echo	"<div class='btn-group' style='float:right;'>
				<a class='btn dropdown-toggle' data-toggle='dropdown' href='#'>
				Sort By
				<span class='caret'></span>
				</a>
				<ul class='dropdown-menu'>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&id=$_GET[id]&lihat=lihat_pengajuan'>Sort BP</a
				</li>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&order=nama_jurusan&id=$_GET[id]&lihat=lihat_pengajuan'>Sort Jurusan</a
				</li>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&order=ipktinggi&id=$_GET[id]&lihat=lihat_pengajuan'>IPK Tertinggi</a
				</li>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&order=ipkrendah&id=$_GET[id]&lihat=lihat_pengajuan'>IPK Terendah</a
				</li>
				</ul>
			</div>
			<br><br>
			";

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
			<td ><a href='index.php?app=daftarpengajuanbeasiswa&hide=hiden&lihat=lihat_pengajuan&terima=terima_pengajuan&nomor_bp=$data[nomor_bp]&id=$_GET[id]' class='btn btn-mini'><i class='icon-ok'></i> Terima </a>
			<td ><a href='index.php?app=daftarpengajuanbeasiswa&lihat=lihat_pengajuan&aksi=tolak_pengajuan&nomor_bp=$data[nomor_bp]&id=$_GET[id]' class='btn btn-mini'><i class='icon-remove'></i>Tolak</a></td>" ;
			}
	echo	"</tr></table>";

	echo	"<br><h6>Data pengajuan yang telah diperiksa </h6>
			<div class='btn-group' style='float:right;'>
				<a class='btn dropdown-toggle' data-toggle='dropdown' href='#'>
				Sort By
				<span class='caret'></span>
				</a>
				<ul class='dropdown-menu'>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&id=$_GET[id]&lihat=lihat_pengajuan'>Sort BP</a
				</li>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&order=nama_jurusan2&id=$_GET[id]&lihat=lihat_pengajuan'>Sort Jurusan</a
				</li>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&order=ipktinggi2&id=$_GET[id]&lihat=lihat_pengajuan'>IPK Tertinggi</a
				</li>
				<li>
				<a href='index.php?app=daftarpengajuanbeasiswa&order=ipkrendah2&id=$_GET[id]&lihat=lihat_pengajuan'>IPK Terendah</a
				</li>
				</ul>
			</div>
			<br><br>
			";

	$daftar2=$pengajuan->tampilDataBatch($id_beasiswa,$order);
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
			
	foreach($daftar2 as $data2){
	echo	"<tr>
			<td align='center'> ".$data2['nomor_bp']."</td>
			<td align='center'> ".$data2['nama_mahasiswa']."</td> 
			<td align='center'> ".$data2['nama_jurusan']."</td> 
			<td align='center'> ".$data2['nama_fakultas']."</td> 
			<td align='center'> ".$data2['id_beasiswa']."</td> 
			<td align='center'> ".$data2['jenis_kelamin']."</td>
			<td align='center'> ".$data2['agama']."</td> 
			<td align='center'> ".$data2['ipk']."</td> 
			<td align='center'> ".$data2['keterangan']."</td> 
			<td ><a href='index.php?app=daftarpengajuanbeasiswa&lihat=lihat_pengajuan&aksi=delete_bacth&nomor_bp=$data2[nomor_bp]&id=$_GET[id]' class='btn btn-mini'><i class='icon-trash'></i> Hapus </a>
			<td ><a href='index.php?app=daftarpengajuanbeasiswa&lihat=lihat_pengajuan&aksi=kembalikan_pengajuan&nomor_bp=$data2[nomor_bp]&id=$_GET[id]' class='btn btn-mini'></i>Kembalikan ke daftar periksa</a></td>" ;
			}
	echo	"</tr></table>";
	}
}
if($_GET['aksi']== 'tolak_pengajuan'){
	$nomor_bp = $_GET['nomor_bp'] ;
	$lihat = $_GET['lihat'] ;
	$pengajuan->tolakPengajuan($nomor_bp,$lihat);
}
else if($_GET['aksi']== 'kembalikan_pengajuan'){
	$nomor_bp = $_GET['nomor_bp'] ;
	$lihat = $_GET['lihat'] ;
	$pengajuan->kembalikanPengajuan($nomor_bp,$lihat);
}
else if($_GET['aksi']== 'delete_bacth'){
	$nomor_bp = $_GET['nomor_bp'] ;
	$lihat = $_GET['lihat'] ;
	$pengajuan->deleteBacth($nomor_bp,$lihat);
}
else if($_GET['aksi']== 'terima_data_pengajuan'){
	$pesan				= mysql_real_escape_string($_POST['pesan']);
	$tanggalterima 		= mysql_real_escape_string($_POST['tanggalterima']); 
	$tanggalberakhir 	= mysql_real_escape_string($_POST['tanggalberakhir']);
	$pesan			 	= mysql_real_escape_string($_POST['pesan']);	
	$nomor_bp = $_GET['nomor_bp'] ;
	$username = $_GET['nomor_bp'] ;
	$lihat = $_GET['lihat'] ;
	$pengajuan->terimaPengajuan($nomor_bp,$lihat,$tanggalterima,$tanggalberakhir);
	$pengguna->updateData($username,$password = null,$nama = null,$pesan);
}
}
else{
	echo '<div class="alert alert-error"> Maaf Anda Harus Login terlebih dahulu untuk mengakses halaman ini </div>';
} 
?>