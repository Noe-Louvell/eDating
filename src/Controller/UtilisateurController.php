<?php


namespace src\Controller;

use src\Model\Bdd;
use src\Model\Utilisateur;

class UtilisateurController
{
    public function OneUtilisateur($Id_Utilisateur){
        // affiche un article seul

        $utilisateur = new Utilisateur();
        $utilisateur->SqlGetOneUtilisateur(Bdd::GetInstance(),$Id_Utilisateur);

        //Lancer la vue TWIG
        return $this->twig->render('User/view.html.twig',[
            'user' => $utilisateur
        ]);
    }

}