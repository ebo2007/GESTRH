<?php
/**
 * Created by PhpStorm.
 * User: e.bouh
 * Date: 20/11/2017
 * Time: 14:00
 */

include_once 'departement.php';

$depart = new departement();
if(isset($_POST['dept_edit'])){
    echo $depart->loadForm($_POST);
}
if(isset($_POST['dept_del'])){
    echo $depart->delete_record($_POST);
}
if(isset($_POST['emp_div'])){
    $data = $depart->get_data(" WHERE parent=".$_POST['sid']);
    echo  json_encode($data,JSON_UNESCAPED_UNICODE);
}
if(isset($_POST['emp_cdr'])){
    $data = $depart->select("grades"," WHERE Cadre=".$_POST['sid']);
    echo  json_encode($data,JSON_UNESCAPED_UNICODE);
}
if(isset($_POST['emp_idc'])){
    $data = $depart->join("SELECT sid, CONCAT(indice, ' - ', echellon) AS nom FROM indiceechellon WHERE grade=".$_POST['sid']);
    echo  json_encode($data,JSON_UNESCAPED_UNICODE);
}
