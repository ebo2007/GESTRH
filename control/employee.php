<?php
/**
 * Created by PhpStorm.
 * User: e.bouh
 * Date: 27/11/2017
 * Time: 14:19
 */

include_once ('connexion.php');
include_once ('utils.php');

class employee extends connexion
{
    public $sid;
    public $nom;
    public $grade;
    public $indice;
    public $departement;
    public $matricule;
    public $dateRec;
    public $tel;
    public $email;
    public $rib;

    public function get_data ($where = ''){
        return $this->select("employes", $where);
    }

    public function build_data($data){
        $all = array();
        $div = array();
        $srv = array();
        $emp = array();
        //print_r($data) ;
        foreach ($data as $row){
            $key = $row['divAbbrev'];
            $skey = $row['srvAbbrev'];

            if(array_key_exists($key, $all)){
                $div[$key][$skey] = $row;
            } else {
                $div[$key] = array();
            }
        }

        $str = str_replace("\"","'", json_encode($div,JSON_UNESCAPED_UNICODE));

        return $str;
    }
}