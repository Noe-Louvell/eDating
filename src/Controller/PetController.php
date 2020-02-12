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


}