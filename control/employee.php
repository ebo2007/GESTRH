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
        $div = array();
        foreach ($data as $row){
            $key = $row['divAbbrev'];
            $skey = $row['srvAbbrev'];

            if(array_key_exists($key, $div)){
                if(array_key_exists($skey, $div[$key]['records'])){
                    array_push($div[$key]['records'][$skey]['records'], $row);
                } else {
                    $div[$key]['records'][$skey] = array();
                    $div[$key]['records'][$skey]['abbrev'] = $skey;
                    $div[$key]['records'][$skey]['name'] = $row['srvNom'];
                    $div[$key]['records'][$skey]['records'] = array();
                    array_push($div[$key]['records'][$skey]['records'], $row);
                }
            } else {
                $div[$key] = array();
                $div[$key]['abbrev'] = $key;
                $div[$key]['name'] = $row['divNom'];
                $div[$key]['records'] = array();
                $div[$key]['records'][$skey] = array();
                $div[$key]['records'][$skey]['abbrev'] = $skey;
                $div[$key]['records'][$skey]['name'] = $row['srvNom'];
                $div[$key]['records'][$skey]['records'] = array();
                array_push($div[$key]['records'][$skey]['records'], $row);
            }
        }

        //$str = str_replace("\"","'", json_encode($div,JSON_UNESCAPED_UNICODE));

        return $div;
    }
}