<form action="ainesAdd.php" method="post">
	<input type="text" name="add"><br><br>
	<input type="submit" name="nappi"><br>
</form>
 

<?php
include('yhteys.php');
if(isset($_POST['nappi']) and ($_POST['add'] != "")) {
	
	$add = mysqli_real_escape_string($yhteys, $_POST['add']);
	$lisayssql = "INSERT INTO ainesosat (ainesosa) VALUES ('$add')";

	$tulos = $yhteys->query($lisayssql);

	if ($tulos === TRUE) {
	//   echo "Ainesosa lisätty.<br>";
	   header("Refresh: 2; url=ainesAdd.php");
	} else {
	   echo "Virhe: " . $lisayssql . "<br>" . $conn->error;
	}
} 

$hakusql = "SELECT * FROM ainesosat";
$tulokset = $yhteys->query($hakusql);

// jos tulosrivejä löytyi
if ($tulokset->num_rows > 0) {
   // hae joka silmukan kierroksella uusi rivi
   while($rivi = $tulokset->fetch_assoc()) {
      // taulukon avaimet (hakasuluissa olevat nimet) ovat TIETOKANNAN KENTTIÄ (sarakkeita)
      echo $rivi["ainesosa"] . "<br>";
   }
} else {
   echo "Ei tuloksia";
}





?>