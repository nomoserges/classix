<?php
require_once '../lib/Functions.php';
/*  Vérification de la session  */
if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
    session_destroy();
    header("Location: ".$library->getServerHost()."login.php");
}else{
    /* La session existe, on vérifie l'autorisation d'accès */
    if( $_SESSION['user']['user_group'] === 'customer') {
        header("Location: ".$library->getServerHost()."index.php");
    }
}
$pageTitle= "Panel admin";
require_once "../_inc/_inc_header.php";
?>
<body>
<div class="header" style="margin-bottom: 100px;">
    <nav class="navbar navbar-default main-navigation navbar-fixed-top"
         role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="./"><img src="assets/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="./">Accueil</a></li>
                    <li><a href="adm_regions.php">Localisations</a></li>
                    <li><a href="adm_categories.php">Categories</a></li>
                    <li><a href="adm_ads.php">Annonces</a></li>
                    <li>
                        <a href data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">Paramètres
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="adm_settings.php">Infos Générales</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="adm_settings_prices.php?cat=texte">Tarifs textes</a></li>
                            <li><a href="adm_settings_prices.php?cat=duree">Tarifs durées</a></li>
                            <li><a href="adm_settings_prices.php?cat=image">Tarifs images</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href class="dropdown-toggle" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">Utilisateurs
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if("admin" === $_SESSION['user']['user_group']): ?>
                            <li><a href="adm_add_user.php">Ajouter</a></li>
                            <li role="separator" class="divider"></li>
                            <?php endif; ?>
                            <li><a href="adm_users.php?group=gestionnaire">Gestionnaires</a></li>
                            <li><a href="adm_users.php?group=admin">Administrateurs</a></li>
                            <li><a href="adm_users.php?group=personnel">Individus</a></li>
                            <li><a href="adm_users.php?group=entreprise">Entreprises</a></li>
                        </ul>
                    </li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <strong>
                            <?php echo $_SESSION['user']['pseudo']; ?>
                            </strong>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="../account_home.php">Mon profil</a></li>
                            <li><a href="../">Site web</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../signout.php">Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--
      <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumb-wrapper">
                <h2 class="page-title" style="color:black;">Login to account</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    -->
</div>
