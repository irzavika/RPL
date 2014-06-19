<?php empty( $app ) ? header('location:../index.php') : '' ;?>
<?php
echo "<h5 align='center' >Beasiswa ynag tersedia</h5><br>";
$dirname = "./asset/imgbea/";
$images = glob($dirname."*.jpg");
echo "<div style='text-align: center;'>";
foreach($images as $image) {
echo "<img class='left' style='margin:20px; border:5px outset silver; ' width='350' height='450' src='".$image."' />";
}
echo "</div>";
?>
