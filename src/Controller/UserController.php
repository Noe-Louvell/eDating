<?php
namespace src\Controller;

use src\Model\User;
use src\Model\Bdd;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

Class UserController extends AbstractController {

    public function login(){
        try {
            return $this->twig->render(
                'User/login.html.twig');
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
        return $this;
    }

    public function checkLogin(){
        $user = new User();
        if($user->SqlLogin(Bdd::GetInstance())){
            echo 'affiche la vue twig profil';
        }else{
            echo 'affiche la vue twig login';
        }

    }

    public function register(){
        echo 'Register';
    }
}