<?php
	function showEDT() {
		$dbname = 'base.db';
		if(!class_exists('SQLite3'))
			die("SQLite 3 NOT supported.");
		$db = new SQLite3($dbname);
?>
		<select id="selectSemainier">
			<option value="monEdt" onclick="getChoix()">Mon EDT</option> 
			<option value="promotions" onclick="getChoix(this)">Promotion</option> 
			<option value="enseignants" onclick="getChoix(this)">Enseignant</option>
			<option value="salles" onclick="getChoix(this)">Salle</option>
		</select>
		<select id="select" style="display:none">
		</select>
		<?php
			if($_SESSION['type']=='Enseignant')
			echo '<div id="info">Votre montant ETD de cette semaine vaut ' . calculETD($db,$_SESSION['login']) . '.</div>';
		?>
		 <div id="semainier">
			<div id="nomJours">
				<div><span>Lundi</span></div>
				<div><span>Mardi</span></div>
				<div><span>Mercredi</span></div>
				<div><span>Jeudi</span></div>
				<div><span>Vendredi</span></div>
			</div>
			<div id="ctn">
				<div id="horaires">
				<?php
					for($i=8;$i<=18;$i++)
						echo '<div><span>' . $i . 'h</span></div>';
				?>
				</div>
				<div id="cours">
					<div id="modal" class="creneau">
						<img id="close" src="close.png" alt="Fermer" onclick="hideModal()">
						<form method="post" action="modif_edt.php">
							<input type="hidden" name="cours">
							<span class="debut"><input type="time" name="debut" min="08:00" max="17:30" size="20" required="required"></span>
							<span class="fin"><input type="time" name="fin" min="08:30" max="18:00" required="required"></span>
							<span class="coursInfo">
							<span>Promotion :</span>
							<select onchange="getME(this.value)" name="promo" required>
								<option name="promo" value=""></option>
								<?php	
									$query = 'SELECT * FROM Promotion';
									$result = $db->query($query);
									while ($row = $result->fetchArray())
										echo '<option name="promotion" value="' . $row['idPromotion'] . '">' . $row['libelle'] . '</option>';
								?>
							</select>
							<br><span>Matière :</span>
							<select id="matiere" name="matiere"></select>
							<br><span>Enseignant :</span>
							<select id="enseignant" name="enseignant"></select>
							</select>
							<br><span>Type:</span>
							<select name="type">
								<?php
									$query = 'SELECT * FROM TypeCours';
									$result = $db->query($query);
									while ($row = $result->fetchArray())
										echo '<option name="type" value="' . $row['idType'] . '">' . $row['nom'] . '</option>';
								?>
							</select>
							<br><span>Jour:</span>
							<select name="jour">
								<?php
									$query = 'SELECT * FROM Jour';
									$result = $db->query($query);
									while ($row = $result->fetchArray())
										echo '<option name="jour" value="' . $row['idJour'] . '">' . $row['nom'] . '</option>';
								?>
							</select>
							</span>
							<span class="salle">
								<select name="salle">
								<?php
								$query = 'SELECT * FROM Salle';
								$result = $db->query($query);
								while ($row = $result->fetchArray())
									echo '<option name="salle" value="' . $row['idSalle'] . '">' . $row['libelle'] . '</option>';
								?>
								</select>
							</span>
							<span><input type="submit" name="submit" value="Valider"></span>
						</form>
					</div>
					<div id="ctnCreneaux">
					<?php
						for($i=0;$i<5;$i++)
							for($j=0;$j<11;$j++)
								echo '<div class="heure"></div>';
					?>
					</div>
				</div>
			</div>
        </div>
<?php
		$db->close();
	 }
?>
<html lang="fr">
<head>
  <title>Accueil</title>
  <link rel="stylesheet" href="edt.css">
	<?php
		include('general.php');
		include('calculetd.php');
	?>
	<h1 id="soustitre">Accueil</h1>
	<?php
		if(!isset($_SESSION['login']))
			header('Location: connexion.php');
		else {
			if($_SESSION['type']=='Administratif')
				header('Location: etd.php');
			else showEDT();
		}
	?>
<script>
$(document).ready(function() {
	getChoix();
});
</script>

</body>
</html>
