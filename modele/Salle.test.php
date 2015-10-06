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
// Test de la classe c
// Auteur : JM CARTRON
// Dernière mise à jour : 21/5/2015

// inclusion de la classe Salle ("include_once" peut être remplacé par "require_once")
include_once ('Salle.class.php');

$unId = 5;
$unRoomName = "Multimédia";
$unCapacity = 25;
$unAreaName = "Informatique - multimédia";
$unAeraAdminEmail = "chemin.lorette@lorraine-sport.net";
$uneSalle = new Salle($unId, $unRoomName, $unCapacity, $unAreaName, $unAeraAdminEmail);

echo ('$id : ' . $uneSalle->getId() . '<br>');
echo ('$room_name : ' . $uneSalle->getRoom_name() . '<br>');
echo ('$capacity : ' . $uneSalle->getCapacity() . '<br>');
echo ('$area_name : ' . $uneSalle->getAeraName() . '<br>');
echo ('$area_admin_email : ' . $uneSalle->getAeraAdminEmail() . '<br>');
echo ('<br>');

$uneSalle->setId(6);
$uneSalle->setRoom_name("Amphithéâtre");
$uneSalle->setCapacity(200);
$uneSalle->setAeraName("Salles de réception");
$uneSalle->setAeraAdminEmail("sophie.fonfec@lorraine-sport.net");

echo ('$id : ' . $uneSalle->getId() . '<br>');
echo ('$room_name : ' . $uneSalle->getRoom_name() . '<br>');
echo ('$capacity : ' . $uneSalle->getCapacity() . '<br>');
echo ('$area_name : ' . $uneSalle->getAeraName() . '<br>');
echo ('$area_admin_email : ' . $uneSalle->getAeraAdminEmail() . '<br>');
echo ('<br>');

?>

</body>
</html>