<?php
	session_start();
	$dbname = 'base.db';
	if(!class_exists('SQLite3'))
			die("SQLite 3 NOT supported.");
		$db = new SQLite3($dbname);
	if($_SESSION['type']=='Administratif') {
		$query = 'SELECT idEnseignant, nom FROM Enseignant WHERE idEnseignant in (SELECT idEnseignant FROM Enseignant_Departement WHERE idDepartement =
		(SELECT idDepartement FROM Promotion WHERE idPromotion = ' . $_GET['v'] . '))';
		$result = $db->query($query);
		while($row = $result->fetchArray()) {
			echo '<option name="enseignant" value="' . $row['idEnseignant'] . '">'. $row['nom'] . '</option>';
		}
	} else {
		$query = 'SELECT * FROM Enseignant WHERE login = "' . $_SESSION['login'] . '"';
		$result = $db->query($query);
		if($row = $result->fetchArray())
			echo '<option name="enseignant" value="' . $row['idEnseignant'] . '">'. $row['nom'] . '</option>';
	}
?>
