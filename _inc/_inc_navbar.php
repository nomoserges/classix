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
        <li><a href="./"></i>Accueil</a></li>
        <li><a href="categories.php">Categories</a></li>
        <li><a href="localisations.php">Localisations</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="postadd">
          <a class="btn btn-danger btn-post" href="posts_ads.php">
            Publier
          </a>
        </li>
        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
        <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
              <strong>
            <?php echo $_SESSION['user']['pseudo']; ?>
              </strong>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="account_home.php">Mon profil</a></li>
            <?php if($_SESSION['user']['user_group'] === "admin" || $_SESSION['user']['user_group'] === "gestionnaire"): ?>
            <li><a href="admin/">Espace admin</a></li>
            <?php endif; ?>
            <li role="separator" class="divider"></li>
            <li><a href="signout.php">Déconnexion</a></li>
          </ul>
        </li>
        <?php else: ?>
        <li><a href="login.php"></i>Connexion</a></li>
        <li><a href="register.php">S'inscrire</a></li>
        <?php endif; ?>
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
