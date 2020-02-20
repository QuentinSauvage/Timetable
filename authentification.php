<?php
	session_start();
	$dbname = 'base.db';
	if(!class_exists('SQLite3'))
		die("SQLite 3 NOT supported.");
	$db = new SQLite3($dbname);
	if($_POST['login']=="") header('Location: accueil.php');
	$login = $_POST['login'];
	$tables = array("Etudiant","Enseignant","Administratif");
	$exists=false;
	foreach($tables as $value) {
		if($exists) break;
			$result = $db->query('SELECT * FROM ' . $value . ' WHERE login="' . $login . '"');
			while($row=$result->fetchArray()) {
				if (password_verify($db->escapeString($_POST['mdp']), $row['password'])) {
					$type=$value;
					$exists=true;
					$_SESSION['prenom']=$row['prenom'];
					$_SESSION['nom']=$row['nom'];
				}
			}
	}
	if($exists) {
		$_SESSION['login']=$_POST['login'];
		$_SESSION['type']=$type;
		header('Location: accueil.php');	
	} else {
		header('Location: connexion.php?error=true');
	}
	$db->close();
?>
