<html lang="fr">
<head>
	<title>Inscription Cours</title>
<?php
	include('general.php');
	include('controls.php');
?>
	<h1 id="soustitre">Enregistrement d'un cours</h1>
<?php
	if(!isset($_SESSION['type'])) header('Location: connexion.php');
	else {
		$dbname = 'base.db';
		if(!class_exists('SQLite3'))
			die("SQLite 3 NOT supported.");
		$db = new SQLite3($dbname);
		if($_SESSION['type']!='Administratif') echo 'Seuls les admin peuvent accéder au contenu de cette page.<br>';
		else if(isset($_POST["submit"])) {
			if($duree=controleHeures($_POST['debut'], $_POST['fin'], $_POST['jour'], $_POST['enseignant'], $_POST['promo'], $db,-1)) {
				$query = "insert into Cours (idMatiere, idType, idEnseignant, idPromotion, heureDeb, heureFin, idJour, idSalle, duree) values ('".$_POST['matiere']."','".$_POST['type']."','".$_POST['enseignant']."','".$_POST['promo']."','".$_POST['debut']."','".$_POST['fin']."','".$_POST['jour']."','".$_POST['salle']."','".$duree."')";
				$result = $db->exec($query);
				header('Location: inscription_cours.php?error=false');
			}else {
				header('Location: inscription_cours.php?error=true');
			}
		} else {
?>
		<form method="post">
			<label><span>Promotion</span>
				<select onchange="getME(this.value)" name="promo" required>
					<option name="promo" value="">Sélectionnez une promotion</option>
					<?php	
						$query = 'SELECT * FROM Promotion';
						$result = $db->query($query);
						while ($row = $result->fetchArray())
							echo '<option name="promo" value="' . $row['idPromotion'] . '">' . $row['libelle'] . '</option>';
					?>
				</select>
			</label><br>
			<label><span>Matière</span>
			<select id="matiere" name="matiere"></select>
			<label><span>Enseignant</span>
			<select id="enseignant" name="enseignant"></select>
			</select></label></br>
			<label><span>Type du cours</span>
				<select name="type">
					<?php
						$query = 'SELECT * FROM TypeCours';
						$result = $db->query($query);
						while ($row = $result->fetchArray())
							echo '<option name="type" value="' . $row['idType'] . '">' . $row['nom'] . '</option>';
					?>
				</select>
			</label><br>
			<label><span>Heure de début</span><input type="time" name="debut" min="08:00" max="17:30" required="required"></label><br>
			<label><span>Heure de fin</span><input type="time" name="fin" min="08:30" max="18:00" required="required"></label><br>
			<label><span>Jour :</span>
				<select name="jour">
					<?php
						$query = 'SELECT * FROM Jour';
						$result = $db->query($query);
						while ($row = $result->fetchArray())
							echo '<option name="jour" value="' . $row['idJour'] . '">' . $row['nom'] . '</option>';
					?>
				</select>
			</label><br>
			<label><span>Salle</span>
				<select name="salle">
					<?php
						$query = 'SELECT * FROM Salle';
						$result = $db->query($query);
						while ($row = $result->fetchArray())
							echo '<option name="salle" value="' . $row['idSalle'] . '">' . $row['libelle'] . '</option>';
					?>
				</select>
			</label><br>
			<label><input type="submit" name="submit" value="Valider"></label>
		</form>
<?php
	}
	$db->close();
}
?>
</body>
</html>
