<?php
    require_once '_inc_header.php';
    require_once '../classes/Users.php';
    $groupUserNames = array(
            "admin"=>"Administrateur",
            "manager"=>"Gestionnaires",
            "customer"=>"Clients"
    );
    if(isset($_GET['group']) && !empty($_GET['group'])){
        $users = new Users();
        $users->setUserGroup($_GET['group']);
        $usersList = $users->getUsersPerGroup();
    }
    /**  visibilité des boutons d'actions
     *  1 - actions possibles pour les gestionnaires et/ou administrateurs.
     *  2 - actions possibles par les administrateur. */
    $btnAction = false;
    if ($_GET['group']==='manager' || $_GET['group']==='admin') {
        if ("admin" === $_SESSION['user']['user_group']){
            $btnAction = true;
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
                    <th width="160" class="center">Actions</th>
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
                        <td class="center">
                            <div class="btn-group btn-xs" role="group">
                                <a href="" class="btn btn-xs btn-warning">désact.</a>
                                <a href="" class="btn btn-xs btn-danger">Supp.</a>
                            </div>
                        </td>
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
