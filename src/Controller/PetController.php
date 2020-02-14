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
        $pet = $PetSQL->SqlGetOnePet(BDD::getInstance(),$ID_Pet,$ID_User);
        $pet->DeletePet(BDD::getInstance(),$ID_Pet,$ID_User);

        header('Location:/User');
    }

    public function UpdatePet($ID_Pet,$ID_User){
        $petSQL = new Pet();
        $pet = $petSQL->SqlGetOnePet(BDD::getInstance(),$ID_Pet,$ID_User);

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

    public function SqlGetAllPet($ID_User){
            // affiche plusieurs Pet
            $Pet = new Pet();
            $listPet = $Pet->SqlGetAllPet(Bdd::GetInstance(),$ID_User);


            //Lancer la vue TWIG
            return $this->twig->render(
                'Pet/ListPet.html.twig',[
                    'PetList' => $listPet
                ]
            );

    }


}