<?php
require_once 'Crud.php';

class Adverts extends Crud {
    public $idadvert;
    public $pseudo;
    public $cat_id;
    public $city_name;
    public $title;
    public $description;
    public $validity;
    public $initial_price;
    public $price_text;
    public $price_validity;
    public $price_images;
    public $price;
    public $tags;
    public $contact_fullname;
    public $contact_email;
    public $contact_phone;
    public $contact_address;
    public $status;
    public $nb_views;
    public $payment_visa;
    public $payment_paypal;
    public $payment_bank;
    public $payment_cashier;
    public $is_deleted;
    public $publish_date;
    public $register_date;

    /**
     * Adverts constructor.
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getIdadvert()
    {
        return $this->idadvert;
    }

    /**
     * @param mixed $idadvert
     */
    public function setIdadvert($idadvert)
    {
        $this->idadvert = $idadvert;
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
    public function getCatId()
    {
        return $this->cat_id;
    }

    /**
     * @param mixed $cat_id
     */
    public function setCatId($cat_id)
    {
        $this->cat_id = $cat_id;
    }

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->city_name;
    }

    /**
     * @param mixed $city_name
     */
    public function setCityName($city_name)
    {
        $this->city_name = $city_name;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getValidity()
    {
        return $this->validity;
    }

    /**
     * @param mixed $validity
     */
    public function setValidity($validity)
    {
        $this->validity = $validity;
    }

    /**
     * @return mixed
     */
    public function getPublishDate()
    {
        return $this->publish_date;
    }

    /**
     * @param mixed $publish_date
     */
    public function setPublishDate($publish_date)
    {
        $this->publish_date = $publish_date;
    }



    /**
     * @return mixed
     */
    public function getInitialPrice()
    {
        return $this->initial_price;
    }

    /**
     * @param mixed $initial_price
     */
    public function setInitialPrice($initial_price)
    {
        $this->initial_price = $initial_price;
    }

    /**
     * @return mixed
     */
    public function getPriceText()
    {
        return $this->price_text;
    }

    /**
     * @param mixed $price_text
     */
    public function setPriceText($price_text)
    {
        $this->price_text = $price_text;
    }

    /**
     * @return mixed
     */
    public function getPriceValidity()
    {
        return $this->price_validity;
    }

    /**
     * @param mixed $price_validity
     */
    public function setPriceValidity($price_validity)
    {
        $this->price_validity = $price_validity;
    }

    /**
     * @return mixed
     */
    public function getPriceImages()
    {
        return $this->price_images;
    }

    /**
     * @param mixed $price_images
     */
    public function setPriceImages($price_images)
    {
        $this->price_images = $price_images;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getContactFullname()
    {
        return $this->contact_fullname;
    }

    /**
     * @param mixed $contact_fullname
     */
    public function setContactFullname($contact_fullname)
    {
        $this->contact_fullname = $contact_fullname;
    }

    /**
     * @return mixed
     */
    public function getContactEmail()
    {
        return $this->contact_email;
    }

    /**
     * @param mixed $contact_email
     */
    public function setContactEmail($contact_email)
    {
        $this->contact_email = $contact_email;
    }

    /**
     * @return mixed
     */
    public function getContactPhone()
    {
        return $this->contact_phone;
    }

    /**
     * @param mixed $contact_phone
     */
    public function setContactPhone($contact_phone)
    {
        $this->contact_phone = $contact_phone;
    }

    /**
     * @return mixed
     */
    public function getContactAddress()
    {
        return $this->contact_address;
    }

    /**
     * @param mixed $contact_address
     */
    public function setContactAddress($contact_address)
    {
        $this->contact_address = $contact_address;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getNbViews()
    {
        return $this->nb_views;
    }

    /**
     * @param mixed $nb_views
     */
    public function setNbViews($nb_views)
    {
        $this->nb_views = $nb_views;
    }

    /**
     * @return mixed
     */
    public function getPaymentVisa()
    {
        return $this->payment_visa;
    }

    /**
     * @param mixed $payment_visa
     */
    public function setPaymentVisa($payment_visa)
    {
        $this->payment_visa = $payment_visa;
    }

    /**
     * @return mixed
     */
    public function getPaymentPaypal()
    {
        return $this->payment_paypal;
    }

    /**
     * @param mixed $payment_paypal
     */
    public function setPaymentPaypal($payment_paypal)
    {
        $this->payment_paypal = $payment_paypal;
    }

    /**
     * @return mixed
     */
    public function getPaymentBank()
    {
        return $this->payment_bank;
    }

    /**
     * @param mixed $payment_bank
     */
    public function setPaymentBank($payment_bank)
    {
        $this->payment_bank = $payment_bank;
    }


    /**
     * @return mixed
     */
    public function getPaymentCashier()
    {
        return $this->payment_cashier;
    }

    /**
     * @param mixed $payment_cashier
     */
    public function setPaymentCashier($payment_cashier)
    {
        $this->payment_cashier = $payment_cashier;
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
     * @return mixed
     */
    public function getRegisterDate()
    {
        return $this->register_date;
    }

    /**
     * @param mixed $register_date
     */
    public function setRegisterDate($register_date)
    {
        $this->register_date = $register_date;
    }

    public function generateID(){
        $theNewCode = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789");
        $isFind = true;
        while ($isFind) {
            # Search the generate's ID in the table
            $sql = "SELECT idadvert FROM ".TBL_Adverts
                ." WHERE idadvert = '".$theNewCode."'";
            $num_rows = $this->getRows( $sql );

            /** Test de la valeur isFind */
            if( $num_rows > 0 ) {
                /* code existe*/
                $isFind = true;
            }else {
                /* ce code n'existe pas*/
                $isFind = false;
                break;
            }
        }
        return $theNewCode;
    }

    public function insert(){
        $this->setIdadvert($this->generateID());
        $query = "INSERT INTO ".TBL_Adverts
            ." VALUES('".$this->getIdadvert()."', "
            ."'".$this->secureField($this->getPseudo())."', '".$this->getCatId()."', '".$this->getCityName()
            ."', '".$this->secureField($this->getTitle())."', '".$this->secureField($this->getDescription())
            ."', ".$this->getValidity().", ".$this->getInitialPrice().", ".$this->getPriceText()
            .", ".$this->getPriceValidity().", ".$this->getPriceImages().", ".$this->getPrice()
            .", '".$this->secureField($this->getTags())."', '".$this->secureField($this->getContactFullname())
            ."', '".$this->secureField($this->getContactEmail())."', '".$this->secureField($this->getContactPhone())
            ."', '".$this->secureField($this->getContactAddress())."', 'online', '0', '".$this->getPaymentVisa()
            ."', '".$this->getPaymentPaypal()."', '".$this->getPaymentBank()."', '".$this->getPaymentCashier()
            ."', '0', null, null)";
        //echo $query;
        return $this->execute($query);
    }

    /** Liste des annonces d'un utilisateur
     * @return array|int|string
     */
    public function userList(){
        return $this->getData("SELECT idadvert, title, nb_views, city_name, publish_date, price, "
            ."(SELECT short_currency FROM ".TBL_Settings." LIMIT 1) AS short_currency, "
            ."(SELECT file_name FROM ".TBL_Images." img WHERE img.idadvert=ads.idadvert AND is_default=1) AS feature_image FROM "
            .TBL_Adverts." ads WHERE pseudo='".$this->getPseudo()
            ."' AND is_deleted=0");

    }

    /** Détails de l'annonce
     * @return array|int|string
     */
    public function adsDetails(){
        return $this->getData("SELECT * FROM ".
            TBL_Adverts." WHERE idadvert='".$this->getIdadvert()."' LIMIT 1");
    }

    /** Mise à jour des prix
     * @return bool
     */
    public function updatePrices(){
        return $this->execute("UPDATE ".TBL_Adverts." SET "
            ." price_text = ".$this->getPriceText().","
            ." price_validity = ".$this->getPriceValidity().","
            ." price_images = ".$this->getPriceImages().","
            ." price = ".$this->getPrice()
            ." WHERE idadvert='".$this->getIdadvert()."'");
    }

    /** Liste des annonces publiées/déseactivées d'un utilisateur
     * @return int|string
     */
    public function numberByStatus(){
        return $this->getRows("SELECT * FROM ".TBL_Adverts
            ." WHERE status='".$this->getStatus()
            ."' AND pseudo='".$this->getPseudo()
            ."' AND is_deleted=0");
    }

    /** Liste de toutes les annonces publiées
     * @return array|int|string
     */
    public function allOnline(){
        return $this->getData("SELECT * FROM ".TBL_Adverts
            ." WHERE status='online' AND is_deleted=0");
    }
}