<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe DAO</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// Domaine : Services web de l'application de suivi des réservations de la Maison des Ligues de Lorraine
// Test de la classe DAO
// Auteur : JM CARTRON
// Dernière mise à jour : 29/9/2015

// connexion du serveur web à la base MySQL
include_once ('DAO.class.php');
$dao = new DAO();


// test de la méthode getNiveauUtilisateur --------------------------------------------------------
// modifié par Jim le 24/9/2015
echo "<h3>Test de getNiveauUtilisateur : </h3>";
$niveauUtilisateur = $dao->getNiveauUtilisateur('admin', 'admin');
echo "<p>NiveauUtilisateur de ('admin', 'admin') : <b>" . $niveauUtilisateur . "</b><br>";
$niveauUtilisateur = $dao->getNiveauUtilisateur('admin', 'adminnnnn');
echo "NiveauUtilisateur de ('admin', 'adminnnnn') : <b>" . $niveauUtilisateur . "</b><br>";
$niveauUtilisateur = $dao->getNiveauUtilisateur('guesdonm', 'passe');
echo "NiveauUtilisateur de ('guesdonm', 'passe') : <b>" . $niveauUtilisateur . "</b></p>";


// test de la méthode genererUnDigicode -----------------------------------------------------------
// modifié par Jim le 24/9/2015
echo "<h3>Test de genererUnDigicode : </h3>";
echo "<p>Un digicode aléatoire : <b>" . $dao->genererUnDigicode() . "</b><br>";
echo "Un digicode aléatoire : <b>" . $dao->genererUnDigicode() . "</b><br>";
echo "Un digicode aléatoire : <b>" . $dao->genererUnDigicode() . "</b><p>";


// test de la méthode creerLesDigicodesManquants --------------------------------------------------
// modifié par Jim le 24/9/2015
echo "<h3>Test de creerLesDigicodesManquants : </h3>";
$dao->creerLesDigicodesManquants();
echo "<p>Pour ce test, videz auparavant la table <b>mrbs_entry_digicode</b><br>";
echo " puis vérifiez que la table est reconstruite après exécution du test.</p>";


// test de la méthode listeReservations -----------------------------------------------------------
// modifié par Jim le 25/9/2015
echo "<h3>Test de listeReservations : </h3>";
$lesReservations = $dao->listeReservations("jim");
$nbReponses = sizeof($lesReservations);
echo "<p>Nombre de réservations de 'jim' : " . $nbReponses . "</p>";
// affichage des réservations
foreach ($lesReservations as $uneReservation)
{	echo (utf8_encode($uneReservation->toString()));
	echo ('<br>');
}
$lesReservations = $dao->listeReservations("zenelsy");
$nbReponses = sizeof($lesReservations);
echo "<p>Nombre de réservations de 'zenelsy' : " . $nbReponses . "</p>";
// affichage des réservations
foreach ($lesReservations as $uneReservation)
{	echo (utf8_encode($uneReservation->toString()));
echo ('<br>');
}


// test de la méthode existeReservation -----------------------------------------------------------
// modifié par Jim le 25/9/2015
echo "<h3>Test de existeReservation : </h3>";
if ($dao->existeReservation("11")) $existe = "oui"; else $existe = "non";
echo "<p>Existence de la réservation 11 : <b>" . $existe . "</b><br>";
if ($dao->existeReservation("12")) $existe = "oui"; else $existe = "non";
echo "Existence de la réservation 12 : <b>" . $existe . "</b></p>";


// test de la méthode estLeCreateur ---------------------------------------------------------------
// modifié par Jim le 25/9/2015
echo "<h3>Test de estLeCreateur : </h3>";
if ($dao->estLeCreateur("giboired", "11")) $estLeCreateur = "oui"; else $estLeCreateur = "non";
echo "<p>'giboired' a créé la réservation 11 : <b>" . $estLeCreateur . "</b><br>";
if ($dao->estLeCreateur("zenelsy", "11")) $estLeCreateur = "oui"; else $estLeCreateur = "non";
echo "'zenelsy' a créé la réservation 11 : <b>" . $estLeCreateur . "</b></p>";


