<?php
require_once '_inc_header.php';
require_once '../classes/Settings.php';

$settings = new Settings();
$getSetting = $settings->getsettings();
/* Valeur du bouton de soumission et son texte
    en fonction de la création ou la mise à jour
    des paramètres
*/
$btnSubmitValue = "insert";
$btnSubmitText = " Créer les paramètres";
if( sizeof($getSetting) > 0){
    $btnSubmitValue = "update";
    $btnSubmitText = " Mettre à jour";
}
/*  Tableau de valeur des paramètres    */
$setting = array(
    "country_code" => $getSetting[0]['country_code'],
    "country_name"  => $getSetting[0]['country_name'],
    "phone_indicator"  => $getSetting[0]['phone_indicator'],
    "currency"  => $getSetting[0]['currency'],
    "short_currency"  => $getSetting[0]['short_currency']
);
/*  Soumission du formulaire    */
if (!empty($_POST)){
    $setting = array(
        "country_code" => $_POST['country_code'],
        "country_name"  => $_POST['country_name'],
        "phone_indicator"  => $_POST['phone_indicator'],
        "currency"  => $_POST['currency'],
        "short_currency"  => $_POST['short_currency']
    );
    /*  Contrôle des formulaires    */
    $fieldStatus = true;
    if ( empty($_POST['country_code'])||strlen($_POST['country_code']) > 4 ){
        $errors['error'] = "Code pays incorrect";
        $fieldStatus = false;
    }elseif ( empty($_POST['country_name'])||strlen($_POST['country_name']) < 3 ){
        $errors['error'] = "Nom de pays incorrect";
        $fieldStatus = false;
    }elseif ( empty($_POST['phone_indicator'])||strlen($_POST['phone_indicator']) > 4 ){
        $errors['error'] = "Indicateur téléphonique incorrect";
        $fieldStatus = false;
    }elseif ( empty($_POST['currency'])||strlen($_POST['currency']) > 20 ){
        $errors['error'] = "Dévise incorrecte";
        $fieldStatus = false;
    }elseif ( empty($_POST['short_currency'])||strlen($_POST['short_currency']) > 4 ){
        $errors['error'] = "Abréviation de dévise incorrecte";
        $fieldStatus = false;
    }

    if ( $fieldStatus === true){
        $settings->setCountryCode($_POST['country_code']);
        $settings->setCountryName($_POST['country_name']);
        $settings->setPhoneIndicator($_POST['phone_indicator']);
        $settings->setCurrency($_POST['currency']);
        $settings->setShortCurrency($_POST['short_currency']);
        switch ($_POST['submit_setting']){
            case 'insert':
                $settings->insert();
                $library->alert("Paramètres enregistrés");
                break;
            case 'update':
                $settings->update();
                $library->alert("Paramètres mis à jour");
                break;
        }
        $library->doReloadPage();
    }

}
?>
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-8 col-lg-offset-2">
                <div class="page-login-form box">
                    <h3>PARAMÈTRES DU SITE</h3>
                    <?php $library->debug_errors( $errors); ?>
                    <form role="form" class="login-form" method="post"
                          action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group col-sm-12 col-lg-2">
                            <label for="countrycode">Code pays</label>
                            <input type="text" class="form-control" id="countrycode"
                                   value="<?php if($setting['country_code']!=null) echo $setting['country_code']; ?>"
                                   name="country_code" autofocus>
                        </div>
                        <div class="form-group col-sm-12 col-lg-4">
                            <label for="countryname">Nom du pays</label>
                            <input type="text" class="form-control" id="countryname"
                                   placeholder="Nom du pays"
                                   value="<?php if($setting['country_name']!=null) echo $setting['country_name']; ?>"
                                   name="country_name">
                        </div>
                        <div class="form-group col-sm-12 col-lg-2">
                            <label for="phoneindicator">Indicateur Tél</label>
                            <input type="text" class="form-control" id="phoneindicator"
                                   value="<?php if($setting['phone_indicator']!=null) echo $setting['phone_indicator']; ?>"
                                   name="phone_indicator">
                        </div>
                        <div class="form-group col-sm-12 col-lg-2">
                            <label for="currency">Dévise</label>
                            <input type="text" class="form-control" id="currency"
                                   placeholder="Dévise"
                                   value="<?php if($setting['currency']!=null) echo $setting['currency']; ?>"
                                   name="currency">
                        </div>
                        <div class="form-group col-sm-12 col-lg-2">
                            <label for="short_currency">Dévise Abr.</label>
                            <input type="text" class="form-control" id="short_currency"
                                   placeholder="Abréviation dévise"
                                   value="<?php if($setting['short_currency']!=null) echo $setting['short_currency']; ?>"
                                   name="short_currency">
                        </div>
                        <div class="form-group col-sm-12 col-lg-6 col-lg-offset-3 center">
                            <button type="submit" class="btn btn-primary"
                                    name="submit_setting" value="<?php echo $btnSubmitValue; ?>"><?php echo $btnSubmitText; ?></button>
                        </div>
                        <button class="btn btn-common log-btn" style="visibility: hidden;">Enregistrer</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<?php require_once '../_inc/_inc_footer.php'; ?>