<?php empty( $app ) ? header('location:../index.php') : '' ; if(isset($_SESSION['level'])){?>
<?php
include "class.php";

$bea = new beasiswa;

if($_GET['aksi']==''){

if($_SESSION['level']=='admin'){ 
echo 	"<p>
		<a href='index.php?app=databeasiswa&aksi=tambah' class='btn btn-mini'><i class='icon-plus'></i>Tambah Baru</a>
		</p>";
}
$daftar=$bea->tampilData();
echo 	"<table <table class='table table-bordered table-condensed table-hover'>
		<tr class='nowrap'>
		<th align='center'>Nomor</th>
		<th align='center'>Beasiswa</th>
		<th align='center'>Asal Beasiswa</th>
		<th align='center'>Besar</th>
		<th align='center'>Tanggal terima</th>
		<th align='center'>Tanggal Berakhir</th>
		<th align='center'>Kuota</th>
		<th align='center'>Syarat IPK</th>
		<th align='center'>Keterangan</th>";
		if($_SESSION['level']=='admin'){
			echo "<th colspan = '3' align='center'>Action</th>";
			 } else {
			echo "<th align='center'>Action</th>";
			 } 
echo	"</tr>";
foreach($daftar as $data){
echo	"<tr>
		<td align='center'> ".$data['id_beasiswa']."</td>
		<td align='center'> ".$data['nama_beasiswa']."</td> 
		<td align='center'> ".$data['pemberi_beasiswa']."</td> 
		<td align='center'> ".$data['besar_beasiswa']."</td> 
		<td align='center'> ".$data['tanggal_terima']."</td> 
		<td align='center'> ".$data['tanggal_berakhir']."</td>
		<td align='center'> ".$data['kuota']."</td> 
		<td align='center'> ".$data['syarat_ipk']."</td> 
		<td align='center'> ".$data['keterangan']."</td> ";
		if($_SESSION['level']=='admin'){
		echo "<td ><a href='index.php?app=databeasiswa&aksi=edit&id=$data[id_beasiswa]' class='btn btn-mini'><i class='icon-edit'></i> Edit</a>" ;
		echo "<td ><a href='index.php?app=databeasiswa&aksi=hapus_data&id=$data[id_beasiswa]' class='btn btn-mini' onClick='return confirm('Yakin ingin delete data beasiswa ?')'><i class='icon-trash'></i>Delete</a></td>" ;
		echo "<td ><a href='index.php?app=daftarpengajuanbeasiswa&lihat=lihat_pengajuan&id=$data[id_beasiswa]' class='btn btn-mini'><i class='icon-folder-open'></i>Pengajuan</a></td>" ;
		echo "<td ><a href='index.php?app=datapenerimabeasiswa&aksi=lihat_penerima&id=$data[id_beasiswa]' class='btn btn-mini'><i class='icon-folder-open'></i>Penerima</a></td>" ;
		}
		else if($_SESSION['level']=='user'){
		echo "<td ><a href='index.php?app=pengajuanbeasiswa&aksi=tambah_pengajuan&id=$data[id_beasiswa]' class='btn btn-mini'><i class='icon-edit'></i> Ajukan Beasiswa</a>";
		}
echo	"</tr>" ;
}
echo	"</table>";
}
else if($_GET['aksi']=='tambah'){

echo"	<form method='POST' action='index.php?app=databeasiswa&aksi=tambah_data' accept-charset='UTF-8'>
		<table>
		<tr>	
			<td valign='top'><label>Nama Beasiswa</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' placeholder='Nama Beasiswa' type='text' name='namabeasiswa' required></td>
		</tr>
		<tr>	
			<td valign='top'><label>Pemberi Beasiswa</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' placeholder='Pemberi Beasiswa' type='text' name='pemberibeasiswa' required></td>
		</tr>
		<tr>	
			<td valign='top'><label>Besar Beasiswa</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' placeholder='Besar Beasiswa' type='text' name='besarbeasiswa' required></td>
		</tr>
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
			<td valign='top'><label>Kuota</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' placeholder='Kuota Beasiswa' type='text' name='kuota' required></td>
		</tr>
		<tr>	
			<td valign='top'><label>Syarat IPK</label></td>
			<td valign='top'>:</td>
			<td><input class='span3' placeholder='Syarat IPK' type='text' name='syaratipk' required></td>
		</tr>
		<tr>	
			<td valign='top'><label>Keterangan</label></td>
			<td valign='top'>:</td>
			<td><textarea rows='5' cols='60' placeholder='Keterangan' name='keterangan'></textarea></td>
		</tr>
		<tr>
			<td colspan='3' align='right'><input type='submit' name='tambah' value='tambah' class='btn btn-mini'</td>
			<td><a href='index.php?app=databeasiswa&aksi=' class='btn btn-mini'><i class='icon-share-alt'></i> Back</a></td>
		</tr>
		</table>
		</form>";

}
else if($_GET['aksi']=='tambah_data'){

$namabeasiswa		= mysql_real_escape_string($_POST['namabeasiswa']);
$pemberibeasiswa	= mysql_real_escape_string($_POST['pemberibeasiswa']);
$besarbeasiswa		= mysql_real_escape_string($_POST['besarbeasiswa']);
$tanggalterima 		= mysql_real_escape_string($_POST['tanggalterima']); 
$tanggalberakhir 	= mysql_real_escape_string($_POST['tanggalberakhir']); 
$kuota 				= mysql_real_escape_string($_POST['kuota']); 
$syaratipk 			= mysql_real_escape_string($_POST['syaratipk']); 
$keterangan 		= mysql_real_escape_string($_POST['keterangan']);
$bea->tambahData($namabeasiswa,$pemberibeasiswa,$besarbeasiswa,$tanggalterima,$tanggalberakhir,$kuota,$syaratipk,$keterangan);

}
else if($_GET['aksi']=='edit'){ 
$id_beasiswa	= $_GET['id'];
echo 	"<form method=POST action='index.php?app=databeasiswa&aksi=update_data'>
		<table>
			<tr>
				<td valign='top'><label>Nama Beasiswa</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='namabeasiswa' value='".$bea->bacaData(nama_beasiswa,$id_beasiswa)."'></td></tr>
			<tr>	
				<td valign='top'><label>Pemberi Beasiswa</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='pemberibeasiswa' value='".$bea->bacaData(pemberi_beasiswa,$id_beasiswa)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>Besar Beasiswa</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='besarbeasiswa' value='".$bea->bacaData(besar_beasiswa,$id_beasiswa)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>Tanggal Terima</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='date' name='tanggalterima' value='".$bea->bacaData(tanggal_terima,$id_beasiswa)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>Tanggal Berakhir</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='date' name='tanggalberakhir' value='".$bea->bacaData(tanggal_berakhir,$id_beasiswa)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>Kuota</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='kuota' value='".$bea->bacaData(kuota,$id_beasiswa)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>Syarat IPK</label></td>
				<td valign='top'>:</td>
				<td><input class='span3' type='text' name='syaratipk' value='".$bea->bacaData(syarat_ipk,$id_beasiswa)."'></td>
			</tr>
			<tr>	
				<td valign='top'><label>Keterangan</label></td>
				<td valign='top'>:</td>
				<td><textarea rows='5' cols='60' name='keterangan'>".$bea->bacaData(keterangan,$id_beasiswa)."</textarea></td>
			</tr>
			<tr>
				<td></td
				<td></td>
				<td><input type=submit value='simpan' class='btn btn-mini'></td>
				<td><a href='index.php?app=databeasiswa&aksi=' class='btn btn-mini'><i class='icon-thumbs-up'></i>Kembali</a></td>
			</tr>
		</table>
		<input type='hidden' name='id_beasiswa' value='".$bea->bacaData(id_beasiswa,$id_beasiswa)."'>
		</form>
";


}
else if($_GET['aksi']=='update_data'){

$id_beasiswa		= mysql_real_escape_string($_POST['id_beasiswa']);
$nomor_bp			= mysql_real_escape_string($_POST['nomor_bp']);
$namabeasiswa		= mysql_real_escape_string($_POST['namabeasiswa']);
$pemberibeasiswa	= mysql_real_escape_string($_POST['pemberibeasiswa']);
$besarbeasiswa		= mysql_real_escape_string($_POST['besarbeasiswa']);
$tanggalterima 		= mysql_real_escape_string($_POST['tanggalterima']); 
$tanggalberakhir 	= mysql_real_escape_string($_POST['tanggalberakhir']); 
$kuota 				= mysql_real_escape_string($_POST['kuota']); 
$syaratipk			= mysql_real_escape_string( $_POST['syaratipk']); 
$keterangan 		= mysql_real_escape_string( $_POST['keterangan']);
$bea->updateData($id_beasiswa,$namabeasiswa,$pemberibeasiswa,$besarbeasiswa,$tanggalterima,$tanggalberakhir,$kuota,$syaratipk,$keterangan);

}
else if($_GET['aksi']=='hapus_data'){
$id_beasiswa=$_GET['id'];
$bea->hapusData($id_beasiswa);
}

/*$sql=mysql_query("select count(*) \"total\"  from beasiswa");
$row=(mysql_fetch_array($sql));
$total=$row['total'];
$dis=5;
$total_page=ceil($total/$dis);
$page_cur=(isset($_GET['page']))?$_GET['page']:1;
$k=($page_cur-1)*$dis;

	if($page_cur>1){
		echo '<a href="index.php?app=databeasiswa&page='.($page_cur-1).'" style="cursor:pointer;color:green;" ><input style="cursor:pointer;background-color:green;border:1px black solid;border-radius:5px;width:120px;height:30px;color:white;font-size:15px;font-weight:bold;" type="button" value=" Previous "></a>';
	}
	else{
		echo '<input style="background-color:green;border:1px black solid;border-radius:5px;width:120px;height:30px;color:black;font-size:15px;font-weight:bold;" type="button" value=" Previous ">';
	}
	for($i=1;$i<=$total_page;$i++){
		if($page_cur==$i){
			echo ' <input style="background-color:green;border:2px black solid;border-radius:5px;width:30px;height:30px;color:black;font-size:15px;font-weight:bold;" type="button" value="'.$i.'"> ';
		}
		else{
		echo '<a href="index.php?app=databeasiswa&page='.$i.'"> <input style="cursor:pointer;background-color:green;border:1px black solid;border-radius:5px;width:30px;height:30px;color:white;font-size:15px;font-weight:bold;" type="button" value="'.$i.'"> </a>';
		}
	}
	if($page_cur<$total_page){
		echo '<a href="index.php?app=databeasiswa&page='.($page_cur+1).'"><input style="cursor:pointer;background-color:green;border:1px black solid;border-radius:5px;width:90px;height:30px;color:white;font-size:15px;font-weight:bold;" type="button" value=" Next "></a>';
	}
	else{
	 echo '<input style="background-color:green;border:1px black solid;border-radius:5px;width:90px;height:30px;color:black;font-size:15px;font-weight:bold;" type="button" value="   Next ">';
	}*/
}
else{
	echo '<div class="alert alert-error"> Maaf Anda Harus Login terlebih dahulu untuk mengakses halaman ini </div>';
}
?> 