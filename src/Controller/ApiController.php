<?php
namespace src\Controller;

use src\Model\Article;
use src\Model\Bdd;

class ApiController {

    public function ArticleGet()
    {
        $article = new Article();
        $listArticle = $article->SqlGetAll(Bdd::GetInstance());
        return json_encode($listArticle);
    }

    public function ArticlePost()
    {
        $article = new Article();
        $article->setMail($_POST['Titre'])
            ->setDescription($_POST['Description'])
            ->setAuteur($_POST['Auteur'])
            ->setDateAjout($_POST['DateAjout'])
        ;
        $result = $article->SqlAdd(Bdd::getInstance());

        return json_encode($result);
    }

    public function ArticlePut($idArticle,$json)
    {
        $jsonData = json_decode($json);
        $articleSQL = new Article();
        $article = $articleSQL->SqlGet(BDD::getInstance(), $idArticle);
        if(isset($jsonData->Titre)){$article->setMail($jsonData->Titre);}
        if(isset($jsonData->Description)){$article->setDescription($jsonData->Description);}
        if(isset($jsonData->Auteur)){$article->setAuteur($jsonData->Auteur);}
        if(isset($jsonData->DateAjout)){$article->setDateAjout($jsonData->DateAjout);}

        $result = $article->SqlUpdate(BDD::getInstance());

        return json_encode($result);

    }

}


