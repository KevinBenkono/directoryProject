<!DOCTYPE html>
<html>
 <body>
	<head>
	<meta charset="UTF-8">
		<title>Drinkkiarkisto</title>
		<style>
		*{
			font-family: Arial;
		}
		
		resepti{
			border:
			}
			
	
		#main-nav{
		}
		
		#main-nav > ul > li{
			display: inline-block;
			background-color: none;
			float: left;
			position: relative;
			margin-right: 5px;
		}
			
		
		</style>
	</head>
	<h1>Haku</h1>

			
	
		
	<br><br><form action="Etusivu.php" method="post">
		
		<input type='text' name=¨'haku' placeholder='hae'>
		<input type='submit' name='nappi'>.<br><br>
		<?php
			session_start(); 
			include('yhteys.php');
			$hakusql = "SELECT * FROM reseptit";
			if(isset ($_GET['haku'])){
					$haku = mysqli_real_escape_string($yhteys, $_GET["haku"]);
					$hakusql = " WHERE nimi LIKE '%$haku%'";
			}	
			$tulokset = $yhteys->query($hakusql);

			if ($tulokset->num_rows > 0) {
					
				   while($rivi = $tulokset->fetch_assoc()) {
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
			} else {
			   echo "Ei tuloksia";
			}
		?>
	</form>
 </body>
</html>