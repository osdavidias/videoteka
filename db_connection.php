<?php
$server="localhost";
$username="root";
$password="";
$database="kolekcija";

$db=mysql_connect($server, $username, $password);

if ($db) {
	echo "Spojeni ste na bazu podataka";
    $db_selected=mysql_select_db($database,$db);
    if ($db_selected) {
    	echo "<br>Baza podataka je uspješno odabrana";
    }
   else {
   	echo "<br>Došlo je do pogreške odabira baze";
   }
}
else
{
	echo "<br>Došlo je do pogreške prilikom spajanja";
}



?>