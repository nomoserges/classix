<?php
require_once 'lib/Functions.php';
$pageTitle = "Connexion";
include "_inc/_inc_header.php";
?>
<body>
<?php
require_once '_inc/_inc_navbar.php';
require_once 'classes/Users.php';

/* Statut de validation des champs, initialisé à vrai  */
$fieldsStatus = true;
if( !empty($_POST) ){
    /* Tableau des erreurs du formulaire    */
    $errors = array();
    if( empty($_POST['username']) ){
        $errors['email'] = "Pseudo ou email incorrect.";
        $fieldsStatus = false;
    }
    if( empty($_POST['user_password']) ){
        $errors['password'] = "Renseigner le mot de passe.";
        $fieldsStatus = false;
    }
    /*  Tous les champs sont ok, on peut vérifier sur la BD */
    if( true === $fieldsStatus ){
        $connectUser = new Users();
        $connectUser->setPseudo($_POST['username']);
        $connectUser->setUserMail($_POST['username']);
        $connectUser->setUserPassword($_POST['user_password']);
        $resultStmt = $connectUser->doLogin();
        //var_dump($resultStmt);
        if ($resultStmt === 0) {
            $library->alert("Email ou mot de passe introuvable");
            $_POST = array();
            unset($_POST);
            $library->doReloadPage();
        } else {
            $resultStmt[0];
            $connectUser->setPseudo($resultStmt[0]['pseudo']);
            $connectUser->setUserMail($resultStmt[0]['user_mail']);
            $connectUser->setLastName($resultStmt[0]['last_name']);
            $connectUser->setFirstName($resultStmt[0]['first_name']);
            $connectUser->setAddress($resultStmt[0]['address']);
            $connectUser->setPhones($resultStmt[0]['phones']);
            $connectUser->setUserGroup($resultStmt[0]['user_group']);
            $connectUser->_setSession();
            $library->goBack();
        }

    }
}

?>
<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-4 col-md-4 col-md-offset-4">
        <?php   if( !isset($_SESSION['user']) || empty($_SESSION['user']) ): ?>
        <div class="page-login-form box">
          <h3>Login</h3>
          <?php $library->debug_errors( $errors); ?>
          <form role="form" class="login-form" method="post" action="">
            <div class="form-group is-empty">
              <div class="input-icon">
                <i class="icon fa fa-user"></i>
                <input type="text" id="sender-email" class="form-control"
                name="username" placeholder="Email / Pseudo"
                       value="<?php $library->inputData($_POST['username']); ?>">
              </div>
              <span class="material-input"></span>
            </div>
            <div class="form-group is-empty">
              <div class="input-icon">
                <i class="icon fa fa-unlock-alt"></i>
                <input type="password" class="form-control"
                       placeholder="Mot de passe" name="user_password" />
              </div>
              <span class="material-input"></span>
            </div>
            <div class="checkbox">
              <input type="checkbox" id="remember" name="rememberme"
              value="forever" style="float: left;">
              <label for="remember">Se souvenir de moi</label>
            </div>
            <button class="btn btn-common log-btn">Submit</button>
          </form>
          <ul class="form-links">
            <li class="pull-left"><a href="#">Créer un compte</a></li>
            <li class="pull-right"><a href="#">Mot de passe oublié ?</a></li>
          </ul>
        </div>
        <?php else: ?>
        <div class="page-login-form box">
          <h3>Choix d'accès</h3>
          <ul class="form-links">
            <li class="pull-left"><a href="/">Aller vers le site</a></li>
            <?php if($_SESSION['user']['user_group']== 'admin' || $_SESSION['user']['user_group']== 'manager'): ?>
            <li class="pull-right"><a href="admin/">Panel administration</a></li>
            <?php else: ?>
            <li class="pull-right"><a href="account_home.php">Mon profil</a></li>
            <?php endif; ?>
          </ul>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php include '_inc/_inc_footer.php'; ?>
