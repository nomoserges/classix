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
    if(empty($_POST['last_name'])||strlen($_POST['last_name'])<3||ctype_alnum($_POST['last_name'])===false){
        $errors['error'] = "Le nom n'est pas valide!";
        $fieldsStatus = false;
    }elseif(empty($_POST['first_name'])||strlen($_POST['first_name'])<3||ctype_alnum($_POST['first_name'])===false){
        $errors['error'] = "Le prénom n'est pas valide";
        $fieldsStatus = false;
    }elseif(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])){
        $errors['error'] = "Le pseudo n'est pas valide(Alphanumérique et \"_\")";
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
        $newUser->setPseudo($library->secureField($_POST['pseudo']));
        $newUser->setUserMail($library->secureField($_POST['user_mail']));
        $newUser->setUserPassword($library->secureField($_POST['user_password']));
        $newUser->setLastName($library->secureField($_POST['last_name']));
        $newUser->setFirstName($library->secureField($_POST['first_name']));
        $newUser->setAddress($library->secureField(""));
        $newUser->setPhones($library->secureField(""));
        $newUser->setUserGroup($library->secureField($_POST['user_group']));
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
      <div class="col-sm-12 col-md-6 col-md-offset-3">
        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
        <div class="page-login-form box">
            <h3>Session déjà ouverte</h3>
            <ul class="form-links">
                <li class="pull-left"><a href="./">Retour au site</a></li>
                <li class="pull-right"><a href="signout.php">Fermer la session</a></li>
            </ul>
        </div>
        <?php else: ?>
        <div class="page-login-form box col-">
        <h3>Inscription</h3>
            <?php $library->debug_errors( $errors); ?>
        <form role="form" class="login-form" method="post"
              action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group is-empty col-sm-12 col-lg-6">
                <div class="input-icon">
                    <i class="icon fa fa-user"></i>
                    <input type="text" class="form-control" name="last_name" placeholder="Votre nom"
                           value="<?php $library->inputData($_POST['last_name']); ?>" />
                </div>
                <span class="material-input"></span>
            </div>
            <div class="form-group is-empty col-sm-12 col-lg-6">
                <div class="input-icon">
                    <i class="icon fa fa-user"></i>
                    <input type="text" class="form-control" name="first_name" placeholder="Prénoms"
                           value="<?php $library->inputData($_POST['first_name']); ?>" />
                </div>
                <span class="material-input"></span>
            </div>
            <div class="form-group col-sm-12">
                <div class="radio col-sm-12 col-lg-6">
                    <label for="personal" class="checkbox-inline">
                        <input type="radio" name="user_group" checked
                               id="personal" value="personnel" />Compte personnel</label>
                </div>
                <div class="radio col-sm-12 col-lg-6">
                    <br>
                    <label for="enterprise" class="checkbox-inline">
                        <input type="radio" name="user_group"
                               id="enterprise" value="entreprise" />Compte entreprise</label>
                </div>
            </div>
            <div class="form-group is-empty col-sm-12 col-lg-6">
                <div class="input-icon">
                    <i class="icon fa fa-user"></i>
                    <input type="text" class="form-control" name="pseudo" placeholder="Pseudo"
                    value="<?php $library->inputData($_POST['pseudo']); ?>" />
                </div>
                <span class="material-input"></span>
            </div>
            <div class="form-group is-empty col-sm-12 col-lg-6">
                <div class="input-icon">
                    <i class="icon fa fa-envelope"></i>
                    <input type="text" class="form-control" name="user_mail" placeholder="Adresse mail"
                           value="<?php $library->inputData($_POST['user_mail']); ?>" />
                </div>
                <span class="material-input"></span>
            </div>
            <div class="form-group is-empty col-sm-12 col-lg-6">
                <div class="input-icon">
                    <i class="icon fa fa-unlock-alt"></i>
                    <input type="password" class="form-control" placeholder="Mot de passe"
                           name="user_password" />
                </div>
                <span class="material-input"></span>
            </div>
            <div class="form-group is-empty col-sm-12 col-lg-6">
                <div class="input-icon">
                    <i class="icon fa fa-unlock-alt"></i>
                    <input type="password" class="form-control"
                    placeholder="Confirmez" name="confirm_password" />
                </div>
                <span class="material-input"></span>
            </div>
            <div class="form-group col-sm-12">
                <div class="checkbox">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="rememberRegister" name="rememberme"
                               value="accept">J'accepte les termes et conditions d'utilisation</a>
                    </label>
                </div>
            </div>
            <button class="btn btn-common log-btn col-sm-12 col-md-4">S'inscrire</button>
        </form>
            <span class="center">
                <a href="login.php">Je dispose déjà d'un compte</a>
            </span>
        </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
<?php include '_inc/_inc_footer.php'; ?>
