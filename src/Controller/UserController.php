<?php

namespace src\Controller;

use src\Model\Bdd;
use src\Model\User;


class UserController extends  AbstractController
{


    public function Index(){
        return $this->AllUser();
    }

    public function OneUser($ID_User){
        // affiche un article seul

        $user = new User();
        $user->SqlGetOneUser(Bdd::GetInstance(),$ID_User);
        var_dump($user);
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
                'UserList' => $listUser
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
        $user->setPrefhum($_POST['prefhum']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);

        $user->AddUser(BDD::getInstance());
        header('Location:/');
    }

    public function loginFrom(){
        unset($_SESSION['errorlogin']);

        return $this->twig->render('User/login.html.twig');
    }

    public function loginCheck()
    {

        $userall = new User();
        $Allemail = $userall->SqlGetAllemailUser(Bdd::GetInstance());

        $email_ok = false;

        foreach ($Allemail as $email) {
            if (strtolower(trim($_POST['email'])) == strtolower(trim($email))) {
                $email_ok = true;
            }
        }

        if ($email_ok == false) {
            $_SESSION['errorlogin'] = "Erreur dans l'email ou le mdp";
            header('Location:/Login');
            return;
        }


        $user = new User();
        $userInfoLog = $user->SqlGetLogin(Bdd::GetInstance(), ($_POST['email']));
        $userInfoLog['password'];

        if (strtolower(trim($_POST['password'])) ==  $userInfoLog['password']){
            $_SESSION['login'] = array("id" => $userInfoLog['ID_User'],
                "Prenom" => $userInfoLog['u_prenom'],
                "Nom" => $userInfoLog['u_nom'],
                "Email" => $userInfoLog['email']);
            header('Location:/');


        } else {
            echo 'Fail';
            $_SESSION['errorlogin'] = "Email ou Mot de passe false ";
            header('Location:/Login');

            return ;
        }
    }

    public function logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['errorlogin']);


        header('Location:/');
    }
}







