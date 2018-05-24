<?php
require_once 'lib/Functions.php';
$pageTitle = "Bienvenue";
include "_inc/_inc_header.php";
?>
<body>
<?php
include '_inc/_inc_navbar.php';
require_once 'classes/Adverts.php';
require_once 'classes/Categories.php';
require_once 'classes/Users.php';
require_once 'classes/Cities.php';
$annonces = new Adverts();
$countAds = sizeof($annonces->allOnline());
$categories = new Categories();
$countCat = sizeof($categories->allCategories());
$users = new Users();
$countUsers = sizeof($users->frontendUsers());
$cities = new Cities();
$countCities = sizeof($cities->getList());
?>

<section id="intro" class="section-intro" style="margin-top:-20px;">
  <div class="overlay">
    <div class="container">
      <div class="main-text">
      <h1 class="intro-title">Bienvenue sur <span style="color: #3498DB">Advertize</span></h1>
          <?php //var_dump($_SESSION['user']); ?>
      <p>Achetez ou vender n'importe quoi d'une voiture
        utilisée à un téléphone portable et un ordinateur,  ou effectuer
        une recherche.
      </p>
        <div class="row search-bar">
          <div class="advanced-search">
            <form class="search-form" method="post" action="search.php">
              <div class="col-lg-9 col-sm-12 search-col">
                <div class="form-group is-empty">
                  <input class="form-control keyword" name="keyword" value=""
                  placeholder="Rechercher une catégorie, une place, mot(s) clé(s)" type="text">
                  <span class="material-input"></span>
                </div>
                <!--<i class="fa fa-search"></i>-->
              </div>
              <div class="col-lg-3 col-sm-12 search-col">
                <button class="btn btn-common btn-search btn-block"><strong>Search</strong></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="location">
    <div class="container">
        <div class="row localtion-list">
            <div class="col-md-2 col-sm-12">&nbsp;</div>
            <div class="col-md-8 col-sm-12 col-xs-12 wow fadeInLeft animated" data-wow-delay="0.5s" style="visibility: visible;-webkit-animation-delay: 0.5s; -moz-animation-delay: 0.5s; animation-delay: 0.5s;">
                <h3 class="title-2"><i class="fa fa-envelope"></i> Souscription à la newsletter</h3>
                <form id="subscribe" action="http://demo.graygrids.com/themes/classix-demo/index.html">
                    <p>
                        Rejoignez plus de 10 000 de nos abonnés et accédez aux dernieres annonces et ressources!
                    </p>
                    <div class="subscribe">
                        <div class="form-group is-empty">
                            <input class="form-control" name="EMAIL" placeholder="Votre adresse mail ici"
                                   required="" type="email">
                            <span class="material-input"></span>
                        </div>
                        <button class="btn btn-common" type="submit">Souscrire</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2 col-sm-12">&nbsp;</div>
        </div>
    </div>
</section>

<section id="counter">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick animated" data-wow-delay=".5s" style="visibility: visible;-webkit-animation-delay: .5s; -moz-animation-delay: .5s; animation-delay: .5s;">
                    <div class="icon">
                        <span>
                        <i class="lnr lnr-tag"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter"><?php echo $countAds; ?></h3>
                        <p>Annonces</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick animated" data-wow-delay="1s" style="visibility: visible;-webkit-animation-delay: 1s; -moz-animation-delay: 1s; animation-delay: 1s;">
                    <div class="icon">
                        <span>
                        <i class="lnr lnr-map"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter"><?php echo $countCities; ?></h3>
                        <p>Localisations</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick animated" data-wow-delay="1.5s" style="visibility: visible;-webkit-animation-delay: 1.5s; -moz-animation-delay: 1.5s; animation-delay: 1.5s;">
                    <div class="icon">
                        <span>
                        <i class="lnr lnr-users"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter"><?php echo $countUsers; ?></h3>
                        <p>Clients reguliers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick animated" data-wow-delay="2s" style="visibility: visible;-webkit-animation-delay: 2s; -moz-animation-delay: 2s; animation-delay: 2s;">
                    <div class="icon">
                        <span>
                        <i class="lnr lnr-license"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter"><?php echo $countCat; ?></h3>
                        <p>Catégories</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '_inc/_inc_footer.php'; ?>
