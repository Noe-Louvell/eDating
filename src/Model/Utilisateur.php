<?php


namespace src\Model;



class Utilisateur implements \JsonSerializable{
    private $ID_Utilisateur;
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


    public function SqlGetOneUtilisateur(\PDO $bdd,$ID_Utilisateur){
        $requete = $bdd->prepare('SELECT * FROM Utilisateur where ID_Utilisateur = :ID_Utilisateur');
        $requete->execute([
            'ID_Utilisateur' => $ID_Utilisateur
        ]);

        $datas =  $requete->fetch();

        $utilisateur = new Utilisateur();
        $utilisateur->setIdUtilisateur($datas['ID_Utilisateur']);
        $utilisateur->setUNom($datas['u_nom']);
        $utilisateur->setUPrenom($datas['u_prenom']);
        $utilisateur->setSexe($datas['sexe']);
        $utilisateur->setVille($datas['ville']);
        $utilisateur->setTelephone($datas['telephone']);
        $utilisateur->setAge($datas['age']);
        $utilisateur->setPassion($datas['passion']);
        $utilisateur->setPrefhum($datas['prefhum']);
        $utilisateur->setStatut($datas['statut']);
        $utilisateur->setParent($datas['parent']);
        $utilisateur->setTaille($datas['taille']);
        $utilisateur->setCorpulence($datas['corpulence']);
        $utilisateur->setCheuveux($datas['cheuveux']);
        $utilisateur->setNationalite($datas['nationalite']);
        $utilisateur->setReligion($datas['religion']);
        $utilisateur->setFumeur($datas['fumeur']);
        $utilisateur->setDescription($datas['description']);
        $utilisateur->setEmail($datas['email']);
        $utilisateur->setPassword($datas['password']);
        $utilisateur->setRole($datas['role']);

        var_dump($utilisateur);


        return $utilisateur;
    }


    public function SqlGetAllUtilisateur(\PDO $bdd){
        $requete = $bdd->prepare('SELECT * FROM Utilisateur');
        $requete->execute();
        $arrayUtilisateur = $requete->fetchAll();

        $listUtilisateur = [];
        foreach ($arrayUtilisateur as $utilisateurSQL){
            $utilisateur = new Utilisateur();
            $utilisateur->setIdUtilisateur($utilisateurSQL['ID_Utilisateur']);
            $utilisateur->setUNom($utilisateurSQL['u_nom']);
            $utilisateur->setUPrenom($utilisateurSQL['u_prenom']);
            $utilisateur->setSexe($utilisateurSQL['sexe']);
            $utilisateur->setVille($utilisateurSQL['ville']);
            $utilisateur->setTelephone($utilisateurSQL['telephone']);
            $utilisateur->setAge($utilisateurSQL['age']);
            $utilisateur->setPassion($utilisateurSQL['passion']);
            $utilisateur->setPrefhum($utilisateurSQL['prefhum']);
            $utilisateur->setStatut($utilisateurSQL['statut']);
            $utilisateur->setParent($utilisateurSQL['parent']);
            $utilisateur->setTaille($utilisateurSQL['taille']);
            $utilisateur->setCorpulence($utilisateurSQL['corpulence']);
            $utilisateur->setCheuveux($utilisateurSQL['cheuveux']);
            $utilisateur->setNationalite($utilisateurSQL['nationalite']);
            $utilisateur->setReligion($utilisateurSQL['religion']);
            $utilisateur->setFumeur($utilisateurSQL['fumeur']);
            $utilisateur->setDescription($utilisateurSQL['description']);
            $utilisateur->setEmail($utilisateurSQL['email']);
            $utilisateur->setPassword($utilisateurSQL['password']);
            $utilisateur->setRole($utilisateurSQL['role']);
            $listUtilisateur[] = $utilisateur;

        }
        return $listUtilisateur;


    }

    public function DeleteUtilisateur(\PDO $bdd,$ID_Utilisateur){
        try{
            $requete = $bdd->prepare('DELETE FROM Utilisateur where ID_Utilisateur = :ID_Utilisateur');
            $requete->execute([
                'ID_Utilisateur' => $ID_Utilisateur
            ]);
            return true;
        }catch (\Exception $e){
            return false;
        }

    }
    public function UpdateUtilisateur(\PDO $bdd){
        try{
            $requete = $bdd->prepare('UPDATE Utilisateur set u_nom=:u_nom, u_prenom=:u_prenom, sexe=:sexe, ville=:ville, telephone=:telephone,age=:age,passion=:passion,prefhum=:prefhum,statut=:statut,parent=: parent,taille=:taille,corpulence=:corpulence,cheuveux=:cheuveux,nationalite=:nationalite,religion=:religion,fumeur=:fumeur,description=:description,email=:email,password=:password,role=:role WHERE ID_Utilisateur=:ID_Utilisateur');
            $requete->execute([
                'ID_Utilisateur' => $this->getIdUtilisateur(),
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
            ]);
            return array("0", "[OK] Update");
        }catch (\Exception $e){
            return array("1", "[ERREUR] ".$e->getMessage());
        }
    }
    public function AddUtilisateur(\PDO $bdd) {
        try{
            $requete = $bdd->prepare('INSERT INTO Utilisateur (u_nom, u_prenom, sexe, ville, telephone, age, passion, prefhum, statut, parent, taille, corpulence, cheuveux, nationalite, religion, fumeur, description, email, password, role) VALUES(:u_nom, :u_prenom, :sexe, :ville, :telephone, :age, :passion, :prefhum, :statut, :parent, :taille, :corpulence, :cheuveux, :nationalite, :religion, :fumeur, :description, :email, :password, :role)');
            $requete->execute([

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


            ]);
            return array("result"=>true,"message"=>$bdd->lastInsertId());
        }catch (\Exception $e){
            return array("result"=>false,"message"=>$e->getMessage());
        }

    }



    public function jsonSerialize()
    {
        return [
            'ID_Utilisateur' => $this->getIdUtilisateur(),
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
    public function getIdUtilisateur()
    {
        return $this->ID_Utilisateur;
    }

    /**
     * @param mixed $ID_Utilisateur
     */
    public function setIdUtilisateur($ID_Utilisateur)
    {
        $this->ID_Utilisateur = $ID_Utilisateur;
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
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
        return $this;
    }

}