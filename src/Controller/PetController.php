<?php


namespace src\Controller;

use src\Model\Bdd;
use src\Model\Pet;

class PetController extends  AbstractController
{
    public function AddPetView(){
        return $this->twig->render('Pet/newPet.html.twig');
    }
    public function AddPet(){
        $sqlRepository = null;


        $pet = new Pet();
        $pet->setIDPet($_POST['ID_Pet']);
        $pet->setIDRace($_POST['ID_Race']);
        $pet->setIDUser($_POST['ID_User']);
        $pet->setEntente($_POST['entente']);
        $pet->setCaractere($_POST['caractere']);
        $pet->setAPrenom($_POST['a_prenom']);
        $pet->setAAge($_POST['a_age']);


        $pet->AddPet(BDD::getInstance());
        header('Location:/');

    }
    public function DeleteOnePet($ID_Pet){
        $PetSQL = new Pet();
        $pet = $PetSQL->SqlGetOnePet(BDD::getInstance(),$ID_Pet);
        $pet->DeletePet(BDD::getInstance(),$ID_Pet);

        header('Location:/User');
    }

    public function UpdatePet($ID_Pet){
        $petSQL = new Pet();
        $pet = $petSQL->SqlGetOnePet(BDD::getInstance(),$ID_Pet);

        $pet->setIDPet($_POST['ID_Pet']);
        $pet->setIDRace($_POST['ID_Race']);
        $pet->setIDUser($_POST['ID_User']);
        $pet->setEntente($_POST['entente']);
        $pet->setCaractere($_POST['caractere']);
        $pet->setAPrenom($_POST['a_prenom']);
        $pet->setAAge($_POST['a_age']);


        $pet->UpdatePet(BDD::getInstance());


            return $this->twig->render('Pet/updatePet.html.twig',[
            'pet' => $pet
        ]);
    }

    public function ShowAllPet(){
            // affiche plusieurs utilisateurs
            $User = new Pet();
            $listUser = $User->SqlGetAllPet(Bdd::GetInstance());

            //Lancer la vue TWIG
            return $this->twig->render(
                'User/ListPet.html.twig',[
                    'UtilisateurList' => $listUser
                ]
            );

    }


}