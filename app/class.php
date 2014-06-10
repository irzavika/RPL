<?php
class database {
	private $dbHost ="localhost";
	private $dbUser ="root";
	private $dbPass ="root";
	private $dbDatabase ="rpl";
	protected $conn ;

	function konek(){

	$this->conn = mysql_connect($this->dbHost,$this->dbUser,$this->dbPass);
	mysql_select_db($this->dbDatabase);

	}
}

class users extends database{
	function tampilData(){
		$this->konek();
		$sql=mysql_query("select * from user where level = 'user' ");
		while($rows=mysql_fetch_array($sql))
			$data[]=$rows;
		return $data;
	}
	function tambahData($user_name,$pass1,$nama){
		$this->konek();
		$query="insert into user(username,password,nama,level)values('$user_name','$pass1','$nama','user')";
		$hasil=mysql_query($query);
		if($hasil){
			echo"<meta http-equiv='refresh' content='0; url=index.php?app=tambahuser&aksi='>";
			echo "Data berhasil dimasukan <br><br>";
		}
		else{
			echo "Data gagal untuk dimasukan";
		}
	}
	function hapusData($user_name){
	$this->konek();
	$query=mysql_query("delete from user where username='$user_name' ");
		if($query){
		echo"<meta http-equiv='refresh' content='0; url=index.php?app=tambahuser'>";
		}
	}
	function bacaData($field,$username){
	$this->konek();
		$query=mysql_query("select * from user where username ='$username'");
		$data=mysql_fetch_array($query);
		if($field == 'username'){
		return $data['username'];
		}elseif($field == 'password'){
		return $data['password'];
		}elseif($field == 'nama'){
		return $data['nama'];
		}elseif($field == 'pesan'){
		return $data['pesan'];
		}
	}
	function updateData($username,$password,$nama,$pesan){
	$this->konek();
	if ($password == null && $nama == null){
		$query=mysql_query("update user set pesan='$pesan' where username='$username'");
			if($query){
				echo"<meta http-equiv='refresh' content='0; url=index.php?app=tambahuser&aksi='>";
				echo "Data berhasil diubah <br><br>";
			}
			else{
				echo "Data gagal untuk diubah <br>";
			}
		}
	else {
		$query=mysql_query("update user set password='$password',nama='$nama' where username='$username'");
			if($query){
				echo"<meta http-equiv='refresh' content='0; url=index.php?app=profile'>";
				echo "Password berhasil diubah berhasil diubah <br>";
			}
			else{
				echo "Data gagal untuk dimasukan <br>";
			}
		}
	}
}

class beasiswa extends database{	
	function cekData(){
		
	}
	function tambahData($namabeasiswa,$pemberibeasiswa,$besarbeasiswa,$tanggalterima,$tanggalberakhir,$kuota,$syaratipk,$keterangan){
		$this->konek();
		$query="insert into beasiswa(id_beasiswa,nama_beasiswa,pemberi_beasiswa,besar_beasiswa,tanggal_terima,tanggal_berakhir,kuota,syarat_ipk,keterangan)values('','$namabeasiswa','$pemberibeasiswa','$besarbeasiswa','$tanggalterima','$tanggalberakhir','$kuota','$syaratipk','$keterangan')";
		$hasil=mysql_query($query);
		if($hasil){
			echo"<meta http-equiv='refresh' content='0; url=index.php?app=databeasiswa'>";
			echo "Data berhasil dimasukan <br><br>";
		}
		else{
			echo "Data gagal untuk dimasukan <br><br>";
			echo "<a href='index.php?app=databeasiswa&aksi=' class='btn btn-mini'><i class='icon-thumbs-up'></i> Back</a>";
		}
	}

	function tampilData(){
		$this->konek();
		/*
		$sql=mysql_query("select count(*) \"total\"  from beasiswa");
		$row=(mysql_fetch_array($sql));
		$total=$row['total'];
		$dis=5;
		$total_page=ceil($total/$dis);
		$page_cur=(isset($_GET['page']))?$_GET['page']:1;
		$k=($page_cur-1)*$dis; limit $k,$dis	*/
		
		$sql=mysql_query("select * from beasiswa");
		while($rows=mysql_fetch_array($sql))
			$data[]=$rows;
		return $data;
	}

