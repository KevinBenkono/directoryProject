<form action="Rekisteroityminen.php" method="post">
	
	<input type="text" name="tunnus" placeholder="Tunnus"><br><br>
	<input type="password" name="salasana" placeholder="Salasana"><br><br>
	<input type="text" name="sposti" placeholder="Sähköpostiosoite"><br><br>
	<input type="submit" name="nappi"><br>
</form>

<?php
	session_start(); 
	include('yhteys.php');
	
	if(isset($_POST['nappi']) and ($_POST['tunnus']) and ($_POST['salasana']) and ($_POST['sposti'] != "")) {
	
	$tunnus = mysqli_real_escape_string($yhteys, $_POST['tunnus']);
	$salasana = mysqli_real_escape_string($yhteys, $_POST['salasana']);
	$sposti = mysqli_real_escape_string($yhteys, $_POST['sposti']);
	
	$check1 = "SELECT Tunnus FROM users  WHERE Tunnus = '$tunnus'";
	$tulos = $yhteys->query($check1);
	
	$check2 = "SELECT Sähköposti FROM users  WHERE Sähköposti = '$sposti'";
	$tulos2 = $yhteys->query($check2);
	
	
	
	if ($tulos->num_rows > 0) {
		echo "Käyttäjänimi varattu.";
	} else if ($tulos2->num_rows > 0) {
		echo "Sähköpostiosoite varattu.";
	} else if ($tulos->num_rows == 0 and $tulos2->num_rows == 0) {
		$lisayssql = "INSERT INTO users (Tunnus, Salasana, Sähköposti) VALUES ('$tunnus', '$salasana', '$sposti')";

		$tuloslisays = $yhteys->query($lisayssql);

		if ($tuloslisays === TRUE) {
		echo "Käyttäjä lisätty lisätty.<br>";
		header("Refresh: 2; url=Kirjautuminen.php");
		}
	} else {
	   echo "Virhe: " . $lisayssql . "<br>" . $conn->error;
	}
	
} else {
	echo "Täytä kaikki kentät!";
}
?>