<!DOCTYPE html>
<html lang = "de">
<head>
    <meta charset="UTF-8">
    <title>Aufgabe 7 Formulare und Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
</head>

<body>
<div class = "container">
    <h1>Anmeldung</h1>
    <?php
    if($_POST) {
        $vorname = filter_var($_POST['vorname'], FILTER_SANITIZE_STRING);
        $nachname = filter_var($_POST['nachname'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $studiengang = filter_var($_POST['studiengang'], FILTER_SANITIZE_STRING);
        $pwd = filter_var($_POST['pwd'], FILTER_SANITIZE_STRING);

        $fehler = false;
        if (!$vorname || !$nachname || !$email || !$studiengang) $fehler = true;

        if (!$fehler) {
            echo "
            <p>
            Herzlichen Dank " . $vorname . " " . $nachname . " vom Studiengang " . $studiengang . "!<br/>
            Wir haben eine E-Mail an " . $email . " gesendet. <br/>
            <a href='./aufgabe7.php'>Zurück</a>
            </p>
            ";
        }
    }
    if(($_POST && $fehler) || empty($_POST)) :
    ?>

    <form action="./aufgabe7.php" method="post" class="form-horizonatal" autocomplete="off">
        <div class="form-group row">
        <label for="vorname" class="col-3">Vorname : </label>
            <?php
            if(isset($vorname) && !$vorname) {
                echo "
                <input type='text' name='vorname' placeholder='Vorname' class='form-control col-9 is-invalid'>
            <div class='invalid-feedback'>Bitte Vornamen eintragen!</div>
                ";
            }
            else {
                echo "
                <input type='text' name='vorname' placeholder='Vorname' class='form-control col-9'>
                ";
            }
            ?>
        </div>
        <div class="form-group row">
            <label for="nachname" class="col-3">Nachname : </label>
            <?php
            if(isset($nachname) && !$nachname) {
                echo "
                <input type='text' name='nachname' placeholder='Nachname' class='form-control col-9 is-invalid'>
            <div class='invalid-feedback'>Bitte Nachnamen eintragen!</div>
                ";
            }
            else {
                echo "
                <input type='text' name='nachname' placeholder='Nachname' class='form-control col-9'>
                ";
            }
            ?>
        </div>
        <div class="form-group row">
            <label for="email" class="col-3">E-Mail : </label>
            <?php
            if(isset($email) && !$email) {
                echo "
                <input type='text' name='email' placeholder='E-Mail' autocomplete='off' class='form-control col-9 is-invalid'>
            <div class='invalid-feedback'>Bitte E-Mail Adresse eintragen!</div>
                ";
            }
            else {
                echo "
                <input type='text' name='email' placeholder='E-Mail' class='form-control col-9'>
                ";
            }
            ?>
        </div>
        <div class="form-group row">
            <label for="studiengang" class="col-3">Studiengang : </label>
            <select name="studiengang" class="form-control col-9">
                <option value="FIW">Informatik und Wirtschaft</option>
                <option value="AI">Angewandte Informatik</option>
                <option value="IMI">Internationale Medieninformatik</option>
            </select>
        </div>
        <div class="form-group row">
            <label for="pwd" class="col-3">Passwort : </label>
            <?php
            if(isset($pwd) && !$pwd) {
                echo "
                <input type='text' name='pwd' placeholder='Passwort' class='form-control col-9 is-invalid'>
            <div class='invalid-feedback'>Bitte Passwort eintragen!</div>
                ";
            }
            else {
                echo "
                <input type='text' name='pwd' placeholder='Passwort' autocomplete='new-password' class='form-control col-9'>
                ";
            }
            ?>
        </div>
        <div class="form-group row">
        <button type="submit" class="btn btn-primary">Anmelden</button>
        </div>
    </form>
    <?php
    endif;
    ?>
</div>
</body>
</html>