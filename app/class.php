<?php
class dbController {
	private $dbHost ="localhost";
	private $dbUser ="root";
	private $dbPass ="root";
	private $dbDatabase ="rpl2";
	protected $conn ;

	function konek(){
	$this->conn = mysql_connect($this->dbHost,$this->dbUser,$this->dbPass);
	mysql_select_db($this->dbDatabase);
	}	
}

class loginController extends dbController{
	public $status ;
	public $sessionStatus ;
	
	function validate($username,$password) {
	$this->konek();
	$sql = "select * from user where nomor_induk = '$username' and password = '$password'";
	$result = mysql_query($sql);
	if (mysql_num_rows($result) == 1){
			echo"<meta http-equiv='refresh' content='0; url=index.php'>";
			$row = mysql_fetch_assoc($result);
			$_SESSION['username'] = $row['username'];
			$_SESSION['nama'] = $row['nama'];
			$_SESSION['level'] = $row['level'];
			header("location:index.php");
			$_SESSION['pesan'] = '<p><div class="alert alert-success">Selamat datang <b>'.$_SESSION['nama'].'</b></div></p>';
		}
	else{
			$_SESSION['error']="Username atau Password salah";
			header("location:index.php?app=login");
		}
	}
	
	function sessionSetting(){
	
	unset($_SESSION['username']);
	unset($_SESSION['nama']);
	unset($_SESSION['level']);
	header("location:index.php?app=login");
	
	}
}

class mainController extends dbController{
	function tampilData($table){
		$this->konek();
		
		if ($table == 'beasiswa'){
			$sql=mysql_query("select * from beasiswa");
		}
		
		while($rows=mysql_fetch_array($sql))
			$data[]=$rows;
		return $data;
	}
	
	function bacaData($table,$field,$where){
		$this->konek();
		if ($table == 'beasiswa'){
			$query=mysql_query("select * from beasiswa where nomor_beasiswa='$where'");
			$data=mysql_fetch_array($query);
			if($field == 'nomor_beasiswa'){
			return $data['nomor_beasiswa'];
			}elseif($field == 'nama_beasiswa'){
			return $data['nama_beasiswa'];
			}elseif($field == 'asal_beasiswa'){
			return $data['asal_beasiswa'];
			}elseif($field == 'besar_beasiswa'){
			return $data['besar_beasiswa'];
			}elseif($field == 'tanggal_terima'){
			return $data['tanggal_terima'];
			}elseif($field == 'tanggal_berakhir'){
			return $data['tanggal_berakhir'];
			}elseif($field == 'kuota'){
			return $data['kuota'];
			}elseif($field == 'syarat_ipk'){
			return $data['syarat_ipk'];
			}elseif($field == 'syarat_penerima'){
			return $data['syarat_penerima'];
			}elseif($field == 'keterangan'){
			return $data['keterangan'];
			}
		}
	}
	
	function updateDataBeasiswa($nomor_beasiswa,$namabeasiswa,$asalbeasiswa,$besarbeasiswa,$tanggalterima,$tanggalberakhir,$kuota,$syaratipk,$syaratpenerima,$keterangan){
	$this->konek();
		$query=mysql_query("update beasiswa set nomor_beasiswa='$nomor_beasiswa',nama_beasiswa='$namabeasiswa',asal_beasiswa='$asalbeasiswa',besar_beasiswa='$besarbeasiswa',tanggal_terima='$tanggalterima',tanggal_berakhir='$tanggalberakhir',kuota='$kuota',syarat_ipk='$syaratipk',syarat_penerima='$syaratpenerima',keterangan='$keterangan' where nomor_beasiswa='$nomor_beasiswa'");
		if($query){
			echo "Data berhasil diubah <br><br>";
			echo"<meta http-equiv='refresh' content='0; url=index.php?app=databeasiswa'>";
		}
		else{
			echo "Data gagal untuk dimasukan <br>";
		}
	}
	
	function deleteData($table,$where){
	$this->konek();
		if ($table == 'beasiswa'){
			$query=mysql_query("delete from beasiswa where nomor_beasiswa='$where' ");
			if($query){
				echo"<meta http-equiv='refresh' content='0; url=index.php?app=databeasiswa'>";
			}
		}
	}
	
	function tambahDataBeasiswa($namabeasiswa,$asalbeasiswa,$besarbeasiswa,$kuota,$syaratipk,$syaratpenerima,$tanggalterima,$tanggalberakhir,$keterangan){
		$this->konek();
		$query="insert into beasiswa(nomor_beasiswa,nama_beasiswa,asal_beasiswa,besar_beasiswa,kuota,syarat_ipk,syarat_penerima,tanggal_terima,tanggal_berakhir,keterangan)values('','$namabeasiswa','$asalbeasiswa','$besarbeasiswa','$kuota','$syaratipk','$syaratpenerima','$tanggalterima','$tanggalberakhir','$keterangan')";
		$hasil=mysql_query($query);
		if($hasil){
			echo"<meta http-equiv='refresh' content='0; url=index.php?app=databeasiswa'>";
			echo "<div class='alert alert-success' align='center'>Data berhasil dimasukan </div><br><br>";
		}
		else{
			echo "Data gagal untuk dimasukan <br><br>";
			echo "<a href='index.php?app=databeasiswa&aksi=' class='btn btn-mini'>Back</a>";
		}
	}
}

