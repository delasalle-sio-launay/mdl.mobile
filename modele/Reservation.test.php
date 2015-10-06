<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Reservation</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// Domaine : Services web de l'application de suivi des réservations de la Maison des Ligues de Lorraine
// Test de la classe Reservation
// Auteur : JM CARTRON
// Dernière mise à jour : 21/5/2015

// inclusion de la classe Reservation ("include_once" peut être remplacé par "require_once")
include_once ('Reservation.class.php');

$unTimeStamp = date('Y-m-d H:i:s', time());		// l'heure courante
$unStartTime = time() + 3600;					// l'heure courante + 1 h
$unEndTime = time() + 7200;						// l'heure courante + 2 h

// appel du constructeur et tests des accesseurs
$uneReservation = new Reservation(10, $unTimeStamp, $unStartTime, $unEndTime, "Salle informatique", 4, "123456");

echo ('$id : ' . $uneReservation->getId() . '<br>');
echo ('$timestamp : ' . $uneReservation->getTimestamp() . '<br>');
echo ('$start_time : ' . $uneReservation->getStart_time() . '<br>');
echo ('$end_time : ' . $uneReservation->getEnd_time() . '<br>');
echo ('$room_name : ' . $uneReservation->getRoom_name() . '<br>');
echo ('$status : ' . $uneReservation->getStatus() . '<br>');
echo ('$digicode : ' . $uneReservation->getDigicode() . '<br>');
echo ('<br>');

// tests des mutateurs
$uneReservation->setId(20);
$uneReservation->setTimestamp(date('Y-m-d H:i:s', time() - 3600));	// l'heure courante - 1 h
$uneReservation->setStart_time(time());								// l'heure courante
$uneReservation->setEnd_time(time() + 3600);						// l'heure courante + 1 h
$uneReservation->setRoom_name("Salle multimédia");
$uneReservation->setStatus(0);
$uneReservation->setDigicode("112233");

echo ('$id : ' . $uneReservation->getId() . '<br>');
echo ('$timestamp : ' . $uneReservation->getTimestamp() . '<br>');
echo ('$start_time : ' . $uneReservation->getStart_time() . '<br>');
echo ('$end_time : ' . $uneReservation->getEnd_time() . '<br>');
echo ('$room_name : ' . $uneReservation->getRoom_name() . '<br>');
echo ('$status : ' . $uneReservation->getStatus() . '<br>');
echo ('$digicode : ' . $uneReservation->getDigicode() . '<br>');
echo ('<br>');

// test de la méthode toString
echo ($uneReservation->toString());
?>

</body>
</html>
