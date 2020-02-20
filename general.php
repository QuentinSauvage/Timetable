<?php
	session_start();
	if (isset($_GET['deco'])) session_unset();
?>
	<meta charset="utf-8">
	<link  rel="icon" type="image/png" href="logo.jpeg" />
	<link rel="stylesheet" href="general.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    <body>
		<div id="top">
			<a id="aLogo" href="accueil.php"><img id="logo" src="logo.jpeg" alt="logo"></a>
			<h1 id="titre">Emploi du temps</h1>
			<div id="logs">
				<?php
					if(isset($_SESSION['login'])) {
						echo '<span>' . $_SESSION['prenom'] . ' ' . $_SESSION['nom'] . '</span>
						<i class="fa fa-angle-down"></i>
						<ul id="listeTop">';
						if($_SESSION['type']=='Administratif') {	
							echo '<li><a href="inscription_etudiant.php">Enregistrer un étudiant</a></li>
								<li><a href="inscription_enseignant.php">Enregistrer un enseignant</a></li>
								<li><a href="inscription_cours.php?">Créer un cours</a></li>
								<li><a href="inscription_salle.php?">Créer une salle</a></li>
								<li><a href="etd.php">Service ETD</a></li>';
						} else echo '<li><a href="accueil.php">Mon EDT</a></li>';
						echo '<li><a href="connexion.php?deco=true">Déconnexion</a></li></ul>';
					}
				?>
			</div>
		</div>
		<div id="infoForm">La création s'est bien déroulée.</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="general.js"></script>
