<?php
/** Constantes pour les tables, au cas ou
* on veuille les préfixer sur un autre serveur,
* et éviter des les changer dans tous les autres scripts */

define('TBL_Adverts', 'adverts');
define('TBL_Categories', 'categories');
define('TBL_Images', 'images');
define('TBL_Settings', 'settings');
define('TBL_Users', 'users');

class DBConfig {
  private $_host = "localhost";
  private $_username = "advertize";
  private $_password = "veinght1";
  private $_database = "advertize";

  /* Connection Handle */
  protected $connection;

  public function __construct() {
    if( !isset($this->connection) ) {
      $this->connection = new mysqli($this->_host, $this->_username,
      $this->_password, $this->_database);

      if( !$this->connection ) {
        echo 'Cannot connect to database server';
        exit;
      }
    }
    return $this->connection;
  }
}
