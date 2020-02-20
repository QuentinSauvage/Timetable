<?php
	session_start();
	include('controls.php');
	if(!isset($_SESSION['type'])) header('Location: modif_edt.php');
	else {
		$dbname = 'base.db';
		if(!class_exists('SQLite3'))
			die("SQLite 3 NOT supported.");
		$db = new SQLite3($dbname);
		if(isset($_POST['submit'])) {
			if($duree=controleHeures($_POST['debut'], $_POST['fin'], $_POST['jour'], $_POST['enseignant'], $_POST['promo'], $db,$_POST['cours'])) {
				$update = 'UPDATE Cours
					SET idMatiere = ' . $_POST['matiere'] . ',
					idType = ' . $_POST['type'] . ',
					idEnseignant = ' . $_POST['enseignant'] . ',
					idPromotion = ' . $_POST['promo'] . ',
					heureDeb = "' . $_POST['debut'] .'",
					heureFin = "' . $_POST['fin'] . '",
					idJour = ' . $_POST['jour'] . ',
					idSalle = ' . $_POST['salle'] . ',
					duree = "' . $duree . '"
					WHERE idCours = ' . $_POST['cours'];
					if($db->exec($update)) header('Location: accueil.php?error=false');
			} else {
				header('Location: accueil.php?error=true');
			}
		}
	}
	$db->close();
?>
</body>
</html>