// test de la méthode getReservation --------------------------------------------------------------
// modifié par Jim le 25/9/2015
echo "<h3>Test de getReservation : </h3>";
$laReservation = $dao->getReservation("11");
if ($laReservation) 
	echo "<p>La réservation 11 existe : <br>" . utf8_encode($laReservation->toString()) . "</p>";
else
	echo "<p>La réservation 11 n'existe pas !</p>";	
 $laReservation = $dao->getReservation("12");
if ($laReservation) 
	echo "<p>La réservation 12 existe : <br>" . utf8_encode($laReservation->toString()) . "</p>";
else
	echo "<p>La réservation 12 n'existe pas !</p>";	


// // test de la méthode getUtilisateur --------------------------------------------------------------
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de getUtilisateur : </h3>";
// $unUtilisateur = $dao->getUtilisateur("admin");
// if ($unUtilisateur)
// 	echo "<p>L'utilisateur admin existe : <br>" . utf8_encode($unUtilisateur->toString()) . "</p>";
// else
// 	echo "<p>L'utilisateur admin n'existe pas !</p>";
// $unUtilisateur = $dao->getUtilisateur("admon");
// if ($unUtilisateur)
// 	echo "<p>L'utilisateur admon existe : <br>" . utf8_encode($unUtilisateur->toString()) . "</p>";
// else
// 	echo "<p>L'utilisateur admon n'existe pas !</p>";


// test de la méthode confirmerReservation --------------------------------------------------------
// pour ce test, utiliser une réservation dont le champ status est mis auparavant à 4 (état provisoire)
// modifié par Jim le 28/9/2015
echo "<h3>Test de confirmerReservation : </h3>";
$laReservation = $dao->getReservation("10");
if ($laReservation) {
echo "<p>Etat de la réservation 10 avant confirmation : <b>" . $laReservation->getStatus() . "</b><br>";
$dao->confirmerReservation("10");
$laReservation = $dao->getReservation("10");
echo "Etat de la réservation 10 après confirmation : <b>" . $laReservation->getStatus() . "</b></p>";
}
else
echo "<p>La réservation 10 n'existe pas !</p>";	


// // test de la méthode annulerReservation --------------------------------------------------------
// // pour ce test, utiliser une réservation existante
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de annulerReservation : </h3>";
// $laReservation = $dao->getReservation("10");
// if ($laReservation) {
// 	$dao->annulerReservation("10");
// 	$laReservation = $dao->getReservation("10");
// 	if ($laReservation)
// 		echo "La réservation 10 n'a pas été supprimée !</p>";
// 	else
// 		echo "La réservation 10 a bien été supprimée !</p>";
// }
// else
// 	echo "<p>La réservation 10 n'existe pas !</p>";


// test de la méthode existeUtilisateur -----------------------------------------------------------
// modifié par Jim le 28/9/2015
echo "<h3>Test de existeUtilisateur : </h3>";
if ($dao->existeUtilisateur("admin")) $existe = "oui"; else $existe = "non";
echo "<p>Existence de l'utilisateur 'admin' : <b>" . $existe . "</b><br>";
if ($dao->existeUtilisateur("xxxx")) $existe = "oui"; else $existe = "non";
echo "Existence de l'utilisateur 'xxxx' : <b>" . $existe . "</b></p>";


// // test de la méthode modifierMdpUser -------------------------------------------------------------
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de modifierMdpUser : </h3>";
// $unUtilisateur = $dao->getUtilisateur("admin");
// if ($unUtilisateur) {
// 	$dao->modifierMdpUser("admin", "passe");
// 	$unUtilisateur = $dao->getUtilisateur("admin");
// 	echo "<p>Nouveau mot de passe de l'utilisateur admin : <b>" . $unUtilisateur->getPassword() . "</b><br>";
	
