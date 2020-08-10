<form action="Kirjautuminen.php" method="post">
	<input type="text" name="tunnus" placeholder="Tunnus"><br><br>
	<input type="password" name="salasana" placeholder="Salasana"><br><br>
	<input type="submit" name="nappi"><br>
</form>

<?php
session_start(); 
include('yhteys.php');
if(isset($_POST['tunnus']) and ($_POST['salasana']) and ($_POST['nappi']!= "")) {
	

	
	
	  $myusername = mysqli_real_escape_string($yhteys,$_POST['tunnus']);
      $mypassword = mysqli_real_escape_string($yhteys,$_POST['salasana']); 
      
      $lisayssql = "SELECT Tunnus FROM users WHERE Tunnus = '$myusername' and Salasana = '$mypassword'";
      $tulos = $yhteys->query($lisayssql);
      
      
      $count = mysqli_num_rows($tulos);
	  
	  if ($count > 0){
		$row = mysqli_fetch_array($tulos,MYSQLI_ASSOC);
		$_SESSION["Tunnus"] = $row['Tunnus'];
		$_SESSION["Rooli"] = $row['Rooli'];
		header('location:drinkkiHaku.php');
	  } else {
		  echo 'käyttäjätunnus tai salasana on väärin';
	  }
}
?>
