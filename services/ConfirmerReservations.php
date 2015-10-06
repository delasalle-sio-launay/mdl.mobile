<?php

global $doc;		// le document XML à générer
global $nom, $mdp, $numRes;

// inclusion de la classe Outils
include_once ('../modele/Outils.class.php');
// inclusion des paramètres de l'application
include_once ('../modele/include.parametres.php');

// crée une instance de DOMdocument
$doc = new DOMDocument();

// specifie la version et le type d'encodage
$doc->version = '1.0';
$doc->encoding = 'ISO-8859-1';

// crée un commentaire et l'encode en ISO
$elt_commentaire = $doc->createComment('Service web ConfirmerReservations - BTS SIO - Lycée De La Salle - Rennes');
// place ce commentaire à la racine du document XML
$doc->appendChild($elt_commentaire);

if ( empty ($_GET ["nom"]) == true)  $nom = "";  else   $nom = $_GET ["nom"];
if ( empty ($_GET ["mdp"]) == true)  $mdp = "";  else   $mdp = $_GET ["mdp"];
// si l'URL ne contient pas les données, on regarde si elles ont été envoyées par la méthode POST
// la fonction $_POST récupère une donnée envoyées par la méthode POST
if ( $nom == "" && $mdp == "" )
{	
	if ( empty ($_POST ["nom"]) == true)  $nom = "";  else   $nom = $_POST ["nom"];
	if ( empty ($_POST ["mdp"]) == true)  $mdp = "";  else   $mdp = $_POST ["mdp"];
}

// Contrôle de la présence des paramètres
if ( $nom == "" || $mdp == "" )
{	
	TraitementAnormal ("Erreur : données incomplètes.");
}
else
{	// connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
	include_once ('../modele/DAO.class.php');
	$dao = new DAO();
	if ( $dao->getNiveauUtilisateur($nom, $mdp) == "inconnu" )
	{
		TraitementAnormal("Erreur : authentification incorrecte.");
	}
	else
	{	// Vérifier l'existence du numéro de réservation.
		if ( $dao->existeReservation($numRes) == false )
		{
			TraitementAnormal("Erreur : numéro de réservation inexistant.");
		}
	
		else
		{	// Vérifier que l'utilisateur est bien l'auteur de la réservation.
			if ( $dao->estLeCreateur($nom, $numRes) == false )
			{
				TraitementAnormal("Erreur : vous n'êtes pas l'auteur de cette réservation.");
			}
			else
			{
				$uneReservation = $dao->getReservation($numRes);
				$status = $uneReservation->getStatus();
				if ($status != 4)
				{
					TraitementAnormal("Erreur : cette réservation est déjà confirmée.");
				}
				else
				{
					$endTime = $uneReservation->getEnd_Time();
					if ($endTime > time())
					{
						TraitementAnormal("Erreur : cette réservation est déjà passée.");
					}
					else 
					{
						TraitementNormal($uneReservation->getDigicode(),$numRes);
					}
				}
			}
		}
	}
	unset($dao);
}

function TraitementAnormal($msg)
{	// redéclaration des données globales utilisées dans la fonction
global $doc;
// crée l'élément 'data' à la racine du document XML
$elt_data = $doc->createElement('data');
$doc->appendChild($elt_data);
// place l'élément 'reponse' juste après l'élément 'data'
$elt_reponse = $doc->createElement('reponse', $msg);
$elt_data->appendChild($elt_reponse);
return;
}

function TraitementNormal($digicode, $numRes)
{
	$elt_data = $doc->createElement('data');
	$doc->appendChild($elt_data);
	// place l'élément 'reponse' juste après l'élément 'data'
	$elt_reponse = $doc->createElement('reponse', "Enregistrement effectué ; vous allez recevoir un mail de confirmation.");
	$elt_data->appendChild($elt_reponse);
	
	$elt_donnees = $doc->createElement('data');
	$elt_data = appendChild($elt_donnees);
	
	$dao = new DAO();
	$dao->confirmerReservation($numRes);
	
	$message = "La réservation a bien été enregistré, le digicode est : " . $digicode;
	$user = $dao->getUtilisateur($nom);
	$email = $user->getEmail();
	Outils::envoyerMail($email, "Confirmation réservation", $message, "delasalle.sio.launay.a@gmail.com")
	return;
}


?>