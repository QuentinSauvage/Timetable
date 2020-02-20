<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>TP4</title>
	</head>
	<body>

	<?php
		$dbname='base.db';
		try{
		$base=new SQLite3($dbname);
		}catch(Exception $e) {
			print $e->getMessage();
		}


/*
		departement	nom
		etudiant	nom prenom promotion login mdp
		promotion	libelle departement
		cours	matiere typecour enseingant promotion heuredeb heurefin jour salle duree
		jour	nom
		typeCours	nom
		matiere	libelle nomComplet
		enseignant	nom prenom login mdp
		enseignant_departement
		salle	libelle
		administratif	nom prenom login mdp
*/

	$query="pragma foreign_keys = ON;";
	$resultat=$base->exec($query);


	$query="create table if not exists Departement (
				idDepartement integer primary key,
				nom text
			)";
	$resultat=$base->exec($query);
	$query="create table if not exists Etudiant (
				idEtudiant integer primary key,
				nom text,
				prenom text,
				idPromotion integer foreign key references Promotion(idPromotion),
				login text,
				password text
			)";
	$resultat=$base->exec($query);
	$query="create table if not exists Promotion (
				idPromotion integer primary key,
				libelle text,
				idDepartement integer foreign key references Departement(idDepartement)
			)";
	$resultat=$base->exec($query);
	$query="create table if not exists Cours (
				idCours integer primary key,
				idMatiere integer foreign key references Matiere(idMatiere),
				idType integer foreign key references TypeCours(idType),
				idEnseignant integer foreign key references Enseignant(idEtudiant),
				idPromotion integer foreign key references Promotion(idPromotion),
				heureDeb text,
				heureFin text,
				idJour integer foreign key references Jour(idJour),
				idSalle integer foreign key references Salle(idSalle),
				duree integer
			)";
	$resultat=$base->exec($query);
	$query="create table if not exists Jour (
				idJour integer primary key,
				nom text
			)";
	$resultat=$base->exec($query);

	$query="create table if not exists TypeCours (
				idType integer primary key,
				nom text
			)";
	$resultat=$base->exec($query);
	$query="create table if not exists Matiere (
				idMatiere integer primary key,
				libelle text,
				nomComplet text
			)";
	$resultat=$base->exec($query);

	$query="create table if not exists Enseignant (
				idEnseignant integer primary key,
				nom text,
				prenom text,
				login text,
				password text
			)";
	$resultat=$base->exec($query);

	$query="create table if not exists Enseignant_Departement (
				idEnseignant integer foreign key references Enseignant(idEnseignant),
				idDepartement integer foreign key references Departement(idDepartement),
				primary key (idEnseignant, idDepartement)
			)";
	$resultat=$base->exec($query);

	$query="create table if not exists Salle (
				idSalle integer primary key,
				libelle text
			)";
	$resultat=$base->exec($query);

	$query="create table if not exists Administratif (
				idAdministratif integer primary key,
				nom text,
				prenom text,
				login text,
				password text
			)";
	$resultat=$base->exec($query);

?>
	</body>
</html>
