<?php
require_once 'lib/Functions.php';
$pageTitle = "Mon espace";
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
        <div class="welcome-msg">
          <h3 class="page-sub-header2 clearfix no-padding">Hello Jhon Doe </h3>
        </div>
        <div id="accordion" class="panel-group">
          <!--  Information utilisateur -->
          <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a href="account-home.php#collapseB1" data-toggle="collapse"> My details </a>
            </h4>
          </div>
          <div class="panel-collapse collapse in" id="collapseB1">
            <div class="panel-body">
              <form role="form">
              <div class="form-group is-empty">
                <label class="control-label">First Name</label>
                <input class="form-control" placeholder="Jhon" type="text">
                <span class="material-input"></span>
              </div>
              <div class="form-group is-empty">
                <label class="control-label">Last name</label>
                <input class="form-control" placeholder="Doe" type="text">
                <span class="material-input"></span>
              </div>
              <div class="form-group is-empty">
                <label class="control-label">Email</label>
                <input class="form-control" placeholder="jhon.deo©example.com" type="email">
                <span class="material-input"></span>
              </div>
              <div class="form-group is-empty">
                <label class="control-label">Address</label>
                <input class="form-control" placeholder=".." type="text">
                <span class="material-input"></span>
              </div>
              <div class="form-group is-empty">
                <label for="Phone" class="control-label">Phone</label>
                <input class="form-control" id="Phone" placeholder="880 123 456789" type="text">
                <span class="material-input"></span>
              </div>
              <div class="form-group is-empty">
                <label class="control-label">Postcode</label>
                <input class="form-control" placeholder="1212" type="text">
                <span class="material-input"></span>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-common">Update</button>
              </div>
            </form>
            </div>
          </div>
        </div>
          <!-- Mot de passe -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" href="account-home.php#collapseB2"
                data-toggle="collapse"> Sécurité </a>
              </h4>
            </div>
            <div style="height: 0px;" aria-expanded="false" class="panel-collapse collapse" id="collapseB2">
            <div class="panel-body">
              <form role="form">
                <div class="form-group is-empty">
                  <label class="control-label">New Password</label>
                  <input class="form-control" placeholder="" type="password">
                  <span class="material-input"></span>
                </div>
                <div class="form-group is-empty">
                  <label class="control-label">Confirm Password</label>
                  <input class="form-control" placeholder="" type="password">
                  <span class="material-input"></span>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-common">Update</button>
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
