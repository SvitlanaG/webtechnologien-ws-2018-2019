
<!DOCTYPE html>
<html lang="de">

<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<style>
	h1 {
	background-color: orange;
	font-style: oblique;
	}
	.container-fluid {
	background-color: moccasin;
	}
</style>
<title>Aufgabe 5 Random PHP</title>

<?php
function zufzahl($max, $anzahl, $stellen) {
	echo "<table class='table table-striped'>
			<thead>
				<tr>
					<th>Zufallszahl</th>";

			for($i=1; $i<=$stellen; $i++) {
				echo "<th> gerundet ".$i."</th>";
				}
			echo "	
				</tr>
			</thead>
			<tbody>";

	for($i=1; $i<=$anzahl; $i++) {
		$zzahl = rand(1,$max);
		//$gerundet1 = abschneiden($zzahl,1);
		//$gerundet2 = abschneiden($zzahl,2);
		//	$gerundet3 = abschneiden($zzahl,3);
		//echo $zzahl." ".$gerundet1." ".$gerundet2." ".$gerundet3. "<br/>";
		if($zzahl<10000) echo "<tr style='background-color:rgba(238,54,25,0.42)'>";
		else echo "<tr style='background-color:rgba(114,113,255,0.45)'>";
		echo "	<td>".$zzahl."</td>";
		for($j=1; $j<=$stellen; $j++){
			echo "<td>".abschneiden($zzahl, $j)."</td>";
		}

			echo"	</tr>";

}

	echo " </tbody>
		</table>";

}

function abschneiden($zahl, $stellen=2) {
	$base = pow(10,$stellen);
	$result = $zahl - ($zahl % $base);
	return $result;
}

?>

</head>
<body>

<div class="container-fluid">
<h1>Zufallszahlen</h1>

	<div>
		<?php zufzahl(20000, 20, 3); ?>
	</div>


<footer>

<b> Svitlana Grytsai MN 563266</b>

</footer>

</body>
</html>