	function bacaData($field,$id_beasiswa){
		$this->konek();
		$query=mysql_query("select * from beasiswa where id_beasiswa='$id_beasiswa'");
		$data=mysql_fetch_array($query);
		if($field == 'id_beasiswa'){
		return $data['id_beasiswa'];
		}elseif($field == 'nama_beasiswa'){
		return $data['nama_beasiswa'];
		}elseif($field == 'pemberi_beasiswa'){
		return $data['pemberi_beasiswa'];
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
		}elseif($field == 'keterangan'){
		return $data['keterangan'];
		}
	}

	function updateData($id_beasiswa,$namabeasiswa,$pemberibeasiswa,$besarbeasiswa,$tanggalterima,$tanggalberakhir,$kuota,$syaratipk,$keterangan){
		$this->konek();
		$query=mysql_query("update beasiswa set id_beasiswa='$id_beasiswa',nama_beasiswa='$namabeasiswa',pemberi_beasiswa='$pemberibeasiswa',besar_beasiswa='$besarbeasiswa',tanggal_terima='$tanggalterima',tanggal_berakhir='$tanggalberakhir',kuota='$kuota',syarat_ipk='$syaratipk',keterangan='$keterangan' where id_beasiswa='$id_beasiswa'");
		if($query){
			echo "Data berhasil diubah <br><br>";
			echo"<meta http-equiv='refresh' content='0; url=index.php?app=databeasiswa'>";
		}
		else{
			echo "Data gagal untuk dimasukan <br>";
		}
	}
	function hapusData($id_beasiswa){
	$this->konek();
	$query=mysql_query("delete from beasiswa where id_beasiswa='$id_beasiswa' ");
		if($query){
		echo"<meta http-equiv='refresh' content='0; url=index.php?app=databeasiswa'>";
		}
	}
}

class penerimaBeasiswa extends database {

