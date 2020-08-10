<!DOCTYPE html>
<html>
<body>
<form action="ReseptiAdd.php" method="post">

	<input type="text" name="Nimi" placeholder="Nimi"><br><br>
	<input type="text" name="Juomalaji" placeholder="Juomalaji"><br><br>
<?php
	session_start(); 
	include('yhteys.php');

	$haku = "SELECT * FROM ainesosat";
	

	$tulokset = $yhteys->query($haku);
	echo "<select name='aines1'>";
	echo "<option value=''></option>";
	if ($tulokset->num_rows > 0) {
	   while($rivi = $tulokset->fetch_assoc()) {
		  echo "<option value='" . $rivi['ID_auto'] . "'>" . $rivi['ainesosa'] . "</option>";
	   }
	   echo "</select>"."<br><br>";
	?>	   
	<input type="text" name="Maara1" placeholder="Määrä"><br><br>
	<?php	
	} else {
	   echo "Ei tuloksia";
	}
	

		$tulokset = $yhteys->query($haku);
	echo "<select name='aines2'>";
	echo "<option value=''></option>";
	if ($tulokset->num_rows > 0) {
	   while($rivi = $tulokset->fetch_assoc()) {
		  echo "<option value='" . $rivi['ID_auto'] . "'>" . $rivi['ainesosa'] . "</option>";
	   }
	   echo "</select>"."<br><br>";
	?>	   
	<input type="text" name="Maara2" placeholder="Määrä"><br><br>
	<?php	
	} else {
	   echo "Ei tuloksia";
	}
	
	
	$tulokset = $yhteys->query($haku);
	echo "<select name='aines3'>";
	echo "<option value=''></option>";
	if ($tulokset->num_rows > 0) {
	   while($rivi = $tulokset->fetch_assoc()) {
		  echo "<option value='" . $rivi['ID_auto'] . "'>" . $rivi['ainesosa'] . "</option>";
	   }
	   echo "</select>"."<br><br>";
	?>	   
	<input type="text" name="Maara3" placeholder="Määrä"><br><br>
	<?php	
	} else {
	   echo "Ei tuloksia";
	}
	
	if(isset($_POST['nappi']) and ($_POST['Nimi']) and ($_POST['Juomalaji']) and ($_POST['Kuvaus']) and ($_POST['Ohje']) and ($_POST['aines1']) and ($_POST['Maara1'] != "")) {
		
		$nimi = mysqli_real_escape_string($yhteys, $_POST['nimi']);
		$juomalaji = mysqli_real_escape_string($yhteys, $_POST['Juomalaji']);
		$kuvaus = mysqli_real_escape_string($yhteys, $_POST['Kuvaus']);
		$ohje = mysqli_real_escape_string($yhteys, $_POST['Ohje']);
		$a1 = mysqli_real_escape_string($yhteys, $_POST['aines1']);
		$a2 = mysqli_real_escape_string($yhteys, $_POST['aines2']);
		$a3 = mysqli_real_escape_string($yhteys, $_POST['aines3']);
		$m1 = mysqli_real_escape_string($yhteys, $_POST['Maara1']);
		$m2 = mysqli_real_escape_string($yhteys, $_POST['Maara2']);
		$m3 = mysqli_real_escape_string($yhteys, $_POST['Maara3']);
		
		$lisayssql = "INSERT INTO reseptit (Nimi, kuvaus, juomalaji, ohje, tarkistus) VALUES ('$nimi', '$kuvaus', '$juomalaji', '$ohje', 1)";

		$tulos = $yhteys->query($lisayssql);

		if ($tulos === TRUE) {
		//   echo "Resepti lisätty.<br>";
		
		$reseptiID = $yhteys->insert_id;
		
			if( $a1 != "" and $m1 != ""){
				$lisayssql = "INSERT INTO rs_aines (drinkkiID_auto, Ainesosa, Määrä) VALUES ($reseptiID, $a1, '$m1')";
				$tulos = $yhteys->query($lisayssql);
			}
			if( $a2 != "" and $m2 != ""){
				$lisayssql = "INSERT INTO rs_aines (drinkkiID_auto, Ainesosa, Määrä) VALUES ($reseptiID, $a2, '$m2')";
				$tulos = $yhteys->query($lisayssql);
			}
			if( $a3 != "" and $m3 != ""){
				$lisayssql = "INSERT INTO rs_aines (drinkkiID_auto, Ainesosa, Määrä) VALUES ($reseptiID, $a3, '$m3')";
				$tulos = $yhteys->query($lisayssql);
			}
			
		} else {
		   echo "Virhe: " . $lisayssql . "<br>" . $conn->error;
		}
	} 
		
?>
<textarea name="Kuvaus" rows="5" cols="50" placeholder="Kuvaus">
</textarea><br><br>
<textarea name="Ohje" rows="5" cols="50" placeholder="Ohje">
</textarea>
<br><br>

	<input type="submit" name="nappi"><br>


</form>
</body>
</html>