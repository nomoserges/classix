<div class="col-sm-12 col-lg-3 page-sideabr">
  <aside>
    <div class="inner-box">
      <div class="user-panel-sidebar">
        <div class="collapse-box">
          <h5 class="collapset-title no-border">Mon espace </h5>
          <div aria-expanded="true" id="myclassified" class="panel-collapse collapse in">
            <ul class="acc-list">
              <li>
                <a href="account_home.php">Accueil</a>
              </li>
                <li>
                    <a href="account_security.php">Sécurité</a>
                </li>
            </ul>
          </div>
        </div>
          <?php if(isset($_SESSION['user'])): ?>
          <?php if( 'personnel' === $_SESSION['user']['user_group'] || 'entreprise' === $_SESSION['user']['user_group'] ): ?>
        <div class="collapse-box">
          <h5 class="collapset-title">Annonces </h5>
          <div aria-expanded="true" id="myads" class="panel-collapse collapse in">
            <ul class="acc-list">
              <li>
                <a href="account_ads.php">Publiées<span class="badge">44</span></a>
              </li>
              <li>
                <a href="account_disabled_ads.php">Désactivées<span class="badge">49</span></a>
              </li>
              <li>
                <a href="account_pending_ads.php">En attente <span class="badge">33</span></a>
              </li>
            </ul>
          </div>
        </div>
          <?php endif; ?>
          <?php endif; ?>
        <div class="collapse-box">
          <h5 class="collapset-title">Fermer mon compte </h5>
          <div aria-expanded="true" id="close" class="panel-collapse collapse in">
            <ul class="acc-list">
              <li>
                <a href="account-close.php">Fermer</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </aside>
</div>