	function tampilData($nomor_bp,$id_beasiswa,$order){
		$this->konek();
		
		if ($nomor_bp == null && $id_beasiswa == null){
			if ($order == 'nama_jurusan'){
			$sql=mysql_query("select * from penerima_beasiswa order by nama_jurusan asc");
			}
			else if ($order == 'ipktinggi'){
			$sql=mysql_query("select * from penerima_beasiswa order by ipk desc");
			}
			else if ($order == 'ipkrendah'){
			$sql=mysql_query("select * from penerima_beasiswa order by ipk asc");
			}
			else {
			$sql=mysql_query("select * from penerima_beasiswa");
			}
			while($rows=mysql_fetch_array($sql))
				$data[]=$rows;
			return $data;
		}
		else if ($id_beasiswa == null && $order == null){
			$sql=mysql_query("select * from penerima_beasiswa where nomor_bp = '$nomor_bp' ");
			while($rows=mysql_fetch_array($sql))
				$data[]=$rows;
			return $data;
		}
		else {
			if ($order == 'nama_jurusan'){
			$sql=mysql_query("select * from penerima_beasiswa where id_beasiswa = '$id_beasiswa' order by nama_jurusan asc");
			}
			else if ($order == 'ipktinggi'){
			$sql=mysql_query("select * from penerima_beasiswa where id_beasiswa = '$id_beasiswa'order by ipk desc");
			}
			else if ($order == 'ipkrendah'){
			$sql=mysql_query("select * from penerima_beasiswa where id_beasiswa = '$id_beasiswa'order by ipk asc");
			}
			else {
			$sql=mysql_query("select * from penerima_beasiswa where id_beasiswa = '$id_beasiswa' ");
			}
			while($rows=mysql_fetch_array($sql))
				$data[]=$rows;
			return $data;
		}
	}
	function hapusData($nomor_bp){
		$this->konek();
		$query=mysql_query("delete from penerima_beasiswa where nomor_bp='$nomor_bp' ");
		if($query){
		echo"<meta http-equiv='refresh' content='0; url=index.php?app=datapenerimabeasiswa'>";
		}
	}
	function bacaData($field,$nomor_bp){
		$this->konek();
		$query=mysql_query("select * from penerima_beasiswa where nomor_bp='$nomor_bp'");
		$data=mysql_fetch_array($query);
		if($field == 'nomor_bp'){
		return $data['nomor_bp'];
		}elseif($field == 'nama_mahasiswa'){
		return $data['nama_mahasiswa'];
		}elseif($field == 'nama_jurusan'){
		return $data['nama_jurusan'];
		}elseif($field == 'nama_fakultas'){
		return $data['nama_fakultas'];
		}elseif($field == 'id_beasiswa'){
		return $data['id_beasiswa'];
		}elseif($field == 'jenis_kelamin'){
		return $data['jenis_kelamin'];
		}elseif($field == 'agama'){
		return $data['agama'];
		}elseif($field == 'ipk'){
		return $data['ipk'];
		}elseif($field == 'keterangan'){
		return $data['keterangan'];
		}elseif($field == 'tanggal_terima'){
		return $data['tanggal_terima'];
		}elseif($field == 'tanggal_berakhir'){
		return $data['tanggal_berakhir'];
		}
	}
	function updateData($nomor_bp,$nama_mahasiswa,$nama_jurusan,$nama_fakultas,$id_beasiswa,$jenis_kelamin,$agama,$ipk,$keterangan,$tanggal_terima,$tanggal_berakhir){
		$this->konek();
		$query=mysql_query("update penerima_beasiswa set nomor_bp='$nomor_bp',nama_mahasiswa='$nama_mahasiswa',nama_jurusan='$nama_jurusan',nama_fakultas='$nama_fakultas',id_beasiswa='$id_beasiswa',jenis_kelamin='$jenis_kelamin',agama='$agama',ipk='$ipk',keterangan='$keterangan',tanggal_terima='$tanggal_terima',tanggal_berakhir='$tanggal_berakhir' where nomor_bp='$nomor_bp'");
		if($query){
			echo "Data berhasil diubah <br><br>";
			echo"<meta http-equiv='refresh' content='0; url=index.php?app=datapenerimabeasiswa&aksi=lihat_penerima&id=$_GET[id]'>";
		}
		else{
			echo "Data gagal untuk diubah <br>";
		}
	}
	
}

