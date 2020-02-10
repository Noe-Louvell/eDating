<?php

namespace src\Controller;

use src\Model\Bdd;
use src\Model\Utilisateur;

class UtilisateurController extends  AbstractController
{


    public function Index(){
        return $this->AllUtilisateur();
    }

    public function OneUtilisateur($ID_Utilisateur){
        // affiche un article seul

        $utilisateur = new Utilisateur();
        $utilisateur->SqlGetOneUtilisateur(Bdd::GetInstance(),$ID_Utilisateur);

        //Lancer la vue TWIG
        return $this->twig->render('/User/view.html.twig',[
            'utilisateur' => $utilisateur
        ]);
    }

    public function AllUtilisateur(){
        // affiche plusieurs utilisateurs
        $Utilisateur = new Utilisateur();
        $listUtilisateur = $Utilisateur->SqlGetAllUtilisateur(Bdd::GetInstance());

        //Lancer la vue TWIG
        return $this->twig->render(
            'User/list.html.twig',[
                'UtilisateurList' => $listUtilisateur
            ]
        );

    }
    public function Delete($ID_Utilisateur){
        $UtilisateurSQL = new Utilisateur();
        $utilisateur = $UtilisateurSQL->SqlGetOneUtilisateur(BDD::getInstance(),$ID_Utilisateur);
        $utilisateur->DeleteUtilisateur(BDD::getInstance(),$ID_Utilisateur);

        header('Location:/Utilisateur');
    }


    public function updateUtilisateur($ID_Utilisateur){
        $utilisateurSQL = new Utilisateur();
        $utilisateur = $utilisateurSQL->SqlGetOneUtilisateur(BDD::getInstance(),$ID_Utilisateur);

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
        ;

        $utilisateur->UpdateUtilisateur(BDD::getInstance());


        return $this->twig->render('User/update.html.twig',[
            'utilisateur' => $utilisateur
        ]);

                }







}