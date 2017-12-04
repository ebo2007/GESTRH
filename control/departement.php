<?php
/**
 * Created by PhpStorm.
 * User: e.bouh
 * Date: 15/11/2017
 * Time: 14:32
 */

include_once ('connexion.php');
include_once ('utils.php');

class departement extends connexion
{
    public $sid;
    public $nom;
    public $abbreviation;
    public $parent;

    /**
     * @param $var
     * @return null|string
     */
    public function isNull($var)
    {
        if($var!="" and !empty($var)){
            return trim($var);
        }
        return null;
    }

    public function get_data ($where = ''){
        return $this->select("departements", $where);
    }

    public function add_record(){
        $this->insert("departements", array(
            'nom' => $this->nom,
            'abbreviation' => $this->abbreviation,
            'parent' => $this->parent
        ));
    }

    public function edit_recod(){
        $this->update("departements", array(
            'nom' => $this->nom,
            'abbreviation' => $this->abbreviation,
            'parent' => $this->parent
        ), intval($this->sid) );
    }

    public function delete_record($data){
        extract($data);
        $this->sid          = $sid;
        try{
            $this->delete("departements", $this->sid);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return "<h4>La suppression terminée avec succés.</h4>";
    }

    public function loadForm($data){
        extract($data);
        $this->sid          = $sid;
        $this->nom          = trim($nom);
        $this->abbreviation = trim($abbreviation);
        $this->parent       = utils::getInstance()->verify_null($parent);

        if($this->testForm()){
            if(utils::isNull($this->sid)){
                $this->add_record();
            } else {
                $this->edit_recod();
            }
            return "<h4>L'opération terminé avec succés.</h4>";
        }
        return "<h4>L'opération terminé avec  des erreurs.</h4>";
    }

    public function testForm(){
        if(utils::isNull($this->nom) || utils::isNull($this->abbreviation)){
            return false;
        }
        return true;
    }
}