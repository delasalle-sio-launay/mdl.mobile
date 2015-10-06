<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Utilisateur</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// Domaine : Services web de l'application de suivi des réservations de la Maison des Ligues de Lorraine
// Test de la classe Utilisateur
// Auteur : JM CARTRON
// Dernière mise à jour : 21/5/2015

// inclusion de la classe Utilisateur ("include_once" peut être remplacé par "require_once")
include_once ('Utilisateur.class.php');
// inclusion de la classe Reservation ("include_once" peut être remplacé par "require_once")
include_once ('Reservation.class.php');

// tests du constructeur et des accesseurs
$unUtilisateur = new Utilisateur(10, 1, "Tess Tuniter", "123456", "tess.tuniter@gmail.com");

echo ('$id : ' . $unUtilisateur->getId() . '<br>');
echo ('$level : ' . $unUtilisateur->getLevel() . '<br>');
echo ('$name : ' . $unUtilisateur->getName() . '<br>');
echo ('$password : ' . $unUtilisateur->getPassword() . '<br>');
echo ('$email : ' . $unUtilisateur->getEmail() . '<br>');
echo ('nombre de réservations : ' . $unUtilisateur->getNbReservations() . '<br>');
echo ('<br>');

// tests des mutateurs
$unUtilisateur->setId(20);
$unUtilisateur->setLevel(2);
$unUtilisateur->setName("Amédée Bogueur");
$unUtilisateur->setPassword("abcdef");
$unUtilisateur->setEmail("amedee.bogueur@gmail.com");

echo ('$id : ' . $unUtilisateur->getId() . '<br>');
echo ('$level : ' . $unUtilisateur->getLevel() . '<br>');
echo ('$name : ' . $unUtilisateur->getName() . '<br>');
echo ('$password : ' . $unUtilisateur->getPassword() . '<br>');
echo ('$email : ' . $unUtilisateur->getEmail() . '<br>');
echo ('nombre de réservations : ' . $unUtilisateur->getNbReservations() . '<br>');
echo ('<br>');

// tests des méthodes ajouteReservation et getNbReservations
$unTimeStamp = date('Y-m-d H:i:s', time());		// l'heure courante
$unStartTime = time() + 3600;					// l'heure courante + 1 h
$unEndTime = time() + 7200;						// l'heure courante + 2 h

$reservation1 = new Reservation(21, $unTimeStamp, $unStartTime, $unEndTime, "Salle 1", 4, "111111");
$reservation2 = new Reservation(22, $unTimeStamp, $unStartTime, $unEndTime, "Salle 2", 4, "222222");

$unUtilisateur->ajouteReservation($reservation1);
$unUtilisateur->ajouteReservation($reservation2);

echo ('nombre de réservations après les ajouts de 2 réservations : ' . $unUtilisateur->getNbReservations() . '<br>');
echo ('<br>');

// tests de la méthode getLaReservation
$uneReservation = $unUtilisateur->getLaReservation(0);
echo ($uneReservation->toString());
echo ('<br>');

$uneReservation = $unUtilisateur->getLaReservation(1);
echo ($uneReservation->toString());
echo ('<br>');

// tests de la méthode viderListeReservations
$unUtilisateur->viderListeReservations();
echo ('nombre de réservations après vidage des réservations : ' . $unUtilisateur->getNbReservations() . '<br>');
echo ('<br>');

$unUtilisateur->ajouteReservation($reservation1);
$unUtilisateur->ajouteReservation($reservation2);
echo ('nombre de réservations après les ajouts de 2 réservations : ' . $unUtilisateur->getNbReservations() . '<br>');
echo ('<br>');

// test de la méthode toString
echo ('Résultat de la méthode toString : <br><br>' . $unUtilisateur->toString());
?>

</body>
</html>