<?php
require_once '_inc_header.php';
require_once '../classes/Users.php';
$fieldsStatus = true;
if(!empty($_POST)){
    $errors = array();
    /*controle du pseudo(aphanumérique avec underscore)*/
    if( empty($_POST['last_name']) ){
        $errors['error'] = "Le nom n'est pas valide";
        $fieldsStatus = false;
    }elseif( empty($_POST['first_name']) ){
        $errors['error'] = "Le prénoms n'est pas valide";
        $fieldsStatus = false;
    }elseif(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])){
        $errors['error'] = "Le pseudo n'est pas valide(Alphanumérique)";
        $fieldsStatus = false;
    }elseif(empty($_POST['user_mail']) || !filter_var($_POST['user_mail'], FILTER_VALIDATE_EMAIL)){
        $errors['error'] = "Votre email n'est pas valide.";
        $fieldsStatus =false;
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
        $newUser->setUserPassword("123456");
        $newUser->setLastName($_POST['last_name']);
        $newUser->setFirstName($_POST['first_name']);
        $newUser->setAddress("");
        $newUser->setPhones("");
        $newUser->setUserGroup($_POST['user_group']);
        $resultStmt = $newUser->insert();

        if( $resultStmt === true ){
            $library->alert("Utilisateur enregistré");
            $_POST = array();
            unset($_POST);
        } else {
            $errors['error'] = "$resultStmt";
        }

    }

}
?>
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-md-offset-2">
                <div class="page-login-form box">
                    <h3>Créer un compte utilisateur</h3>
                    <?php $library->debug_errors( $errors); ?>
                    <form role="form" class="login-form" method="post"
                          action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" placeholder="Nom"
                            value="<?php $library->inputData($_POST['last_name']) ?>"
                                   name="last_name" autofocus>
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="prenoms">Prénoms</label>
                            <input type="text" class="form-control" id="prenoms" placeholder="prenoms"
                                   value="<?php $library->inputData($_POST['first_name']) ?>"
                                   name="first_name">
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="user_mail">Pseudo</label>
                            <input type="text" class="form-control" id="pseudo"
                                   placeholder="Pseudo utilisateur"
                                   value="<?php $library->inputData($_POST['pseudo']) ?>"
                                   name="pseudo">
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="user_mail">Adresse mail</label>
                            <input type="email" class="form-control" id="user_mail"
                                   placeholder="Adresse mail"
                                   value="<?php $library->inputData($_POST['user_mail']) ?>"
                                   name="user_mail" />
                        </div>
                        <!--
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="address">Adresse</label>
                            <input type="text" class="form-control" id="address"
                                   placeholder="Adresse"
                                   value="<?php $library->inputData($_POST['address']) ?>">
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="phones">Téléphone</label>
                            <input type="text" class="form-control" id="phones" placeholder="Téléphone"
                                   value="<?php $library->inputData($_POST['phones']) ?>">
                        </div>
                        -->
                        <div class="form-group col-sm-12 col-lg-6">
                            <label class="radio-inline">
                                <input type="radio" name="user_group" id="inlineRadio1" value="manager" checked> Gestionnaire
                            </label>
                        </div>
                        <div class="form-group col-sm-12 col-lg-6">
                            <label class="radio-inline">
                                <input type="radio" name="user_group" id="inlineRadio2" value="admin"> Administrateur
                            </label>
                        </div>
                        <div class="form-group col-sm-12 col-lg-6 col-lg-offset-3 center">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                        <button class="btn btn-common log-btn" style="visibility: hidden;">Enregistrer</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<?php require_once '../_inc/_inc_footer.php'; ?>