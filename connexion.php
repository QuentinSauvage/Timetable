<html lang="fr">
<head>
  <title>Connexion</title>
<?php
	include('general.php');
	include('controls.php');
	if(!isset($_SESSION['login'])) {
?>	
		<div>
			<h1 id="soustitre">Connexion</h1><br>
			<form method="post" action="authentification.php">
				<label><span>Login</span><input type="text" name="login" required="required"></label>
				<label><span>Mot de passe</span><br><input type="password" name="mdp" required="required"></label>
				<label><input id="submit" type="submit" name="submit" value="Valider"></label>
			</form>
		</div>
	<?php
		if(isset($_GET['error']))
			echo '<div id="info">Mot de passe est invalide.</div>';
	} else
		header('Location: accueil.php');
	?>
</body>
</html>
