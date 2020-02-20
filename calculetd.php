<?php
	function calculETD($db,$login) {
		$h=0;
		$m=0;
		$query = 'SELECT * FROM Cours WHERE idEnseignant=(Select idEnseignant FROM Enseignant Where login="' . $login . '")';
		$result = $db->query($query);
		while ($row = $result->fetchArray()) {
			$res = substr($row['duree'],0,1)*60;
			$m1 = substr($row['duree'],-2);
			if($row['idType']==3)
				$res+=$res/2;
			$res+=$m1;
			$h+=floor($res/60);
			$m+=$res%60;
		}
		$h+=floor($m/60);
		$m%=60;
		if($m==0) return $h . "h00";
		return $h . "h" . $m;
	}
?>
