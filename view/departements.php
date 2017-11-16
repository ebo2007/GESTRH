<?php
/**
 * Created by PhpStorm.
 * User: e.bouh
 * Date: 24/10/2017
 * Time: 12:11
 */
require '../control/connexion.php';
include_once '../control/departement.php';

$depart = new \control\departement();
if(isset($_POST['nom'])){
    $depart->loadForm($conn, $_POST);
}
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
        <div class="col-md-12 ">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">ARCHIVES DU MAROC</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    $dvsReponse = $conn->query('SELECT * FROM departements WHERE parent IS NULL');
                    $data = $dvsReponse->fetchAll(PDO::FETCH_ASSOC);
                    //$count = 0;
                    foreach ($data as $dvs) {
                        //$count++;
                        ?>
                        <div class="col-md-6 connectedSortable ui-sortable">
                            <div class="box box-success box-solid">
                                <div class="box-header ui-sortable-handle">
                                    <h3 class="box-title"><?php echo $dvs['nom']; ?></h3>
                                    <div class="box-tools pull-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#msgBox"><i class="fa fa-trash-o"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <?php
                                        $srvReponse = $conn->query('SELECT * FROM departements WHERE parent = ' . $dvs['sid']);
                                        while ($srv = $srvReponse->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <tr>
                                                <td style="width: 10px"><i class="fa fa-sitemap"></i></td>
                                                <td><?php echo $srv['nom']; ?></td>
                                                <td><?php echo $srv['abbreviation']; ?></td>
                                                <td style="width: 45px">
                                                    <div class="tools">
                                                        <a style="cursor: pointer;" class="fa fa-edit" data-toggle="modal" data-target="#myModal"></a>
                                                        <a style="cursor: pointer;" class="fa fa-trash-o" data-toggle="modal" data-target="#msgBox"></a>
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
                    ?>
                </div>
                <!-- /.box-body -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Nouveau Département</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <div class="form-group">
                                        <label>Département</label>
                                        <select class="form-control" name="parent">
                                            <option value="">Archives du Maroc</option>
                                            <?php
                                                foreach ($data as $dvs) {
                                            ?>
                                            <option value="<?php echo $dvs["sid"] ?>"><?php echo $dvs["nom"] ?></option>
                                            <?php
                                                }
                                                $dvsReponse->closeCursor();
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Division / Service :</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-sitemap"></i>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Nom Service" name="nom" value="<?php echo $depart->nom ?>" >
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
                                            <input type="text" class="form-control" placeholder="Abbréviation"name="abbreviation" value="<?php echo $depart->abbreviation ?>">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">
                                    Fermer
                                </button>
                                <button type="submit" class="btn btn-primary" name="enregistrer" data-dismiss="modal">Enregistrer</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <div class="modal modal-warning" id="msgBox">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><i class="fa fa-warning" style="padding-right: 5px;"></i>Avertissement</h4>
                            </div>
                            <div class="modal-body">
                                <p style="text-align: center;">Voulez vous vraiment supprimer ... ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">NON</button>
                                <button type="button" class="btn btn-outline" data-dismiss="modal">OUI</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
        </div>
    </div>
</section>
<script>
    $.AdminLTE.sortBox();
</script>
