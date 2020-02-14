<?php

namespace src\Controller;

use src\Model\Bdd;
use src\Model\User;


class UserController extends  AbstractController
{


    public function Index(){
        return $this->AllUser();
    }

    public function Show($ID_User){
        // affiche un article seul
        $UserSQL = new User();
        $user = $UserSQL->SqlGetOneUser(BDD::getInstance(),$ID_User);

        return $this->twig->render('User/view.html.twig',[
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
        $user->SqlDeleteUser(BDD::getInstance(),$ID_User);

        header('Location:/User');
    }


    public function updateUser($ID_User){
        $userSQL = new User();
        $user = $userSQL->SqlGetOneUser(BDD::getInstance(),$ID_User);
        if ($_POST) {
            $sqlRepository = null;
            $user->setIdUser($_POST['ID_User']);
            $user->setUNom($_POST['u_nom']);
            $user->setUPrenom($_POST['u_prenom']);
            $user->setEmail($_POST['email']);

            $user->SqlUpdateUser(BDD::getInstance());
            header('Location:/User/List/');
        }


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
        $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));

        $user->SqlAddUser(BDD::getInstance());
        header('Location:/');
    }

    public function loginFrom(){
        unset($_SESSION['errorlogin']);

        return $this->twig->render('User/login.html.twig');
    }

    public function loginCheck()
    {

        /*$userall = new User();
        $Allemail = $userall->SqlGetAllemailUser(Bdd::GetInstance());
        $email_ok = false;

        foreach ($Allemail as $emailuser) {
            if (($_POST['email']) == ($emailuser)) {
                $email_ok = true;
            }
        }

        if ($email_ok == false) {
            $_SESSION['errorlogin'] = "Erreur dans l'email ou le mdp";
            header('Location:/Login');
            return;
        }*/




        $user = new User();
        $userInfoLog = $user->SqlGetUserLogin(Bdd::GetInstance(), ($_POST['email']));

        var_dump(password_verify($_POST['password'], $user->getPassword()));
        if(password_verify($_POST['password'], $user->getPassword())){
            $_SESSION['login'] = array(
                "id" => $userInfoLog['ID_User'],
                "Prenom" => $userInfoLog['u_prenom'],
                "Nom" => $userInfoLog['u_nom'],
                "Email" => $userInfoLog['email']);
            header('Location:/User/List');
            }
        else {

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







