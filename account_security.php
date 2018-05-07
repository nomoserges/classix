<?php
require_once 'lib/Functions.php';
if(!isset($_SESSION['user'])||empty($_SESSION['user']['pseudo'])){
    $library->openUrl($library->getServerHost());
}
$pageTitle = "Mon espace - Sécurité";
require_once "_inc/_inc_header.php";
?>
<body>
<?php
require_once '_inc/_inc_navbar.php';
require_once 'classes/Users.php';
$userOnline = new Users();

/*  Soumission du formulaire securite */
if(isset($_POST['form_security']) && $_POST['form_security'] == "ok"){
    $securityErrors = array();
    $fieldsStatus = true;
    if( empty($_POST['user_password']) ){
        $securityErrors['error'] = "Renseigner le mot de passe.";
        $fieldsStatus = false;
    }elseif( strlen($_POST['user_password']) < 6 ){
        $securityErrors['error'] = "Mot de passe: 6 caractères min.";
        $fieldsStatus = false;
    }elseif($_POST['user_password'] <> $_POST['confirm_password']){
        $securityErrors['error'] = "Les mots de passe ne correspondent pas.";
        $fieldsStatus = false;
    }

    if( true === $fieldsStatus ) {
        $userOnline->setUserPassword($_POST['user_password']);
        $userOnline->setPseudo($_SESSION['user']['pseudo']);
        $userOnline->setUserMail($_SESSION['user']['email']);
        $resultStmt = $userOnline->changePassword();
        if( $resultStmt === true ){
            $library->alert("Mot de passe changé");
            $library->doReloadPage();
        } else {
            $securityErrors['error'] = $resultStmt;
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
                        <!-- Mot de passe -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#collapseB2" data-toggle="collapse"> Sécurité </a>
                                </h4>
                            </div>
                            <div aria-expanded="false" class="panel-collapse collapse in" id="collapseB2">
                                <div class="panel-body">
                                    <?php $library->debug_errors($securityErrors); ?>
                                    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <div class="form-group col-sm-12 col-lg-6">
                                            <label class="control-label">Nouveau mot de passe</label>
                                            <input class="form-control" name="user_password" type="password">
                                            <span class="material-input"></span>
                                        </div>
                                        <div class="form-group col-sm-12 col-lg-6">
                                            <label class="control-label">Confirmez</label>
                                            <input class="form-control" name="confirm_password" type="password">
                                            <span class="material-input"></span>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <button type="submit" class="btn btn-common"
                                                    name="form_security" value="ok">Changer le mot de passe</button>
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
