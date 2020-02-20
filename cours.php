<?php
	session_start();
	for($i=0;$i<5;$i++)
		for($j=0;$j<11;$j++)
			echo '<div class="heure"></div>';
	$dbname = 'base.db';
	if(!class_exists('SQLite3'))
		die("SQLite 3 NOT supported.");
	$db = new SQLite3($dbname);
	$query = 'SELECT * FROM Cours WHERE ';
	if($_GET['t'] == 1)
		$query .= ' idPromotion = ' . $_GET['v'];
	else if($_GET['t'] == 2)
		$query .= ' idEnseignant = ' . $_GET['v'];
	else if($_GET['t'] == 3)
		$query .= ' idSalle = ' . $_GET['v'];
	else {
		if($_SESSION['type'] == 'Enseignant')
			$query .= ' idEnseignant = (SELECT idEnseignant FROM Enseignant WHERE login = "' . $_SESSION['login'] . '")';
		else
			$query .= ' idPromotion = (SELECT idPromotion FROM Etudiant WHERE login = "' . $_SESSION['login'] . '")';
	}
	$result = $db->query($query);
	while($row = $result->fetchArray()) {
		$id=$row['idCours'];
		$margin = $row['heureDeb'];
		$margin = ((substr($margin,0,2)*60 + substr($margin,-2) - (8*60))/60) * 95;
		$height = $row['duree'];
		$height = ((substr($height,0,1)*60 + substr($height,-2))/60)*95;
		
		$result2 = $db->query('SELECT nom FROM Jour WHERE idJour = ' . $row['idJour']);
		$row2 = $result2->fetchArray();
		$jour = $row2['nom'];
		$result2 = $db->query('SELECT nom FROM TypeCours WHERE idType = ' . $row['idType']);
		$row2 = $result2->fetchArray();
		$type = $row2['nom'];
		$result2 = $db->query('SELECT nom FROM Enseignant WHERE idEnseignant = ' . $row['idEnseignant']);
		$row2 = $result2->fetchArray();
		$enseignant = $row2['nom'];
		$result2 = $db->query('SELECT libelle FROM Matiere WHERE idMatiere = ' . $row['idMatiere']);
		$row2 = $result2->fetchArray();
		$matiere = $row2['libelle'];
		$result2 = $db->query('SELECT libelle FROM Salle WHERE idSalle = ' . $row['idSalle']);
		$row2 = $result2->fetchArray();
		$salle = $row2['libelle'];
		$debut = $row['heureDeb'];
		$fin = $row['heureFin'];
		echo '<div class="creneau ' . $jour . ' ' . $type . '" style="margin-top:' . $margin . ';height:' . $height . 'px" onclick="showModal(this,'.$id.')">
		<span class="debut">'. $debut . '</span><span class="fin">' . $fin . '</span><span class="coursInfo">' . $matiere . 
		'<br>' . $enseignant . '</span><span class="salle">' . $salle . '</span></div>';
	}
?>
