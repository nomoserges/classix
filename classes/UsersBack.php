<?php
/** Require once pour inclure une seule fois ce fichier */
require_once 'Crud.php';

class Users extends Crud {

    public $useremail;
    public $motdepasse;
    public $nom;
    public $prenoms;
    public $adresse;
    public $telephones;
    public $manager;
    public $admin;
    public $front;
    public $is_enabled;
    public $is_deleted;

    public function __construct() {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getUseremail()
    {
        return $this->useremail;
    }

    /**
     * @param mixed $useremail
     */
    public function setUseremail($useremail)
    {
        $this->useremail = $useremail;
    }

    /**
     * @return mixed
     */
    public function getMotdepasse()
    {
        return $this->motdepasse;
    }

    /**
     * @param mixed $motdepasse
     */
    public function setMotdepasse($motdepasse)
    {
        $this->motdepasse = $motdepasse;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenoms()
    {
        return $this->prenoms;
    }

    /**
     * @param mixed $prenoms
     */
    public function setPrenoms($prenoms)
    {
        $this->prenoms = $prenoms;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getTelephones()
    {
        return $this->telephones;
    }

    /**
     * @param mixed $telephones
     */
    public function setTelephones($telephones)
    {
        $this->telephones = $telephones;
    }

    /**
     * @return mixed
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param mixed $manager
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getFront()
    {
        return $this->front;
    }

    /**
     * @param mixed $front
     */
    public function setFront($front)
    {
        $this->front = $front;
    }

    /**
     * @return mixed
     */
    public function getisEnabled()
    {
        return $this->is_enabled;
    }

    /**
     * @param mixed $is_enabled
     */
    public function setIsEnabled($is_enabled)
    {
        $this->is_enabled = $is_enabled;
    }

    /**
     * @return mixed
     */
    public function getisDeleted()
    {
        return $this->is_deleted;
    }

    /**
     * @param mixed $is_deleted
     */
    public function setIsDeleted($is_deleted)
    {
        $this->is_deleted = $is_deleted;
    }

    public function create() {
        $dataArray = array($this->useremail, $this->nom, $this->prenoms, $this->adresse, $this->telephones,
            $this->motdepasse);
        $this->insert(TBL_Users, $dataArray);
    }

    public function doRegister() {
        $sqlQuery = "INSERT INTO ".TBL_Users."(nom, prenoms,useremail, motdepasse, adresse, telephones, manager, admin,"
            ." front) VALUES( '".$this->nom."', '".$this->prenoms."', '".$this->useremail."',"
            ." '".sha1($this->motdepasse)."', '".$this->adresse."', '".$this->telephones."', "
            ."'".$this->manager."', '".$this->admin."', '".$this->front."')";
        $statement = $this->execute($sqlQuery);
        return $statement;
    }

    public function doLogin(){
        $sqlQuery = "SELECT * FROM ".TBL_Users
            ." WHERE useremail = '".$this->useremail."'"
            ." AND motdepasse = '".sha1($this->motdepasse)."'"
            ." AND is_enabled='1' AND is_deleted='0' ";
        //echo $sqlQuery.'<br>';
        $statement = $this->getData($sqlQuery);
        return $statement;
    }

    /**
     * Creer la session de l'utilisateur
     */
    public function _setSession() {
        $_SESSION['user']['nom'] = $this->nom;
        $_SESSION['user']['prenoms'] = $this->prenoms;
        $_SESSION['user']['email'] = $this->useremail;
        $_SESSION['user']['adresse'] = $this->adresse;
        $_SESSION['user']['telephones'] = $this->telephones;
        $_SESSION['user']['is_admin'] = $this->admin;
        $_SESSION['user']['is_manager'] = $this->manager;
        $_SESSION['user']['is_front'] = $this->front;
    }

    /**
     * Supprimer la session de l'utilisateur
     */
    public function _unsetSession() {
        session_unset($_SESSION['user']);
    }

    /**
     * Vérifier si l'adresse mail existe deja
     */
    public function _emailAlready(){
        $statement = $this->getRows("SELECT useremail FROM ".TBL_Users
            ." WHERE useremail='".$this->getUseremail()."'");
        if( $statement < 1){
            return false;
        }else {
            return true;
        }
    }
}