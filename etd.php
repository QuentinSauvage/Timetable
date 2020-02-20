<html lang="fr">
<head>
  <title>Service ETD</title>
	<?php
		include('general.php');
		include('calculetd.php');
	?>
	<h1 id="soustitre">Service ETD</h1>
	<?php
		if($_SESSION['type']!='Administratif') {
			if(isset($_SESSION['type']))
				header('Location: accueil.php');
			else
				header('Location: connexion.php');
		} else {
			$dbname = 'base.db';
			if(!class_exists('SQLite3'))
				die("SQLite 3 NOT supported.");
			$db = new SQLite3($dbname);
			$query = 'SELECT * FROM Enseignant';
			$result = $db->query($query);
			while($row = $result->fetchArray()) {
				echo '<div id="info">' . $row['prenom'] . ' ' . $row['nom'] . ' : ' . calculETD($db,$row['login']) . '</div><br>';
			}
		}
	?>
</body>
</html>
