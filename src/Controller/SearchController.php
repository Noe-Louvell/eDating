<?php


namespace src\Controller;

use src\Model\Bdd;
use src\Model\Search;

class SearchController
{

    public function Search(){
        $search = new UsrSearch();

        $searchmot= strip_tags($_POST['search']);
        $listUser = $search->SqlSearch(Bdd::GetInstance(),$searchmot);

        return $this->twig->render('Search/list.html.twig',[
                'listUser' => $listUser
            ]
        );
    }



}