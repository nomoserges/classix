<?php
require_once 'lib/Functions.php';
if(!isset($_SESSION['user'])||empty($_SESSION['user']['pseudo'])){
    $library->openUrl($library->getServerHost());
}
$pageTitle = "Mes annonces";
include "_inc/_inc_header.php";
?>
<body>
<?php include '_inc/_inc_navbar.php'; ?>
<div id="content">
  <div class="container">
    <div class="row">
      <?php include '_inc/_inc_account_menu.php'; ?>
      <div class="col-sm-9 page-content">
        <div class="inner-box">
        <h2 class="title-2"> Annonces en ligne</h2>
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
            <?php for ($i=0; $i < 5; $i++) { ?>
            <tr>
              <td class="add-img-td">
                <a href="#">
                  <img class="img-responsive" src="assets/img3.jpg" alt="img">
                </a>
              </td>
              <td class="ads-details-td">
                <h4><a href="#">Brand New All about iPhones</a></h4>
                <p> <strong> Publié le </strong>:02-Oct-2017, 04:38 PM </p>
                <p> <strong>Visiteurs </strong>: 221 <strong>Localisé à:</strong> New York </p>
              </td>
              <td class="price-td">
                <strong> $199</strong>
              </td>
              <td class="action-td">
                <p><a class="btn btn-info btn-xs">Désactiver</a></p>
                <p><a class="btn btn-danger btn-xs">Supprimer&nbsp;&nbsp;</a></p>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>


<?php include '_inc/_inc_footer.php'; ?>
