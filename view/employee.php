<?php
/**
 * Created by PhpStorm.
 * User: e.bouh
 * Date: 24/10/2017
 * Time: 12:11
 */

if(file_exists('control/departement.php')) {
    include_once 'control/departement.php';
    include_once 'control/employee.php';
} else {
    include_once '../control/departement.php';
    include_once '../control/employee.php';
}

$depart = new departement();
$emp = new employee();
$qData = $emp->join("SELECT employes.sid,
       employes.nom,
       employes.matricule,
       employes.dateRecrute,
       employes.tel,
       employes.email,
       employes.rib,
       departements.sid AS divId,
       departements.nom AS divNom,
       departements.abbreviation AS divAbbrev,
       departements_1.sid AS srvId,
       departements_1.nom AS srvNom,
       departements_1.abbreviation AS srvAbbrev,
       grades.nom AS gradeNom,
       grades.abbreviation AS gradeAbbrev,
       grades.echelle,
       indiceechellon.indice,
       indiceechellon.echellon
  FROM (((gestrh.indiceechellon indiceechellon
          INNER JOIN gestrh.grades grades
             ON (indiceechellon.grade = grades.sid))
         INNER JOIN gestrh.employes employes
            ON     (employes.indice = indiceechellon.sid)
               AND (employes.grade = grades.sid))
        INNER JOIN gestrh.departements departements_1
           ON (employes.departement = departements_1.sid))
       INNER JOIN gestrh.departements departements
          ON (departements_1.parent = departements.sid)");

$data = $emp->build_data($qData);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Employés des ARCHIVES DU MAROC
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="?page=dashboard.php"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li class="active">Employés</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">

        <!-- USERS LIST -->
    <div class="col-md-12">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title" style="width: 100%;">Employés des ARCHIVES DU MAROC</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" data-toggle="modal" data-target="#empModal"><i class="fa fa-user-plus"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <?php
                    //$data = $depart->get_data(" WHERE parent IS NULL");
                    //$count = 0;
                    foreach ($data as $dvs) {
                        //$str = str_replace("\"", "'", json_encode($dvs, JSON_UNESCAPED_UNICODE));
                        ?>
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <h4 class="box-title" style="width: 100%;">
                                    <a data-toggle="collapse" data-parent="#accordion" href="<?php echo "#clp_".$dvs['abbrev']?>" style="width: 100%;display: inline-block;">
                                        <?php echo $dvs['name']?>
                                    </a>
                                </h4>
                            </div>
                            <div id="<?php echo "clp_".$dvs['abbrev']?>" class="panel-collapse collapse">
                                <div class="box-body">
                                    <div class="box-group" id="accordion1">
                                        <?php
                                        //$sData = $depart->get_data( " WHERE parent=".$dvs['sid']);
                                        foreach ($dvs['records'] as $srv) {
                                        //$strs = str_replace("\"", "'", json_encode($srv, JSON_UNESCAPED_UNICODE));
                                        ?>
                                        <div class="panel box box-info box-solid">
                                            <div class="box-header with-border">
                                                <h4 class="box-title" style="width: 100%;">
                                                    <a data-toggle="collapse" data-parent="#accordion1" href="<?php echo "#clp_".$srv['abbrev']?>" style="width: 100%;display: inline-block;">
                                                        <?php echo $srv['name']?>
                                                    </a>
                                                </h4>
                                                <div class="box-tools pull-right">
                                                    <a class="btn btn-box-tool" data-toggle="modal" data-target="#empModal"><i class="fa fa-user-plus"></i></a>
                                                </div>
                                            </div>
                                            <div id="<?php echo "clp_".$srv['abbrev']?>" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <ul class="users-list clearfix">
                                                        <?php
                                                        //$eData = $emp->get_data( " WHERE departement=".$srv['sid']);
                                                        foreach ($srv['records'] as $emplye) {
                                                            $str = str_replace("\"", "'", json_encode($emplye, JSON_UNESCAPED_UNICODE));
                                                            ?>
                                                            <li>
                                                                <img src="dist/img/user1-128x128.jpg" alt="<?php echo $emplye['nom']?>">
                                                                <a class="users-list-name" href="#" data-toggle="modal" data-target="#empModal" data-employe="<?php echo $str; ?>"><?php echo $emplye['nom']?></a>
                                                                <span class="users-list-date"><?php echo $emplye['gradeAbbrev']?></span>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<div class="modal" id="empModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nouveau Département</h4>
            </div>
            <form  method="post" id="emp_frm">
                <div class="modal-body">
                    <input type="hidden" name="sid" value="">
                    <input type="hidden" name="edit" value="edit">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="form-group col-lg-9">
                                    <label>Nom de l'employé :</label>
                                    <input type="text" class="form-control" placeholder="Nom de l'employé" name="nom" value="" >
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>N° de matricule :</label>
                                    <input type="text" class="form-control" placeholder="Matricule" name="matricule" value="" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label>Date de recrutement :</label>
                                    <input type="text" class="form-control" placeholder="Date de recrutement" name="Date de recrutement" value="" >
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Téléphone :</label>
                                    <input type="text" class="form-control" placeholder="Téléphone" name="tel" value="" >
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Email :</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email" value="" >
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-2">
                            <img src="dist/img/user1-128x128.jpg" style="border-radius: 50%;">
<!--                            <label>N° de matricule :</label>-->
<!--                            <input type="text" class="form-control" placeholder="Matricule" name="matricule" value="" >-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-5">
                            <input type="hidden" name="divId" value="" >
                            <label>Division</label>
                            <select class="form-control" name="divId" placeholder="Division">
                                <?php
                                $data = $depart->get_data(" WHERE parent IS NULL");
                                foreach ($data as $dvs) {
                                    ?>
                                    <option value="<?php echo $dvs["sid"] ?>"><?php echo $dvs["nom"] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-7">
                            <input type="hidden" name="srvId" value="" >
                            <label>Service</label>
                            <select class="form-control" name="srvId" placeholder="Service"></select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-5">
                            <input type="hidden" name="cdrId" value="" >
                            <label>Cadre</label>
                            <select class="form-control" name="cdrId" placeholder="Cadre">
                                <?php
                                $gData = $depart->select("grades",  "WHERE Cadre IS NULL");
                                foreach ($gData as $cdr) {
                                    ?>
                                    <option value="<?php echo $cdr["sid"] ?>"><?php echo $cdr["nom"] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-5">
                            <input type="hidden" name="grdId" value="" >
                            <label>Grade</label>
                            <select class="form-control" name="grdId" placeholder="Grade"></select>
                        </div>
                        <div class="form-group col-lg-2">
                            <input type="hidden" name="idcId" value="" >
                            <label>Indice - Echellon</label>
                            <select class="form-control" name="idcId" placeholder="Indice - Echellon"></select>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="parent" value="">
                        <label>Département</label>
                        <select class="form-control" name="parent">
                            <option value="<?php echo NULL ?>">Archives du Maroc</option>
                            <?php
                            foreach ($data as $dvs) {
                                ?>
                                <option value="<?php echo $dvs["sid"] ?>"><?php echo $dvs["nom"] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Division / Service :</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sitemap"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Nom Service" name="nom" value="" >
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
                            <input type="text" class="form-control" placeholder="Abbréviation"name="abbreviation" value="">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
                <div class="modal-footer">
                    <input type="button"  class="btn btn-default pull-left" data-dismiss="modal" value="Fermer">
                    <input type="submit" class="btn btn-primary" name="submit" data-dismiss="modal" value="Enregistrer" >
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.row -->
</section>