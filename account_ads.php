<?php
require_once 'lib/Functions.php';
if(!isset($_SESSION['user'])||empty($_SESSION['user']['pseudo'])){
    $library->openUrl($library->getServerHost()."login.php");
}
$pageTitle = "Mes annonces";
require_once "_inc/_inc_header.php";
require_once "classes/Adverts.php";
?>
<body>
<?php
include '_inc/_inc_navbar.php';
$annonces = new Adverts();
$annonces->setStatus("online");
$annonces->setPseudo($_SESSION['user']['pseudo']);
$listeAnnonces = $annonces->userList();

if (isset($_GET['action']) && isset($_GET['id'])){
    if($_GET['action'] <> '' && $_GET['id'] <> ''){
        switch ($_GET['action']){
            case 'disable':
                $annonces->setIsDeleted(0);
                $updateStmt = $annonces->execute("UPDATE ".TBL_Adverts
                    ." SET status = 'offline',"
                    ." is_deleted = 0"
                    ." WHERE idadvert='".$_GET['id']."' ");
                break;
            case 'delete':
                $updateStmt = $annonces->execute("UPDATE ".TBL_Adverts
                    ." SET status = 'offline',"
                    ." is_deleted = 1"
                    ." WHERE idadvert='".$_GET['id']."' ");
                break;
        }
        if($updateStmt==true){
            $library->goBack();
        }
    }
}
?>
<div id="content">
  <div class="container">
    <div class="row">
      <?php include '_inc/_inc_account_menu.php'; ?>
      <div class="col-sm-9 page-content">
          <h2 class="title-2"> Annonces en ligne</h2>
          <?php if( $listeAnnonces[0]['title'] == "" ): ?>
              <div class="page-login-form box">
                  <h1>Aucune annonce disponible</h1>
              </div>
          <?php else: ?>
              <div class="table-responsive">
                  <table class="table table-striped table-bordered add-manage-table">
                      <thead>
                      <tr>
                          <th>Photo</th>
                          <th>Details</th>
                          <th>Prix</th>
                          <th>Options</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php for($i=0; $i < sizeof($listeAnnonces); $i++): ?>
                          <tr>
                              <td class="add-img-td">
                                  <a href="account_details_ads.php?id=<?php echo $listeAnnonces[$i]["idadvert"]; ?>">
                                      <img class="img-responsive" src="uploads/<?php echo $listeAnnonces[$i]["feature_image"]; ?>" alt="img">
                                  </a>
                              </td>
                              <td class="ads-details-td">
                                  <h4><a href="account_details_ads.php?id=<?php echo $listeAnnonces[$i]["idadvert"]; ?>"><? echo $listeAnnonces[$i]["title"]; ?></a></h4>
                                  <p> <strong> Publié le </strong>:<?php echo $listeAnnonces[$i]["publish_date"]; ?> </p>
                                  <p> <strong>Visiteurs </strong>: <?php echo $listeAnnonces[$i]["nb_views"]; ?>
                                      <strong>Localisé à:</strong> <?php echo $listeAnnonces[$i]["city_name"]; ?>
                                  </p>
                              </td>
                              <td class="price-td">
                                  <strong> <?php echo $listeAnnonces[$i]["price"]." ".$listeAnnonces[$i]["short_currency"]; ?></strong>
                              </td>
                              <td class="action-td">
                                  <p><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=disable&id=<?php echo $listeAnnonces[$i]["idadvert"]; ?>"
                                        class="btn btn-info btn-xs">Désactiver</a></p>
                                  <p><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=delete&id=<?php echo $listeAnnonces[$i]["idadvert"]; ?>"
                                        class="btn btn-danger btn-xs">Supprimer&nbsp;&nbsp;</a></p>
                              </td>
                          </tr>
                      <?php endfor; ?>
                      </tbody>
                  </table>
              </div>
          <?php endif; ?>
      </div>
    </div>
  </div>
</div>


<?php include '_inc/_inc_footer.php'; ?>
