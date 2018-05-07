<?php
require_once 'lib/Functions.php';
if(!isset($_SESSION['user'])||empty($_SESSION['user']['pseudo'])){
    $library->openUrl($library->getServerHost());
}
$pageTitle = "Mon espace";
require_once "_inc/_inc_header.php";
?>
<body>
<?php
require_once '_inc/_inc_navbar.php';
require_once 'classes/Users.php';
$userOnline = new Users();
/*  Soumission du formulaire details */

if( isset($_POST['form_details']) ){
    $errors = array();
    $fieldsStatus = true;

    if(!empty($_POST['first_name']) && strlen($_POST['first_name']) < 2){
        $errors['error'] = "Votre prénoms n'est pas valide.";
        $fieldsStatus =false;
    }elseif(!empty($_POST['last_name']) && strlen($_POST['last_name']) < 2){
        $errors['error'] = "Votre nom n'est pas valide.";
        $fieldsStatus =false;
    }elseif(!empty($_POST['address']) && strlen($_POST['address']) < 2){
        $errors['error'] = "Votre adresse n'est pas valide.";
        $fieldsStatus =false;
    }elseif(!empty($_POST['phones']) && strlen($_POST['phones']) < 8){
        $errors['error'] = "Votre téléphone n'est pas valide.";
        $fieldsStatus =false;
    }
    if( true === $fieldsStatus ) {
        $userOnline->setPseudo($_SESSION['user']['pseudo']);
        $userOnline->setUserMail($_SESSION['user']['email']);
        $userOnline->setLastName($_POST['last_name']);
        $userOnline->setFirstName($_POST['first_name']);
        $userOnline->setAddress($_POST['address']);
        $userOnline->setPhones($_POST['phones']);
        $userOnline->setUserGroup($_SESSION['user']['user_group']);
        $resultStmt = $userOnline->updateDetails();

        if( $resultStmt === true ){
            $library->alert("Informations enregistrées !");
            $userOnline->_setSession();
            $library->doReloadPage();
        } else {
            $errors['error'] = $resultStmt;
        }
    }
}

?>
<div id="content">
  <div class="container">
    <div class="row">
      <?php include '_inc/_inc_account_menu.php'; ?>
      <div class="col-sm-12 col-lg-9 page-content">

        <div class="inner-box">
        <div class="welcome-msg">
          <h3 class="page-sub-header2 clearfix no-padding">
              Hello <?php echo $_SESSION['user']['prenoms']." ".$_SESSION['user']['nom']; ?>
          </h3>
        </div>
        <div id="accordion" class="panel-group">
          <!--  Informations utilisateur -->
          <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a href="#collapseB1" data-toggle="collapse"> Mes details </a>
            </h4>
          </div>
          <div class="panel-collapse collapse in" id="collapseB1">
            <div class="panel-body">
              <?php $library->debug_errors($errors); ?>
              <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                <div class="form-group col-sm-12 col-lg-6">
                    <label class="control-label">Prénoms</label>
                    <input class="form-control" name="first_name"
                           value="<?php echo html_entity_decode($_SESSION['user']['prenoms']); ?>"
                           type="text">
                </div>
                <div class="form-group col-sm-12 col-lg-6">
                    <label class="control-label">Nom</label>
                    <input class="form-control" name="last_name"
                         value="<?php echo html_entity_decode($_SESSION['user']['nom']); ?>" type="text">
                </div>
                <div class="form-group col-sm-12 col-lg-6">
                    <label class="control-label">Adresse</label>
                    <input class="form-control" name="address"
                         value="<?php echo html_entity_decode($_SESSION['user']['adresse']); ?>"
                           type="text">
                </div>
                <div class="form-group col-sm-12 col-lg-6">
                    <label for="Phone" class="control-label">Téléphone</label>
                    <input class="form-control" name="phones"
                         value="<?php echo html_entity_decode($_SESSION['user']['telephones']); ?>"
                           type="text">
                </div>
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-common"
                            name="form_details" value="ok">Mettre à jour</button>
                </div>
            </form>
            </div>
          </div>
        </div>

        </div>
      </div>
      </div>
    </div>
  </div>
</div>


<?php include '_inc/_inc_footer.php'; ?>
