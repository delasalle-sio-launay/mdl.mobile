<?php
// Domaine : Services web de l'application de suivi des réservations de la Maison des Ligues de Lorraine
// Classe : Salle
// Auteur : JM CARTRON
// Dernière mise à jour : 7/5/2015

class Salle
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	private $id;				// identifiant de la salle
	private $room_name;			// nom de la salle
	private $capacity;			// capacité de la salle
	private $area_name;			// nom du domaine de la salle
	private $area_admin_email;	// adresse mail de l'administrateur du domaine

	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function __construct($unId, $unRoomName, $unCapacity, $unAreaName, $unAeraAdminEmail) {
		$this->id = $unId;
		$this->room_name = $unRoomName;
		$this->capacity = $unCapacity;
		$this->area_name = $unAreaName;
		$this->area_admin_email = $unAeraAdminEmail;
	}

	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Getters et Setters ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function getId()	{return $this->id;}
	public function setId($unId) {$this->id = $unId;}
	
	public function getRoom_name()	{return $this->room_name;}
	public function setRoom_name($unRoom_name) {$this->room_name = $unRoom_name;}
	
	public function getCapacity()	{return $this->capacity;}
	public function setCapacity($unCapacity) {$this->capacity = $unCapacity;}
		
	public function getAeraName()	{return $this->area_name;}
	public function setAeraName($unAreaName) {$this->area_name = $unAreaName;}

	public function getAeraAdminEmail()	{return $this->area_admin_email;}
	public function setAeraAdminEmail($unAeraAdminEmail) {$this->area_admin_email = $unAeraAdminEmail;}
	
} // fin de la classe Salle

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!