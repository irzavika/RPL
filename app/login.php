<?php empty( $app ) ? header('location:../index.php') : '' ;?>
<?php include "class.php";?>
<div class="well">

<form method="POST" action="index.php?app=login&aksi=validate" accept-charset="UTF-8">
	<table>
		<tr><?php if(isset($_SESSION['error'])){?>
			<td colspan="3"><div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>
			<?php echo $_SESSION['error']; unset($_SESSION['error']);}?></td>
		</tr>
		<tr>	
			<td valign="top"><label>Username</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Username" type="text" name="username" required></td>
		</tr>
		<tr>	
			<td valign="top"><label>Password</label></td>
			<td valign="top">:</td>
			<td><input class="span3" placeholder="Password" type="password" name="password" required></td>
		</tr>
		<tr>
			<td colspan="3" align="right"><button class="btn-info btn" type="submit">Login</button></td>
		</tr>
	</table>
</form>
<?php
if ($_GET['aksi']=='validate'){
	$username 	= mysql_real_escape_string($_POST['username']);
	$password	= mysql_real_escape_string(md5($_POST['password']));
	echo $username;
	echo "<br>";
	echo $password;
	echo "<br>";
	$login = new loginController;
	$login->validate($username,$password);
}
?>
</div>