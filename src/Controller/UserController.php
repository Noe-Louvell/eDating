<?php

namespace src\Controller;

use src\Model\Bdd;
use src\Model\User;


class UserController extends  AbstractController
{


    public function Index(){
        return $this->AllUser();
    }

    public function OneUtilisateur($ID_User){
        // affiche un article seul

        $user = new User();
        $user->SqlGetOneUser(Bdd::GetInstance(),$ID_User);

        //Lancer la vue TWIG
        return $this->twig->render('/User/view.html.twig',[
            'user' => $user
        ]);
    }

    public function AllUser(){
        // affiche plusieurs utilisateurs
        $User = new User();
        $listUser = $User->SqlGetAllUser(Bdd::GetInstance());

        //Lancer la vue TWIG
        return $this->twig->render(
            'User/list.html.twig',[
                'UtilisateurList' => $listUser
            ]
        );

    }
    public function DeleteUser($ID_User){
        $UserSQL = new User();
        $user = $UserSQL->SqlGetOneUser(BDD::getInstance(),$ID_User);
        $user->DeleteUser(BDD::getInstance(),$ID_User);

        header('Location:/User');
    }


    public function updateUser($ID_User){
        $userSQL = new User();
        $user = $userSQL->SqlGetOneUser(BDD::getInstance(),$ID_User);

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


        $user->UpdateUser(BDD::getInstance());


        return $this->twig->render('User/update.html.twig',[
            'user' => $user
        ]);

    }
    public function registerFrom(){
        return $this->twig->render('User/register.html.twig');
    }

    public function registerAdd()
    {
        $sqlRepository = null;


        $user = new User();

        $user->setUNom($_POST['u_nom']);
        $user->setUPrenom($_POST['u_prenom']);
        $user->setSexe($_POST['sexe']);
        $user->setVille($_POST['ville']);
        $user->setTelephone($_POST['telephone']);
        $user->setAge($_POST['age']);
        $user->setPassion($_POST['passion']);
        $user->setPrefhum($_POST['prefhum']);
        $user->setStatut($_POST['statut']);
        $user->setParent($_POST['parent']);
        $user->setTaille($_POST['taille']);
        $user->setCorpulence($_POST['corpulence']);
        $user->setCheveux($_POST['cheveux']);
        $user->setNationalite($_POST['nationalite']);
        $user->setReligion($_POST['religion']);
        $user->setFumeur($_POST['fumeur']);
        $user->setDescription($_POST['description']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);

        $user->AddUser(BDD::getInstance());
        header('Location:/');
    }







}