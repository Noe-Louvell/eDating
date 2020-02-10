<?php


namespace src\Model;



class Utilisateur implements \JsonSerializable{
    private $Id_Utilisateur;
    private $u_nom;
    private $u_prenom;
    private $sexe;
    private $ville;
    private $telephone;
    private $age;
    private $passion;
    private $prefhum;
    private $statut;
    private $parent;
    private $taille;
    private $corpulence;
    private $cheuveux;
    private $nationalite;
    private $religion;
    private $fumeur;
    private $description;
    private $email;
    private $password;
    private $role;


    public function SqlGet(\PDO $bdd,$Id_Utilisateur){
        $requete = $bdd->prepare('SELECT * FROM Utilisateur where ID_Utilisateur = :$Id_Utilisateur');
        $requete->execute([
            'idUtilisateur' => $Id_Utilisateur
        ]);

        $datas =  $requete->fetch();

        $user = new User();
        $user->setIdUti($datas['id_uti']);
        $user->setUtiMail($datas['uti_mail']);
        $user->setUtiNom($datas['uti_nom']);
        $user->setUtiPrenom($datas['uti_prenom']);
        $user->setUtiPassword($datas['uti_password']);
        $user->setUtiRole($datas['uti_role']);

        return $user;
    }




    public function jsonSerialize()
    {
        return [
            'u_nom' => $this->getUNom(),
            'u_prenom' => $this->getUPrenom(),
            'sexe' => $this->getSexe(),
            'ville' => $this->getVille(),
            'telephone' => $this->getTelephone(),
            'age' => $this->getAge(),
            'passion' => $this->getPassion(),
            'prefhum' => $this->getPrefhum(),
            'statut' => $this->getStatut(),
            'parent' => $this->getParent(),
            'taille' => $this->getTaille(),
            'corpulence' => $this->getCorpulence(),
            'cheuveux' => $this->getCheuveux(),
            'nationalite' => $this->getNationalite(),
            'religion' => $this->getReligion(),
            'fumeur' => $this->getFumeur(),
            'description' => $this->getDescription(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'role' => $this->getRole(),


        ];
    }

    /**
     * @return mixed
     */
    public function getUNom()
    {
        return $this->u_nom;
    }

    /**
     * @param mixed $u_nom
     */
    public function setUNom($u_nom)
    {
        $this->u_nom = $u_nom;
    }

    /**
     * @return mixed
     */
    public function getUPrenom()
    {
        return $this->u_prenom;
    }

    /**
     * @param mixed $u_prenom
     */
    public function setUPrenom($u_prenom)
    {
        $this->u_prenom = $u_prenom;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getPassion()
    {
        return $this->passion;
    }

    /**
     * @param mixed $passion
     */
    public function setPassion($passion)
    {
        $this->passion = $passion;
    }

    /**
     * @return mixed
     */
    public function getPrefhum()
    {
        return $this->prefhum;
    }

    /**
     * @param mixed $prefhum
     */
    public function setPrefhum($prefhum)
    {
        $this->prefhum = $prefhum;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * @param mixed $taille
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;
    }

    /**
     * @return mixed
     */
    public function getCorpulence()
    {
        return $this->corpulence;
    }

    /**
     * @param mixed $corpulence
     */
    public function setCorpulence($corpulence)
    {
        $this->corpulence = $corpulence;
    }

    /**
     * @return mixed
     */
    public function getCheuveux()
    {
        return $this->cheuveux;
    }

    /**
     * @param mixed $cheuveux
     */
    public function setCheuveux($cheuveux)
    {
        $this->cheuveux = $cheuveux;
    }

    /**
     * @return mixed
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * @param mixed $nationalite
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;
    }

    /**
     * @return mixed
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * @param mixed $religion
     */
    public function setReligion($religion)
    {
        $this->religion = $religion;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFumeur()
    {
        return $this->fumeur;
    }

    /**
     * @param mixed $fumeur
     */
    public function setFumeur($fumeur)
    {
        $this->fumeur = $fumeur;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

}