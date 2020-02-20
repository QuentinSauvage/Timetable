<html lang="fr">
<head>
	<title>Inscription Enseignant</title>
<?php
	include('general.php');
?>
	<h1 id="soustitre">Enregistrement d'un enseignant</h1>
<?php
	if(!isset($_SESSION['type'])) header('Location: connexion.php');
	else {
		$dbname = 'base.db';
		if(!class_exists('SQLite3'))
		die("SQLite 3 NOT supported.");
		$db = new SQLite3($dbname);
		if($_SESSION['type']!='Administratif') echo 'Seuls les admin peuvent accéder au contenu de cette page.<br>';
		else if(isset($_POST["submit"])) {
			$crypted = password_hash($db->escapeString($_POST['mdp']), PASSWORD_DEFAULT);
			$login = $db->escapeString(lcfirst($_POST['prenom'])) . "_" . $db->escapeString(lcfirst($_POST['nom']));
			$query = "Select * From Enseignant Where login = '" . $login . "'";
			$result = $db->query($query);
			if($result->fetchArray())
				header('Location: inscription_cours.php?error=true');
			else {
				$query = "insert into Enseignant (nom, prenom, login, password) values ('".$db->escapeString($_POST['nom'])."','".$db->escapeString($_POST['prenom'])."','".$login."','".$crypted."')";
				$result = $db->exec($query);
				$query = "select idEnseignant from Enseignant where login='".$login."'";
				$result = $db->query($query);
				while ($row = $result->fetchArray()) {
					$id = $row['idEnseignant'];
				}
				foreach ($_POST['dep'] as $k => $val) {
					$query = "insert into Enseignant_Departement values (".$id.",".$val.")";
					$result = $db->query($query);		
				}
				header('Location: inscription_enseignant.php?error=false');
			}
		} else {
?>

	<form method="post">
		<label><span>Nom</span><input type="text" name="nom" required="required"></label><br>
		<label><span>Prenom</span><input type="text" name="prenom" required="required"></label><br>
		<label><span>Mot de passe</span><input type="password" name="mdp" required="required"></label><br>
		<label><span>Departement</span>
			<select name="dep[]" multiple required>
				<?php
				$query = "select * from Departement";
				$result = $db->query($query);
				while ($row = $result->fetchArray())
					print "<option value='".$row['idDepartement']."'>".$row['nom']."</option>";
				?>
			</select>
		</label>
		<label><input type="submit" name="submit" value="Enregister"></label>
	</form>
<?php
	}
	$db->close();
}
?>
</body>
</html>
