<?php
/**
 * Created by PhpStorm.
 * User: e.bouh
 * Date: 30/10/2017
 * Time: 15:40
*/
//namespace control;


class connexion
{
    public  $cnx;
    private $servername = "10.100.1.2";
    private $db         = "amgrh";
    private $username   = "ebouh";
    private $password   = "ebo";

    function __construct()
    {
        try {
            $this->cnx = new PDO("mysql:host=$this->servername;dbname=$this->db;charset=utf8", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function select($table, $where)
    {
        $res=$this->cnx->query("SELECT * FROM $table $where");
        return $res;
    }

    public function delete($table, $id)
    {
        $res=$this->cnx->query("DELETE FROM $table WHERE sid=$id");
        return $res;
    }

    public function insert ($table, $arr)
    {
        $fields = array();
        $vFields = array();
        $str = "";
        foreach ($arr as $key=>$val) {
            array_push($fields, $key);
            array_push($vFields, ":$key");
        }

        $req=$this->cnx->prepare("INSERT INTO $table (".implode(',', $fields)." ) VALUES (".implode(',', $vFields).")");
        $req->execute($arr);
    }

    public function update ($table, $arr, $id)
    {
        $fields = array();
        $vFields = array();
        foreach ($arr as $key=>$val) {
            array_push($fields, "$key=?");
        }
        if(is_numeric($id)){
            $where = "sid=$id";
        } else  {
            $where = $id;
        }
        $req=$this->cnx->prepare("UPDATE $table SET ".implode($fields)." WHERE $where");
        $req->execute($arr);
    }


}

?>