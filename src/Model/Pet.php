<?php


namespace src\Model;


class Pet implements \JsonSerializable
{
    public function AddUser(\PDO $bdd,$password) {
        try{
            $pass_hash = password_hash($password, PASSWORD_BCRYPT);

            $requete = $bdd->prepare('INSERT INTO Pet(ID_Race,ID_User, caractere, a_prenom, a_age) 
                                                VALUES (:ID_Race,:ID_User,:caractere, :a_prenom, :a_age)
            $requete->execute([

                


            ]);
            return array("result"=>true,"message"=>$bdd->lastInsertId());
        }catch (\Exception $e){
            return array("result"=>false,"message"=>$e->getMessage());
        }

    }
    
    
    
    public function jsonSerialize()
    {
        return [
            'ID_Pet' => $this->(),
            'entente' => $this->(),
            'caractere' => $this->(),
            'a_prenom' => $this->(),
            'a_age' => $this->(),
            


        ];
    }

}