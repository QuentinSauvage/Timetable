<?php
	$dbname = 'base.db';
	if(!class_exists('SQLite3'))
		die("SQLite 3 NOT supported.");
	$db = new SQLite3($dbname);
	if($_GET['v'] == 'promotions') {
		$query = 'SELECT * FROM Promotion';
		$result = $db->query($query);
		while ($row = $result->fetchArray())
			echo '<option value="' . $row['idPromotion'] . '" onclick="getCours(this.value,1)">' . $row['libelle'] . '</option>';
	} else if($_GET['v'] == 'enseignants') {
		$query = 'SELECT * FROM Enseignant';
		$result = $db->query($query);
		while ($row = $result->fetchArray())
			echo '<option value="' . $row['idEnseignant'] . '" onclick="getCours(this.value,2)">' . $row['nom'] . '</option>';
	} else if($_GET['v'] == 'salles') {
		$query = 'SELECT * FROM Salle';
		$result = $db->query($query);
		while ($row = $result->fetchArray())
			echo '<option value="' . $row['idSalle'] . '" onclick="getCours(this.value,3)">' . $row['libelle'] . '</option>';
	}
?>
