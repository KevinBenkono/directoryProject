<!DOCTYPE html>
<html>
 <body>

<form action="hyvaksyHylkaa.php" method="post">

		<?php
			session_start(); 
			include('yhteys.php');
			$hakusql = "SELECT * FROM reseptit WHERE tarkistus = 0";
			
			$tulokset = $yhteys->query($hakusql);
			echo "<select name='resepti'>";
			echo "<option value=''></option>";

			if ($tulokset->num_rows > 0) {
					
				   while($rivi = $tulokset->fetch_assoc()) {
						echo "<option value='" . $rivi['drinkkiID_auto'] . "'>" . $rivi['drinkkiID_auto'] . "</option>";
						
					}
					echo "</select><br><br>";
			}
			
						
		?>
		
					<input type="submit" name="nappi1" value="Hylkää">
					<input type="submit" name="nappi2" value="Hyväksy"><br><br><br>
					
					
	</form>
  </body>
</html>

<?php
			
			
	
			if(isset($_POST['nappi1']) and ($_POST['resepti'] != "")){
				
				$resepti = mysqli_real_escape_string($yhteys, $_POST['resepti']);
				
				$poistosql = "DELETE FROM reseptit WHERE drinkkiID_auto ='$resepti';";
				
				echo $poistosql;
				$tulos = $yhteys->query($poistosql);
				if ($tulos === TRUE) {
						echo "Resepti poistettu";
						header("Refresh: 2; url=hyvaksyHylkaa.php");
				} 
			}
		?>
		
<?php
			
			
	
			if(isset($_POST['nappi2']) and ($_POST['resepti'] != "")){
				
				$resepti = mysqli_real_escape_string($yhteys, $_POST['resepti']);
				$poistosql = "UPDATE reseptit SET tarkistus = 1 WHERE drinkkiID_auto = '$resepti';";

				$tulos = $yhteys->query($poistosql);
				if ($tulos === TRUE) {
						echo "Resepti hyväksytty";
						header("Refresh: 2; url=hyvaksyHylkaa.php");
				}
				
			}
		?>		
		
	
<?php
	
$hakusql = "SELECT * FROM reseptit WHERE tarkistus = 0";
			
			$tulokset = $yhteys->query($hakusql);

			if ($tulokset->num_rows > 0) {
					
				   while($rivi = $tulokset->fetch_assoc()) {
						echo "ID: " . $rivi['drinkkiID_auto'] . "<br>";
					    echo "Nimi:" . $rivi['nimi'] . "<br>";
						echo "Kuvaus: " . $rivi['kuvaus'] . "<br>";
						echo "Ohje: " . $rivi['ohje'] . "<br>";
						echo "juomalaji: " . $rivi['juomalaji'] . "<br>";

						$reseptiID = $rivi['drinkkiID_auto'];
						$ainessql = "SELECT * FROM rs_aines, ainesosat WHERE rs_aines.Ainesosa = ID_auto AND drinkkiID_auto = $reseptiID";
						$tulokset2 = $yhteys->query($ainessql);
						if ($tulokset2->num_rows > 0) {
							while($aines = $tulokset2->fetch_assoc()) {
								echo "Ainekset: " . $aines["Määrä"] . " " . $aines['ainesosa'] . "<br>";
							}
						echo "<br><br>";	
						}
					}
			}		
?>			
			