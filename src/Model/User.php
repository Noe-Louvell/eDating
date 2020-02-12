<?php


namespace src\Model;



class User implements \JsonSerializable{
    private $ID_User;
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
    private $cheveux;
    private $nationalite;
    private $religion;
    private $fumeur;
    private $description;
    private $email;
    private $password;
    private $role;


    public function SqlGetOneUser(\PDO $bdd,$ID_User){
        $requete = $bdd->prepare('SELECT * FROM User where ID_User = :ID_User');
        $requete->execute([
            'ID_User' => $ID_User
        ]);

        $datas =  $requete->fetch();

        $user = new User();
        $user->setIdUser($datas['ID_User']);
        $user->setUNom($datas['u_nom']);
        $user->setUPrenom($datas['u_prenom']);
        $user->setSexe($datas['sexe']);
        $user->setVille($datas['ville']);
        $user->setTelephone($datas['telephone']);
        $user->setAge($datas['age']);
        $user->setPassion($datas['passion']);
        $user->setPrefhum($datas['prefhum']);
        $user->setStatut($datas['statut']);
        $user->setParent($datas['parent']);
        $user->setTaille($datas['taille']);
        $user->setCorpulence($datas['corpulence']);
        $user->setCheveux($datas['cheveux']);
        $user->setNationalite($datas['nationalite']);
        $user->setReligion($datas['religion']);
        $user->setFumeur($datas['fumeur']);
        $user->setDescription($datas['description']);
        $user->setEmail($datas['email']);
        $user->setPassword($datas['password']);
        $user->setRole($datas['role']);

        var_dump($user);


        return $user;
    }


    public function SqlGetAllUser(\PDO $bdd){
        $requete = $bdd->prepare('SELECT * FROM User');
        $requete->execute();
        $arrayUser = $requete->fetchAll();

        $listUser = [];
        foreach ($arrayUser as $userSQL){
            $user = new User();
            $user->setIdUser($userSQL['ID_User']);
            $user->setUNom($userSQL['u_nom']);
            $user->setUPrenom($userSQL['u_prenom']);
            $user->setSexe($userSQL['sexe']);
            $user->setVille($userSQL['ville']);
            $user->setTelephone($userSQL['telephone']);
            $user->setAge($userSQL['age']);
            $user->setPassion($userSQL['passion']);
            $user->setPrefhum($userSQL['prefhum']);
            $user->setStatut($userSQL['statut']);
            $user->setParent($userSQL['parent']);
            $user->setTaille($userSQL['taille']);
            $user->setCorpulence($userSQL['corpulence']);
            $user->setCheveux($userSQL['cheveux']);
            $user->setNationalite($userSQL['nationalite']);
            $user->setReligion($userSQL['religion']);
            $user->setFumeur($userSQL['fumeur']);
            $user->setDescription($userSQL['description']);
            $user->setEmail($userSQL['email']);
            $user->setPassword($userSQL['password']);
            $user->setRole($userSQL['role']);
            $listUser[] = $user;

        }
        return $listUser;


    }

    public function DeleteUser(\PDO $bdd,$ID_User){
        try{
            $requete = $bdd->prepare('DELETE FROM User where ID_User = :ID_User');
            $requete->execute([
                'ID_User' => $ID_User
            ]);
            return true;
        }catch (\Exception $e){
            return false;
        }

    }
    public function UpdateUser(\PDO $bdd){
        try{
            $requete = $bdd->prepare('UPDATE User set u_nom=:u_nom, u_prenom=:u_prenom, sexe=:sexe, ville=:ville, telephone=:telephone,age=:age,passion=:passion,prefhum=:prefhum,role=:role,parent=: parent,taille=:taille,corpulence=:corpulence,cheuveux=:cheuveux,nationalite=:nationalite,religion=:religion,fumeur=:fumeur,description=:description,email=:email,password=:password,role=:role 
                                                WHERE ID_User=:ID_User');
            $requete->execute([
                'ID_User' => $this->getIdUser(),
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
                'cheveux' => $this->getCheveux(),
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
    public function AddUser(\PDO $bdd,$password) {
        try{
            $pass_hash = password_hash($password, PASSWORD_BCRYPT);

            $requete = $bdd->prepare('INSERT INTO User (u_nom, u_prenom, sexe, ville, telephone, age, passion, prefhum, statut, parent, taille, corpulence, cheuveux, nationalite, religion, fumeur, description, email, password, role) 
                                                VALUES(:u_nom, :u_prenom, :sexe, :ville, :telephone, :age, :passion, :prefhum, :statut, :parent, :taille, :corpulence, :cheuveux, :nationalite, :religion, :fumeur, :description, :email, :password, :role)');
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
                'cheveux' => $this->getCheveux(),
                'nationalite' => $this->getNationalite(),
                'religion' => $this->getReligion(),
                'fumeur' => $this->getFumeur(),
                'description' => $this->getDescription(),
                'email' => $this->getEmail(),
                'password' => $pass_hash,
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
            'ID_User' => $this->getIdUser(),
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
            'cheuvex' => $this->getCheveux(),
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
    public function getIdUser()
    {
        return $this->ID_User;
    }

    /**
     * @param mixed $ID_User
     */
    public function setIdUser($ID_User)
    {
        $this->ID_User = $ID_User;
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
    public function getCheveux()
    {
        return $this->cheveux;
    }

    /**
     * @param mixed $cheuveux
     */
    public function setCheveux($cheveux)
    {
        $this->cheveux = $cheveux;
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