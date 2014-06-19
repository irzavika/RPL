<?php 
session_start();
error_reporting(0);
$base_url = 'http://'.$_SERVER['HTTP_HOST'].'/rplbeasiswa/'; 

isset ($_GET['app']) ? $app = $_GET['app'] : $app = 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Informasi Beasiswa</title>
	<link href="<?php echo $base_url;?>asset/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $base_url;?>asset/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?php echo $base_url;?>asset/css/style.css" rel="stylesheet">
	<link rel="shortcut icon" href="<?php echo $base_url;?>asset/img/favicon.ico">
	<script type="text/javascript" src="<?php echo $base_url;?>asset/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $base_url;?>asset/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $base_url;?>asset/js/scripts.js"></script>
</head>
<body>
<div id="container">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="page-header">
					<img src="<?php echo $base_url;?>asset/img/unand.jpg" style="width:80px; height:90px; position:absolute; " alt="some_text">
					<h3 style=" margin-left:90px;">Informasi Beasiswa <br><small> Fakultas Teknologi Informasi</small></h3>
					<!--<marquee behavior="scroll" direction="left"><strong>FTI UNAND</strong> Masa Depan Unand</marquee>-->
				</div>
				<ul class="nav nav-tabs">
					<li <?php echo $app=='home'?'class="active"':'';?>><a href="index.php"><i class="icon-home"></i> Home</a></li>
					<?php if(isset($_SESSION['level'])){?>
					<li <?php echo $app=='profile'?'class="active"':'';?>><a href="index.php?app=profile"><i class="icon-wrench"></i>Profile</a></li>
					<li <?php echo $app=='databeasiswa'?'class="active"':'';?>><a href="index.php?app=databeasiswa"><i class="icon-list-alt"></i> Data Beasiswa</a></li>
					<?php }?>
					<?php if(isset($_SESSION['level'])){
						if($_SESSION['level']=='admin'){?>
					<li <?php echo $app=='daftarpengajuanbeasiswa'?'class="active"':'';?>><a href="index.php?app=daftarpengajuanbeasiswa"><i class="icon-list-alt"></i> Daftar Pengajuan Beasiswa</a></li>
					<li <?php echo $app=='datapenerimabeasiswa'?'class="active"':'';?>><a href="index.php?app=datapenerimabeasiswa"><i class="icon-list-alt"></i>Penerima Beasiswa</a></li>
					<li <?php echo $app=='tambahuser'?'class="active"':'';?>><a href="index.php?app=tambahuser"><i class="icon-list-alt"></i> Tambah User</a></li>
					<?php } else { ?>
					<li <?php echo $app=='pengajuanbeasiswa'?'class="active"':'';?>><a href="index.php?app=pengajuanbeasiswa"><i class="icon-list-alt"></i> Form Pengajuan Beasiswa</a></li>
					<?php } } ?>
					<li <?php echo $app=='about'?'class="active"' :'';?>><a href="index.php?app=about"><i class="icon-thumbs-up"></i> About</a></li>
					<li class="dropdown pull-right">
						<?php if (isset($_SESSION['nama'])):?>
						<a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-user"></i> <?php echo $_SESSION['nama'];?> <strong class="caret"></strong></a>
						<ul class="dropdown-menu">
							<li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
							<?php else:?>
						<a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-user"></i> Account<strong class="caret"></strong></a>
						<ul class="dropdown-menu">
							<li><a href="index.php?app=login"><i class="icon-user"></i> Login</a></li>
							<?php endif;?>							
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
<div id="content">
<?php 	
	
if(isset($_SESSION['pesan'])){echo $_SESSION['pesan']; unset($_SESSION['pesan']);}

if(file_exists('app/'.$app.'.php')){
	include ('app/'.$app.'.php'); 
}else{
	echo '<div class="well">Error : Aplikasi tidak menemukan adanya file <b>'.$app.'.php </b> pada direktori <b>app/..</b></div>';
}

?>
</div>
<p class="footer">RPL <a href=""><b> Kel 7 </b></a>Visit <a href=""> <b> Sistem Informasi</b></a> </p>
</div>
</body>
</html>
