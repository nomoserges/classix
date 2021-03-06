<?php
/** Constantes pour les tables, au cas ou
* on veuille les préfixer sur un autre serveur,
* et éviter des les changer dans tous les autres scripts
**/

define('TBL_Regions', 'regions');
define('TBL_Cities', 'cities');
define('TBL_Adverts', 'adverts');
define('TBL_Categories', 'categories');
define('TBL_Images', 'images');
define('TBL_Settings', 'settings');
define('TBL_Settings_Prices', 'settings_prices');
define('TBL_Users', 'users');

/**
 * Class CRUD (Create - Read - Update - Delete)
 */
class Crud {

  private $_host = "localhost";
  private $_username = "advertize";
  private $_password = "*c218*";
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

  /** Proteger une requete de la presence
   * des caracteres speciaux.
   * @param $value : commade sql.
   * @return $texte : returne le texte.
   */
    /*private function escape_string($value) {
        return $this->connection->real_escape_string($value);
        return $value;
    }*/
  /** Recuperation des données
   * @param $query: requete a executer
   */
  public function getData($query) {
    $result = $this->connection->query($query);
    if($result === false) {
        return $this->connection->error;
    }else{
        if( $result->num_rows == 0 ) {
            return 0;
        }else {
            /*  Tableau qui contiendra les données  */
            $rows = array();
            /*  Parcours des données et encapsulation dans le tableau*/
            while ($row = $result->fetch_assoc()) {   $rows[] = $row; }
            return $rows;
        }
    }

  }
    /** Retourner le nombre de lignes d'une requete de type select
     * @param $query: requete sql de type SELECT
     * @return : nombre de lignes renvoyées
     */
    public function getRows($query){
        $result = $this->connection->query($query);
        if ($result == false) {
            return $this->connection->error;
        }else{
            return $result->num_rows;
        }
    }

  /**   Execution d'une requete de type Insert/Update/Delete.
   * @param $query : texte de la requete.
   * @return boolean : etat d'execution.
   */
  public function execute($query) {
    $result = $this->connection->query($query);
    if ($result == false) {
        return $this->connection->error;
    } else { return true; }
  }

    /** Gestion des slashes et caractères spéciaux dans les formulaires
     * @param $input
     * @return string
     */
  public function secureField($input){
      return addslashes(htmlentities($input));
  }

    public function mysqlDateToFrench($dateInput){
        /* On sépare la date de l'heure avec le caractère espace */
        $x = explode(" ", $dateInput);
        /*  On reconverti la date au format dd/mm/aaa   */
        $frenchDate = explode("-", $x[0]);
        echo $frenchDate[2]."/".$frenchDate[1]."/".$frenchDate[0]." à ".$x[1];
  }
}
