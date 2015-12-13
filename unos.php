<html>

<head>

<style type="text/css">
body{

	background-image: url(videoteka5.jpg);
	background-size: 100% 100%;
	background-repeat: no-repeat;
}
table, th, td {
     border: 4px solid blue;
     border-collapse: collapse;
 }
h1 {
	color: red;
	background-color: "E4E4E4";
}

p {
	
	font-size: 20px;
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

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<!-- Uključivanje jquery skripte koja mijenja element <p> kada se prijeđe mišem
 = pozadinu u crveno i povećava font -->

<?php

//include "db_connection.php";


?>

<center><h1>UNOS:</h1></center>
<br>

<form method="post" action="" enctype="multipart/form-data">
	<p>Unesi naslov filma:</p>
	<br> <input type="text" name="naslov">
	 <br><br>


	<p>Odaberi žanr:</p> <br>
<select name="zanr"> 
<?php

$mysqli= new mysqli ("localhost", "root", "", "kolekcija");
$query_tpl= "SELECT id, naziv from zanr";

if ($stmt=$mysqli->prepare($query_tpl));
{
    
$stmt->bind_result($s, $n);
$stmt->execute(); 

while ($stmt->fetch()) {
 echo '<option value="'.$s.'">'.$n.'</option>';    	
 
}



}

$stmt->close();
?>
</select>

<br><br>
<p>Unesi godinu:</p>
<br>
<select name="godina">

<?php
for ($i=1900; $i <=2015 ; $i++) { 
	echo '<option value="'.$i.'">'.$i.'</option>';
}


?>

</select>

<br><br>

<p>Unesi trajanje filma:</p> <br>
<input type="number" name="trajanje"> <p>min</p>


<br><br>

<p>Unesi sliku:</p><br>
<input type="file" name="slika"> <br><br>

<input type="submit" name="dugme" value="Pošalji">



<?php


if (isset($_POST["dugme"])) {
	

	$uploaddir='C:/xampp/htdocs/test/seminar/';
$uploadfile=$_FILES["slika"]["name"];


$new_file_name=$uploaddir.$uploadfile;
move_uploaded_file($_FILES["slika"]["tmp_name"], $new_file_name);

$mysqli=new mysqli("localhost", "root", "", "kolekcija");
$query_tpl='INSERT INTO filmovi (naslov, id_zanr, godina, trajanje, slika)
VALUES (?, ?, ?, ?, ?)';
if ($stmt=$mysqli->prepare($query_tpl))
 {
	 $stmt->bind_param("siiis", $_POST["naslov"], $_POST["zanr"],
	 	$_POST["godina"], $_POST["trajanje"], $_FILES["slika"]["name"]);
	 
	 $stmt->execute();
	 $stmt->close();

}
$mysqli->close();


} // kraj if isset uvjeta


echo '<div><table>
<tr bgcolor="E4E4E4">
<th width="120">Slika</th>
<th width="200">Naslov filma</th>
<th width="120">Godina</th>
<th width="120">Trajanje</th>
<th width="120">Akcija</th>
</tr>';


$mysqli=new mysqli ("localhost", "root", "", "kolekcija");
$query_tpl="SELECT id, slika, naslov, godina, trajanje FROM filmovi";
if ($stmt=$mysqli->prepare($query_tpl)) {
	$stmt->execute();
	$stmt->bind_result($id, $sl, $nasl, $god, $traj);
    while ($stmt->fetch()) {
    	echo '
         <tr>
         <td> <image src="'.$sl.'" height="150" width="100" align="center"></td>
         <td align="center"><p>'.$nasl.'</p></td>
         <td align="center"><p>'.$god.'</p></td>
         <td align="center"><p>'.$traj.' min </p></td>
         <td align="center">
         
         <button name="brisi" type="submit" value="'.$id.'">Obriši</button>

  
         </td>
         </tr>';


    }
   

    $stmt->close();

}
$mysqli->close();

echo '</table></div>';

if (isset($_POST["brisi"])) {
	$brisanje=new mysqli ("localhost", "root", "", "kolekcija");
	$query="DELETE FROM filmovi WHERE id =?";
	if ($stmt=$brisanje->prepare($query)) {
		$stmt->bind_param("i", $_POST["brisi"]);
		$stmt->execute();
		$stmt->close();
	}
     $brisanje->close();

} // kraj if is set


?>


</form>
</body>


</html>