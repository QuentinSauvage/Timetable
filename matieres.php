<?php
	$dbname = 'base.db';
	if(!class_exists('SQLite3'))
		die("SQLite 3 NOT supported.");
	$db = new SQLite3($dbname);
	$query = 'SELECT * FROM Matiere WHERE idPromo = ' . $_GET['v'];
	$result = $db->query($query);
	while($row = $result->fetchArray()) {
		echo '<option name="matiere" value="' . $row['idMatiere'] . '">'. $row['libelle'] . '</option>';
	}
?>
