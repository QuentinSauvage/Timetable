<html lang="fr">
<head>
	<title>Inscription Salle</title>
<?php
	include('general.php');
?>
	<h1 id="soustitre">Enregistrement d'une salle</h1>
<?php
	if(!isset($_SESSION['type'])) header('Location: connexion.php');
	else {
		$dbname = 'base.db';
		if(!class_exists('SQLite3'))
			die("SQLite 3 NOT supported.");
		$db = new SQLite3($dbname);
		if($_SESSION['type']!='Administratif') echo 'Seuls les admin peuvent accéder au contenu de cette page.<br>';
		else if(isset($_POST["submit"])) {
			$query = "Select * From Salle Where libelle = '" . $_POST['nom'] . "'";
			$result = $db->query($query);
			if($result->fetchArray())
				header('Location: inscription_salle.php?error=true');
			else {
				$query = "insert into Salle (libelle) values ('".$db->escapeString($_POST['nom'])."')";
				$result = $db->exec($query);
				header('Location: inscription_salle.php?error=false');
			}
		}
		else {
?>

	<form method="post">
		<label><span>Libellé</span><input type="text" name="nom" required="required"></label><br>
		<label><input type="submit" name="submit" value="Enregister"></label>
	</form>
<?php
	}
	$db->close();
}
?>
</body>
</html>
