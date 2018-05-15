<?php
require_once '_inc_header.php';
require_once '../classes/Settings.php';
$settings = new Settings();
$getSetting = $settings->getsettings();

require_once '../classes/Settingprices.php';
$categoriesLabel = array(
    "texte" => "Caract.",
    "duree" => "Jour(s)",
    "image" => "Image(s)"
);

if( isset($_GET['cat']) && !empty($_GET['cat'])){
    $settingprice = new Settingprices();
    $settingprice->setCategory($_GET['cat']);
    /*  Liste des tarifs associé à la catégorie $_GET['cat'] */
    $settingpricelist = $settingprice->getPricesPerCategory();
    if (!empty($_POST)){
        /*  Contrôle des formulaires    */
        $fieldStatus = true;
        if ( empty($_POST['min_value']) || ctype_digit($_POST['min_value'])===false ){
            $errors['error'] = "Valeur minimale incorrecte";
            $fieldStatus = false;
        }elseif ( empty($_POST['max_value']) || ctype_digit($_POST['max_value'])===false ){
            $errors['error'] = "Valeur maximale incorrecte";
            $fieldStatus = false;
        }elseif ( intval($_POST['min_value']) > intval($_POST['max_value']) ){
            $errors['error'] = "Valeurs incohérentes";
            $fieldStatus = false;
        }elseif ( empty($_POST['price']) || ctype_digit($_POST['price'])===false || intval($_POST['price']) < 1 ){
            $errors['error'] = "Valeur du prix incorrecte";
            $fieldStatus = false;
        }

        if ($fieldStatus===true){
            $settingprice->setMinValue($_POST['min_value']);
            $settingprice->setMaxValue($_POST['max_value']);
            $settingprice->setPrice($_POST['price']);
            $resulStatement = $settingprice->insert();
            if (true === $resulStatement){
                $library->alert("Tarif ajouté!");
                $_POST = array();
                unset($_POST);
                $library->doReloadPage();
            }else{
                $errors['error'] = $resulStatement;
            }
        }
    }
}

?>
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-md-offset-5">
                    <h3 class="section-title">TARIFS <?php echo $_GET['cat'] ?></h3>
                </div>
                <div class="col-sm-12 col-md-8 col-md-offset-2">
                    <?php $library->debug_errors( $errors); ?>
                    <form role="form" class="login-form" method="post"
                          action="<?php echo $_SERVER['PHP_SELF']; ?>?cat=<?php echo $_GET['cat'] ?>">
                        <div class="form-group col-sm-12 col-md-4">
                            <label for="min_value">Nombre min.</label>
                            <input type="text" class="form-control" id="min_value"
                                   placeholder="Nombre min" autofocus
                                   value="<?php echo $_POST['min_value']; ?>"
                                   name="min_value">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label for="max_value">Nombre max.</label>
                            <input type="text" class="form-control" id="max_value"
                                   placeholder="Nombre max"
                                   value="<?php echo $_POST['max_value']; ?>"
                                   name="max_value">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label for="price">Tarif.</label>
                            <input type="text" class="form-control" id="price"
                                   placeholder="Prix"
                                   value="<?php echo $_POST['price']; ?>"
                                   name="price">
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary"
                                    name="submit_setting" value="ok">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <!-- LISTE DES TARIFS -->
                <div class="col-sm-12 col-lg-8 col-lg-offset-2">
                    <table class="table table-hover table-condensed table-striped table-bordered">
                        <thead>
                        <th width="30" class="center">#</th>
                        <th class="center">Marges</th>
                        <th class="center">Prix</th>
                        <th class="center">...</th>
                        </thead>
                        <tbody>
                        <?php for($i=0; $i<sizeof($settingpricelist); $i++): ?>
                        <tr>
                            <td class="center"><?php echo $i+1; ?></td>
                            <td class="center">
                                <?php echo $settingpricelist[$i]['min_value']; ?> -
                                <?php echo $settingpricelist[$i]['max_value']; ?>
                                &nbsp;<?php echo $categoriesLabel[$_GET['cat']]; ?>
                            </td>
                            <td class="center">
                                <?php echo $settingpricelist[$i]['price']; ?>
                                &nbsp;<?php echo $getSetting[0]['short_currency']; ?>
                            </td>
                            <td class="center">
                                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=delete&id=<?php echo $settingpricelist[$i]['idprice']; ?>"
                                   class="btn btn-xs btn-danger">Supp.</a>
                            </td>
                        </tr>
                        <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php require_once '../_inc/_inc_footer.php'; ?>