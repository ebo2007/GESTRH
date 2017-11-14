<?php
/**
 * Created by PhpStorm.
 * User: e.bouh
 * Date: 24/10/2017
 * Time: 12:11
 */
require '../control/connexion.php';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Départements des ARCHIVES DU MAROC
        <small>Divisions & Services</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li class="active">Départements</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <?php
        $dvsReponse = $conn->query('SELECT * FROM departements WHERE parent IS NULL');
        $count = 0;
        while ($dvs = $dvsReponse->fetch()) {
            $count++;
            ?>
            <div class="col-md-6 connectedSortable ui-sortable">
                <div class="box box-success box-solid">
                    <div class="box-header ui-sortable-handle">
                        <h3 class="box-title"><?php echo $dvs['nom']; ?></h3>
                        <div class="box-tools pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-box-tool dropdown-toggle"
                                        data-toggle="dropdown">
                                    <i class="fa fa-wrench"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" style="color: #0c0c0c;" data-toggle="modal"
                                           data-target="<?php echo "#myModal" . $count ?>">Nouveau</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" style="color: #0c0c0c;" data-toggle="modal"
                                           data-target="<?php echo "#msgBox" . $count ?>">Supprimer</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="modal" id="<?php echo "myModal" . $count ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Nouveau service</h4>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label>Nom Service :</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-sitemap"></i>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Nom Service">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                        <div class="form-group">
                                            <label>Abbréviation :</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-sitemap"></i>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Abbréviation">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                                        Fermer
                                    </button>
                                    <button type="button" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <div class="modal modal-warning" id="<?php echo "msgBox" . $count ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Avertissement</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Voulez vous vraiment la supprimer ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">NON
                                    </button>
                                    <button type="button" class="btn btn-outline" data-dismiss="modal">OUI</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <?php
                            $srvReponse = $conn->query('SELECT * FROM departements WHERE parent = ' . $dvs['sid']);
                            while ($srv = $srvReponse->fetch()) {
                                ?>
                                <tr>
                                    <td style="width: 10px"><i class="fa fa-sitemap"></i></td>
                                    <td><?php echo $srv['nom']; ?></td>
                                    <td><?php echo $srv['abbreviation']; ?></td>
                                    <td style="width: 45px">
                                        <div class="tools">
                                            <a style="cursor: pointer;" class="fa fa-edit"></a>
                                            <a style="cursor: pointer;" class="fa fa-trash-o"></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            $srvReponse->closeCursor();
                            ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <?php
        }
        $dvsReponse->closeCursor();
        ?>

    </div>
</section>
<script>
    $.AdminLTE.sortBox();
</script>

