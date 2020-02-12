<?php


namespace src\Model;


class Pet implements JsonSerializable{

    private $ID_Pet;
    private $ID_Race;
    private $ID_User;
    private $entente;
    private $caractere;
    private $a_prenom;

    private $a_age;

    public function AddPet(\PDO $bdd) {
        try{
            $requete = $bdd->prepare('INSERT INTO Pet(ID_Race,ID_User, caractere, a_prenom, a_age,entente) 
                                                VALUES (:ID_Race,:ID_User,:caractere,:a_prenom,:a_age,:entente)');
            $requete->execute([
                'ID_Race' => $this->getIDRace(),
                'ID_User' => $this->getIDUser(),
                'caractere' => $this->getCaractere(),
                'a_prenom' => $this->getAPrenom(),
                'a_age' => $this->getAAge(),
                'entente'=>$this->getEntente(),

            ]);
            return array("result"=>true,"message"=>$bdd->lastInsertId());
        }catch (\Exception $e){
            return array("result"=>false,"message"=>$e->getMessage());
        }

    }
    public function DeletePet(\PDO $bdd,$ID_Pet){
        try{
            $requete = $bdd->prepare('DELETE FROM Pet where ID_Pet = :ID_Pet');
            $requete->execute([
                'ID_Pet' => $ID_Pet
            ]);
            return true;
        }catch (\Exception $e){
            return false;
        }

    }
    public function SqlGetOnePet(\PDO $bdd,$ID_Pet){
        $requete = $bdd->prepare('SELECT * FROM Pet where ID_Pet = :ID_Pet');
        $requete->execute([
            'ID_Pet' => $ID_Pet
        ]);

        $datas =  $requete->fetch();

        $pet = new Pet();
        $pet->setIDPet($datas['ID_Pet']);
        $pet->setIDRace($datas['ID_Race']);
        $pet->setIDUser($datas['ID_User']);
        $pet->setAPrenom($datas['a_prenom']);
        $pet->setEntente($datas['entente']);
        $pet->setCaractere($datas['caractere']);


        return $pet;
    }
    public function UpdatePet(\PDO $bdd){
            try{
                $requete = $bdd->prepare('UPDATE Pet set entente=:entente,caractere=:caractere 
                                                    WHERE ID_Pet=:ID_Pet');
                $requete->execute([
                    'entente' => $this->getEntente(),
                    'caractere' => $this->getCaractere(),
                ]);
                return array("0", "[OK] Update");
            }catch (\Exception $e){
                return array("1", "[ERREUR] ".$e->getMessage());
            }

    }




    public function jsonSerialize()
    {
        return [
            'ID_Pet' => $this->getIDPet(),
            'ID_Race' => $this->getIDRace(),
            'ID_User' => $this->getIDUser(),
            'entente' => $this->getEntente(),
            'caractere' => $this->getCaractere(),
            'a_prenom' => $this->getAPrenom(),
            'a_age' => $this->getAAge(),
            


        ];
    }

    /**
     * @return mixed
     */
    public function getIDPet()
    {
        return $this->ID_Pet;
    }

    /**
     * @param mixed $ID_Pet
     */
    public function setIDPet($ID_Pet)
    {
        $this->ID_Pet = $ID_Pet;
    }

    /**
     * @return mixed
     */
    public function getAAge()
    {
        return $this->a_age;
    }

    /**
     * @param mixed $a_age
     */
    public function setAAge($a_age)
    {
        $this->a_age = $a_age;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEntente()
    {
        return $this->entente;
    }

    /**
     * @param mixed $entente
     */
    public function setEntente($entente)
    {
        $this->entente = $entente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIDRace()
    {
        return $this->ID_Race;
    }

    /**
     * @param mixed $ID_Race
     */
    public function setIDRace($ID_Race)
    {
        $this->ID_Race = $ID_Race;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIDUser()
    {
        return $this->ID_User;
    }

    /**
     * @param mixed $ID_User
     */
    public function setIDUser($ID_User)
    {
        $this->ID_User = $ID_User;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCaractere()
    {
        return $this->caractere;
    }

    /**
     * @param mixed $caractere
     */
    public function setCaractere($caractere)
    {
        $this->caractere = $caractere;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAPrenom()
    {
        return $this->a_prenom;
    }

    /**
     * @param mixed $a_prenom
     */
    public function setAPrenom($a_prenom)
    {
        $this->a_prenom = $a_prenom;
        return $this;
    }

    
}
    

