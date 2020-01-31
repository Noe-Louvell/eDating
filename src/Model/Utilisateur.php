<?php
namespace src\Model;

class Utilisateur {
    private $U_NOM;
    private $U_PRENOM;
    private $U_SEXE;
    private $U_AGE;
    private $U_VILLE;
    private $U_TELEPHONE;
    private $U_PASSION;
    private $U_DESCRIPTION;
    private $U_CHEVEUX;
    private $U_CORPULANCE;
    private $U_EMAIL;
    private $U_FUMEUR;
    private $U_RELIGION;
    private $U_PREFHUMAIN;
    private $U_STATUT;
    private $U_PARENT;
    private $U_TAILLE;


    public function SqlAdd(\PDO $Bdd){
        try {
            $requete = $Bdd->prepare('INSERT INTO UTILISATEUR(U_NOM, U_PRENOM, U_SEXE,U_AGE,U_VILLE,U_TELEPHONE,U_PASSION,U_DESCRIPTION,U_CHEVEUX,U_CORPULANCE,U_EMAIL,U_FUMEUR,U_NATIONALITE,U_RELIGION,U_PREFHUMAIN,U_STATUT,U_PARENT,U_TAILLE)VALUES(:U_NOM, :U_PRENOM, :U_SEXE, :U_AGE, :U_VILLE, :U_TELEPHONE, :U_PASSION, :U_DESCRIPTION, :U_CHEVEUX, :U_CORPULANCE, :U_EMAIL, :U_FUMEUR, :U_NATIONALITE, :U_RELIGION, :U_PREFHUMAIN, :U_STATUT, :U_PARENT, :U_TAILLE)');
            $requete->execute([
                "U_NOM" => $this->getNom(),
                "U_PRENOM" => $this->getPrenom(),
                "U_SEXE" => $this->getSexe(),
                "U_AGE" => $this->getAge(),
                "U_VILLE" => $this->getVille(),
                "U_TELEPHONE" => $this->getTel(),
                "U_PASSION" => $this->getPassion(),
                "U_DESCRIPTION" => $this->getDescritpion(),
                "U_CHEVEUX" => $this->getCheuveux(),
                "U_CORPULANCE" => $this->getCorpulance(),
                "U_EMAIL" => $this->getEmail(),
                "U_FUMEUR" => $this->getFumeur(),
                "U_RELIGION" => $this->getReligion(),
                "U_PREFHUMAIN" => $this->getPref(),
                "U_STATUT" => $this->getStatut(),
                "U_PARENT" => $this->getParent(),
                "U_TAILLE" => $this->getTaille(),

        }
    }

    private function getNom()
    {
        $this->U_NOM = $U_NOM;
        return $this;
    }


}