<?php
    require_once '_inc_header.php';
    require_once '../classes/Users.php';
    $users = new Users();

    $groupUserNames = array(
            "admin"=>"Administrateur",
            "gestionnaire"=>"Gestionnaires",
            "personnel"=>"Clients personnels",
            "entreprise"=>"Clients entreprises",
    );
    if(isset($_GET['group']) && !empty($_GET['group'])){
        $users->setUserGroup($_GET['group']);
        $usersList = $users->getUsersPerGroup();
    }
    /**  visibilité des boutons d'actions
     *  1 - actions possibles pour les gestionnaires et/ou administrateurs.
     *  2 - actions possibles par les administrateur. */
    /*$btnAction = false;
    if ($_GET['group']==='gestionnaire' || $_GET['group']==='admin') {
        if ("admin" === $_SESSION['user']['user_group']){
            $btnAction = true;
        }
        $btnAction = true;
    }*/
    $btnAction = true;
    /** Gestion des actions supprimer, activer et desactiver
     *  d'un compte.
     */
    if( isset($_GET['action']) && !empty($_GET['action']) ) {
        if( isset($_GET['userid']) && !empty($_GET['userid']) ) {
            $users->setPseudo($_GET['userid']);
            switch ($_GET['action']){
                case 'enable':
                    $users->setPseudo($_GET['userid']);
                    $users->setIsEnabled(1);
                    $resultStmt = $users->updateStatus();
                    if( $resultStmt === true ){
                        $library->alert("Compte Utilisateur activé");
                        $library->goBack();
                    }
                    break;

                case 'disable':
                    $users->setPseudo($_GET['userid']);
                    $users->setIsEnabled(0);
                    $resultStmt = $users->updateStatus();
                    if( $resultStmt === true ){
                        $library->alert("Compte Utilisateur désactivé");
                        $library->goBack();
                    }
                    break;

                case 'delete':
                    $users->setPseudo($_GET['userid']);
                    $resultStmt = $users->deleteAccount();
                    if( $resultStmt === true ){
                        $library->alert("Compte Utilisateur supprimé");
                        $library->goBack();
                    }
                    break;
            }
        }
    }
?>
<section id="categories-homepage">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">Liste des <?php echo $groupUserNames[$_GET['group']]; ?></h3>
            </div>
            <?php if($usersList=== 0): ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="category-box">
                    <div class="category-header">
                        <a href="#"><h4>Aucun utilisateurs associés</h4></a>
                    </div>
                    <div class="category-content"
                         style="text-align: center;padding-top: 30px;">
                        <h1>0</h1>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <table class="table table-hover table-condensed table-striped table-bordered">
                <thead>
                    <th width="30" class="center">#</th>
                    <th class="center">Pseudo</th>
                    <th class="center">Emails</th>
                    <th class="center">Noms complets</th>
                    <th class="center">Contacts</th>
                    <?php if( true === $btnAction ): ?>
                    <th class="center">Actions</th>
                    <?php endif; ?>

                </thead>
                <tbody>
                <?php for($i=0; $i<sizeof($usersList); $i++): ?>
                    <tr>
                        <td class="center"><?php echo $i+1; ?></td>
                        <td class="center"><?php echo $usersList[$i]['pseudo']; ?></td>
                        <td class="center"><?php echo $usersList[$i]['user_mail']; ?></td>
                        <td class="center">
                            <?php echo $usersList[$i]['first_name']." ".$usersList[$i]['last_name']; ?>
                        </td>
                        <td class="center">
                            <?php
                                if(!empty($usersList[$i]['address'])){
                                    echo $usersList[$i]['address'];
                                }
                                if(!empty($usersList[$i]['phones'])){
                                    echo '</br>'.$usersList[$i]['phones'];
                                }
                            ?>
                        </td>
                        <?php if( true === $btnAction ): ?>
                            <?php if($_SESSION['user']['pseudo']===$usersList[$i]['pseudo']): ?>
                        <td class="center">
                            <a href="../account_home.php" class="btn btn-xs btn-primary">Mon profile</a>
                        </td>
                            <?php else: ?>
                        <td class="center">
                            <div class="btn-group btn-xs" role="group">
                                <?php if (1 == $usersList[$i]['is_enabled']): ?>
                                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=disable&userid=<?php echo $usersList[$i]['pseudo']; ?>"
                                class="btn btn-xs btn-warning">Désact.</a>
                                <?php else: ?>
                                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=enable&userid=<?php echo $usersList[$i]['pseudo']; ?>"
                                   class="btn btn-xs btn-primary">Activer</a>
                                <?php endif; ?>
                                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=delete&userid=<?php echo $usersList[$i]['pseudo']; ?>"
                               class="btn btn-xs btn-danger">Supp.</a>
                            </div>
                        </td>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>

            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once '../_inc/_inc_footer.php'; ?>
