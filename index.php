<html>

<head>

<style type="text/css">
body{

	background-image: url(videoteka2.jpg);
	background-size: 100% 100%;
	background-repeat: no-repeat;
}

h1 {

	color: red;
	background-color: "E4E4E4";
}

p {
	display: inline;
	background-color: "E4E4E4";
	padding: 3px 3px;

}


img:hover {
    width: 300px;
    height: 400px;
}
/*Povećanje slike kada se prijeđe mišem preko nje  */
</style>

</head>



<body>

	<center><h1>VIDEOTEKA</h1></center>
<br>

<center><b><p>Odaberite početno slovo filma: </p></b></center>
<br>
<br>

<?php

$popis=range("A", "Z");
echo "<center>";
foreach ($popis as $key => $value) {
	echo '<p><a href="index.php?id='.$value.'">'."[".$value."]</a></p>";
}

echo "</center>";

echo "<br>";

if (!isset($_GET["id"])) {  
	$_GET["id"]="A";
}
// Ako id nije postavljen default je "A"

$slovo=$_GET["id"];


echo '<center><b><font size="5" ><p>'.$slovo.':</p></b></font></center><br>';

$mysqli= new mysqli ("localhost", "root", "", "kolekcija");
$query="SELECT naslov, godina, trajanje, slika
FROM  filmovi WHERE naslov LIKE CONCAT (?, '%') ";
if ($stmt=$mysqli->prepare($query)) {
	$stmt->bind_param("s", $slovo);
	$stmt->execute();
	$stmt->bind_result($nasl, $god, $traj, $sl);
	while ($stmt->fetch()) {
		
		echo "<center>";
		echo '<img src="'.$sl.'" height="175" width="125" >';
		echo "<br><i><p>".$nasl." (".$god.") </p><br>";
		echo "<p>Trajanje: ".$traj." min</i></p><br><br>";
		echo "</center>";
		



	}
	$stmt->close();

}
$mysqli->close();

?>



</body>



</html>