pragma foreign_keys = ON;

create table if not exists Departement (
				idDepartement integer primary key,
				nom text
			);

create table if not exists Etudiant (
				idEtudiant integer primary key,
				nom text,
				prenom text,
				idPromotion integer references Promotion(idPromotion),
				login text,
				password text
			);

create table if not exists Promotion (
				idPromotion integer primary key,
				libelle text,
				idDepartement integer references Departement(idDepartement)
			);

create table if not exists Cours (
				idCours integer primary key,
				idMatiere integer references Matiere(idMatiere),
				idType integer references TypeCours(idType),
				idEnseignant integer references Enseignant(idEtudiant),
				idPromotion integer references Promotion(idPromotion),
				heureDeb text,
				heureFin text,
				idJour integer references Jour(idJour),
				idSalle integer references Salle(idSalle),
				duree integer
			);

create table if not exists Jour (
				idJour integer primary key,
				nom text
			);


create table if not exists TypeCours (
				idType integer primary key,
				nom text
			);

create table if not exists Matiere (
				idMatiere integer primary key,
				libelle text,
				nomComplet text,
				idPromo integer references Promotion(idPromotion)
			);


create table if not exists Enseignant (
				idEnseignant integer primary key,
				nom text,
				prenom text,
				login text,
				password text
			);


create table if not exists Enseignant_Departement (
				idEnseignant integer references Enseignant(idEnseignant),
				idDepartement integer references Departement(idDepartement),
				primary key (idEnseignant, idDepartement)
			);


create table if not exists Salle (
				idSalle integer primary key,
				libelle text
			);


create table if not exists Administratif (
				idAdministratif integer primary key,
				nom text,
				prenom text,
				login text,
				password text
			);