// 	$dao->modifierMdpUser("admin", "admin");
// 	$unUtilisateur = $dao->getUtilisateur("admin");
// 	echo "Nouveau mot de passe de l'utilisateur admin : <b>" . $unUtilisateur->getPassword() . "</b><br>";
	
// 	$niveauUtilisateur = $dao->getNiveauUtilisateur('admin', 'admin');
// 	echo "NiveauUtilisateur de ('admin', 'admin') : <b>" . $niveauUtilisateur . "</b></p>";
// }
// else
// 	echo "<p>L'utilisateur admin n'existe pas !</p>";


// // test de la méthode envoyerMdp ------------------------------------------------------------------
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de envoyerMdp : </h3>";
// $dao->modifierMdpUser("jim", "passe");
// $ok = $dao->envoyerMdp("jim", "passe");
// if ($ok)
// 	echo "<p>Mail bien envoyé !</p>";
// else
// 	echo "<p>Echec lors de l'envoi du mail !</p>";


// test de la méthode testerDigicodeSalle ---------------------------------------------------------
// modifié par Jim le 28/9/2015
echo "<h3>Test de testerDigicodeSalle : </h3>";
$reponse = $dao->testerDigicodeSalle("10", "34214E");
echo "<p>L'appel de testerDigicodeSalle('10', '34214E') donne : <b>" . $reponse . "</b><br>";


// // test de la méthode testerDigicodeBatiment ------------------------------------------------------
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de testerDigicodeBatiment : </h3>";
// $reponse = $dao->testerDigicodeBatiment("34214E");
// echo "<p>L'appel de testerDigicodeBatiment('34214E') donne : <b>" . $reponse . "</b><br>";


// test de la méthode enregistrerUtilisateur ------------------------------------------------------
// modifié par Jim le 28/9/2015
echo "<h3>Test de enregistrerUtilisateur : </h3>";
$ok = $dao->enregistrerUtilisateur("jim1", "1", "passe", "delasalle.sio.launay.a@gmail.com");
if ($ok)
	echo "<p>Utilisateur bien enregistré !</p>";
else
	echo "<p>Echec lors de l'enregistrement de l'utilisateur !</p>";


// // test de la méthode aPasseDesReservations -------------------------------------------------------
// // pour ce test, choisir un utilisateur avec des réservations et un autre sans réservation
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de aPasseDesReservations : </h3>";
// $ok = $dao->aPasseDesReservations("zenelsy");
// if ($ok)
// 	echo "<p>zenelsy a bien passé des réservations !<br>";
// else
// 	echo "<p>zenelsy n'a pas passé de réservations !<br>";
// $ok = $dao->aPasseDesReservations("admin");
// if ($ok)
// 	echo "admin a bien passé des réservations !</p>";
// else
// 	echo "admin n'a pas passé de réservations !</p>";


// // test de la méthode supprimerUtilisateur --------------------------------------------------------
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de supprimerUtilisateur : </h3>";
// $ok = $dao->supprimerUtilisateur("jim1");
// if ($ok)
// 	echo "<p>Utilisateur bien supprimé !</p>";
// else
// 	echo "<p>Echec lors de la suppression de l'utilisateur !</p>";


// // test de la méthode listeSalles -----------------------------------------------------------------
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de listeSalles : </h3>";
// $lesSalles = $dao->listeSalles();
// $nbReponses = sizeof($lesSalles);
// echo "<p>Nombre de salles : " . $nbReponses . "</p>";
// // affichage des salles
// foreach ($lesSalles as $uneSalle)
// {	echo (utf8_encode($uneSalle->getRoom_name()));
// 	echo ('<br>');
// }


// ferme la connexion à MySQL :
unset($dao);
?>

</body>
</html>