class pengajuanBeasiswa extends database {
	function deleteData($nomor_bp){
		$this->konek();
		$query=mysql_query("delete from pengajuan_beasiswa where nomor_bp='$nomor_bp' ");
		if($query){
		echo"<meta http-equiv='refresh' content='0; url=index.php?app=pengajuanbeasiswa'>";
		}
	}
	function updateData($nomor_bp,$nama_mahasiswa,$nama_jurusan,$nama_fakultas,$id_beasiswa,$jenis_kelamin,$agama,$ipk,$keterangan){
		$this->konek();
		$query=mysql_query("update pengajuan_beasiswa set nomor_bp='$nomor_bp',nama_mahasiswa='$nama_mahasiswa',nama_jurusan='$nama_jurusan',nama_fakultas='$nama_fakultas',id_beasiswa='$id_beasiswa',jenis_kelamin='$jenis_kelamin',agama='$agama',ipk='$ipk',keterangan='$keterangan' where nomor_bp='$nomor_bp'");
		if($query){
			echo "Data berhasil diubah <br><br>";
			echo"<meta http-equiv='refresh' content='0; url=index.php?app=pengajuanbeasiswa'>";
		}
		else{
			echo "Data gagal untuk diubah <br>";
		}
	}
	function tampilData($id_beasiswa,$order){
	$this->konek();
		if ($id_beasiswa == null){
			if ($order == 'nama_jurusan'){
			$sql=mysql_query("select * from pengajuan_beasiswa order by nama_jurusan asc");
			}
			else if ($order == 'ipktinggi'){
			$sql=mysql_query("select * from pengajuan_beasiswa order by ipk desc");
			}
			else if ($order == 'ipkrendah'){
			$sql=mysql_query("select * from pengajuan_beasiswa order by ipk asc");
			}
			else{
			$sql=mysql_query("select * from pengajuan_beasiswa");
			}
		while($rows=mysql_fetch_array($sql))
			$data[]=$rows;
		return $data;
		}
		else{
			if ($order == 'nama_jurusan'){
			$sql=mysql_query("select * from pengajuan_beasiswa where id_beasiswa = '$id_beasiswa'order by nama_jurusan asc");
			}
			else if ($order == 'ipktinggi'){
			$sql=mysql_query("select * from pengajuan_beasiswa where id_beasiswa = '$id_beasiswa'order by ipk desc");
			}
			else if ($order == 'ipkrendah'){
			$sql=mysql_query("select * from pengajuan_beasiswa where id_beasiswa = '$id_beasiswa'order by ipk asc");
			}
			else {
			$sql=mysql_query("select * from pengajuan_beasiswa where id_beasiswa = '$id_beasiswa' ");
			}
		while($rows=mysql_fetch_array($sql))
			$data[]=$rows;
		return $data;
		}
	}
	function tampilDataBatch ($id_beasiswa,$order){
		$this->konek();	
		if ($id_beasiswa == null){
			if ($order == 'nama_jurusan2'){
			$sql=mysql_query("select * from batch_pengajuan order by nama_jurusan asc");
			}
			else if ($order == 'ipktinggi2'){
			$sql=mysql_query("select * from batch_pengajuan order by ipk desc");
			}
			else if ($order == 'ipkrendah2'){
			$sql=mysql_query("select * from batch_pengajuan order by ipk asc");
			}
			else{
			$sql=mysql_query("select * from batch_pengajuan");
			}
		while($rows=mysql_fetch_array($sql))
			$data[]=$rows;
		return $data;
		}
		else{
			if ($order == 'nama_jurusan2'){
			$sql=mysql_query("select * from batch_pengajuan where id_beasiswa = '$id_beasiswa'order by nama_jurusan asc");
			}
			else if ($order == 'ipktinggi2'){
			$sql=mysql_query("select * from batch_pengajuan where id_beasiswa = '$id_beasiswa'order by ipk desc");
			}
			else if ($order == 'ipkrendah2'){
			$sql=mysql_query("select * from batch_pengajuan where id_beasiswa = '$id_beasiswa'order by ipk asc");
			}
			else{
			$sql=mysql_query("select * from batch_pengajuan where id_beasiswa = '$id_beasiswa' ");
			}
		while($rows=mysql_fetch_array($sql))
			$data2[]=$rows;
		return $data2;
		}
	}
	function tampilDataUser($username){
	$this->konek();
	$sql1=mysql_query("select * from pengajuan_beasiswa where nomor_bp = '$username' ");
	
	if ($sql1){
			while($rows=mysql_fetch_array($sql1))
			$data[]=$rows;
			return $data;
	}
	else {
		echo "Data tidak ditemukan, anda belum pernah mengajukan beasiswa";
	}
	}
	function tambahPengajuan($nomor_bp,$nama_mahasiswa,$nama_jurusan,$nama_fakultas,$id_beasiswa,$jenis_kelamin,$agama,$ipk,$keterangan){
		$this->konek();
		$query="insert into pengajuan_beasiswa(nomor_bp,nama_mahasiswa,nama_jurusan,nama_fakultas,id_beasiswa,jenis_kelamin,agama,ipk,keterangan)values('$nomor_bp','$nama_mahasiswa','$nama_jurusan','$nama_fakultas','$id_beasiswa','$jenis_kelamin','$agama','$ipk','$keterangan')";
		$hasil=mysql_query($query);
		if($hasil){
			echo "Data dimasukan";
			echo"<meta http-equiv='refresh' content='0; url=index.php?app=pengajuanbeasiswa'>";
		}
	}
	function bacaDataPengajuan($field,$nomor_bp,$tabel){
		$this->konek();
		if ($tabel == 'pengajuan_mahasiswa'){
		$query=mysql_query("select * from pengajuan_beasiswa where nomor_bp = '$nomor_bp' ");
		}
		else if ($tabel == 'batch_pengajuan'){
		$query=mysql_query("select * from batch_pengajuan where nomor_bp = '$nomor_bp' ");
		}
		$data=mysql_fetch_array($query);
		if($field == 'nomor_bp'){
		return $data['nomor_bp'];
		}elseif($field == 'nama_mahasiswa'){
		return $data['nama_mahasiswa'];
		}elseif($field == 'nama_jurusan'){
		return $data['nama_jurusan'];
		}elseif($field == 'nama_fakultas'){
		return $data['nama_fakultas'];
		}elseif($field == 'id_beasiswa'){
		return $data['id_beasiswa'];
		}elseif($field == 'jenis_kelamin'){
		return $data['jenis_kelamin'];
		}elseif($field == 'agama'){
		return $data['agama'];
		}elseif($field == 'ipk'){
		return $data['ipk'];
		}elseif($field == 'keterangan'){
		return $data['keterangan'];
		}
	}
	function tolakPengajuan($nomor_bp,$lihat){
	$this->konek();
	$nomor_bp1 			= $this->bacaDataPengajuan(nomor_bp,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$nama_mahasiswa1 	= $this->bacaDataPengajuan(nama_mahasiswa,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$nama_jurusan1		= $this->bacaDataPengajuan(nama_jurusan,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$nama_fakultas1		= $this->bacaDataPengajuan(nama_fakultas,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$id_beasiswa1 		= $this->bacaDataPengajuan(id_beasiswa,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$jenis_kelamin1 	= $this->bacaDataPengajuan(jenis_kelamin,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$agama1				= $this->bacaDataPengajuan(agama,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$ipk1				= $this->bacaDataPengajuan(ipk,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$keterangan1		= $this->bacaDataPengajuan(keterangan,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	
	$sqlquery1 =mysql_query("insert into batch_pengajuan(nomor_bp,nama_mahasiswa,nama_jurusan,nama_fakultas,id_beasiswa,jenis_kelamin,agama,ipk,keterangan)values('$nomor_bp1','$nama_mahasiswa1','$nama_jurusan1','$nama_fakultas1','$id_beasiswa1','$jenis_kelamin1','$agama1','$ipk1','$keterangan1')");
	$sqlquery2 =mysql_query("delete from pengajuan_beasiswa where nomor_bp = '$nomor_bp1'");
	
		if ($lihat == null){
		echo"<meta http-equiv='refresh' content='0; url=index.php?app=daftarpengajuanbeasiswa'>";
		}
		else{
		echo"<meta http-equiv='refresh' content='0; url=index.php?app=daftarpengajuanbeasiswa&lihat=lihat_pengajuan&id=$_GET[id]'>";
		}
	}
	function kembalikanPengajuan($nomor_bp,$lihat){
	$this->konek();
	$nomor_bp1 			= $this->bacaDataPengajuan(nomor_bp,$nomor_bp,$tabel= 'batch_pengajuan');
	$nama_mahasiswa1 	= $this->bacaDataPengajuan(nama_mahasiswa,$nomor_bp,$tabel= 'batch_pengajuan');
	$nama_jurusan1		= $this->bacaDataPengajuan(nama_jurusan,$nomor_bp,$tabel= 'batch_pengajuan');
	$nama_fakultas1		= $this->bacaDataPengajuan(nama_fakultas,$nomor_bp,$tabel= 'batch_pengajuan');
	$id_beasiswa1 		= $this->bacaDataPengajuan(id_beasiswa,$nomor_bp,$tabel= 'batch_pengajuan');
	$jenis_kelamin1 	= $this->bacaDataPengajuan(jenis_kelamin,$nomor_bp,$tabel= 'batch_pengajuan');
	$agama1				= $this->bacaDataPengajuan(agama,$nomor_bp,$tabel= 'batch_pengajuan');
	$ipk1				= $this->bacaDataPengajuan(ipk,$nomor_bp,$tabel= 'batch_pengajuan');
	$keterangan1		= $this->bacaDataPengajuan(keterangan,$nomor_bp,$tabel= 'batch_pengajuan');
	
	$sqlquery1 =mysql_query("insert into pengajuan_beasiswa(nomor_bp,nama_mahasiswa,nama_jurusan,nama_fakultas,id_beasiswa,jenis_kelamin,agama,ipk,keterangan)values('$nomor_bp1','$nama_mahasiswa1','$nama_jurusan1','$nama_fakultas1','$id_beasiswa1','$jenis_kelamin1','$agama1','$ipk1','$keterangan1')");
	$sqlquery2 =mysql_query("delete from batch_pengajuan where nomor_bp = '$nomor_bp1'");
	
	if ($lihat == null){
		echo"<meta http-equiv='refresh' content='0; url=index.php?app=daftarpengajuanbeasiswa'>";
		}
	else{
		echo"<meta http-equiv='refresh' content='0; url=index.php?app=daftarpengajuanbeasiswa&lihat=lihat_pengajuan&id=$_GET[id]'>";
		}
	}
	function deleteBacth($nomor_bp,$lihat){
	
		$sqlquery =mysql_query("delete from batch_pengajuan where nomor_bp = '$nomor_bp'");
	if ($lihat == null){
		echo"<meta http-equiv='refresh' content='0; url=index.php?app=daftarpengajuanbeasiswa'>";
		}
	else{
		echo"<meta http-equiv='refresh' content='0; url=index.php?app=daftarpengajuanbeasiswa&lihat=lihat_pengajuan&id=$_GET[id]'>";
		}
	}
	function terimaPengajuan($nomor_bp,$lihat,$tanggalterima,$tanggalberakhir){
	$this->konek();
	$nomor_bp1 			= $this->bacaDataPengajuan(nomor_bp,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$nama_mahasiswa1 	= $this->bacaDataPengajuan(nama_mahasiswa,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$nama_jurusan1		= $this->bacaDataPengajuan(nama_jurusan,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$nama_fakultas1		= $this->bacaDataPengajuan(nama_fakultas,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$id_beasiswa1 		= $this->bacaDataPengajuan(id_beasiswa,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$jenis_kelamin1 	= $this->bacaDataPengajuan(jenis_kelamin,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$agama1				= $this->bacaDataPengajuan(agama,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$ipk1				= $this->bacaDataPengajuan(ipk,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	$keterangan1		= $this->bacaDataPengajuan(keterangan,$nomor_bp,$tabel= 'pengajuan_mahasiswa');
	
	$sqlquery1 =mysql_query("insert into penerima_beasiswa(nomor_bp,nama_mahasiswa,nama_jurusan,nama_fakultas,id_beasiswa,jenis_kelamin,agama,ipk,keterangan, tanggal_terima, tanggal_berakhir)values('$nomor_bp1','$nama_mahasiswa1','$nama_jurusan1','$nama_fakultas1','$id_beasiswa1','$jenis_kelamin1','$agama1','$ipk1','$keterangan1', '$tanggalterima', '$tanggalberakhir')");
	$sqlquery2 =mysql_query("delete from pengajuan_beasiswa where nomor_bp = '$nomor_bp1'");
	
	if ($lihat == null){
		echo"<meta http-equiv='refresh' content='0; url=index.php?app=daftarpengajuanbeasiswa'>";
		}
	else{
		echo"<meta http-equiv='refresh' content='0; url=index.php?app=daftarpengajuanbeasiswa&lihat=lihat_pengajuan&id=$_GET[id]'>";
		}
	}
}
?>	