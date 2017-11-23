<?php
/**
 * Created by PhpStorm.
 * User: e.bouh
 * Date: 15/11/2017
 * Time: 14:32
 */

//namespace control;

include('/control/connexion.php');

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
    public function verif_null($var)
    {
        if($var!="" and !empty($var)){
            return trim($var);
        }
        return null;
    }

    public function add_record(){
        try {
            $this->insert("departements", array(
                'nom' => $this->nom,
                'abbreviation' => $this->abbreviation,
                'parent' => $this->parent
            ));
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }

    }

    public function edit_recod(){
        try {
            $this->update("departements", array(
                'nom' => $this->nom,
                'abbreviation' => $this->abbreviation,
                'parent' => $this->parent
            ), intval($this->sid) );
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function delete_record($data){
        extract($data);
        $this->sid          = $sid;
        try{
            $this->delete("departements", $this->sid);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function loadForm($data){
        extract($data);
        $this->sid          = $sid;
        $this->nom          = trim(htmlentities($nom, ENT_QUOTES));
        $this->abbreviation = trim(htmlentities($abbreviation, ENT_QUOTES));
        $this->parent       = $this->verif_null($parent);

        if($this->testForm()){
            if(is_null($this->verif_null($this->sid))){
                $this->add_record();
            } else {
                $this->edit_recod();
            }
        }
    }

    public function testForm(){
        if(is_null($this->verif_null($this->nom)) and is_null($this->verif_null($this->abbreviation)) and is_null($this->verif_null($this->parent))){
            return false;
        }
        return true;
    }
}