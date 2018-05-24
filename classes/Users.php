<?php
/** Require once pour inclure une seule fois ce fichier */
require_once 'Crud.php';


class Users extends Crud {

    public $pseudo;
    public $user_mail;
    public $user_password;
    public $last_name;
    public $first_name;
    public $address;
    public $phones;
    public $user_group;
    public $is_enabled;
    public $is_deleted;

    /**
     * Users constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getUserMail()
    {
        return $this->user_mail;
    }

    /**
     * @param mixed $user_mail
     */
    public function setUserMail($user_mail)
    {
        $this->user_mail = $user_mail;
    }

    /**
     * @return mixed
     */
    public function getUserPassword()
    {
        return $this->user_password;
    }

    /**
     * @param mixed $user_password
     */
    public function setUserPassword($user_password)
    {
        $this->user_password = $user_password;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param mixed $phones
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;
    }

    /**
     * @return mixed
     */
    public function getUserGroup()
    {
        return $this->user_group;
    }

    /**
     * @param mixed $user_group
     */
    public function setUserGroup($user_group)
    {
        $this->user_group = $user_group;
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

    /**
     * @return bool
     */
    public function insert() {
        $sqlQuery = "INSERT INTO ".TBL_Users
            ." VALUES( '".$this->secureField($this->getPseudo())."', '".$this->secureField($this->getUserMail())
            ."', '".sha1($this->getUserPassword())."', '".$this->secureField($this->getLastName())
            ."', '".$this->secureField($this->getFirstName())."', '".$this->secureField($this->getAddress())."', "
            ."'".$this->secureField($this->getPhones())."', '".$this->getUserGroup()."', 1, 0)";
        return $this->execute($sqlQuery);
    }


    public function doLogin(){
        $sqlQuery = "SELECT * FROM ".TBL_Users
            ." WHERE (pseudo = '".$this->getPseudo()."'"
            ." OR user_mail = '".$this->getUserMail()."')"
            ." AND user_password = '".sha1($this->getUserPassword())."'"
            ." AND is_enabled=1 AND is_deleted=0 ";
        //echo $sqlQuery.'<br>';
        return $this->getData($sqlQuery);
    }

    /** Vérifier si l'email ou le pseudo existe déjà
     * @return bool
     */
    public function _credentialsAlready(){
        $statement = $this->getRows("SELECT * FROM ".TBL_Users
            ." WHERE user_mail='".$this->getUserMail()."'"
            ." OR pseudo = '".$this->getPseudo()."'");
        if( $statement < 1){
            return false;
        }else {
            return true;
        }
    }

    /**
     * Creer la session de l'utilisateur
     */
    public function _setSession() {
        $_SESSION['user']['pseudo'] = $this->getPseudo();
        $_SESSION['user']['nom'] = $this->getLastName();
        $_SESSION['user']['prenoms'] = $this->getFirstName();
        $_SESSION['user']['email'] = $this->getUserMail();
        $_SESSION['user']['adresse'] = $this->getAddress();
        $_SESSION['user']['telephones'] = $this->getPhones();
        $_SESSION['user']['user_group'] = $this->getUserGroup();
    }

    /**
     * Supprimer la session de l'utilisateur
     */
    public function _unsetSession() {
        session_unset($_SESSION['user']);
    }

    /** Liste des utilisateurs d'un group utilisateur
     * @return array|int|string
     */
    public function getUsersPerGroup(){
        $sqlQuery = "SELECT * FROM ".TBL_Users
            ." WHERE user_group ='".$this->getUserGroup()."'";
        return $this->getData($sqlQuery);
    }

    /** Activer/Desactiver un compte
     * @return bool
     */
    public function updateStatus(){
        $sqlQuery = "UPDATE ".TBL_Users
            ." SET is_enabled = ".$this->getisEnabled()
            ." WHERE pseudo = '".$this->getPseudo()."'"
            ." OR user_mail = '".$this->getUserMail()."'";
        return $this->execute($sqlQuery);
    }

    /** Activer/Desactiver un compte
     * @return bool
     */
    public function deleteAccount(){
        $sqlQuery = "UPDATE ".TBL_Users
            ." SET is_deleted = 1, is_enabled=0"
            ." WHERE pseudo = '".$this->getPseudo()."'"
            ." OR user_mail = '".$this->getUserMail()."'";
        return $this->execute($sqlQuery);
    }

    /** Mise à jour du profile
     * @return bool
     */
    public function updateDetails(){
        $sqlQuery = "UPDATE ".TBL_Users
            ." SET last_name = '".htmlentities($this->getLastName())."'"
            ." ,first_name = '".htmlentities($this->getFirstName())."'"
            ." ,address = '".htmlentities($this->getAddress())."'"
            ." ,phones = '".$this->getPhones()."'"
            ." WHERE pseudo = '".$this->getPseudo()."'"
            ." OR user_mail = '".$this->getUserMail()."'";
        return $this->execute($sqlQuery);
    }

    /** Changement du mot de passe
     * @return bool
     */
    public function changePassword(){
        $sqlQuery = "UPDATE ".TBL_Users
            ." SET user_password = '".sha1($this->getUserPassword())."'"
            ." WHERE pseudo = '".$this->getPseudo()."'"
            ." OR user_mail = '".$this->getUserMail()."'";
        return $this->execute($sqlQuery);
    }

    /** Utilisateurs clients du site
     * @return array|int|string
     */
    public function frontendUsers(){
        return $this->getData("SELECT * FROM ".TBL_Users
            ." WHERE user_group IN ('personnel', 'entreprise')"
            ." AND is_deleted = 0");
    }

    /** Utilisateurs du panel admin site
     * @return array|int|string
     */
    public function backendUsers(){
        return $this->getData("SELECT * FROM ".TBL_Users
            ." WHERE user_group IN ('admin', 'gestionnaire')"
            ." AND is_deleted = 0");
    }
}