<?php
require_once 'lib/Functions.php';
$pageTitle = "Inscription";
require_once "_inc/_inc_header.php";
?>
<body>
<?php
require_once '_inc/_inc_navbar.php';
require_once 'classes/Users.php';
$fieldsStatus = true;
if(!empty($_POST)){
    $errors = array();
    /*controle du pseudo(aphanumérique avec underscore)*/
    if(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])){
        $errors['error'] = "Le pseudo n'est pas valide(Alphanumérique)";
        $fieldsStatus = false;
    }elseif(empty($_POST['user_mail']) || !filter_var($_POST['user_mail'], FILTER_VALIDATE_EMAIL)){
        $errors['error'] = "Votre email n'est pas valide.";
        $fieldsStatus =false;
    }elseif( empty($_POST['user_password']) ){
        $errors['error'] = "Renseigner le mot de passe.";
        $fieldsStatus = false;
    }elseif( strlen($_POST['user_password']) < 6 ){
        $errors['error'] = "Mot de passe: 6 caractères min.";
        $fieldsStatus = false;
    }elseif($_POST['user_password'] <> $_POST['confirm_password']){
        $errors['error'] = "Les mots de passe ne correspondent pas.";
        $fieldsStatus = false;
    }
    /*  Vérification si le pseudo existe déjà */
    $newUser = new Users();
    $newUser->setPseudo($_POST['pseudo']);
    $newUser->setUserMail($_POST['user_mail']);
    if( $newUser->_credentialsAlready() === true){
        $errors['error'] = "Email / Pseudo déjà pris.";
        $fieldsStatus = false;
    }

    if( true === $fieldsStatus ) {
        $newUser->setPseudo($_POST['pseudo']);
        $newUser->setUserMail($_POST['user_mail']);
        $newUser->setUserPassword($_POST['user_password']);
        $newUser->setLastName("");
        $newUser->setFirstName("");
        $newUser->setAddress("");
        $newUser->setPhones("");
        $newUser->setUserGroup("customer");
        $resultStmt = $newUser->insert();

        if( $resultStmt === true ){
            $newUser->_setSession();
            $library->goBack();
        } else {
            $errors['error'] = "$resultStmt";
        }

    }

}
?>

<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
        <div class="page-login-form box">
          <h3>Session déjà ouverte</h3>
          <ul class="form-links">
            <li class="pull-left"><a href="./">Retour au site</a></li>
            <li class="pull-right"><a href="signout.php">Fermer la session</a></li>
          </ul>
        </div>
        <?php else: ?>
        <div class="page-login-form box">
        <h3>Inscription</h3>
            <?php $library->debug_errors( $errors); ?>
        <form role="form" class="login-form" method="post"
              action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="form-group is-empty">
            <div class="input-icon">
            <i class="icon fa fa-user"></i>
            <input type="text" class="form-control" name="pseudo" placeholder="Pseudo"
            value="<?php $library->inputData($_POST['pseudo']); ?>"
            >
            </div>
            <span class="material-input"></span></div>
          <div class="form-group is-empty">
            <div class="input-icon">
            <i class="icon fa fa-envelope"></i>
            <input type="text" class="form-control" name="user_mail" placeholder="Adresse mail"
                   value="<?php $library->inputData($_POST['user_mail']); ?>" />
            </div>
            <span class="material-input"></span>
          </div>
          <div class="form-group is-empty">
            <div class="input-icon">
            <i class="icon fa fa-unlock-alt"></i>
            <input type="password" class="form-control" placeholder="Mot de passe"
                   name="user_password">
            </div>
            <span class="material-input"></span>
          </div>
          <div class="form-group is-empty">
            <div class="input-icon">
            <i class="icon fa fa-unlock-alt"></i>
            <input type="password" class="form-control"
            placeholder="Confirmez" name="confirm_password">
          </div>
          <span class="material-input"></span></div>
          <div class="checkbox">
          <input type="checkbox" id="remember" name="rememberme" value="forever" style="float: left;">
          <label for="remember">By creating account you agree to our Terms &amp; Conditions</label>
          </div>
          <button class="btn btn-common log-btn">S'inscrire</button>
        </form>
        </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
<?php include '_inc/_inc_footer.php'; ?>
