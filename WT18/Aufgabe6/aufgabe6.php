<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Datei einlesen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="container-fluid">
<h1>Datei einlesen</h1>
<?php
/*
 * falls das Zeilenende der einzulesenden Datei nicht korrekt
 * erkannt werden sollte, dann sollte die folgende Anweisung
 * ausgeführt werden
 */
ini_set("auto_detect_line_endings", true);
/* Öffnen der Datei zum Lesen "r"
 * Datei muss im gleichen Verzeichnis liegen wie aufgabe6.php
 * andernfalls Pfadangabe ändern
 * @ unterdrückt evtl Warnungen
 */


$fileHandler = @fopen ( "./mockdatatext", "r" );
if (! $fileHandler) {
    echo "Es ist ein Problem beim Öffnen der Datei 'mockupdatatext' aufgetreten.";
} else {
    echo"<div class = 'row'>";
    $count = 0;
    while (!feof ($fileHandler)) {

        if ($count % 10 == 0) {
            echo"<div class = 'col-xl-4 col-lg-6 col-md-12' style = 'background-color:dimgray; margin: 10px;'>";
            echo "<ul class = 'list-group' style='padding-top: 10px; padding-bottom: 10px;'>";
        }
        $vorname = fgets($fileHandler);
        $nachname = fgets($fileHandler);
        $email = fgets($fileHandler);
        $ip = fgets($fileHandler);
        $leer = fgets($fileHandler);
        echo"<li class = 'list-group-item'>".$vorname." ".$nachname."(<a href='mailto:".$email."'>".$email."</a>)</li>";


        if ($count % 10 == 9) {
            echo "</ul>";
            echo "</div>";
        }
            $count++;
    }

    fclose ($fileHandler);
}
?>
</body>
</html>