class mainView extends mainController{

	function viewDataBeasiswa(){
	$bea = new mainController;
	$this->tampilData($table = 'beasiswa');
	
		if($_SESSION['level']=='admin'){ 
			echo 	"<p>
					<a href='index.php?app=databeasiswa&aksi=tambah' class='btn btn-mini'><i class='icon-plus'></i>Tambah Baru</a>
					</p>";
			}
			$daftar=$bea->tampilData($table = 'beasiswa');
			echo 	"<table <table class='table table-bordered table-condensed table-hover'>
					<tr class='nowrap'>
					<th align='center'>Nomor</th>
					<th align='center'>Beasiswa</th>
					<th align='center'>Asal</th>
					<th align='center'>Besar</th>
					<th align='center'>Tanggal terima</th>
					<th align='center'>Tanggal Berakhir</th>
					<th align='center'>Kuota</th>
					<th align='center'>Syarat IPK</th>
					<th align='center'>Syarat penerima</th>
					<th align='center'>Keterangan</th>";
					if($_SESSION['level']=='admin'){
						echo "<th colspan = '3' align='center'>Action</th>";
						 } else {
						echo "<th align='center'>Action</th>";
						 } 
			echo	"</tr>";
			foreach($daftar as $data){
			echo	"<tr>
					<td align='center'> ".$data['nomor_beasiswa']."</td>
					<td align='center'> ".$data['nama_beasiswa']."</td> 
					<td align='center'> ".$data['asal_beasiswa']."</td> 
					<td align='center'> ".$data['besar_beasiswa']."</td> 
					<td align='center'> ".$data['tanggal_terima']."</td> 
					<td align='center'> ".$data['tanggal_berakhir']."</td>
					<td align='center'> ".$data['kuota']."</td> 
					<td align='center'> ".$data['syarat_ipk']."</td>
					<td align='center'> ".$data['syarat_penerima']."</td> 		
					<td align='center'> ".$data['keterangan']."</td> ";
					if($_SESSION['level']=='admin'){
					echo "<td ><a href='index.php?app=databeasiswa&aksi=edit&id=$data[nomor_beasiswa]' class='btn btn-mini'><i class='icon-edit'></i> Edit</a>" ;
					echo "<td ><a href='index.php?app=databeasiswa&aksi=hapus_data&id=$data[nomor_beasiswa]' class='btn btn-mini' onClick='return confirm('Yakin ingin delete data beasiswa ?')'><i class='icon-trash'></i>Delete</a></td>" ;
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
	function viewEditBeasiswa($nomor_beasiswa){
		$beasiswa = new mainController;
		$where = $nomor_beasiswa ;
		echo 	"<form method=POST action='index.php?app=databeasiswa&aksi=update_data'>
				<table>
					<tr>
						<td valign='top'><label>Nama Beasiswa</label></td>
						<td valign='top'>:</td>
						<td><input class='span3' type='text' name='namabeasiswa' value='".$beasiswa->bacaData($table ='beasiswa',nama_beasiswa,$where)."'></td></tr>
					<tr>	
						<td valign='top'><label>Asal Beasiswa</label></td>
						<td valign='top'>:</td>
						<td><input class='span3' type='text' name='asalbeasiswa' value='".$beasiswa->bacaData($table ='beasiswa',asal_beasiswa,$where)."'></td>
					</tr>
					<tr>	
						<td valign='top'><label>Besar Beasiswa</label></td>
						<td valign='top'>:</td>
						<td><input class='span3' type='text' name='besarbeasiswa' value='".$beasiswa->bacaData($table ='beasiswa',besar_beasiswa,$where)."'></td>
					</tr>
					<tr>	
						<td valign='top'><label>Tanggal Terima</label></td>
						<td valign='top'>:</td>
						<td><input class='span3' type='date' name='tanggalterima' value='".$beasiswa->bacaData($table ='beasiswa',tanggal_terima,$where)."'></td>
					</tr>
					<tr>	
						<td valign='top'><label>Tanggal Berakhir</label></td>
						<td valign='top'>:</td>
						<td><input class='span3' type='date' name='tanggalberakhir' value='".$beasiswa->bacaData($table ='beasiswa',tanggal_berakhir,$where)."'></td>
					</tr>
					<tr>	
						<td valign='top'><label>Kuota</label></td>
						<td valign='top'>:</td>
						<td><input class='span3' type='text' name='kuota' value='".$beasiswa->bacaData($table ='beasiswa',kuota,$where)."'></td>
					</tr>
					<tr>	
						<td valign='top'><label>Syarat IPK</label></td>
						<td valign='top'>:</td>
						<td><input class='span3' type='text' name='syaratipk' value='".$beasiswa->bacaData($table ='beasiswa',syarat_ipk,$where)."'></td>
					</tr>
					<tr>	
						<td valign='top'><label>Syarat IPK</label></td>
						<td valign='top'>:</td>
						<td><input class='span3' type='text' name='syaratpenerima' value='".$beasiswa->bacaData($table ='beasiswa',syarat_penerima,$where)."'></td>
					</tr>
					<tr>	
						<td valign='top'><label>Keterangan</label></td>
						<td valign='top'>:</td>
						<td><textarea rows='5' cols='60' name='keterangan'>".$beasiswa->bacaData($table ='beasiswa',keterangan,$where)."</textarea></td>
					</tr>
					<tr>
						<td></td
						<td></td>
						<td><input type=submit value='simpan' class='btn btn-mini'></td>
						<td><a href='index.php?app=databeasiswa&aksi=' class='btn btn-mini'>Kembali</a></td>
					</tr>
				</table>
				<input type='hidden' name='nomor_beasiswa' value='".$beasiswa->bacaData($table ='beasiswa',nomor_beasiswa,$where)."'>
				</form>
		";
	}
	function viewTambahDataBeasiswa(){
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
					<td><input class='span3' placeholder='Pemberi Beasiswa' type='text' name='asalbeasiswa' required></td>
				</tr>
				<tr>	
					<td valign='top'><label>Besar Beasiswa</label></td>
					<td valign='top'>:</td>
					<td><input class='span3' placeholder='Besar Beasiswa' type='text' name='besarbeasiswa' required></td>
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
					<td valign='top'><label>Syarat Penerima</label></td>
					<td valign='top'>:</td>
					<td><input class='span3' placeholder='Syarat Penerima' type='text' name='syaratpenerima' required></td>
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
					<td valign='top'><label>Keterangan</label></td>
					<td valign='top'>:</td>
					<td><textarea rows='5' cols='60' placeholder='Keterangan' name='keterangan'></textarea></td>
				</tr>
				<tr>
					<td colspan='3' align='right'><input type='submit' name='tambah' value='tambah' class='btn btn-mini'</td>
					<td><a href='index.php?app=databeasiswa&aksi=' class='btn btn-mini'>Back</a></td>
				</tr>
				</table>
				</form>";
	}
	
	function viewDataPengajuan(){
	echo 	"<table <table class='table table-bordered table-condensed table-hover'>
			<tr class='nowrap'>
			<th align='center'>Nomor Pengajuan</th>
			<th align='center'>Nomor Induk</th>
			<th align='center'>Nomor Beasiswa</th>
			<th align='center'>Nama Beasiswa</th>
			<th align='center'>Tanggal Mendaftar</th>
			<th align='center'>Status Beasiswa</th>
			<th align='center'>Tanggal Terima</th>
			<th align='center'>Tanggal Berakhir</th>
			<th colspan = '3' align='center'>Action</th>
			</tr>";
	foreach($daftar as $data){
	echo	"<tr>
			<td align='center'> ".$data['nomor_pengajuan']."</td>
			<td align='center'> ".$data['nomor_induk']."</td> 
			<td align='center'> ".$data['nomor_beasiswa']."</td> 
			<td align='center'> ".$data['nama_beasiswa']."</td> 
			<td align='center'> ".$data['tanggal_mendaftar']."</td> 
			<td align='center'> ".$data['status_beasiswa']."</td>
			<td align='center'> ".$data['tanggal_terima']."</td> 
			<td align='center'> ".$data['tanggal_berakhir']."</td> 
			<td ><a href='index.php?app=daftarpengajuanbeasiswa&hide=hiden&lihat=lihat_pengajuan&terima=terima_pengajuan&nomor_bp=$data[nomor_bp]&id=$_GET[id]' class='btn btn-mini'><i class='icon-ok'></i> Terima </a>
			<td ><a href='index.php?app=daftarpengajuanbeasiswa&lihat=lihat_pengajuan&aksi=tolak_pengajuan&nomor_bp=$data[nomor_bp]&id=$_GET[id]' class='btn btn-mini'><i class='icon-remove'></i>Tolak</a></td>
			<td ><a href='index.php?app=daftarpengajuanbeasiswa&lihat=lihat_pengajuan&aksi=tolak_pengajuan&nomor_bp=$data[nomor_bp]&id=$_GET[id]' class='btn btn-mini'><i class='icon-remove'></i>Lihat data</a></td>" ;
			}
	echo	"</tr></table>";
	}
}

class beasiswa extends mainController{
	private $nomor_beasiswa ;
	private $nama_beasiswa ;
	private $asal_beasiswa ;
	private $besar_beasiswa ;
	private $kuota ;
	private $syarat_ipk ;
	private $syarat_penerima ;
	private $tanggal_terima ;
	private $tanggal_berakhir ;
	private $keterangan ;
	private $status_beasiswa ;
	
	function ambilData(){
	}
}

?>	