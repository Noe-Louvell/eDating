<<<<<<< HEAD
<?php


namespace src\Controller;

use src\Model\Bdd;
use src\Model\Utilisateur;

class UtilisateurController
{

=======
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

>>>>>>> 805a7a10d594772e4bd9e30df9ef2a7f564186e2
}