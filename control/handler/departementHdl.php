<?php
/**
 * Created by PhpStorm.
 * User: e.bouh
 * Date: 20/11/2017
 * Time: 14:00
 */

include_once '../departement.php';

$depart = new departement();
if(isset($_POST['edit'])){
    echo $depart->loadForm($_POST);
}

if(isset($_POST['del'])){
    echo $depart->delete_record($_POST);
}
