<!doctype html>
<html>
<head>
   <meta charset="UTF-8">
   <title>Formular</title>
   <link rel="stylesheet" href="bootstrap.min.css">
   <link rel="stylesheet" href="styles.css">
   <?php

   /* in der folgenden Datei steht mein Passwort für den MySQl-Server
    *  $password = 'meinPasswort';
    *
    */
   	require_once './passwd.inc.php';
   	require_once('DB.php');

   	/* hier wird ein neues Objekt von DB erzeugt
   	 * erster Parameter ist der Name Ihrer Datenbank (auf dem Studi-Server _IhreMatrNr__mockupdatadb
   	 * , lokal wahrscheinlich nur mockupdatadb
   	 * zweiter Parameter ist der MySql-Server (Studi-Server db.f4.htw-berlin.de:3306
   	 * , lokal wahrscheinlich localhost
   	 * dritter Parameter ist Ihr Nutzername (vom MySQL-Server) (Studi-Server Ihr FB4-Account
   	 * , lokal wahrscheinlich root
   	 * vierter Parameter ist Ihr Passwort (ich habe mein Passwort als Wert der Variablen $password
   	 * in der Datei passwd.inc.pwd abgelegt (siehe oben)
   	 */
   	$dbh = new DB($db, $host . ':'. $port, $user, $password);

   	/* die folgende Funktion ist nur eine Hilfsfunktion zum Debuggen
   	 * auf der Konsole in den Entwicklertools Ihres Browsers erscheint
   	 * der als String übergebene Text
   	 * die Funktion kann auch gelöscht werden
   	 */
   function debug_to_console( $data ) {

       if ( is_array( $data ) )
           $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
       else
           $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

       echo $output;
   }
   ?>
</head>
<body>
	<?php
	   $form_header = 'Teilnehmerin hinzufügen';
	
	   if ($_GET) {

           if($_GET['id'] && $_GET['command'] === 'edit') {
               $command = 'edit';
               $form_header = 'Eintrag bearbeiten';
               $data = $dbh->get(intval($_GET['id']));
           } elseif ($_GET['id'] && $_GET['command'] === 'delete') {
               $dbh->delete(intval($_GET['id']));
           }
            /*
             * es empfiehlt sich, an Ihre URL bei Absenden des Formulars ein "command" als Schlüssel anzuhängen,
             * welcher die Werte "edit" oder "delete" annehmen kann, je nachdem, ob Sie einen Datensatz
             * ändern oder löschen möchten
             * An den einzelnen "Karteikarten" erscheinen edit- und delete-"Buttons" - s.u.
             */
	   }
	   elseif ($_POST) {

           $vorname = filter_var($_POST['vorname'], FILTER_SANITIZE_STRING);
           $nachname = filter_var($_POST['nachname'], FILTER_SANITIZE_STRING);
           $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
           $ipnr = filter_var($_POST['ipnr'], FILTER_SANITIZE_STRING);
           $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

           $fehler = false;
           if (!$vorname || !$nachname || !$email || !$ipnr) {
               $fehler = true;
               $message = "Check fields!";
           } else {

               if(!$_POST['id']) {
                   $data = [
                       $vorname,
                       $nachname,
                       $email,
                       $ipnr,
                   ];

                   $res = $dbh->add($data);
                   $message = "Successfully added!";
                   if(false === $res) {
                       $message = "Something went wrong during adding...";
                   }
               } else {

                   $data = [
                       $vorname,
                       $nachname,
                       $email,
                       $ipnr,
                       $id,
                   ];

                   $res = $dbh->edit($data);
                   $message = "Successfully edited!";
                   if(false === $res) {
                       $message = "Something went wrong during editing...";
                   }
               }

           }
            /*
             * hier werden die über das Formular gesendeten Daten ausgewertet
             * 2 Fälle: wird die id mitgesendet, dienen die übersendeten Daten der Änderung des
             * entsprechenden Datensatzes
             * wird die id nicht mitgeliefert, dienen die Daten dem Einfügen eines neuen Datensatzes
             * in die Datenbank
             */
	   }
	
	   $teilnehmerinnen = $dbh->all();
	?>
   <div class="container">
      <div class="panel panel-default">

         <div class="panel-heading">
            <h3 class="panel-title"><?= $form_header ?></h3>
         </div>

         <div class="panel-body">

            <?php if (isset($message)) : ?>
               <div class="alert <?php echo true === $fehler ? "alert-warning" : "alert-success" ?>">
                  <?= $message ?>
               </div>
            <?php endif; ?>

            <?php if (isset($command) && $command == 'edit') : ?>

                <div class="col-xs-12">
                    <form role="form" class="form-horizonatal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                        <div class="row">
                            <input type="text" class="form-control col-12" name="vorname" value="<?php echo $data['vorname']; ?>">
                        </div>
                        <div class="row">
                            <input type="text" class="form-control col-12" name="nachname" value="<?php echo $data['nachname']; ?>">
                        </div>
                        <div class="row">
                            <input type="email" class="form-control col-12" name="email" value="<?php echo $data['email']; ?>">
                        </div>
                        <div class="row">
                            <input type="text" class="form-control col-12" name="ipnr" value="<?php echo $data['ipnr']; ?>">
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary col-12">Aktualizieren</button>
                        </div>
                    </form>
                </div>

            <?php else : ?>
            <div class="col-xs-12">
                <form role="form" class="form-horizonatal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

                    <div class="row">
                        <input type="text" class="form-control col-12" name="vorname" placeholder="Vorname">
                    </div>
                    <div class="row">
                        <input type="text" class="form-control col-12" name="nachname" placeholder="Nachname">
                    </div>
                    <div class="row">
                        <input type="email" class="form-control col-12" name="email" placeholder="E-Mail Adresse">
                    </div>
                    <div class="row">
                        <input type="text" class="form-control col-12" name="ipnr" placeholder="IP-Adresse">
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary col-12">Anlegen</button>
                    </div>
                    <!--
                         dies ist das Formular für das Anlegen eines neuen Datensatzes
                         es beinhaltet 4 einzeilige Textfelder: für Vornmae, Name, E-Mail-Adresse und IP-Nummer
                         keine id - diese wird von der Datenbank selbständig erzeugt (auto inkrement)
                    -->

                </form>
             </div>
         <?php endif; ?>

         </div> <!-- / .panel-body -->
      </div> <!-- / .panel -->

      <div class="row">

         <?php
            if (!sizeof($teilnehmerinnen)) {
               echo '<div class="alert alert-info">Es sind keine Studentinnen angemeldet!</div>';
            }
            else {
               foreach ($teilnehmerinnen as $teilnehmerin) {
                  echo
                  '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                     <div class="thumbnail">
                        <p> '.$teilnehmerin["vorname"].' </p>
      					<h4> '.$teilnehmerin["nachname"].' </h4>
      		 			<p> '.$teilnehmerin["email"].' </p>
      					<p> '.$teilnehmerin["ipnr"].' </p>
                        <div class="buttons-edit">
                           <a class="btn btn-default btn-sm" href="'. htmlspecialchars($_SERVER["PHP_SELF"]) .'?command=edit&id='.$teilnehmerin["id"].'">Edit</a>
                           <a class="btn btn-default btn-sm" href="'. htmlspecialchars($_SERVER["PHP_SELF"]) .'?command=delete&id='.$teilnehmerin["id"].'">Delete</a>
                        </div>
                     </div>
                  </div>';
               }
            }
         ?>

      </div> <!-- / list-group -->
   </div> <!-- / .container -->
</body>
</html>