<?php
require_once 'Database.php';

/** Configuration sur les tarifs */
class Settings extends Database {
    public $idsetting;
    public $is_default;
    public $text_limit;
    public $text_price;
    public $image_price;

    public function __construct(){
        parent::__construct();
    }

    public function setIdSetting($idsetting) {  $this->idsetting = $idsetting;  }
    public function getIdSetting(){ return $this->idsetting; }

    public function setIsDefault($is_default){ $this->is_default = $is_default; }
    public function getIsDefault(){ return $this->idsetting;    }

    public function setTextLimit($text_limit){  $this->text_limit = $text_limit;    }
    public function getTextLimit(){ return $this->text_limit;  }

    public function setTextPrice($text_price){  $this->text_price = $text_price;    }
    public function getTextPrice(){ return $this->text_price;   }

    public function setImagePrice($image_price){    $this->image_price = $image_price;  }
    public function getImagePrice(){    return $this->image_price;  }


}