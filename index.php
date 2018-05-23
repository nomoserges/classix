<?php
require_once 'lib/Functions.php';
$pageTitle = "Bienvenue";
include "_inc/_inc_header.php";
?>
<body>
<?php include '_inc/_inc_navbar.php'; ?>
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



<?php include '_inc/_inc_footer.php'; ?>
