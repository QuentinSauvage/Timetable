<?php
	function hachage($mdp) {
		$res="";
		for($i=0;$i<strlen($mdp);$i++) {
			$c=ord($mdp[$i]);
			if($c>=65 && $c<=90)
				$res .= chr((65 + (($c - 65) + 13)%26));
			else if($c>=97 && $c<=122)
				$res .= chr((97 + (($c - 97) + 13)%26));
			else
				$res .= chr($c+13);
		}
		return $res;
	}
	
	function dehachage($mdp) {
		$res="";
		for($i=0;$i<strlen($mdp);$i++) {
			$c=ord($mdp[$i]);
			if($c>=65 && $c<=90)
				$res .= chr(65-(65-($c)-13)%26);
			else if($c>=97 && $c<=122) {
				$res .= chr(97-(97-($c)-13)%26);
			}
			else
				$res .= chr($c-13);
		}
		return $res;
	}
	
	function controleHeures($heure1, $heure2, $jour, $enseignant, $promo, $db, $id) {
		date_default_timezone_set("Europe/Paris");
		$h1 = substr($heure1,0,2);
		$m1 = substr($heure1,-2);
		$h2 = substr($heure2,0,2);
		$m2 = substr($heure2,-2);
		$debut = mktime($h1,$m1,0,0,0,2018);
		$fin = mktime($h2,$m2,0,0,0,2018);
		$min = ($h2 * 60 + $m2) - ($h1 * 60 + $m1);
		if($min>500||$min<30)
			return 0;
		$query = "Select * From Cours";
		$result = $db->query($query);
		while ($row = $result->fetchArray())
			if($row['idCours']!=$id && $jour == $row['idJour'] && (($heure1 >= $row['heureDeb'] && $heure1 <= $row['heureFin']) || ($heure2 >= $row['heureDeb'] && $heure2 <= $row['heureFin']))) {
				if($enseignant == $row['idEnseignant'] || $promo == $row['idPromotion'])
					return 0;
			}
		$tmp=$min%60;
		$res=($tmp==0)?(floor($min/60) . "h00"):(floor($min/60) . "h" . $tmp);
		return $res;
	}
?>
