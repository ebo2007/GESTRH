<?php
/**
 * Created by PhpStorm.
 * User: e.bouh
 * Date: 15/11/2017
 * Time: 14:32
 */

namespace control;


class departement
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

    public function test(){
        echo 'Le jeu a bien été ajouté !';
    }

    public function add_record($con){
        try {
            $req = $con->prepare('INSERT INTO departements (nom, abbreviation, parent) VALUES(:nom, :abbreviation, :parent)');
            $req->execute(array(
                'nom' => $this->nom,
                'abbreviation' => $this->abbreviation,
                'parent' => $this->parent
            ));
            echo 'Le jeu a bien été ajouté !';
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }

    }

    public function loadForm($con, $data){
        extract($data);
        $this->nom              = trim(htmlentities($nom, ENT_QUOTES));
        $this->abbreviation     = trim(htmlentities($abbreviation, ENT_QUOTES));
        $this->parent           = $parent;

        if($this->testForm()){
            $this->add_record($con);
        };
    }

    public function testForm(){
        if(is_null($this->verif_null($this->nom)) and is_null($this->verif_null($this->abbreviation))){
            return false;
        }
        return true;
    }
}