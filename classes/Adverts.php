<?php
require_once 'Crud.php';

class Adverts extends Crud {
    public $idadvert;
    public $useremail;
    public $cat_id;
    public $title;
    public $description;
    public $date_published;
    public $close_published;
    public $status;
    public $payment_visa;
    public $payment_paypal;
    public $payment_cashier;
    public $location_id;
    public $is_deleted;

    /**
     * Adverts constructor.
     */
    public function __construct() {
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
    public function getDatePublished()
    {
        return $this->date_published;
    }

    /**
     * @param mixed $date_published
     */
    public function setDatePublished($date_published)
    {
        $this->date_published = $date_published;
    }

    /**
     * @return mixed
     */
    public function getClosePublished()
    {
        return $this->close_published;
    }

    /**
     * @param mixed $close_published
     */
    public function setClosePublished($close_published)
    {
        $this->close_published = $close_published;
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
    public function getLocationId()
    {
        return $this->location_id;
    }

    /**
     * @param mixed $location_id
     */
    public function setLocationId($location_id)
    {
        $this->location_id = $location_id;
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




}