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
        while ($dvs = $dvsReponse->fetch()) {
            ?>
            <div class="col-md-6 connectedSortable ui-sortable">
                <div class="box box-success box-solid">
                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="box-title"><?php echo $dvs['nom']; ?></h3>
                    </div>
                    <!-- /.box-header -->
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

